<?php  
include 'config.php'; //including the db connection details

if(isset($_POST['csv_submit'])) {

//get the csv file 

    $file = $_FILES["csv"]["tmp_name"]; 

if ($_FILES["csv"]["size"] > 0) { 
  
    $handle = fopen($file,"r");    
    $flag = true;

    //loop through the csv file and insert into database 

  while (($data = fgetcsv($handle,10000,",")) !== FALSE) {   
     if($flag) { $flag = false; continue; }
           $query="INSERT INTO ReadMe VALUES ('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]','$data[7]','$data[8]','$data[9]','$data[10]','$data[11]','$data[12]','$data[13]','$data[14]','$data[15]','$data[16]','$data[17]','$data[18]', '$data[19]','$data[20]', '$data[21]', '$data[22]')";
      $res = pg_query($db, $query);    
    } 
fclose($handle);

 } 
 }
?>
 


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 

<html lang="en">
 
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>
 
</head>
 
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
    <div id="wrap">
        <div class="container">
            <div class="row">
<br>

                <!-- code for downloading template  -->

                <form class="form-horizontal" action="template.php" method="post" name="download_template" enctype="multipart/form-data">
                         <div class="form-group">
                            <label class="col-md-4 control-label" for="singlebutton">Template</label>
                            <div class="col-md-4">
                                <input type="submit" name="template_submit" value="Download" style="color: #D96B27;border: 1px solid #D96B27" />
                            </div>
                         </div>  
                </form>

                <!-- code for selecting a file and uploading it on submission -->
 
                <form class="form-horizontal" method="post" name="upload_excel" enctype="multipart/form-data">
                    <fieldset>
 
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="filebutton">Select File</label>
                            <div class="col-md-4">
                                <input type="file" name="csv" id="csv" class="input-large" >
                            </div>
                        </div>
 
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="singlebutton">Submit data</label>
                            <div class="col-md-4">
                                <button type="submit" id="submit" name="csv_submit" style="color: #D96B27;border: 1px solid #D96B27" data-loading-text="Loading...">Submit</button>
                            </div>
                        </div>
 
                    </fieldset>
                </form>
 
            </div>
           
        </div>
    </div>
    <br>
</body>
 
</html>



<?php

//the following php code is for displaying the table contents on the same page

include 'config.php';

$query = "select * from ReadMe";

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
} </style><table><tr>';

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

<!-- html code for the export to excel button with form action -->

<html>
    <div id="wrap">
        <div class="container">
            <div class="row">
    <br>
            <form class="form-horizontal" action="expbut.php" method="post" name="upload_excel"   
                      enctype="multipart/form-data">
                  <div class="form-group">
                            <div class="col-md-4 col-md-offset-4">
                                <input type="submit" name="Export" style="color: #D96B27;border: 1px solid #D96B27" value="export to excel" />
                            </div>
                   </div>                    
            </form>           

                  
 </div>
</div>
</div>
 </html>







