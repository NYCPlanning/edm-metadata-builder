<?php

$tbname = $_GET['tableName']; //getting the variable value of the table name that was created and passed through the header by the previous php page 
include 'config.php'; //including the db connection details
if (!empty($_POST['submit'])) {
$query = "INSERT INTO ".$tbname." VALUES ('$_POST[col_name]','$_POST[col_des]','$_POST[cd]','$_POST[add_notes]', '$_POST[internal_notes]')";
$result = pg_query($query); 
}
?>

<!-- the following html code creates a form for Data Dictionary -->

<!DOCTYPE html>
<head>
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
    background-color: #D96B27;
    padding: 15px;
    text-align: center;
    font-size: 15px;
    color: #fff;
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
<img class="img" src="logo.png" style="display: inline; float: left;"> <h1 align="center" style="color: #fff; display: inline;"></h1>
</div>
</div>
<br> 
 <!-- just indenting -->

<h4>Insert values:</h4>
<form name="dict_data" action="dict_name-p2.php?tableName=<?php echo $tbname;?>" method="POST">
<label>Column Name:</label>
<input type="text" name="col_name" maxlength="50" value="" required />
<label>Column Description:</label> 
<input type="text" name="col_des" maxlength="1000" value="" />
<label>Term, Acronym or Code Definition:</label> 
<input type="text" name="cd" maxlength="500" value="" />
<label>Additional Notes:</label> 
<input type="text" name="add_notes" maxlength="1000" value="" />
<label>Internal Notes:</label> 
<input type="text" name="internal_notes" maxlength="1000" value="" />

<input type="submit" name="submit" value="Insert Data" />
<style type="text/css">
input{
    float:left;
    margin:2px;
    width: 90px;
    color: #D96B27;
    border: 1px solid #D96B27;
    height: 20px;
}

label{
    float:left;
    margin:6px;
    color: #D96B27;
}
</style>
</form>
<br>
<br>
<br>
</body>
</head>
<html>


<?php

//the following php code is for displaying the table contents on the same page

$tbname = $_GET['tableName']; //getting the variable value of the table name that was created and passed through the header by the previous php page 
include 'config.php';

$query = "select * from ".$tbname;

$result = pg_query($query);

$i = 0;

// code for creating a table structure using css

echo '<html><body><style>
table, td, th {    
    border: 0.5px solid #D96B27;
    text-align: left;
}

th, td {
    padding: 10px;
} </style><table align="center"><tr>';

//fetching the column names of the db table

while ($i < pg_num_fields($result))
{
	$fieldName = pg_field_name($result, $i);
	echo '<th>' . $fieldName . '</th>';
	$i = $i + 1;
}
echo '</tr>';
$i = 0;

//fetching and displaying the contents of the db table

while ($row = pg_fetch_row($result)) 
{
	echo '<tr>';
	$count = count($row);
	$y = 0;
	while ($y < $count)
	{
		$c_row = current($row);
		echo '<td>' . $c_row . '</td>';
		next($row);
		$y = $y + 1;
	}
	echo '</tr>';
	$i = $i + 1;
}
pg_free_result($result);

echo '</table></body></html>';
?> 


<!-- html code for the export to excel and xml button with form action -->

<br>
<br>
<html>
<body>
    <div id="wrap">
        <div class="container">
            <div class="row">
	<br>
            <form class="form-horizontal" action="expbut_dict.php?tableName=<?php echo $tbname;?>" method="post" name="upload_excel"   
                      enctype="multipart/form-data">
                  <div class="form-group">
                            <div class="col-md-4 col-md-offset-4">
                                <input type="submit" name="Export" class="btn btn-success" value="export to excel"/>
                            </div>
                   </div>                    
            </form>           

            <form class="form-horizontal" action="expxml_dict.php?tableName=<?php echo $tbname;?>" method="post"  name="upload_excel" enctype="multipart/form-data">
                  <div class="form-group">
                            <div class="col-md-4 col-md-offset-4">
                                <input type="submit" name="Expor2xml" class="btn btn-success" value="export to xml"/>
                            </div>
                   </div>                    
            </form>           
 </div>
</div>
</div>
</body>
 </html>



