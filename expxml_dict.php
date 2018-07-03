<?php
include('sqltoxml.php');
$db = pg_connect("host=localhost port=5432 dbname=postgres user=amolivani");
$tbname = $_GET['tableName'];
header('content-type: text/xml');
header('Content-Disposition: attachment; filename='.$tbname.'.xml');
?>
<DOCUMENT>
<?php 
$tbname = $_GET['tableName'];
sql2xml('select * from '.$tbname);?>
</DOCUMENT>
