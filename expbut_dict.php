<?php

$db = pg_connect("host=localhost port=5432 dbname=postgres user=amolivani");
$tbname = $_GET['tableName'];
 // Connect to the Database
if (isset($_POST["Export"])) {
//get records from database
header('Content-Type: text/csv;');
header('Content-Disposition: attachment; filename='.$tbname.'.csv');
$fp = fopen("php://output", "w");
fputcsv($fp, array('common_name','column_description','code_def','add_notes'));

$q = 'select * from '.$tbname;
$query = pg_query($q);

//$filename = "ReadMe_" . date('Y-m-d') . ".csv";

while($row = pg_fetch_assoc($query)) {
    fputcsv($fp, $row);
}


fclose($fp);
}

?>