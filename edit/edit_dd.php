<?php
echo '<div class="dd-header-container">
  <div class="container left-container">
    <h4>Data Dictionary</h4>
  </div>
  <div class="upload-dd container right-container">
    <div class="modal fade upload-modal" id="dd-upload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header text-center">
            <h4 class="modal-title w-100 font-weight-bold">Data Dictionary</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="display.php?tbname='.$sde_name_underscore.'&id='.$id.'" class="form-horizontal" method="post" name="upload_excel" enctype="multipart/form-data">
              <fieldset>

                  <div class="form-group">
                      <label class="col-md-4 control-label" for="filebutton">Select File</label>
                      <div class="col-md-4">
                          <input type="file" name="file" id="dd-file" class="input-large" accept=".xml,.csv">
                      </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-4 col-md-offset-5">
                        <button type="submit" id="dd_submit_append" name="dd_submit_append" data-loading-text="Loading...">Append</button>
                    </div>
                    <div class="col-md-4 col-md-offset-5">
                        <button type="submit" id="dd_submit_overwrite" name="dd_submit_overwrite" data-loading-text="Loading...">Overwrite</button>
                    </div>
                  </div>

              </fieldset>
          </form>

          </div>
        </div>
      </div>
    </div>
  <div class="upload-readme container right-container" style="width:240px; padding-right: 0px;">
    <!-- Trigger the modal with a button -->
    <button type="button" class="btn btn-default btn-rounded mb-4 export-file" data-toggle="modal" data-target="#exportDD" style="display: inline;">Export</button>

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

            <form class="form-horizontal" action="'. $path . '/export/expcsv_dict.php?sde_normalize='. $sde_name_normalize .'&sde_underscore='. $sde_name_underscore .'" method="post"  name="upload_excel" enctype="multipart/form-data">
              <input type="submit" name="Export" class="btn btn-default btn-rounded mb-4" value=".CSV"/>
            </form>
            <form class="form-horizontal" action="'. $path . '/export/expxml_dict.php?sde_normalize='. $sde_name_normalize .'&sde_underscore='. $sde_name_underscore .'" method="post"  name="upload_excel" enctype="multipart/form-data">
              <input type="submit" name="Expor2xml" class="btn btn-default btn-rounded mb-4" value=".XML"/>
            </form>
            <form class="form-horizontal" action="'. $path . '/export/expmd_dict.php?sde_normalize='. $sde_name_normalize .'&sde_underscore='. $sde_name_underscore .'" method="post"  enctype="multipart/form-data">
              <input type="submit" name="Expor2md" class="btn btn-default btn-rounded mb-4" value=".MD"/>
            </form>
            <form class="form-horizontal" action="'. $path . '/export/exppdf_dict.php?sde_normalize='. $sde_name_normalize .'&sde_underscore='. $sde_name_underscore .'" method="post"  enctype="multipart/form-data">
              <input type="submit" name="Expor2pdf" class="btn btn-default btn-rounded mb-4" value=".PDF"/>
            </form>
          </div>

        </div>

      </div>
    </div>
    <div class="text-right" style="display: inline;">
      <a href="" class="btn btn-default btn-rounded mb-4 " data-toggle="modal" data-target="#dd-upload" style="margin-top:8px;">Upload From File</a>
    </div>

  </div>
</div>

<!-- Bottom Div -->
<div id="bottom-div">';

// Display Data Dictionary Table


$data_dict_query = "SELECT * FROM $sde_name_underscore ORDER BY uid";
$data_dict = pg_query($data_dict_query);


//fetching the column names of the dd table
  echo '<div id="dd-wrapper"><table class="form-table"> <tr>';
  echo '<th> Edit </th> <th> Delete </th> ';
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
    // echo "<form action=readme-p-update.php?id=".$row[0]." method='post'>";
    echo "<tr>";
    $count = count($row);
    //Adds the Edit and Delete buttons to every row
    echo "<td style='text-align: center'>
              <button class='btn edit-btn' id='edit".$row[0]. "' onClick='editFunc(this.id)' >
                <i class='far fa-edit'></i>
              </button>
              <form action='' id='form".$row[0]."'>
              <button class='save-btn' id='saveedit" .$row[0]."' type='submit' name='save-submit' form='form".$row[0]."' style=display:none;'>
                <i class='far fa-save' ></i>
              </button>
              </form>

          </td>";
          echo "<td style='text-align: center'>

                  <form action='display.php?delete-id=".$row[0]."&tbname=". $sde_name_underscore ."&id=".$id."' method='post' enctype='multipart/form-data'>
                    <button class='btn' type='submit'>
                      <i class='far fa-trash-alt'></i>
                    </button>
                  </form>
                </td>";
          echo "<input type='hidden' name='id' form='form".$row[0]."' value='".$id."'>";
          echo "<input type='hidden' name='sde_table' form='form".$row[0]."' value='".$sde_name_underscore."'>";
          for ($y = 0; $y < $count; $y+=1)
          {
            $c_row = current($row);

            if($y == 5 || $y == 6 || $y == 10) {
              echo "<td class='uid" . $y . "' >
                      <select name='s" .$y. "' style='font-size:12pt; height:40px; width:200px;border:none; border: 0;' class='textedit" .$row[0]. "' disabled form='form".$row[0]."'>
                        <option value='". $c_row ."' selected>" . $c_row . "</option>
                        <option value='True'>True</option>
                        <option value='False'>False</option>
                      </select>
                   </td>";
            } else if ($y == 7) {
              echo "<td class='uid" . $y . "' >
                      <select name='s" .$y. "' style='font-size:12pt; height:40px; width:200px;border:none; border: 0;' class='textedit" .$row[0]. "' disabled form='form".$row[0]."'>
                        <option value='". $c_row ."' selected>" . $c_row . "</option>
                        <option value='String'>String</option>
                        <option value='OID'>OID</option>
                        <option value='Geometry'>Geometry</option>
                        <option value='Double'>Double</option>
                      </select>
                   </td>";
            } else {

              echo "<td class='uid" . $y . "' id='uid" . $y . "edit" .$row[0]. "' ><textarea disabled style='border: none' name='s" .$y. "' form='form".$row[0]."' class='textedit" .$row[0]. "' id='uid" . $y . "textedit" .$row[0]. "'>" . $c_row . "</textarea></td>";

            }
          next($row);
          }

    echo "</form>";
    $i = $i + 1;
  }
  pg_free_result($data_dict);

  echo '</table></div>';
  echo '<div id="dd_add_row">
          <form action="display.php" id="add_row_form">
            <button type="submit" name="add_row">
              <i class="fas fa-plus-circle"></i>
            </button>
          </form>
        </div>';
  echo "<input type='hidden' name='id' form='add_row_form' value='".$id."'>";
  echo "<input type='hidden' name='sde_table' form='add_row_form' value='".$sde_name_underscore."'>";
?>


</div>  <!-- /Bottom Div -->

</div> <!-- /wrapper -->
