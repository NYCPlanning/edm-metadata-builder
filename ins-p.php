<?php
$db = pg_connect("host=localhost port=5432 dbname=postgres user=amolivani");
$query = "INSERT INTO info VALUES ('$_POST[nameid]','$_POST[addressid]')";
$result = pg_query($query); 
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
echo '<html><body><style>
table, td, th {    
    border: 0.5px solid #ddd;
    text-align: left;
}

th, td {
    padding: 10px;
} </style><table><tr>';
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
<div>
	<br>
            <form class="form-horizontal" action="test1.php" method="post" 
                      enctype="multipart/form-data">
                  <div class="form-group">
                            <div class="col-md-4 col-md-offset-4">
                                <input type="submit" name="Export" class="btn btn-success" value="export to excel"/>
                            </div>
                   </div>                    
            </form>           
 </div>
 </html>