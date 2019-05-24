<?php

include 'config.php';
  // Connect to the Database
  if (isset($_POST["template_submit"])) {
  //get records from database
  header('Content-Type: text/csv;');
  header('Content-Disposition: attachment; filename=Template.csv');
  $fp = fopen("php://output", "w");
  fputcsv($fp, array('column_name','column_description','code_def','add_notes','internal_notes'));

  fclose($fp);
}

?>
