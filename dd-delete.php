<?php
include 'config.php';
    $delete_id = $_POST['delete-id'];
    $table = $_POST['tbname'];
    $delete_sql = "DELETE FROM $table WHERE uid = $delete_id";
    pg_query($delete_sql);


?>
