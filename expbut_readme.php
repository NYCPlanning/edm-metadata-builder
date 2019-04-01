<?php
// Connect to the Database
include 'config.php';
// Getting the unique id and tbname
$uid = $_GET['id'];
$tbname = $_GET['tbname'];

// If export all data is pressed
if (isset($_POST["export-all"])) {
  //the header is used to download the csv file with the name passed in the header
  header('Content-Type: text/csv;');
  header('Content-Disposition: attachment; filename='.$tbname.'.csv'); //
  //opening the csv file that is to be downloaded
  $fp = fopen("php://output", "w");
  //adding the column names to the csv file
  fputcsv($fp, array('uid','common_name','sde_name','tags_guide','tags_sde','summary','summary_update_date','description','description_data_loc',' data_steward','data_engineer',
                     'credits','genconst','legconst','update_freq','date_last_update','date_underlying_data','data_source','version','common_uses','data_quality',
                     'caveats','future_plans','distribution','contact','date_last_updated','dates_input_dataset','extent','fgdc_geo_format','series_name','series_issue',
                     'spatial_repre_type','processing_env','arcgis_item_prop_name','rpoc_contact_position','rpoc_address','sr_geo_coor_ref','sr_projection','terms_fees',
                     'dis_transfer_option_location','dis_transfer_option_description','responsible_party_name','sdp_vector_object_count','data_access'));
  // Getting the entire row that matches the uid
  $q = "SELECT * from ReadMe where uid= '".$uid."'";
  $query = pg_query($q);
  //fetching the values from the table to be inserted into the csv file
  while($row = pg_fetch_assoc($query)) {
      fputcsv($fp, $row);
  }
  fclose($fp);
  // if export template is pressed
} else if (isset($_POST["export-template"])) {
  header('Content-Type: text/csv;');
  header('Content-Disposition: attachment; filename=template.csv');
  $fp = fopen("php://output", "w");
  fputcsv($fp, array('uid','common_name','sde_name','tags_guide','tags_sde','summary','summary_update_date','description','description_data_loc',' data_steward','data_engineer',
                     'credits','genconst','legconst','update_freq','date_last_update','date_underlying_data','data_source','version','common_uses','data_quality',
                     'caveats','future_plans','distribution','contact','date_last_updated','dates_input_dataset','extent','fgdc_geo_format','series_name','series_issue',
                     'spatial_repre_type','processing_env','arcgis_item_prop_name','rpoc_contact_position','rpoc_address','sr_geo_coor_ref','sr_projection','terms_fees',
                     'dis_transfer_option_location','dis_transfer_option_description','responsible_party_name','sdp_vector_object_count','data_access'));
  fclose($fp);
}
?>
