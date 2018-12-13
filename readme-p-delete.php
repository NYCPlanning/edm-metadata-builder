<?php
include 'config.php';
    $id = $_GET['id'];
    $sql = "DELETE FROM readme WHERE uid = $id";
    $result = pg_query($sql);

    pg_free_result($result);
    header('location: readme-p.php');
?>
