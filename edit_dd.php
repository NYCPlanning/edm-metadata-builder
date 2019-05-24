<?php
include ('navbar.php');
include ('MaintFreq_dropdown.php');
include ('readme_upload.php');
include ('dd_delete.php');
include ('dd_edit_submission.php');
include ('readme_edit_submission.php');



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
    $data_access = $readme_row['data_access'];
    $sde_name_normalize = trim($sde_name);
    $sde_name_underscore =  str_replace(' ', '_', $sde_name_normalize);




  // Checks if user is admin or super
  $privilege = FALSE;
  if (($_SESSION["type"] == 'superuser') || ($_SESSION["type"] == 'admin')) {
    $privilege = TRUE;
  }
  // If $privilege is false then check if user has access from collaboration
  if(!$privilege){
    $user = $_SESSION["user"];
    // Check if user have access to this dataset in the collaboration table
    $query = "SELECT sdename FROM collaboration WHERE email = '$user'";
    $result = pg_query($query);
    $arr = pg_fetch_all($result);
    foreach($arr as $v) {
      if($v["sdename"] == $sde_name){
        $privilege = TRUE;
      }
    }
  }


  // If dataset name doesn't exist in database send user back to Main.php
  if (!isset($id) || !$privilege) {
    echo '<script>';
    echo 'window.location.href="Main.php"';  //not showing an alert box.
    echo '</script>';
  }
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
  padding: 20px 0 0 0;
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
  width: 245px;
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


}
#bottom-div {
    float: left;
    width: 100%;
    height: 30%;
    overflow: auto;
    padding: 0.4em;

}

/* code for creating a table structure using css */
  table, td, th {
      border: 0.5px solid #D6D7DB;
      text-align: left;
  }

  th {
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
  margin: -10px 10px 0 0;
}
.dd-header-container a {
  margin: 10px 0 0 0;
}
/* Readme Overlay */
.upload-modal {
  margin-top: 20%;
}
.form-table form{
  margin-bottom: 0;
}
.save-btn {
  border: none;
}
#dd_add_row {
  padding: 13px 0 0 8px;
}

#dd_add_row button{
  border: none;
  background-color: white;
}

#dd_add_row .fa-plus-circle {
  font-size: 24px;
  background-color:white;
}
.dataset-delete {
  margin-left: 5px;
  font-size: 18px;
}
.modal-dialog {
  width: 370px;
}

.readme-modal {
  width: 120px;
  display: inline-block !important;
}

.readme-modal-header {
  width: 110px;
}

.modal-format-header {
  margin: -15px 0 -20px;
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

      <div class="text-right">
        <a href= "edit.php?id=<?php echo $id; ?>"  class="btn btn-default btn-rounded mb-4">Edit</a>

        <!-- Trigger the modal with a button -->
        <button type="button" class="btn btn-default btn-rounded mb-4 export-file" data-toggle="modal" data-target="#exportReadme">Export</button>

      </div>

    </div>
  </div>
  <!-- Modal -->
  <div id="exportReadme" class="modal fade " role="dialog" style="margin-top: 200px;">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content ">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title text-left" style="">Readme Export</h3>
        </div>
        <div class="modal-body">
          <div class="modal-format-header">
            <div class="readme-modal-header" style="display:inline-block;">
              <h4>Format</h4>
            </div>
            <div class=""  style="display:inline-block; margin-left:15px;">
              <h4>Layout</h4>
            </div>
          </div>
          <hr>
          <div class="readme-csv">
            <div class="readme-modal-header" style="display:inline-block;">
              <h4>CSV <a data-toggle="tooltip" data-placement="top" title="All Data contains all the columns within the database"><i class="fas fa-info-circle"></i></a></h4>
            </div>
            <div class=""  style="display:inline-block; margin-left:15px;">
              <form class="form-horizontal" action="expbut_readme.php?id=<?php echo $id;?>&tbname=<?php echo $common_name;?>" method="post"  name="upload_excel" enctype="multipart/form-data">
                <input type="submit" name="export-all" class="btn btn-default btn-rounded mb-4" value="All Data"/>
                <input type="submit" name="export-template" class="btn btn-default btn-rounded mb-4" value="Blank Template"/>
              </form>
            </div>
          </div>
          <div class="readme-xml">
            <div class="readme-modal-header" style="display:inline-block;">
              <h4>XML <a data-toggle="tooltip" data-placement="top" title="The XML file is ESRI compatible"><i class="fas fa-info-circle"></i></a></h4>
            </div>
            <div class=""  style="display:inline-block; margin-left:15px;">
              <form class="form-horizontal" action="expxml_readme_ind.php?id=<?php echo $id;?>&tbname=<?php echo $common_name;?>" method="post"  name="upload_excel" enctype="multipart/form-data">
                <input type="submit" name="export-sde" class="btn btn-default btn-rounded mb-4" value="Sde"/>
                <input type="submit" name="export-sde" class="btn btn-default btn-rounded mb-4" value="Bytes"/>
              </form>
            </div>
          </div>
          <div class="readme-pdf">
            <div class="readme-modal-header" style="display:inline-block;">
              <h4>PDF <a data-toggle="tooltip" data-placement="top" title="The PDF version of the user guide."><i class="fas fa-info-circle"></i></a></h4>
            </div>
            <div class=""  style="display:inline-block; margin-left:15px;">
              <form class="form-horizontal" action="exppdf_readme.php?id=<?php echo $id;?>&tbname=<?php echo $common_name;?>" method="post" enctype="multipart/form-data">
                <input type="submit" name="export-opendata" class="btn btn-default btn-rounded mb-4" value="Open Data"/>
                <input type="submit" name="export-guide" class="btn btn-default btn-rounded mb-4" value="The Guide" disabled/>
              </form>
            </div>
          </div>
          <div class="readme-md">
            <div class="readme-modal-header" style="display:inline-block;">
              <h4>MarkDown <a data-toggle="tooltip" data-placement="top" title="Markdown is a lightweight and easy-to-use syntax for styling all forms of writing on the GitHub platform."><i class="fas fa-info-circle"></i></a></h4>
            </div>
            <div class=""  style="display:inline-block; margin-left:15px;">
              <form class="form-horizontal" action="expmd_readme.php?id=<?php echo $id;?>&tbname=<?php echo $common_name;?>" method="post" enctype="multipart/form-data">
                <input type="submit" name="export-opendata" class="btn btn-default btn-rounded mb-4" value="Open Data"/>
                <input type="submit" name="export-guide" class="btn btn-default btn-rounded mb-4" value="The Guide" disabled/>
              </form>
            </div>
          </div>
          <!-- <div class="readme-sde text-center readme-modal">
            <h4>Sde</h4>
            <form class="form-horizontal" action="expbut_readme.php?id=<?php echo $id;?>&tbname=<?php echo $common_name;?>" method="post"  name="upload_excel" enctype="multipart/form-data">
              <input type="submit" name="Export" class="btn btn-default btn-rounded mb-4" value=".CSV"/>
            </form>
            <form class="form-horizontal" action="expxml_readme_ind.php?id=<?php echo $id;?>&tbname=<?php echo $common_name;?>" method="post"  name="upload_excel" enctype="multipart/form-data">
              <input type="submit" name="Expor2xml" class="btn btn-default btn-rounded mb-4" value=".XML"/>
            </form>
            <form class="form-horizontal" action="expmd_readme.php?id=<?php echo $id;?>&tbname=<?php echo $common_name;?>" method="post" enctype="multipart/form-data">
              <input type="submit" name="Expor2md" class="btn btn-default btn-rounded mb-4" value=".MD"/>
            </form>
            <form class="form-horizontal" action="exppdf_readme.php?id=<?php echo $id;?>&tbname=<?php echo $common_name;?>" method="post" enctype="multipart/form-data">
              <input type="submit" name="Expor2pdf" class="btn btn-default btn-rounded mb-4" value=".PDF"/>
            </form>
          </div> -->


        </div>

      </div>

    </div>
  </div>
  <div id="wrapper">

    <!-- Top Div -->
    <div id="top-div" class="border-bottom">
      <h5>Common Name <a data-toggle="tooltip" data-placement="top" title="Descriptive name without underscores or abbreviations"><i class="fas fa-info-circle"></i></a></h5>
      <p><?php echo $common_name; ?></p>
      <br>
      <h5>SDE Name <a data-toggle="tooltip" data-placement="top" title="Name of the SDE data set"><i class="fas fa-info-circle"></i></a></h5>
      <p><?php echo $sde_name; ?></p>
      <br>
      <h5>Tags for Guide <a data-toggle="tooltip" data-placement="top" title="Enter search terms for the data set. These will be used to find the data set on the Esri HUB. These tags would be used for the guide."><i class="fas fa-info-circle"></i></a></h5>
      <p><?php echo $tags_guide; ?></p>
      <br>
      <h5>Tags for SDE <a data-toggle="tooltip" data-placement="top" title="Enter search terms for the data set. These will be used to find the data set on the Esri HUB. These tags would be used for the SDE."><i class="fas fa-info-circle"></i></a></h5>
      <p><?php echo $tags_sde; ?></p>
      <br>
      <h5>Summary <a data-toggle="tooltip" data-placement="top" title="One or two line description of the data set"><i class="fas fa-info-circle"></i></a></h5>
      <p><?php echo $summary; ?></p>
      <br>
      <h5>Summary - Update Date <a data-toggle="tooltip" data-placement="top" title="Date the summary was updated"><i class="fas fa-info-circle"></i></a></h5>
      <p><?php echo $summary_update_date; ?></p>
      <br>
      <h5>Description <a data-toggle="tooltip" data-placement="top" title="Concise, high level summary of the data set (no more than one or two paragraphs)."><i class="fas fa-info-circle"></i></a></h5>
      <p><?php echo $description; ?></p>
      <br>
      <h5>Description - Data Location <a data-toggle="tooltip" data-placement="top" title="Data location of the dataset"><i class="fas fa-info-circle"></i></a></h5>
      <p><?php echo $description_data_loc; ?></p>
      <br>
      <h5>Data Steward <a data-toggle="tooltip" data-placement="top" title="The group or division in DCP that is the business owner for the data set."><i class="fas fa-info-circle"></i></a></h5>
      <p><?php echo $data_steward; ?></p>
      <br>
      <h5>Data Engineer <a data-toggle="tooltip" data-placement="top" title="The group or division in DCP that is the technical owner for the data set. The data engineer cleans, prepares, and optimizes the data set under the guidance of the data steward."><i class="fas fa-info-circle"></i></a></h5>
      <p><?php echo $data_engineer; ?></p>
      <br>
      <h5>Credits <a data-toggle="tooltip" data-placement="top" title="For data sets received from an outside source and not modified by DCP, list the outside source. If DCP added value to the data, list both the outside source and DCP."><i class="fas fa-info-circle"></i></a></h5>
      <p><?php echo $credits; ?></p>
      <br>
      <h5>General Constraints Use Limitations <a data-toggle="tooltip" data-placement="top" title="Dataset is being provided by the Department of City Planning (DCP) on DCP's website for informational purposes only. DCP does not warranty the completeness, accuracy, content, or fitness for any particular purpose or use of dataset, nor are any such warranties to be implied or inferred with respect to Dataset as furnished on the website."><i class="fas fa-info-circle"></i></a></h5>
      <p><?php echo $genconst; ?></p>
      <br>
      <h5>Legal Constraints Use Limitations <a data-toggle="tooltip" data-placement="top" title="DCP and the City are not liable for any deficiencies in the completeness, accuracy, content, or fitness for any particular purpose or use of the dataset, or applications utilizing Dataset, provided by any third party."><i class="fas fa-info-circle"></i></a></h5>
      <p><?php echo $legconst; ?></p>
      <br>
      <h5>Update Frequency <a data-toggle="tooltip" data-placement="top" title="How often will this data set be updated? For data sets with a regular update schedule, this may be Monthly, Quarterly, or Annually. For one-off data sets, such as those created for a particular study, this may be None planned or As needed."><i class="fas fa-info-circle"></i></a></h5>
      <p><?php echo $update_freq; ?></p>
      <br>
      <h5>Date of Last Update <a data-toggle="tooltip" data-placement="top" title="When was the data set last updated? This should be the date that any processing and quality assurance was complete. It is the release date of the data set."><i class="fas fa-info-circle"></i></a></h5>
      <p><?php echo $date_last_update; ?></p>
      <br>
      <h5>Date of Underlying Data <a data-toggle="tooltip" data-placement="top" title="The “as of” date for the data. For a data set with multiple sources, like MapPLUTO, list each source and the date the data was extracted or received."><i class="fas fa-info-circle"></i></a></h5>
      <p><?php echo $date_underlying_data; ?></p>
      <br>
      <h5>Data Sources and Compilation Process <a data-toggle="tooltip" data-placement="top" title="If applicable, include a link to GitHub. Otherwise, describe how the data was sourced and processed."><i class="fas fa-info-circle"></i></a></h5>
      <p><?php echo $data_source; ?></p>
      <br>
      <h5>Version <a data-toggle="tooltip" data-placement="top" title="If applicable, include the version number, e.g., 17V1 for MapPLUTO"><i class="fas fa-info-circle"></i></a></h5>
      <p><?php echo $version; ?></p>
      <br>
      <h5>Common Uses <a data-toggle="tooltip" data-placement="top" title="Describe any common applications for the dataset (i.e. soft site or CEQR analyses), including primary users of the dataset."><i class="fas fa-info-circle"></i></a></h5>
      <p><?php echo $common_uses; ?></p>
      <br>
      <h5>Data Quality <a data-toggle="tooltip" data-placement="top" title="If known, include information on the overall accuracy and completeness of the data set. (Information on specific fields should be documented in the data dictionary)."><i class="fas fa-info-circle"></i></a></h5>
      <p><?php echo $data_quality; ?></p>
      <br>
      <h5>Caveats <a data-toggle="tooltip" data-placement="top" title="Outline any pitfalls, potential misconceptions, and/or misuses of the data. This will help users determine if the data set is applicable to their use case and help them avoid using the data incorrectly."><i class="fas fa-info-circle"></i></a></h5>
      <p><?php echo $caveats; ?></p>
      <br>
      <h5>Future Plans <a data-toggle="tooltip" data-placement="top" title="If applicable, describe any enhancements planned for the data set."><i class="fas fa-info-circle"></i></a></h5>
      <p><?php echo $future_plans; ?></p>
      <br>
      <h5>Distribution <a data-toggle="tooltip" data-placement="top" title="Who is allowed to use this data set? Specific divisions within DCP, all DCP staff, other city agencies, the public?"><i class="fas fa-info-circle"></i></a></h5>
      <p><?php echo $distribution; ?></p>
      <br>
      <h5>Contact <a data-toggle="tooltip" data-placement="top" title="If known, include contact information for the dataset."><i class="fas fa-info-circle"></i></a></h5>
      <p><?php echo $contact; ?></p>
      <br>
      <h5>Data Access <a data-toggle="tooltip" data-placement="top" title="The Guide Specific, path to layers."><i class="fas fa-info-circle"></i></a></h5>
      <p><?php echo $data_access; ?></p>
      <br>
    </div><!-- /Top Div -->

    <div class="dd-header-container">
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
              <form action="display.php?tbname=<?php echo $sde_name_underscore;?>&id=<?php echo $id;?>" class="form-horizontal" method="post" name="upload_excel" enctype="multipart/form-data">
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
      <div class="upload-readme container right-container">
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
                <form class="form-horizontal" action="expbut_dict.php?sde_normalize=<?php echo $sde_name_normalize;?>&sde_underscore=<?php echo $sde_name_underscore;?>" method="post"  name="upload_excel" enctype="multipart/form-data">
                  <input type="submit" name="Export" class="btn btn-default btn-rounded mb-4" value=".CSV"/>
                </form>
                <form class="form-horizontal" action="expxml_dict.php?sde_normalize=<?php echo $sde_name_normalize;?>&sde_underscore=<?php echo $sde_name_underscore;?>" method="post"  name="upload_excel" enctype="multipart/form-data">
                  <input type="submit" name="Expor2xml" class="btn btn-default btn-rounded mb-4" value=".XML"/>
                </form>
                <form class="form-horizontal" action="expmd_dict.php?sde_normalize=<?php echo $sde_name_normalize;?>&sde_underscore=<?php echo $sde_name_underscore;?>" method="post"  enctype="multipart/form-data">
                  <input type="submit" name="Expor2md" class="btn btn-default btn-rounded mb-4" value=".MD"/>
                </form>
                <form class="form-horizontal" action="exppdf_dict.php?sde_normalize=<?php echo $sde_name_normalize;?>&sde_underscore=<?php echo $sde_name_underscore;?>" method="post"  enctype="multipart/form-data">
                  <input type="submit" name="Expor2pdf" class="btn btn-default btn-rounded mb-4" value=".PDF"/>
                </form>
              </div>

            </div>

          </div>
        </div>
        <div class="text-right" style="display: inline;">
          <a href="" class="btn btn-default btn-rounded mb-4" data-toggle="modal" data-target="#dd-upload">Upload From File</a>
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
                  <form action='edit_dd.php' id='form".$row[0]."'>
                  <button class='save-btn' id='saveedit" .$row[0]."' type='submit' name='save-submit' form='form".$row[0]."' style=display:none;'>
                    <i class='far fa-save' ></i>
                  </button>
                  </form>

              </td>";
              echo "<td style='text-align: center'>
                      <form action=edit_dd.php?delete-id=".$row[0]."&tbname=". $sde_name_underscore ."&id=".$id." " . " method='post' enctype='multipart/form-data'>
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
              <form action="edit_dd.php" id="add_row_form">
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

  <script>
    var counter = 0;
    // Data dictionary Edit event listener
    function editFunc(clicked_id) {

      var editbtn = document.getElementById(clicked_id);
      var savebtn = document.getElementById("save" + clicked_id);
      var allClasses = document.getElementsByClassName("text" + clicked_id);
      if(counter < 1) {
        for (var i = 0; i < allClasses.length; i++) {
          allClasses[i].disabled = false;
          allClasses[i].style.border = "0.8px solid #bababa";
        }
        editbtn.style.display = "none";
        savebtn.style.display = "inline-block";
        counter++;
      }
      else {
        alert("Please save the other row first");
      }

    }

  </script>
</body>
</html>