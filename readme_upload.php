<?php
if(isset($_POST['readme_submit'])) {
    // Get the file
    $id = $_GET['id'];
    $file = $_FILES["file"]["tmp_name"];
    // Get contents of the file
    $file_contents = file_get_contents($file);
    // Get the file extension
    $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    // XML file upload
    if($ext === 'xml') {
      $file_string = simplexml_load_string($file_contents);
      $json = json_encode($file_string);
      $json_decoded = json_decode($json, true);
      // $common_name = $json_decoded["dataIdInfo"]["idCitation"]["resTitle"];

      $tags_guide_array_1 = $json_decoded["dataIdInfo"]["searchKeys"];
      $tags_guide_array_2 = $json_decoded["idinfo"]["keywords"]["theme"][0];
      $tags_guide_array_3 = $json_decoded["idinfo"]["keywords"]["place"];
      $tags_guide_string = '';

      if($tags_guide_array_1) {
        foreach ($tags_guide_array_1['keyword'] as $p) {
            $tags_guide_string = $tags_guide_string . $p . ', ';
        }
      } else if($tags_guide_array_2 || $tags_guide_array_3) {

          foreach ($tags_guide_array_2['themekey'] as $p) {
            $tags_guide_string = $tags_guide_string . $p . ', ';
          }
          foreach($tags_guide_array_3['placekey'] as $p) {
            $tags_guide_string = $tags_guide_string . $p . ', ';
          }
      }

      $tags_guide = rtrim(trim($tags_guide_string), ',');
      $tags_guide = str_replace("'", "''", $tags_guide);
      $tags_sde = $tags_guide;
      $summary = preg_replace("/^REQUIRED: /i", "", $json_decoded["idinfo"]["descript"]["purpose"]);
      $summary = str_replace("'", "''", $summary);
      $descript = preg_replace("/^REQUIRED: /i", "", $json_decoded["idinfo"]["descript"]["abstract"]);
      $descript = str_replace("'", "''", $descript);
      $credits = $json_decoded["dataIdInfo"]["idCredit"];
      $credits = str_replace("'", "''", $credits);
      $update_freq = '';
      $update_freq = $json_decoded["idinfo"]["status"]["update"];
      $update_freq = str_replace("'", "''", $update_freq);

      if(!$update_freq) {
        $update_freq_code = $json_decoded["mdMaint"]["maintFreq"]["MaintFreqCd"];
        if($update_freq_code['@attributes']['value'] === '009') {
          $update_freq = 'as-needed';
        } else if ($update_freq_code['@attributes']['value'] === '008') {
          $update_freq = 'annually';
        } else if ($update_freq_code['@attributes']['value'] === '007') {
          $update_freq = 'biannually';
        } else if ($update_freq_code['@attributes']['value'] === '006') {
          $update_freq = 'quarterly';
        } else if ($update_freq_code['@attributes']['value'] === '005') {
          $update_freq = 'monthly';
        } else if ($update_freq_code['@attributes']['value'] === '004') {
          $update_freq = 'fortnightly';
        } else if ($update_freq_code['@attributes']['value'] === '003') {
          $update_freq = 'weekly';
        } else if ($update_freq_code['@attributes']['value'] === '002') {
          $update_freq = 'daily';
        }
      }

      $version = $json_decoded["idinfo"]["citation"]["citeinfo"]["edition"];
      $version = str_replace("'", "''", $version);

      $contact = $json_decoded["idinfo"]["ptcontac"]["cntinfo"]["cntorgp"]["cntorg"];
      $contact = str_replace("'", "''", $contact);

      $date_last_update = $json_decoded["Esri"]["ModDate"];
      $date_underlying_data = preg_replace("/T00:00:00$ /i", "", $json_decoded["dataIdInfo"]["idCitation"]["date"]["createDate"]);

      $query = "UPDATE ReadMe
                SET tags_guide = '$tags_guide',
                    tags_sde = '$tags_sde',
                    summary = '$summary',
                    description = '$descript',
                    credits = '$credits',
                    update_freq = '$update_freq',
                    version = '$version',
                    date_last_update = '$date_last_update',
                    date_underlying_data = '$date_underlying_data',
                    contact = '$contact'
                WHERE uid = $id";

      // $query="INSERT INTO ReadMe(tags_guide,summary,description,credits,update_freq,date_last_update, date_underlying_data) VALUES ('$tags_guide','$summary','$descript','$credits','$update_freq','$date_last_update','$date_underlying_data')";
      $res = pg_query($db, $query);

    }
    // CSV file upload
    else if($ext === 'csv') {
      if ($_FILES["file"]["size"] > 0) {
        $handle = fopen($file,"r");
        $flag = true;
          //loop through the csv file and insert into database
        while (($data = fgetcsv($handle,10000,",")) !== FALSE) {
           if($flag) { $flag = false; continue; }

            $query = "UPDATE ReadMe
                      SET tags_guide = '$data[2]',
                      tags_sde = '$data[3]',
                      summary = '$data[4]',
                      summary_update_date = '$data[5]',
                      description = '$data[6]',
                      description_data_loc = '$data[7]',
                      data_steward = '$data[8]',
                      data_engineer = '$data[9]',
                      credits = '$data[10]',
                      genconst = '$data[11]',
                      legconst = '$data[12]',
                      update_freq = '$data[13]',
                      date_last_update = '$data[14]',
                      date_underlying_data = '$data[15]',
                      data_source = '$data[16]',
                      version = '$data[17]',
                      common_uses = '$data[18]',
                      data_quality = '$data[19]',
                      caveats = '$data[20]',
                      future_plans = '$data[21]',
                      distribution = '$data[22]',
                      contact = '$data[23]'
                      WHERE uid = $id";

                 // $query="INSERT INTO ReadMe(common_name, sde_name, tags_guide, tags_sde, summary, summary_update_date, description, description_data_loc,
                 // data_steward, data_engineer, credits, genconst, legconst, update_freq, date_last_update, date_underlying_data, data_source, version,
                 // common_uses, data_quality, caveats, future_plans, distribution, contact) VALUES ('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]','$data[7]','$data[8]','$data[9]','$data[10]','$data[11]','$data[12]','$data[13]','$data[14]','$data[15]','$data[16]','$data[17]','$data[18]', '$data[19]','$data[20]', '$data[21]', '$data[22]','$data[23]')";
            $res = pg_query($db, $query);
          }
      fclose($handle);
       }
    }


}


 ?>
