<?php

//this code exports the table into the Esri accepted xml format

include 'config.php'; //connect to database
$uid = $_GET['id'];
$tbname = $_GET['tbname'];

//the file extension to be downloaded and the file name is passed through the header
header('content-type: text/xml');
header('Content-Disposition: attachment; filename='.$tbname.'.xml');

if (isset($_POST["export-sde"])) {

//creating a temporary table temp so as to get the xml in the Esri accepatble format

$r = "CREATE TABLE temp AS
       (
       SELECT common_name AS title,
              tags_guide AS themekey ,
              summary||summary_update_date AS purpose,
              description||description_data_loc AS abstract,
              credits AS datacred,
              genconst AS useconst,
              legconst AS accconst,
              update_freq AS update,
              version AS edition,
              date_last_update AS pubdate,
              rpoc_contact_position AS cntpos,
              processing_env AS native,
              fgdc_geo_format AS geoform,
              series_name AS sername,
              common_name AS issue,
              contact AS publish,
              data_source AS othercit,
              spatial_repre_type AS direct,
              sdp_vector_object_count AS ptvctcnt,
              arcgis_item_prop_name AS enttypl,
              sr_geo_coor_ref AS horizdn,
              sr_projection AS mapprojn,
              caveats AS complete,
              terms_fees AS fees,
              dis_transfer_option_location AS onlink,
              dis_transfer_option_description AS resdesc,
              extent AS bounding
              FROM readme
		WHERE uid = '".$uid."')";

$table = pg_query($r);

$fp = fopen("php://output", 'w'); //opening the xml fille to be downloaded

//the following query uses Postgres XML functions. '\' is added to maintain Mixed Case.

$q = "SELECT
xmlelement(name metadata,
  xmlelement(name idinfo,
    xmlelement(name citation,
      XMLELEMENT (name citeinfo,
        XMLAGG (XMLFOREST (title, edition, pubdate, geoform, othercit, onlink)),
        XMLELEMENT (name serinfo,
         XMLAGG (XMLFOREST (sername, issue))),
         XMLELEMENT (name pubinfo,
          XMLAGG (XMLFOREST (publish))))),
      XMLELEMENT (name descript,
        XMLAGG (XMLFOREST (purpose, abstract ))),
      XMLELEMENT (name status,
        XMLAGG (XMLFOREST (update))),
      XMLELEMENT (name spdom,
        XMLAGG (XMLFOREST (bounding))),
      xmlelement(name keywords,
       XMLELEMENT (name theme,
         XMLAGG (XMLFOREST (themekey)))),
           XMLAGG (XMLFOREST (datacred)),
           XMLAGG (XMLFOREST (native)),
           XMLAGG (XMLFOREST (accconst)),
           XMLAGG (XMLFOREST (useconst)),
         XMLELEMENT (name ptcontac,
           XMLELEMENT (name cntinfo,
             XMLELEMENT (name cntorgp,
               XMLAGG (XMLFOREST ('NYC Department of City Planning' AS cntorg))),
             XMLELEMENT (name cntaddr,
               XMLAGG (XMLFOREST ('mailing and physical' AS addrtype)),
               XMLAGG (XMLFOREST ('120 Broadway, 31st Floor' AS address)),
               XMLAGG (XMLFOREST ('New York' AS city)),
               XMLAGG (XMLFOREST ('New York' AS state)),
               XMLAGG (XMLFOREST ('10271' AS postal))),
               XMLAGG (XMLFOREST ('DCPopendata@planning.nyc.gov' AS cntemail))))
       ),

       XMLELEMENT (name dataqual,
          XMLAGG (XMLFOREST (complete))
      ),

      XMLELEMENT (name spdoinfo,
          XMLAGG (XMLFOREST (direct)),
          XMLELEMENT (name ptvctinf,
            XMLELEMENT (name sdtsterm,
              XMLAGG (XMLFOREST (ptvctcnt))))
     ),

       XMLELEMENT (name spref,
           XMLELEMENT (name horizsys,
             XMLELEMENT (name planar,
               XMLELEMENT (name mapproj,
                 XMLAGG (XMLFOREST (mapprojn)))
             ),
             XMLELEMENT (name geodetic,
               XMLAGG (XMLFOREST (horizdn))))

       ),
       XMLELEMENT (name eainfo,
           XMLELEMENT (name detailed,
             XMLELEMENT (name enttyp,
               XMLAGG (XMLFOREST (enttypl))))
      ),


  XMLELEMENT (name distinfo,
     XMLELEMENT (name distrib,
       XMLELEMENT (name cntinfo,
         XMLELEMENT (name cntorgp,
           XMLAGG (XMLFOREST ('NYC Department of City Planning' AS cntorg))),
         XMLELEMENT (name cntaddr,
           XMLAGG (XMLFOREST ('mailing and physical' AS addrtype)),
           XMLAGG (XMLFOREST ('120 Broadway' AS address)),
           XMLAGG (XMLFOREST ('New York' AS city)),
           XMLAGG (XMLFOREST ('New York' AS state)),
           XMLAGG (XMLFOREST ('10007' AS postal)),
           XMLAGG (XMLFOREST ('US' AS country))))),
      XMLAGG (XMLFOREST (resdesc)),
      XMLELEMENT (name stdorder,
        XMLAGG (XMLFOREST (fees)))
  ),
  XMLELEMENT (name metc,
      XMLELEMENT (name cntinfo,
        XMLELEMENT (name cntorgp,
          XMLAGG (XMLFOREST ('NYC Department of City Planning' AS cntorg))),
          XMLAGG (XMLFOREST (cntpos)),
        XMLELEMENT (name cntaddr,
          XMLAGG (XMLFOREST ('mailing and physical' AS addrtype)),
          XMLAGG (XMLFOREST ('120 Broadway, 31st Floor' AS address)),
          XMLAGG (XMLFOREST ('New York' AS city)),
          XMLAGG (XMLFOREST ('New York' AS state)),
          XMLAGG (XMLFOREST ('10271' AS postal))),
          XMLAGG (XMLFOREST ('DCPopendata@planning.nyc.gov' AS cntemail)))
  )
)
FROM temp";
$query = pg_query($q);

//fetching the results and writing it into the xml file opened

while($row = pg_fetch_row($query)) {
    echo $row[0];
}

fclose($fp);

//dropping the temporary table

$d = "DROP TABLE temp";

$drop = pg_query($d);



}


?>
