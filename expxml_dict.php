<?php
include('sqltoxml.php'); //code for coverting a table into xml
include 'config.php'; //connect to database
$tbname = $_GET['tableName'];

//the header is used to download the xml file with the name passed in the header

header('content-type: text/xml'); 
header('Content-Disposition: attachment; filename='.$tbname.'.xml');
?>
<DOCUMENT>
<?php 
$tbname = $_GET['tableName'];
sql2xml('select * from '.$tbname);?>
</DOCUMENT>
