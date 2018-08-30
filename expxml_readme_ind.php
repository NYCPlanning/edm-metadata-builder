<?php

//this code exports the table into the Esri accepted xml format

include 'config.php'; //connect to database
$tbname = $_GET['selection'];

//the file extension to be downloaded and the file name is passed through the header 
header('content-type: text/xml');
header('Content-Disposition: attachment; filename='.$tbname.'.xml');
$tbname = $_GET['selection'];

if (isset($_POST["Expor2xml"])) {

//creating a temporary table temp so as to get the xml in the Esri accepatble format

$r = "CREATE TABLE temp AS
       (
       SELECT common_name AS title, tags_guide||tags_sde AS themekey , summary||summary_update_date AS purpose, description||description_data_loc AS abstract, credits AS datacred, genconst AS useconst, legconst AS distliab, update_freq AS update, version AS edition
              FROM readme
		WHERE sde_name = '".$tbname."')";

$table = pg_query($r);

$fp = fopen("php://output", 'w'); //opening the xml fille to be downloaded

//the following query uses Postgres XML functions. '\' is added to maintain Mixed Case.

$q = "SELECT xmlelement(name metadata, 
xmlelement(
       name idinfo,
       XMLELEMENT (name descript,
       XMLAGG (XMLFOREST (purpose, abstract ))),
       xmlelement(
       name keywords,
       XMLELEMENT (name theme,
       XMLAGG (XMLFOREST (themekey)))),
       xmlelement(
       name citation,
       XMLELEMENT (name citeinfo,
       XMLAGG (XMLFOREST (title, edition)))),
       XMLAGG (XMLFOREST (datacred)),
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
       XMLAGG (XMLFOREST ('DCPopendata@planning.nyc.gov' AS cntemail)))),
       XMLELEMENT (name status,
       XMLAGG (XMLFOREST (update)))
       ),
XMLELEMENT (name metc,
       XMLELEMENT (name cntinfo, 
       XMLELEMENT (name cntorgp,
       XMLAGG (XMLFOREST ('NYC Department of City Planning' AS cntorg))),
       XMLELEMENT (name cntaddr,
       XMLAGG (XMLFOREST ('mailing and physical' AS addrtype)),
       XMLAGG (XMLFOREST ('120 Broadway, 31st Floor' AS address)),
       XMLAGG (XMLFOREST ('New York' AS city)),
       XMLAGG (XMLFOREST ('New York' AS state)),
       XMLAGG (XMLFOREST ('10271' AS postal))),
       XMLAGG (XMLFOREST ('DCPopendata@planning.nyc.gov' AS cntemail)))
),
XMLELEMENT (name distinfo, 
XMLAGG (XMLFOREST (distliab))
))
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



