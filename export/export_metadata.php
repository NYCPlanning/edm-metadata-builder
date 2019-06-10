<?php
include ('../navbar.php');
?>

<style>
.header-h3 {
  margin-left: 23px;
}
table, td, th {
    border: 0.5px solid #D6D7DB;
    text-align: center;
}

th, td {
    padding: 10px;
  }
.export-button {
  display: inline !important;
}

</style>



<div class="wrapper">
  <h3 class="header-h3">Export Metadata</h3>

<?php

include 'config.php';

$query = 'select * from readme';

$result = pg_query($query);

echo '<div class="col-md-10 col-md-offset-3">
        <table class="form-table">
          <tr>';

//Column names for the table
echo '<th> Dataset </th> <th> Readme </th> <th> Data Dictionary </th>';

$i = 0;

while ($row = pg_fetch_row($result))
{
  echo "<tr>";
  $count = count($row);
  // Fetching dataset name to every row
  $uid = $row[0];
  $common_name = $row[1];
  $sde_name_normalize = trim($row[2]);
  $sde_name_underscore = str_replace(' ', '_', $sde_name_normalize);

  echo "<td><a href=display.php?id=".$uid. " > ".$common_name."</a></td>";
  echo "<td>
          <form action=expcsv_readme.php?id=" . $uid . "&tbname=" . $common_name . " method='post'  name='upload_excel' enctype='multipart/form-data' class='export-button'>
            <input type=submit name=Export class='btn btn-default btn-rounded mb-4' value='.CSV'/>
          </form>
          <form action=expxml_readme.php?id=" . $uid . "&tbname=" . $common_name . " method='post'  name='upload_excel' enctype='multipart/form-data' class='export-button'>
            <input type=submit name=Expor2xml class='btn btn-default btn-rounded mb-4' value='.XML'/>
          </form>
          <form class='form-horizontal export-button' action=expmd_readme.php?id=" . $uid . "&tbname=". $common_name . " method='post' enctype='multipart/form-data'>
            <input type=submit name=Expor2md class='btn btn-default btn-rounded mb-4' value='.MD'/>
          </form>
        </td>";

echo "<td>
        <form class='form-horizontal export-button' action=expcsv_dict.php?sde_underscore=" . $sde_name_underscore ." method='post'  name='upload_excel' enctype='multipart/form-data'>
          <input type='submit' name='Export' class='btn btn-default btn-rounded mb-4' value='.CSV'/>
        </form>
        <form class='form-horizontal export-button' action=expxml_dict.php?sde_underscore=" . $sde_name_underscore . " method='post'  name='upload_excel' enctype='multipart/form-data'>
          <input type='submit' name='Expor2xml' class='btn btn-default btn-rounded mb-4' value='.XML'/>
        </form>
        <form class='form-horizontal export-button' action=expmd_dict.php?sde_underscore=" . $sde_name_underscore . " method='post'  enctype='multipart/form-data'>
          <input type='submit' name='Expor2md' class='btn btn-default btn-rounded mb-4' value='.MD'/>
        </form>
      </td>";

  // echo "<td>
  //         <form action=expcsv_dict.php?sde_normalize=" . $row[2] . "&sde_underscore=" . $sde_name_underscore . " method='post'  name='upload_excel' enctype='multipart/form-data' class='export-button'>
  //           <input type=submit name=Export class='btn btn-default btn-rounded mb-4' value='.CSV'/>
  //         </form>
  //         <form action=expxml_dict.php?sde_normalize=" . $row[2] . "&sde_underscore=" . $sde_name_underscore . " method='post'  name='upload_excel' enctype='multipart/form-data' class='export-button'>
  //           <input type=submit name=Expor2xml class='btn btn-default btn-rounded mb-4' value='.XML'/>
  //         </form>
  //       </td>";



  $i = $i + 1;
}
pg_free_result($result);

echo '</table></div>';


 ?>


</div>
