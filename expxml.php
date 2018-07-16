<?php
include('sqltoxml.php');
include 'config.php';
header('content-type: text/xml');
header('Content-Disposition: attachment; filename=ReadMe.xml');
?>
<DOCUMENT>
<?php 
sql2xml("select * from ReadMe");?>
</DOCUMENT>
