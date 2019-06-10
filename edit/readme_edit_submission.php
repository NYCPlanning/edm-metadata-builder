<?php
// Updating readme
if (isset($_POST['readme_save_button'])) {
  $id = $_POST['id'];
  $sde_old = $_POST['sde_old'];
  $sde_old = str_replace(' ', '_', $sde_old);
  $sde = $_POST['sde_name'];
  $sde_new =  str_replace(' ', '_', $sde);
  $common_name = $_POST['common_name'];
  $tags_guide = $_POST['tags_guide'];
  $tags_sde = $_POST['tags_sde'];
  $summary = $_POST['summary'];
  $summary_update_date = $_POST['summary_update_date'];
  $description = $_POST['description'];
  $description_data_loc = $_POST['description_data_loc'];
  $data_steward = $_POST['data_steward'];
  $data_engineer = $_POST['data_engineer'];
  $credits = $_POST['credits'];
  $genconst = $_POST['genconst'];
  $legconst = $_POST['legconst'];
  $update_freq = $_POST['update_freq'];
  $data_last_update = $_POST['date_last_update'];
  $date_underlying_data = $_POST['date_underlying_data'];
  $data_source = $_POST['data_source'];
  $version = $_POST['version'];
  $common_uses = $_POST['common_uses'];
  $data_quality = $_POST['data_quality'];
  $caveats = $_POST['caveats'];
  $future_plans = $_POST['future_plans'];
  $distribution = $_POST['distribution'];
  $contact = $_POST['contact'];
  $data_access = $_POST['data_access'];


  $sql = "SELECT * FROM $sde_new";
  $result = pg_query($sql);
  // If the new sde name is not a duplicate
  if (pg_num_rows($result)==0) {
    // Update readme row
    $sql2 = "UPDATE readme
             SET common_name = $1,
                sde_name    = $2,
                tags_guide = $3,
                tags_sde  = $4,
                summary = $5,
                summary_update_date = $6,
                description = $7,
                description_data_loc = $8,
                data_steward = $9,
                data_engineer = $10,
                credits = $11,
                genconst = $12,
                legconst = $13,
                update_freq = $14,
                date_last_update = $15,
                date_underlying_data = $16,
                data_source = $17,
                version = $18,
                common_uses = $19,
                data_quality = $20,
                caveats = $21,
                future_plans = $22,
                distribution = $23,
                contact = $24,
                data_access = $25
                WHERE uid = $26";
    $result = pg_query_params($db, $sql2, array($common_name, $sde, $tags_guide, $tags_sde, $summary, $summary_update_date, $description, $description_data_loc, $data_steward, $data_engineer,
                                      $credits, $genconst, $legconst, $update_freq, $data_last_update, $date_underlying_data, $data_source, $version, $common_uses, $data_quality,
                                      $caveats, $future_plans, $distribution, $contact, $data_access, $id));


    // If update was successful and the new sde name doesn't equal old sde name
    if($result && ($sde_new !== $sde_old)) {

      $sql1 = "ALTER TABLE ".$sde_old." RENAME TO ".$sde_new."";
      pg_query($sql1);

    }
    // else {
    //   echo "Sde table name didn't update.";
    // }
    unset($_SESSION["edit-readme"]);
  }


}

    ?>
