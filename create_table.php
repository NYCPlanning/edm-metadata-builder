<?php
include 'config.php';
// Trim white spaces
$common_name_normalize = trim($_POST['common_name']);
$sde_name_normalize = trim($_POST['sde_name']);
// Replace space with underscore
$sde_name_underscore =  str_replace(' ', '_', $sde_name_normalize);

$query = "INSERT INTO ReadMe(common_name, sde_name) VALUES ('$common_name_normalize','$sde_name_normalize');";
$query .= "CREATE TABLE $sde_name_underscore (
                  uid serial PRIMARY key NOT NULL,
                  orders int,
                  field_name text,
                  longform_name text,
                  description text,
                  geocoded boolean,
                  required boolean,
                  data_type text,
                  expected_allowed_values text,
                  last_modified_date text,
                  no_longer_in_use text,
                  notes text
                );";
pg_query($query);

$id = "SELECT uid FROM readme WHERE sde_name = $sde_name_normalize";



header('location: import_metadata.php');
?>
