<?php  
$db = pg_connect("host=localhost port=5432 dbname=postgres user=amolivani");
session_start();
if(!empty('_POST[csv_submit]')) {
// storing the file name and getting rid of the extension to use it as the table name 
   $namewithEx = $_FILES["csv"]["name"];
   $tableName = preg_replace('/.csv/', '', $namewithEx);
   $_SESSION['tableName'] = $tableName;
// 
    $file = $_FILES["csv"]["tmp_name"]; 

if ($_FILES["csv"]["size"] > 0) { 

    //get the csv file 
    //$file = $_FILES[csv][tmp_name]; 
    $handle = fopen($file,"r"); 
     
    //loop through the csv file and insert into database 
    $flag = true;
  while (($data = fgetcsv($handle,10000,",","'")) !== FALSE) { 
        //if ($data[0]) { 
     if($flag) { $flag = false; continue; }
           $query="CREATE TABLE $tableName (
column_name text,
column_description text,
code_def text,
add_notes text
)";
      $res = pg_query($db, $query); 
      if (res)
      {  
      $query2 = "INSERT INTO ".$tableName." VALUES ('$data[0]','$data[1]','$data[2]','$data[3]')";
      $res2 = pg_query($db, $query2);  }
      else 
      {
        echo pg_last_error($db);
      }
        //} 
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
 
<body style="background-color:ivory;"> 
    <div id="wrap">
        <div class="container">
            <div class="row">
<br>

                  <form class="form-horizontal" action="template_dict.php" method="post" name="download_template" enctype="multipart/form-data">
                         <div class="form-group">
                            <label class="col-md-4 control-label" for="singlebutton">Template</label>
                            <div class="col-md-4">
                                <input type="submit" name="template_submit" class="btn btn-success" value="Download"/>
                            </div>
                        </div>  
                    </form>
 
                <form class="form-horizontal" method="post" name="upload_excel" enctype="multipart/form-data">
                    <fieldset>
 
                  
                        <!-- File Button -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="filebutton">Select File</label>
                            <div class="col-md-4">
                                <input type="file" name="csv" id="csv" class="input-large">
                            </div>
                        </div>
 
                        <!-- Button -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="singlebutton">Submit data</label>
                            <div class="col-md-4">
                                <button type="submit" id="submit" name="csv_submit" class="btn btn-primary button-loading" data-loading-text="Loading...">Submit</button>
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
$host = 'localhost';
$port = '5432';
$database = 'postgres';
$user = 'amolivani';

$connectString = 'host=' . $host . ' port=' . $port . ' dbname=' . $database . 
    ' user=' . $user;
session_start();

$link = pg_connect ($connectString);
if (!$link)
{
    die('Error: Could not connect: ' . pg_last_error());
}
if(!empty('_POST[csv_submit]')) 
{
$query = "select * from ".$_SESSION['tableName'];

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
}
?> 


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
                                <input type="submit" name="Export" class="btn btn-success" value="export to excel"/>
                            </div>
                   </div>                    
            </form>           

            <form class="form-horizontal" action="expxml_dict.php?tableName=<?php echo $tableName;?>" method="post"  name="upload_excel" enctype="multipart/form-data">
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






