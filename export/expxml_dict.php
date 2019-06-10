<?php
include('../sqltoxml.php'); //code for coverting a table into xml
include '../config.php'; //connect to database
$sde_underscore = $_GET['sde_underscore'];
//the header is used to download the xml file with the name passed in the header
header('content-type: text/xml');
header('Content-Disposition: attachment; filename='.$sde_underscore.'.xml');
?>
<DOCUMENT>
<?php
sql2xml('select * from '.$sde_underscore);?>
</DOCUMENT>
