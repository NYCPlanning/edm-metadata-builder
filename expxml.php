<?php
include('sqltoxml.php');
include 'config.php';
header('content-type: text/xml');
header('Content-Disposition: attachment; filename=ReadMe.xml');
?>
<DOCUMENT>
<?php 
sql2xml("SELECT * from ReadMe");?>
</DOCUMENT>
