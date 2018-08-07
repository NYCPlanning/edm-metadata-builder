<?php

//this code is to drop the table while uploading data through a csv file and it already exists. If the user clicks ok on the popup of dict_csv, it redirects to this page to drop the table

include 'config.php';
$tbname = $_GET['tableName'];
$query = "DROP TABLE ".$tbname;
$result = pg_query($query);
if ($result)
{
 echo "Table Droped";
}

?>

<body style="background-color:ivory;"> 

<form action="dict_csv.php" method="POST" >
    <br>
    <input type="submit" value="Back" style="font-size:75%;color:green"/>
  </form>
  <style>
 form {
  text-align: left;
  vertical-align: middle;
  font-family: tahoma; 
  color: black;
  font-size:150%;

}
</style>
</body>