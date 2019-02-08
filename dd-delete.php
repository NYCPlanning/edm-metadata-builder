<?php
include 'config.php';
if (isset($_GET['delete-id'])) {
    $delete_id = $_GET['delete-id'];
    $table = $_GET['tbname'];
    $delete_sql = "DELETE FROM $table WHERE uid = $delete_id";
    pg_query($delete_sql);
}

?>
