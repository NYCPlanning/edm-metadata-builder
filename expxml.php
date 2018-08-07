<?php
include('sqltoxml.php'); //this file contains the code to convert the table values to an xml format
include 'config.php';

//the header contains the file name and extension of the xml file to be downloaded

header('content-type: text/xml');
header('Content-Disposition: attachment; filename=ReadMe.xml');
?>
<DOCUMENT>
<?php 
sql2xml("SELECT * from ReadMe");?>
</DOCUMENT>
