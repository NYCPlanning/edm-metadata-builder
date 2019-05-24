<?php

// Editing row in data dictionary
if(isset($_GET['save-submit'])) {
  $id = $_GET['s0'];
  $sde = $_GET['sde_table'];
  $sql = "UPDATE $sde
          SET orders = '" . $_GET['s1'] . "',
              field_name    = '" . $_GET['s2'] . "',
              longform_name = '" . $_GET['s3'] . "',
              description  = '" . $_GET['s4'] . "',
              geocoded = '" . $_GET['s5'] . "',
              required = '" . $_GET['s6']. "',
              data_type = '" . $_GET['s7'] . "',
              expected_allowed_values = '" . $_GET['s8'] . "',
              last_modified_date = '" . $_GET['s9'] . "',
              no_longer_in_use = '" . $_GET['s10'] . "',
              notes = '" . $_GET['s11'] . "'
              WHERE uid = $id ";
  pg_query($sql);

}


// add new row in data dictionary
$uid_focus;
if(isset($_GET['add_row'])) {
  $sde = $_GET['sde_table'];
  $sql_add = "INSERT INTO $sde (orders,field_name,longform_name,description,geocoded,required,data_type,expected_allowed_values,last_modified_date,no_longer_in_use,notes)
          VALUES ('','','','','','','','','','','')";

  pg_query($sql_add);

  $dd_query = "SELECT uid FROM $sde ORDER BY uid DESC LIMIT 1";

  $dd_results = pg_query($dd_query);
  $dd_row = pg_fetch_assoc($dd_results);

}


?>
