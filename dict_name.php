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
include ('navbar.php');
?>

<!-- html form to enter the data dictionary table name to be created
 --><!DOCTYPE html>
<body style="background-color:white;">
<style>
  * {
    box-sizing: border-box;
  }

  body {
    font-family: Arial, Helvetica, sans-serif;
  }

/* Style the header */
  .header {
    padding: 15px;
    text-align: center;
    font-size: 15px;
    display: block;

  }

  .clearfix {
    overflow: auto;
}

  .img {
  background-color: #fff;
  width: 50px;
  height: 50px;
  display: block;
  vertical-align: middle;
  }

</style>
<body style="background-color: white; background-repeat: no-repeat; height: 100%; background-position: center;
  background-size: cover;
  position: relative; ">
  <div class="header">
<div class="clearfix">
 <h1 align="center" style="display: inline;">Data Dictionary</h1>
</div>
</div>
<br>

<ul>
<form name="dict_name" method="POST" >
<li>Enter name of the table to be created:</li><li><input type="text" name="nameid" style="height: 50px; width: 300px;border: 1px solid #D96B27" required/></li>
 <br>
 <br>

 <li><input type="submit" name="dictname-submit" value="Create Table" style="border: 1px solid #D96B27; color: #D96B27" /></li>
 <style>
li {
list-style: none;
}
</style>
</form>
</ul>
