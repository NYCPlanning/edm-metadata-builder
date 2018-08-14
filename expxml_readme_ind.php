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
		(SELECT common_name AS \"resTitle\", tags AS \"keyword\", summary AS \"idPurp\", description AS \"idAbs\", credits AS \"idCredit\", use_limitations AS \"useLimit\", date_underlying_data AS \"otherCitDet\", version AS \"idVersion\", (SELECT b.tag FROM readme a, maintfreq b WHERE a.update_freq = b.maintfreq AND a.sde_name = '".$tbname."')::text AS \"MaintFreq\",'2018'::text AS \"CreaDate\", '00:00'::text AS \"CreaTime\", '1.0'::text AS \"ArcGISFormat\", 'TRUE'::text AS \"SyncOnce\", 'ISO 19139 Metadata Implementation Specification'::text AS \"ArcGISstyle\", '150000000'::text AS \"minScale\", '5000'::text AS \"maxScale\"
				FROM readme
				WHERE sde_name = '".$tbname."')";
$table = pg_query($r);

$fp = fopen("php://output", 'w'); //opening the xml fille to be downloaded

//the following query uses Postgres XML functions. '\' is added to maintain Mixed Case.

$q = "SELECT xmlelement(name metadata, 
XMLELEMENT(name \"Esri\", XMLAGG (XMLFOREST (\"CreaDate\", \"CreaTime\",\"ArcGISFormat\", \"SyncOnce\", \"ArcGISstyle\" )),
       xmlelement(
       name \"scaleRange\",
       XMLAGG (XMLFOREST (\"minScale\",\"maxScale\")))),
       xmlelement(
       name \"dataIdInfo\",
       XMLAGG (XMLFOREST (\"idPurp\", \"idAbs\" )),
       xmlelement(
       name \"searchKeys\",
       XMLAGG (XMLFOREST (keyword))),
       xmlelement(
       name \"idCitation\",
       XMLAGG (XMLFOREST (\"resTitle\"))),
       xmlelement(
       name \"resConst\",
       xmlelement(
       name \"Consts\",
       XMLAGG (XMLFOREST (\"useLimit\")))),
       xmlelement(
       name \"resMaint\",
       xmlelement(
       name \"maintFreq\",
       xmlelement(name \"MaintFreqCd\", xmlattributes(\"MaintFreq\" AS value))))),
       xmlelement(
       name \"mdHrLv\",
       xmlelement(name \"ScopeCd\", xmlattributes('005' AS value))),
       xmlelement(
       name \"refSysInfo\",
       xmlelement(
       name \"RefSystem\",
       xmlelement(
       name \"refSysID\",
       XMLAGG (XMLFOREST (\"idVersion\"))))),
       xmlelement(
       name \"mdMaint\",
       xmlelement(
       name \"maintFreq\",
       xmlelement(name \"MaintFreqCd\", xmlattributes(\"MaintFreq\" AS value))))

)

FROM temp
GROUP BY \"MaintFreq\" ";
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



