<?php  

//connect to the database $db = pg_connect("host=localhost port=5432 dbname=postgres user=amolivani"); 
$db = pg_connect("host=localhost port=5432 dbname=postgres user=amolivani");

// 
    $file = $_FILES["csv"]["tmp_name"]; 

if ($_FILES["csv"]["size"] > 0) { 

    //get the csv file 
    //$file = $_FILES[csv][tmp_name]; 
    $handle = fopen($file,"r"); 
     
    //loop through the csv file and insert into database 
  while ($data = fgetcsv($handle,10000,",","'")) { 
        //if ($data[0]) { 
           $query="INSERT INTO info VALUES ('$data[0]','$data[1]')";
      $res = pg_query($db, $query);      
        //} 
    } 

//if (!$sth) {
    //echo "<p>\nPDO::errorInfo():\n</p>";
    //print_r($db->errorInfo());
//} 
fclose($handle);

    

//redirect 
 echo "<p><b>Records Imported</b></p>";

// while (!feof($handle) ) {

//     $text_file = fgetcsv($handle);

//     //print_r($text_file);
// $query=<<<eof
// INSERT INTO info VALUES ('$text_file[0]','$text_file[1]')
// eof;
// $sth = $db->query($query);
// }
// if (!$sth) {
//     echo "<p>\nPDO::errorInfo():\n</p>";
//     print_r($db->errorInfo());
// } 
// fclose($handle);

// echo "<p><b>Records Imported</b></p>";


} 

?> 



<?php

$host = 'localhost';
$port = '5432';
$database = 'postgres';
$user = 'amolivani';

$connectString = 'host=' . $host . ' port=' . $port . ' dbname=' . $database . 
  ' user=' . $user;


$link = pg_connect ($connectString);
if (!$link)
{
  die('Error: Could not connect: ' . pg_last_error());
}


$query = 'select * from info';

$result = pg_query($query);

$i = 0;
echo '<html><body><table><tr>';
while ($i < pg_num_fields($result))
{
  $fieldName = pg_field_name($result, $i);
  echo '<td>' . $fieldName . '</td>';
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
<div>
  <br>
            <form class="form-horizontal" action="export.php" method="post" name="upload_excel"   
                      enctype="multipart/form-data">
                  <div class="form-group">
                            <div class="col-md-4 col-md-offset-4">
                                <input type="submit" name="Export" class="btn btn-success" value="export to excel"/>
                            </div>
                   </div>                    
            </form>           
 </div>
 </html>