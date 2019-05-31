<?php
include ('navbar.php');
include ('import/readme_upload.php');
include ('edit/readme_edit_submission.php');
include ('import/dd_upload.php');
include ('edit/dd_delete.php');
include ('edit/dd_edit_submission.php');


// After import metadata page form submission
if (isset($_POST['common_name'])) {
  $current_date = date("m-d-Y");
  $common_name_normalize = trim($_POST['common_name']);
  $sde_name_normalize = trim($_POST['sde_name']);
  // Replace space with underscore
  $sde_name_underscore =  str_replace(' ', '_', $sde_name_normalize);
  $query = "INSERT INTO ReadMe(common_name, sde_name, date_last_updated) VALUES ('$common_name_normalize','$sde_name_normalize', '$current_date');";
  $query .= "CREATE TABLE $sde_name_underscore (
                    uid serial PRIMARY key NOT NULL,
                    orders text,
                    field_name text,
                    longform_name text,
                    description text,
                    geocoded text,
                    required text,
                    data_type text,
                    expected_allowed_values text,
                    last_modified_date text,
                    no_longer_in_use text,
                    notes text
                  );";
  pg_query($query);
  if ($u_type == 'basic') {
    $u_query = "INSERT INTO collaboration (sdename, email)
                VALUES ('$sde_name_normalize', '$email')";
    pg_query($u_query);
  }
}

// Get search result from the navbar
$common_name_search = $_GET['search'];
$id_query = "SELECT uid FROM readme WHERE LOWER(common_name) = LOWER('$common_name_search')";
$id_results = pg_query($id_query);
$id_row = pg_fetch_assoc($id_results);
$id = $id_row['uid'];

// Getting the uid
if (isset($_GET['id'])) {
  $id = $_GET['id'];
} else if (isset($_POST['id'])){
  $id = $_POST['id'];
} else if (isset($_GET['search'])) {
  $id_query = "SELECT uid FROM readme WHERE common_name = '$common_name_search'";
  $id_results = pg_query($id_query);
  $id_row = pg_fetch_assoc($id_results);
  $id = $id_row['uid'];
} else{
  $id_query = "SELECT uid FROM readme WHERE sde_name = '$sde_name_underscore'";
  $id_results = pg_query($id_query);
  $id_row = pg_fetch_assoc($id_results);
  $id = $id_row['uid'];
}

// Retrieve row from Readme table
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

if($privilege && $_GET['edit-dd'] == "TRUE") {
  $_SESSION["edit-dd"] = TRUE;
}

if($privilege && $_GET['edit-readme'] == "TRUE") {
  $_SESSION["edit-readme"] = TRUE;
}

// If dataset name doesn't exist in database send user back to Main.php
if (!isset($id)) {
  echo '<script>';
  echo 'window.location.href=' . $path .'/Main.php';  //not showing an alert box.
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

.modal-content {
  margin-top: 300px;
}

.readme-header-container {
  width: 100%;
  padding: 16px 10px 0 0;
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
.text-right a{
  margin: -10px 10px 0 0;
}
.dd-header-container a {
  margin: 10px 10px 0 0;
}
/* Readme Overlay */
#modalLoginForm {
  margin-top: 20%;
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
<!-- Dataset Common name -->
<div class="common-name-header border-bottom">
  <h3 id="common-name-delete"><?php echo $common_name; ?></h3>
  <input type="hidden" id="sde-name-delete" value="<?php echo $sde_name_underscore; ?>">
  <input type="hidden" id="readme-id" value="<?php echo $id; ?>">
  <?php
      // Dataset Delete button will show if user has access to this dataset
      if ($privilege) {
        echo'<a id="deleteData"><i class="far fa-trash-alt dataset-delete"></i></a>';
      }
  ?>
</div>



<?php
  // Readme
  // The normal display of readme with edit and export
  if(!isset($_SESSION['edit-readme'])) {
    include("edit/readme_display.php");
    // When Edit readme is clicked
  } else {
    include("edit/edit_readme.php");
  }


  //Data Dictionary
  // The normal display of Data Dictionary with edit and export
  if(!isset($_SESSION['edit-dd'])) {
    include("edit/dd_display.php");
  } else {
    // When Edit Data Dictionary is clicked
    include("edit/edit_dd.php");
  }
?>
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
