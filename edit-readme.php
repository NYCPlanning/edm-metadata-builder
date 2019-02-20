<?php
include ('navbar.php');
include ('MaintFreq_dropdown.php');
include ('readme_upload.php');
include ('dd_upload.php');
include ('readme-p-edit-submission.php');

// Trim white spaces
$common_name_normalize = trim($_POST['common_name']);
$sde_name_normalize = trim($_POST['sde_name']);
// Replace space with underscore
$sde_name_underscore =  str_replace(' ', '_', $sde_name_normalize);

$query = "INSERT INTO ReadMe(common_name, sde_name) VALUES ('$common_name_normalize','$sde_name_normalize');";
$query .= "CREATE TABLE $sde_name_underscore (
                  uid serial PRIMARY key NOT NULL,
                  orders int,
                  field_name text,
                  longform_name text,
                  description text,
                  geocoded boolean,
                  required boolean,
                  data_type text,
                  expected_allowed_values text,
                  last_modified_date text,
                  no_longer_in_use text,
                  notes text
                );";
pg_query($query);

if (isset($_GET['id'])) {
  $id = $_GET['id'];
} else if (isset($_POST['id'])){
  $id = $_POST['id'];
} else{
  $id_query = "SELECT uid FROM readme WHERE sde_name = '$sde_name_underscore'";
  $id_results = pg_query($id_query);
  $id_row = pg_fetch_assoc($id_results);
  $id = $id_row['uid'];
}

$readme_query = "SELECT * FROM readme WHERE uid = $id";

$readme_results = pg_query($readme_query);
$readme_row = pg_fetch_assoc($readme_results);
    $uid = $readme_row['uid'];
    $common_name = $readme_row['common_name'];
    $sde_name = $readme_row['sde_name'];
    $tags_guide = $readme_row['tags_guide'];
    $tags_sde = $readme_row['tags_sde'];
    $summary = $readme_row['summary'];
    $summary_update_date = $readme_row['summary_update_date'];
    $description = $readme_row['description'];
    $description_data_loc = $readme_row['description_data_loc'];
    $data_steward = $readme_row['data_steward'];
    $data_engineer = $readme_row['data_engineer'];
    $credits = $readme_row['credits'];
    $genconst = $readme_row['genconst'];
    $legconst = $readme_row['legconst'];
    $update_freq = $readme_row['update_freq'];
    $date_last_update = $readme_row['date_last_update'];
    $date_underlying_data = $readme_row['date_underlying_data'];
    $data_source = $readme_row['data_source'];
    $version = $readme_row['version'];
    $common_uses = $readme_row['common_uses'];
    $data_quality = $readme_row['data_quality'];
    $caveats = $readme_row['caveats'];
    $future_plans = $readme_row['future_plans'];
    $distribution = $readme_row['distribution'];
    $contact = $readme_row['contact'];

    $sde_name_normalize = trim($sde_name);
    $sde_name_underscore =  str_replace(' ', '_', $sde_name_normalize);

?>


<style>
li {
  list-style: none;
}

.border-bottom {
  border-bottom: 1px solid #DFE0E5;
  box-shadow: 0 5px 5px -3px #DFE0E5;
}

.common-name-header{
  margin: 0;
  padding: 7px;
}

.common-name-header h3{
  display: inline;
}
.fa-pen {
  margin-left: 5px;
  padding-bottom: 3px;
  font-size: 18px;

}

.readme-header-container {
  width: 100%;
  padding: 15px 0 0 0;
}

.readme-header-container h4{
  margin: -9px 0 0 0;
}

.readme-header-container button{
  margin: -12px 10px 0 0;
}


.dd-header-container h4{
  margin: 10px 0 0 0;
}
.dd-header-container a {
  margin: 10px 10px 0 0;
}
.dd-header-container button{
  margin: 9px 10px 0 0;
}
.left-container {
  float: left;
  width: 250px;
}

.right-container {
  float: right;
  width: 180px;
}

.common-name-header h3 {
  margin: 0;
}

.dd-header-container {
    width: 100%;
    padding: 20px 0 0 0;
}

#wrapper {
    width: 100%;
    max-height: 100vh;
}
#top-div {
    float: left;
    width: 100%;
    height: 45%;
    overflow: auto;
    padding: 0.4em;
    resize:vertical;

}
#top-div textarea{
  border-color: #D6D7DB;
  border-width: 1.5px;
}
#bottom-div {
    float: left;
    width: 100%;
    height: 30%;
    overflow: auto;
    padding: 0.4em;
    resize:vertical;
}

/* code for creating a table structure using css */
  table, td, th {
      border: 0.5px solid #D6D7DB;
      text-align: left;
  }

  th, td {
      padding: 10px;
    }
 i {
   color: black;
 }
 i:hover {
   color: #D96B27;
 }
/* Hide the UID of the table */
.uid0 {
  display: none;
}

.text-right a{
  margin-right: 10px;
}
.dd-header-container a {
  margin: 10px 10px 0 0;
}
/* upload Overlay */
.upload-modal{
  margin-top: 20%;
}
.dataset-delete {
  margin-left: 5px;
  font-size: 18px;
}
</style>

<div class="common-name-header border-bottom">
  <h3 id="common-name-delete"><?php echo $common_name; ?></h3>
  <input type="hidden" id="sde-name-delete" value="<?php echo $sde_name_underscore; ?>">
  <input type="hidden" id="readme-id" value="<?php echo $id; ?>">
  <a id="deleteData"><i class="far fa-trash-alt dataset-delete"></i></a>
</div>




  <div class="readme-header-container">
    <div class="container left-container">
      <h4>Readme</h4>
    </div>
    <div class="upload-readme container right-container">
      <div class="modal fade upload-modal" id="readme-upload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header text-center">
              <h4 class="modal-title w-100 font-weight-bold">Readme</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="display.php?id=<?php echo $id;?>" class="form-horizontal" method="post" name="upload_excel" enctype="multipart/form-data">
                <fieldset>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="filebutton">Select File</label>
                        <div class="col-md-4">
                            <input type="file" name="file" id="readme-file" class="input-large" accept=".xml,.csv">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-4 col-md-offset-5">
                            <button type="submit" id="submit" name="readme_submit" data-loading-text="Loading...">Submit</button>
                        </div>
                    </div>

                </fieldset>
            </form>

            </div>
          </div>
        </div>
      </div>

      <div class="text-right">
        <input type="submit" id="tableSubmit" value="Save" name="readme_save_button" form="readme-form" class="btn btn-default btn-rounded mb-4" style="padding-top:-15px;"/>
        <a href="" class="btn btn-default btn-rounded mb-4" data-toggle="modal" data-target="#readme-upload">Upload From File</a>
      </div>

    </div>
  </div>

  <div id="wrapper">

    <!-- Top Div -->
    <div id="top-div" class="border-bottom">
      <form name="readme" action="edit-dd.php?selection=<?php echo $selection;?>&id=<?php echo $id;?>" id="readme-form" method="POST" >
        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
        <input type="hidden" name="sde_old" value="<?php echo $sde_name; ?>">
        <li>Common Name</li><li><input type="text" name="common_name" style="width:500px;" value="<?php echo $common_name; ?>"/></li>
        <br>
        <li>SDE Name</li><li><input type="text" name="sde_name" style="width:500px;" value="<?php echo $sde_name; ?>" required/></li>  <!-- this field is made mandatory by adding 'required' -->

        <br>
        <li>Tags for Guide</li><li><input type="text" name="tags_guide" style="width:500px;" value="<?php echo $tags_guide; ?>"/></li>
        <br>
        <li>Tags for SDE</li><li><input type="text" name="tags_sde" style="width:500px;" value="<?php echo $tags_sde; ?>"/></li>
        <br>
        <li>Summary</li><li><textarea name="summary" style="height:90px;width:500px;" ><?php echo $summary; ?> </textarea></li>
        <br>
        <li>Summary - Update Date</li><li><input type="text" name="summary_update_date" style="height:40px;width:500px;" value="<?php echo $summary_update_date; ?>"/></li>
        <br>
        <li>Description</li><li><textarea name="description" style="height:90px;width:500px;"> <?php echo $description; ?> </textarea></li>
        <br>
        <li>Description - Data Location</li><li><input type="text" name="description_data_loc" style="width:500px;" value="<?php echo $description_data_loc; ?>"/></li>
        <br>
        <li>Data Steward</li><li><input type="text" name="data_steward" style="width:500px;" value="<?php echo $data_steward; ?>"/></li>
        <br>
        <li>Data Engineer</li><li><input type="text" name="data_engineer" style="width:500px;" value="<?php echo $data_engineer; ?>"/></li>
        <br>
        <li>Credits</li><li><input type="text" name="credits" style="width:500px;" value="<?php echo $credits; ?>"/></li>
        <br>
        <li>General Constraints Use Limitations</li><li><textarea name="genconst" style="height:90px;width:500px;" ><?php echo $genconst; ?></textarea></li>
        <br>
        <li>Legal Constraints Use Limitations</li><li><textarea name="legconst" style="height:90px;width:500px;" ><?php echo $legconst; ?></textarea></li>
        <br>
        <!-- <li>Update Frequency:</li><li><input type="text" name="update_freq" /></li> -->
        <li>Update Frequency</li>
        <select required name="update_freq" id="ddTables" style="font-size:12pt; height:45px; width:500px;">
          <option value="<?php echo $update_freq; ?>" selected><?php echo $update_freq; ?></option>
          <?php
          echo $tables;
          ?>
        </select>
        <br>
        <br><li>Date of Last Update</li><li><input type="text" name="date_last_update" style="width:500px;" value="<?php echo $date_last_update; ?>"/></li>
        <br>
        <li>Date of Underlying Data</li><li><input type="text" name="date_underlying_data" style="width:500px;" value="<?php echo $date_underlying_data; ?>"/></li>
        <br>
        <li>Data Sources and Compilation Process</li><li><textarea name="data_source" style="height:90px;width:500px;" ><?php echo $data_source; ?></textarea></li>
        <br>
        <li>Version</li><li><input type="text" name="version" style="width:500px;" value="<?php echo $version; ?>"/></li>
        <br>
        <li>Common Uses</li><li><textarea name="common_uses" style="height:90px;width:500px;" ><?php echo $common_uses; ?></textarea></li>
        <br>
        <li>Data Quality</li><li><textarea name="data_quality" style="height:90px;width:500px;"><?php echo $data_quality; ?></textarea></li>
        <br>
        <li>Caveats</li><li><textarea name="caveats" style="height:90px;width:500px;"><?php echo $caveats; ?></textarea></li>
        <br>
        <li>Future Plans</li><li><textarea name="future_plans" style="height:90px;width:500px;"><?php echo $future_plans; ?></textarea></li>
        <br>
        <li>Distribution</li><li><input type="text" name="distribution" style="width:500px;" value="<?php echo $distribution; ?>"/></li>
        <br>
        <li>Contact</li><li><input type="text" name="contact" style="width:500px;" value="<?php echo $contact; ?>"/></li>
        <br>
        <br>

      </form>
    </div><!-- /Top Div -->

    <div class="dd-header-container">
      <div class="container left-container">
        <h4>Data Dictionary</h4>
      </div>
      <div class="text-right dd-header-container">
        <a href= "edit.php?id=<?php echo $id; ?>"  class="btn btn-default btn-rounded mb-4">Edit</a>

        <!-- Trigger the modal with a button -->
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
                <form class="form-horizontal" action="expbut_dict.php?sde_normalize=<?php echo $sde_name_normalize;?>&sde_underscore=<?php echo $sde_name_underscore;?>" method="post"  name="upload_excel" enctype="multipart/form-data">
                  <input type="submit" name="Export" class="btn btn-default btn-rounded mb-4" value="CSV"/>
                </form>
                <form class="form-horizontal" action="expxml_dict.php?sde_normalize=<?php echo $sde_name_normalize;?>&sde_underscore=<?php echo $sde_name_underscore;?>" method="post"  name="upload_excel" enctype="multipart/form-data">
                  <input type="submit" name="Expor2xml" class="btn btn-default btn-rounded mb-4" value="XML"/>
                </form>

              </div>

            </div>

          </div>
        </div>
      </div>
    </div>


    <!-- Bottom Div -->
    <div id="bottom-div">

      <!-- Display Data Dictionary Table -->
      <?php

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
      ?>


    </div>  <!-- /Bottom Div -->

  </div> <!-- /wrapper -->


</body>
</html>
