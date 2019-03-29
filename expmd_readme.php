<?php
require 'vendor/autoload.php';
include 'config.php';
use League\HTMLToMarkdown\HtmlConverter;

$uid = $_GET['id'];
$tbname = $_GET['tbname'];
$readme_query = "SELECT * FROM readme WHERE uid = $uid";

$readme_results = pg_query($readme_query);
$readme_row = pg_fetch_assoc($readme_results);
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

 // Connect to the Database
if (isset($_POST["export-opendata"])) {
  //the header is used to download the csv file with the name passed in the header
  header('Content-Type: text/csv;');
  header('Content-Disposition: attachment; filename='.$tbname.'.md'); //

  //opening the csv file that is to be downloaded
  $fp = fopen("php://output", "w");
  $html = '
  <h3>Common Name</h3>
  <p>'. $common_name.'</p>
  <br>
  <h3>SDE Name</h3>
  <p>' . $sde_name . '</p>
  <br>
  <h3>Tags for Guide</h3>
  <p>' . $tags_guide .'</p>
  <br>
  <h3>Tags for SDE</h3>
  <p>' . $tags_sde . '</p>
  <br>
  <h3>Summary</h3>
  <p>' .$summary. '</p>
  <br>
  <h3>Summary - Update Date</h3>
  <p>' . $summary_update_date . '</p>
  <br>
  <h3>Description</h3>
  <p>' .$description .'</p>
  <br>
  <h3>Description - Data Location</h3>
  <p>' .$description_data_loc .'</p>
  <br>
  <h3>Data Steward</h3>
  <p>'.$data_steward .'</p>
  <br>
  <h3>Data Engineer</h3>
  <p>' .$data_engineer . '</p>
  <br>
  <h3>Credits</h3>
  <p>' .$credits .'</p>
  <br>
  <h3>General Constraints Use Limitations</h3>
  <p>' .$genconst .'</p>
  <br>
  <h3>Legal Constraints Use Limitations</h3>
  <p>' .$legconst .'</p>
  <br>
  <h3>Update Frequency</h3>
  <p>' .$update_freq .'</p>
  <br>
  <h3>Date of Last Update</h3>
  <p>' .$date_last_update .'</p>
  <br>
  <h3>Date of Underlying Data</h3>
  <p>' .$date_underlying_data .'</p>
  <br>
  <h3>Data Sources and Compilation Process</h3>
  <p>' .$data_source .'</p>
  <br>
  <h3>Version</h3>
  <p>' .$version .'</p>
  <br>
  <h3>Common Uses</h3>
  <p>' .$common_uses.'</p>
  <br>
  <h3>Data Quality</h3>
  <p>' .$data_quality.'</p>
  <br>
  <h3>Caveats</h3>
  <p>' .$caveats .'</p>
  <br>
  <h3>Future Plans</h3>
  <p>' .$future_plans .'</p>
  <br>
  <h3>Distribution</h3>
  <p>' . $distribution .'</p>
  <br>
  <h3>Contact</h3>
  <p>' .$contact .'</p>
  <br>';


  $converter = new HtmlConverter();

  $markdown = $converter->convert($html);
  echo $markdown;

  fclose($fp);
}

?>
