<?php
include('sqltoxml.php');
include 'config.php';
$tbname = $_GET['selection'];
header('content-type: text/xml');
header('Content-Disposition: attachment; filename='.$tbname.'.xml');
?>
<DOCUMENT>
<?php 
$tbname = $_GET['selection'];
sql2xml("SELECT * FROM readme WHERE sde_name = '". $tbname ."'");?>
</DOCUMENT>



 