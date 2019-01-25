<?php
if (isset($_POST['readme_save_button'])) {
  $id = $_POST['id'];
  $sql = "UPDATE readme
          SET common_name = '" . $_POST['common_name'] . "',
              sde_name    = '" . $_POST['sde_name'] . "',
              tags_guide = '" . $_POST['tags_guide'] . "',
              tags_sde  = '" . $_POST['tags_sde'] . "',
              summary = '" . $_POST['summary'] . "',
              summary_update_date = '" . $_POST['summary_update_date']. "',
              description = '" . $_POST['description'] . "',
              description_data_loc = '" . $_POST['description_data_loc'] . "',
              data_steward = '" . $_POST['data_steward'] . "',
              data_engineer = '" . $_POST['data_engineer'] . "',
              credits = '" . $_POST['credits'] . "',
              genconst = '" . $_POST['genconst'] . "',
              legconst = '" . $_POST['legconst'] . "',
              update_freq = '" . $_POST['update_freq'] . "',
              date_last_update = '" . $_POST['date_last_update'] . "',
              date_underlying_data = '" . $_POST['date_underlying_data'] . "',
              data_source = '" . $_POST['data_source'] . "',
              version = '" . $_POST['version'] . "',
              common_uses = '" . $_POST['common_uses'] . "',
              data_quality = '" . $_POST['data_quality'] . "',
              caveats = '" . $_POST['caveats'] . "',
              future_plans = '" . $_POST['future_plans'] . "',
              distribution = '" . $_POST['distribution'] . "',
              contact = '" . $_POST['contact'] . "'
             WHERE uid = $id";
  // $sql .= "ALTER TABLE table_name RENAME TO new_table_name";
  $result = pg_query($sql);
  pg_free_result($result);
}

    ?>
