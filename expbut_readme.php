<?php

include 'config.php';
$uid = $_GET['id'];
$tbname = $_GET['tbname'];
 // Connect to the Database
if (isset($_POST["Export"])) {
//the header is used to download the csv file with the name passed in the header
header('Content-Type: text/csv;');
header('Content-Disposition: attachment; filename='.$tbname.'.csv'); //

//opening the csv file that is to be downloaded
$fp = fopen("php://output", "w");

//adding the column names to the csv file
fputcsv($fp, array('uid','common_name','sde_name','tags_guide','tags_sde','summary','summary_update_date','description','description_data_loc',' data_steward','data_engineer','credits','genconst','legconst','update_freq','date_last_update','date_underlying_data','data_source','version','common_uses','data_quality','caveats','future_plans','distribution','contact'));

$q = "SELECT * from ReadMe where uid= '".$uid."'";

$query = pg_query($q);

//fetching the values from the table to be inserted into the csv file

while($row = pg_fetch_assoc($query)) {
    fputcsv($fp, $row);
}


fclose($fp);
}

?>
