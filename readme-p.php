<?php

include 'config.php'; //including the configuration file that has the db connection details
//passing the values taken from readme.php as '$_POST[]'

 $query1 = pg_query("SELECT common_name FROM ReadMe WHERE common_name = '$_POST[common_name]'");  
      if (pg_num_rows($query1) > 0) //checking if the dataset already exsits and prompting to enter a different Common Name
      {
        $message = "Table already exists. Please Enter different name in Common Name!";
        echo "<script type='text/javascript'>alert('$message'); window.location.href = 'readme.php?' </script>";
              }
      else //if the dataset record does not exits, then adding the values to the ReadMe file
      {
        $selection = $_POST['update_freq']; //accepting the update frequency selection from the dropdown on previous php page as a variable
        $query = "INSERT INTO ReadMe VALUES ('$_POST[common_name]', 
'$_POST[sde_name]',
'$_POST[tags]',
'$_POST[summary]',
'$_POST[description]',
'$_POST[data_steward]',
'$_POST[data_engineer]',
'$_POST[credits]',
'$_POST[use_limitations]',
'$selection',
'$_POST[date_last_update]',
'$_POST[date_underlying_data]',
'$_POST[data_source]',
'$_POST[version]',
'$_POST[common_uses]',
'$_POST[data_quality]',
'$_POST[caveats]',
'$_POST[future_plans]',
'$_POST[distribution]')";

$result = pg_query($query); //executing the query
      } 

?>


<?php

//the following php code is for displaying the table contents on the same page

include 'config.php';

$query = 'select * from ReadMe';

$result = pg_query($query);


$i = 0;

// code for creating a table structure using css

echo '<html><body><style>
table, td, th {    
    border: 0.5px solid #ddd;
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
<body style="background-color:ivory;"> 
    <div id="wrap">
        <div class="container">
            <div class="row">
  <br>
            <form class="form-horizontal" action="expbut.php" method="post" name="upload_excel"   
                      enctype="multipart/form-data">
                  <div class="form-group">
                            <div class="col-md-4 col-md-offset-4">
                                <input type="submit" name="Export" class="btn btn-success" value="export to excel"/>
                            </div>
                   </div>                    
            </form>           
        
 </div>
</div>
</div>
</body>
 </html>