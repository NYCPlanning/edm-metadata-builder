<?php
include 'config.php';
// Trim white spaces
$common_name_normalize = trim($_POST['common_name']);
$sde_name_normalize = trim($_POST['sde_name']);
// Replace space with underscore
$sde_name_underscore =  str_replace(' ', '_', $sde_name_normalize);

$query = "INSERT INTO ReadMe(common_name, sde_name) VALUES ('$common_name_normalize','$sde_name_normalize');";
$query .= "CREATE TABLE $sde_name_underscore (
                  column_name text,
                  column_description text,
                  code_def text,
                  add_notes text,
                  internal_notes text
                );";
pg_query($query);

$id = "SELECT uid FROM readme WHERE sde_name = $sde_name_normalize";



header('location: import_metadata.php');
?>
