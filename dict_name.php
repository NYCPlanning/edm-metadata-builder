<!DOCTYPE html>
<head>
<title>Insert data to PostgreSQL with php - creating a simple web application</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

</head>
<body>
<h2>Enter table name to be created</h2>
<ul>
<form name="dict_name" method="POST" >
<li>Name:</li><li><input type="text" name="nameid" /></li>
<!-- <li>Address:</li><li><input type="text" name="addressid" /></li>
 --><br>
 <li><input type="submit" name="dictname-submit" value="Create Table" /></li>
 <style>
li {
list-style: none;
}
</style>
</form>
</ul>


<form name="dict_data" method="POST">
<label>Column Name:</label>
<input type="text" name="col_name" maxlength="30" value="" />
<label>Column Description:</label> 
<input type="text" name="col_des" maxlength="500" value="" />
<label>Term, Acronym or Code Definition:</label> 
<input type="text" name="cd" maxlength="100" value="" />
<label>Additional Notes:</label> 
<input type="text" name="add_notes" maxlength="500" value="" />

<input type="submit" name="submit" value="Insert Data" />
<style type="text/css">
input, label {
    float:left;
    margin:5px;
}
</style>
</form>
</body>
</html>

<?php

if (!empty($_POST['dictname-submit']) && (!empty($_POST['submit']))) {
$db = pg_connect("host=localhost port=5432 dbname=postgres user=amolivani");
$query = "CREATE TABLE $_POST[nameid] (
column_name text,
column_description text,
code_def text,
add_notes text
)";
$result = pg_query($query); 
$query = "INSERT INTO $_POST[nameid] VALUES ('$_POST[col_name]','$_POST[col_des]','$_POST[cd]','$_POST[add_notes]')";
$result = pg_query($query);
}
?>

<!-- // if (empty($_POST['dictname-submit'])) {
// if (!empty($_POST['submit'])) {
// $db = pg_connect("host=localhost port=5432 dbname=postgres user=amolivani");
// $query = "INSERT INTO $_POST[nameid] VALUES ('$_POST[col_name]','$_POST[col_des]','$_POST[cd]','$_POST[add_notes]')";
// $result = pg_query($query); 
// }
// } -->



