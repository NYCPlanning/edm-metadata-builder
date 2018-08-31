<?php  
include 'config.php';
session_start();
if(isset($_POST['csv_submit'])) {

// storing the file name and getting rid of the extension to use it as the table name 

   $namewithEx = $_FILES["csv"]["name"];
   $tableName = preg_replace('/.csv/', '', $namewithEx);
   $_SESSION['tableName'] = $tableName;

   //get the csv file 

    $file = $_FILES["csv"]["tmp_name"]; 

if ($_FILES["csv"]["size"] > 0) { 

    $handle = fopen($file,"r"); 
     
    //loop through the csv file and create table with 

    $flag = true;
    $query="CREATE TABLE $tableName (
            column_name text,
            column_description text,
            code_def text,
            add_notes text,
            internal_notes text
          )";
      $res = pg_query($query); 
      if ($res)
      { 

      //if the query executes without any errors then insert data into the table created else throw an error that the table already exists and you can either drop it or upload the csv with a different name 
     while (($data = fgetcsv($handle,10000,",")) !== FALSE) { 
     if($flag) { $flag = false; continue; }
      $query2 = "INSERT INTO ".$tableName." VALUES ('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]')";
      $res2 = pg_query($db, $query2);  
    }
  }
      else 
      {
        $message = "Table already exits. Do you want to drop the existing Table?";
        echo "<script type='text/javascript'>var r = confirm('$message');
        if(r == true)
        {
          window.location.href = 'drop.php?tableName=$tableName';
        }
        else
        {
          window.location.href = 'dict_csv.php';
        }
         </script>";


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
                  <!-- code for downloading the template  -->

                  <form class="form-horizontal" action="template_dict.php" method="post" name="download_template" enctype="multipart/form-data">
                         <div class="form-group">
                            <label class="col-md-4 control-label" for="singlebutton">Template</label>
                            <div class="col-md-4">
                                <input type="submit" name="template_submit" style="color: #D96B27;border: 1px solid #D96B27" value="Download"/>
                            </div>
                        </div>  
                    </form>
 
                
                <!-- code for selecting a file and uploading it on submission -->

                <form class="form-horizontal" method="post" name="upload_excel" enctype="multipart/form-data">
                    <fieldset>
 
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="filebutton">Select File</label>
                            <div class="col-md-4">
                                <input type="file" name="csv" id="csv" class="input-large">
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
session_start(); //getting the variable value of the table name that was created and passed through the header by the previous php page 

$query = "select * from ".$_SESSION['tableName']; 

if(isset($_POST['csv_submit'])) 
{

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

}
?> 


<!-- html code for the export to excel and xml button with form action -->


<html>
<body>
    <div id="wrap">
        <div class="container">
            <div class="row">
    <br>
            <form class="form-horizontal" action="expbut_dict.php?tableName=<?php echo $tableName;?>" method="post" name="upload_excel"   
                      enctype="multipart/form-data">
                  <div class="form-group">
                            <div class="col-md-4 col-md-offset-4">
                                <input type="submit" name="Export" style="color: #D96B27;border: 1px solid #D96B27" value="export to excel"/>
                            </div>
                   </div>                    
            </form>           

            <form class="form-horizontal" action="expxml_dict.php?tableName=<?php echo $tableName;?>" method="post"  name="upload_excel" enctype="multipart/form-data">
                  <div class="form-group">
                            <div class="col-md-4 col-md-offset-4">
                                <input type="submit" name="Expor2xml" value="export to xml" style="color: #D96B27;border: 1px solid #D96B27"/>
                            </div>
                   </div>                    
            </form>           
 </div>
</div>
</div>
</body>
 </html>






