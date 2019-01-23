<?php
include 'config.php';
$sde_underscore = $_GET['$sde_underscore'];
 // Connect to the Database
if (isset($_POST["Export"])) {
//get records from database
header('Content-Type: text/csv;');
header('Content-Disposition: attachment; filename='.$sde_underscore .'.csv'); //this dowloads the csv file with the given name
//opening the csv file to be downloaded
$fp = fopen("php://output", "w");
fputcsv($fp, array('uid','common_name','column_description','code_def','add_notes','internal_notes'));
$q = 'select * from '.$sde_underscore ;
$query = pg_query($q);
//fetching values to write into the csv file
while($row = pg_fetch_assoc($query)) {
    fputcsv($fp, $row);
}
fclose($fp);
}
?>
