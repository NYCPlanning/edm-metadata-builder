<?php

include 'config.php'; //inluding the db connection 
$tableName = $_POST['nameid']; //accepting the table name entered in the html form below as $tableName variable

if (!empty($_POST['dictname-submit']))  { //condition only if submit button is clicked
//creating table with the table name inputted
$query = "CREATE TABLE $tableName (
column_name text,
column_description text,
code_def text,
add_notes text,
internal_notes text
)";
$result = pg_query($query); //executing the query
if ($result) {
        header("Location: dict_name-p2.php?tableName=".$tableName); //if there is no error in query execution it passes the table name in the header as a variable to the next php page 
    }
    else{
        //if the query fails, it means it threw an error that the table already exits 
        $message = "Table already exits. Do you want to insert data into the existing Table?"; //popup for error
        //checking if the user wants to insert data in the same table by clicking ok or going back to change the table name by clicking cancel
        //if the user wants to insert in the same table then the table name is passed as a variable value in the header to the next php page else it stays on the same page to enter new table name.
        echo "<script type='text/javascript'>var r = confirm('$message');
        if(r == true)
        {
          window.location.href = 'dict_name-p2.php?tableName=$tableName';
        }
        else
        {
          window.location.href = 'dict_name.php'; 
        }
         </script>";
    }
}

?>

<!-- html form to enter the data dictionary table name to be created
 --><!DOCTYPE html>
<body style="background-color:ivory;"> 
<h2>Enter table name to be created</h2>
<ul>
<form name="dict_name" method="POST" >
<li>Name:</li><li><input type="text" name="nameid" required/></li>
 <br>
 <li><input type="submit" name="dictname-submit" value="Create Table" /></li>
 <style>
li {
list-style: none;
}
</style>
</form>
</ul>





