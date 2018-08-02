<?php

include 'config.php';
$tbname = $_GET['selection'];
 // Connect to the Database
if (isset($_POST["Export"])) {
//get records from database
header('Content-Type: text/csv;');
header('Content-Disposition: attachment; filename='.$tbname.'.csv');
$fp = fopen("php://output", "w");
fputcsv($fp, array('common_name','sde_name','tags','summary','description',' data_steward','data_engineer','credits','use_limitations','update_freq','date_last_update','date_underlying_data','data_source','version','common_uses','data_quality','caveats','future_plans','distribution'));

$q = "SELECT * from ReadMe where sde_name = '".$tbname."'";

$query = pg_query($q);

//$filename = "ReadMe_" . date('Y-m-d') . ".csv";

while($row = pg_fetch_assoc($query)) {
    fputcsv($fp, $row);
}


fclose($fp);
}

?>



