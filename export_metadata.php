<?php
include ('navbar.php');
?>

<style>
table, td, th {
    border: 0.5px solid #D6D7DB;
    text-align: left;
}

th, td {
    padding: 10px;
  }
</style>



<div class="wrapper">
  <h3>Export Metadata</h3>

<?php

include 'config.php';

$query = 'select * from readme';

$result = pg_query($query);

echo '<div class="col-md-10 col-md-offset-3">
        <table class="form-table">
          <tr>';

//Column names for the table
echo '<th> Dataset </th> <th> Readme </th> <th> Data Dictionary </th> <th> Readme + Data Dictionary </th>';

$i = 0;

while ($row = pg_fetch_row($result))
{
  echo "<tr>";
  $count = count($row);
  // Fetching dataset name to every row
  $sde_name_normalize = trim($row[2]);
  $sde_name_underscore = str_replace(' ', '_', $sde_name_normalize);

  echo "<td><a href=display.php?id=".$row[0]. " > ".$row[1]."</a></td>";
  echo "<td>
          <form action=expbut_readme.php?id=" . $row[0] . "&tbname=" . $row[1] . " method='post'  name='upload_excel' enctype='multipart/form-data'>
            <input type=submit name=Export class='btn btn-default btn-rounded mb-4' value='CSV'/>
          </form>
          <form action=expxml_readme_ind.php?id=" . $row[0] . "&tbname=" . $row[1] . " method='post'  name='upload_excel' enctype='multipart/form-data'>
            <input type=submit name=Expor2xml class='btn btn-default btn-rounded mb-4' value='XML'/>
          </form>
        </td>";
  echo "<td>
          <form action=expbut_dict.php?sde_normalize=" . $sde_name_normalize . "&sde_underscore=" . $sde_name_underscore . " method='post'  name='upload_excel' enctype='multipart/form-data'>
            <input type=submit name=Export class='btn btn-default btn-rounded mb-4' value='CSV'/>
          </form>
          <form action=expxml_dict.php?sde_normalize=" . $sde_name_normalize . "&sde_underscore=" . $sde_name_underscore . " method='post'  name='upload_excel' enctype='multipart/form-data'>
            <input type=submit name=Expor2xml class='btn btn-default btn-rounded mb-4' value='XML'/>
          </form>
        </td>";
  echo "<td>
          <form action=expbut_dict.php?sde_normalize=" . $row[2] . "&sde_underscore=" . $sde_name_underscore . " method='post'  name='upload_excel' enctype='multipart/form-data'>
            <input type=submit name=Export class='btn btn-default btn-rounded mb-4' value='CSV'/>
          </form>
          <form action=expxml_dict.php?sde_normalize=" . $row[2] . "&sde_underscore=" . $sde_name_underscore . " method='post'  name='upload_excel' enctype='multipart/form-data'>
            <input type=submit name=Expor2xml class='btn btn-default btn-rounded mb-4' value='XML'/>
          </form>
        </td>";



  $i = $i + 1;
}
pg_free_result($result);

echo '</table></div>';


 ?>


</div>
