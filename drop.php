<?php
$db = pg_connect("host=localhost port=5432 dbname=postgres user=amolivani");
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