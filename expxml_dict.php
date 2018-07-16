<?php
include('sqltoxml.php');
include 'config.php';
$tbname = $_GET['tableName'];
header('content-type: text/xml');
header('Content-Disposition: attachment; filename='.$tbname.'.xml');
?>
<DOCUMENT>
<?php 
$tbname = $_GET['tableName'];
sql2xml('select * from '.$tbname);?>
</DOCUMENT>
