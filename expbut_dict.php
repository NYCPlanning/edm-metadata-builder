<?php

include 'config.php';
$tbname = $_GET['tableName'];
 // Connect to the Database
if (isset($_POST["Export"])) {
//get records from database
header('Content-Type: text/csv;');
header('Content-Disposition: attachment; filename='.$tbname.'.csv'); //this dowloads the csv file with the given name

//opening the csv file to be downloaded
$fp = fopen("php://output", "w");
fputcsv($fp, array('common_name','column_description','code_def','add_notes','internal_notes'));

$q = 'select * from '.$tbname;
$query = pg_query($q);

//fetching values to write into the csv file
while($row = pg_fetch_assoc($query)) {
    fputcsv($fp, $row);
}


fclose($fp);
}

?>