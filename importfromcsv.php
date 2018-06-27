<?php  

//connect to the database $db = pg_connect("host=localhost port=5432 dbname=postgres user=amolivani");
try { 
    $db = new PDO("pgsql:dbname=postgres;host=localhost","amolivani");
}   
catch(PDOException $e) {
    echo $e->getMessage();
}

// 

//if ($_FILES[csv][size] > 0) { 

    //get the csv file 
    $file = $_FILES[csv][tmp_name]; 
    $handle = fopen($file,"r"); 


while (!feof($handle) ) {

    $text_file = fgetcsv($handle);

    //print_r($text_file);
$query=<<<eof
INSERT INTO info VALUES ('$text_file[0]','$text_file[1]')
eof;
$sth = $db->query($query);
}
if (!$sth) {
    echo "<p>\nPDO::errorInfo():\n</p>";
    print_r($db->errorInfo());
} 
fclose($handle);

echo "<p><b>Choose File to Import Data from</b></p>";



?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> 
<title>Import a CSV File with PHP & Postgres</title> 
</head> 

<body> 

<?php if (!empty($_GET[success])) { echo "<b>Your file has been imported.</b><br><br>"; } //generic success notice ?> 

<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1"> 
  Choose your file: <br /> 
  <input name="csv" type="file" id="csv" /> 
  <input type="submit" name="Submit" value="Submit" /> 
</form> 

</body> 
</html> 