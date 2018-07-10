<?php
include('sqltoxml.php');
$db = pg_connect("host=localhost port=5432 dbname=postgres user=amolivani");
$tbname = $_GET['selection'];
header('content-type: text/xml');
header('Content-Disposition: attachment; filename='.$tbname.'.xml');
?>
<DOCUMENT>
<?php 
$tbname = $_GET['selection'];
sql2xml("SELECT * FROM readme WHERE common_name = '". $tbname ."'");?>
</DOCUMENT>



 