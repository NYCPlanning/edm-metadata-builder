<?php

$tbname = $_GET['tableName'];
include 'config.php';
if (!empty($_POST['submit'])) {
$query = "INSERT INTO ".$tbname." VALUES ('$_POST[col_name]','$_POST[col_des]','$_POST[cd]','$_POST[add_notes]')";
$result = pg_query($query); 
}
?>


<!DOCTYPE html>
<head>
<body style="background-color:ivory;"> 
<h2>Enter values</h2>
<form name="dict_data" action="dict_name-p2.php?tableName=<?php echo $tbname;?>" method="POST">
<label>Column Name:</label>
<input type="text" name="col_name" maxlength="50" value="" required />
<label>Column Description:</label> 
<input type="text" name="col_des" maxlength="1000" value="" />
<label>Term, Acronym or Code Definition:</label> 
<input type="text" name="cd" maxlength="500" value="" />
<label>Additional Notes:</label> 
<input type="text" name="add_notes" maxlength="1000" value="" />

<input type="submit" name="submit" value="Insert Data" />
<style type="text/css">
input, label {
    float:left;
    margin:5px;
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
$tbname = $_GET['tableName'];
include 'config.php';

$query = "select * from ".$tbname;

$result = pg_query($query);

$i = 0;
echo '<html><body><style>
table, td, th {    
    border: 0.5px solid #ddd;
    text-align: left;
}

th, td {
    padding: 10px;
} </style><table align="center"><tr>';
while ($i < pg_num_fields($result))
{
	$fieldName = pg_field_name($result, $i);
	echo '<th>' . $fieldName . '</th>';
	$i = $i + 1;
}
echo '</tr>';
$i = 0;

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



