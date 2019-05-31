<?php

echo '<div class="dd-header-container">
    <div class="container left-container">
      <h4>Data Dictionary</h4>
    </div>
    <div class="text-right dd-header-container">';

          if ($privilege && !isset($_SESSION["edit-dd"])) {
            echo'<a href= "display.php?id=' .$id. '&edit-dd=TRUE"  class="btn btn-default btn-rounded mb-4">Edit</a>';
          }



  echo '<!-- Trigger the modal with a button -->
      <button type="button" class="btn btn-default btn-rounded mb-4 export-file" data-toggle="modal" data-target="#exportDD">Export</button>

      <!-- Modal -->
      <div id="exportDD" class="modal fade" role="dialog" style="margin-top: 200px;">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title text-left" style="">Data Dictionary Export</h4>
            </div>
            <div class="modal-body text-center">

              <form class="form-horizontal" action="'. $path . '/export/expcsv_dict.php?sde_normalize='.$sde_name_normalize.'&sde_underscore='.$sde_name_underscore.'" method="post"  name="upload_excel" enctype="multipart/form-data">
                <input type="submit" name="Export" class="btn btn-default btn-rounded mb-4" value=".CSV"/>
              </form>
              <form class="form-horizontal" action="'. $path . '/export/expxml_dict.php?sde_normalize='.$sde_name_normalize.'&sde_underscore='.$sde_name_underscore.'" method="post"  name="upload_excel" enctype="multipart/form-data">
                <input type="submit" name="Expor2xml" class="btn btn-default btn-rounded mb-4" value=".XML"/>
              </form>
              <form class="form-horizontal" action="'. $path . '/export/expmd_dict.php?sde_normalize='.$sde_name_normalize.'&sde_underscore='.$sde_name_underscore.'" method="post"  enctype="multipart/form-data">
                <input type="submit" name="Expor2md" class="btn btn-default btn-rounded mb-4" value=".MD"/>
              </form>
              <form class="form-horizontal" action="'. $path . '/export/exppdf_dict.php?sde_normalize='.$sde_name_normalize.'&sde_underscore='.$sde_name_underscore.'" method="post"  enctype="multipart/form-data">
                <input type="submit" name="Expor2pdf" class="btn btn-default btn-rounded mb-4" value=".PDF"/>
              </form>

            </div>

          </div>

        </div>
      </div>
    </div>
  </div>


  <!-- Bottom Div -->
  <div id="bottom-div">';

  // Display Data Dictionary Table


  $data_dict_query = "SELECT * FROM $sde_name_underscore ORDER BY uid";
  $data_dict = pg_query($data_dict_query);


    //fetching the column names of the dd table
    echo '<table class="form-table"> <tr>';
    $i = 0;
    while ($i < pg_num_fields($data_dict))
    {
      $fieldName = pg_field_name($data_dict, $i);
      $fieldName = ucwords(str_replace("_"," ",$fieldName));
      if($fieldName == 'Orders') {
        echo '<th class=uid' .$i . '> Order </th>';
      } else {
        echo '<th class=uid' .$i . '>' . $fieldName . '</th>';
      }
      $i = $i + 1;
    }
    echo '</tr>';
    $i = 0;

    //fetching and displaying the contents of the db table
    while ($row = pg_fetch_row($data_dict))
    {
      echo "<form action=readme-p-update.php?id=".$row[0]." method='post'>";
      echo "<tr>";
      $count = count($row);
      for ($y = 0; $y < $count; $y+=1)
      {
        $c_row = current($row);
        echo "<td class=uid" . $y . ">" . $c_row . "</td>";
        next($row);
      }

      $i = $i + 1;
    }
    pg_free_result($data_dict);

    echo '</form></table>';



echo '      </div>  <!-- /Bottom Div -->
        </div> <!-- /wrapper -->';

 ?>
