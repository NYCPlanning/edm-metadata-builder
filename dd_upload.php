<?php
if (isset($_POST['dd_submit_append'])) {
  // Get the file
  $tbname = $_GET['tbname'];
  $id = $_GET['id'];
  $file = $_FILES["file"]["tmp_name"];
  // Get contents of the file
  $file_contents = file_get_contents($file);
  // Get the file extension
  $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

  // XML file upload
  if($ext === 'xml') {
    $xml = simplexml_load_file($file);

    $results = $xml->xpath("//attr");
    $order = 1;

    foreach ($results as $result) {
      $attrlabl = $result->attrlabl. " ";
      $attrdef = $result->attrdef. " " .$result->attrdomv->udom. " ";

      foreach($result->attrdomv->edom as $e) {
        $edom .= $e->edomv . " - " . $e->edomvd . ", ";
      }
      $query = "INSERT INTO ".$tbname."(orders, field_name, description, expected_allowed_values) VALUES ('$order','$attrlabl','$attrdef','$edom')";
      pg_query($query);
      $order += 1;
      $edom ="";
    }
}


  // CSV file upload
  else if($ext === 'csv') {
    if ($_FILES["file"]["size"] > 0) {

        $handle = fopen($file,"r");
         while (($data = fgetcsv($handle,10000,",")) !== FALSE) {
         if($flag) { $flag = false; continue; }
          $query2 = "INSERT INTO ".$tbname."(orders, field_name, longform_name, description, geocoded, required, data_type, expected_allowed_values, last_modified_date, no_longer_in_use, notes) VALUES ('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]','$data[7]','$data[8]','$data[9]','$data[10]')";
          $res2 = pg_query($query2);
      }

    fclose($handle);
     }
  }


}


else if (isset($_POST['dd_submit_overwrite'])) {
  $tbname = $_GET['tbname'];
  $id = $_GET['id'];
  $file = $_FILES["file"]["tmp_name"];
  // Get contents of the file
  $file_contents = file_get_contents($file);
  // Get the file extension
  $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);


  // XML file upload
  if($ext === 'xml') {
    $query2 = "DELETE FROM " .$tbname;
    pg_query($query2);
    $xml = simplexml_load_file($file);

    $results = $xml->xpath("//attr");
    $order = 1;

    foreach ($results as $result) {
      $attrlabl = $result->attrlabl. " ";
      $attrdef = $result->attrdef. " " .$result->attrdomv->udom. " ";

      foreach($result->attrdomv->edom as $e) {
        $edom .= $e->edomv . " - " . $e->edomvd . ", ";
      }
      $query = "INSERT INTO ".$tbname."(orders, field_name, description, expected_allowed_values) VALUES ('$order','$attrlabl','$attrdef','$edom')";
      pg_query($query);
      $order += 1;
      $edom ="";

  }
}

  // CSV file upload
  else if($ext === 'csv') {
    $query3 = "DELETE FROM " .$tbname;
    pg_query($query3);
    if ($_FILES["file"]["size"] > 0) {
        $handle = fopen($file,"r");
         while (($data = fgetcsv($handle,10000,",")) !== FALSE) {
         if($flag) { $flag = false; continue; }
          $query4 = "INSERT INTO ".$tbname."(orders, field_name, longform_name, description, geocoded, required, data_type, expected_allowed_values, last_modified_date, no_longer_in_use, notes) VALUES ('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]','$data[7]','$data[8]','$data[9]','$data[10]')";
          $res4 = pg_query($query4);
      }

    fclose($handle);
     }
  }


}
 ?>
