<!-- code for getting the dropdown list of all the sde_names in ReadMe so as to export each row individually
 -->
<?php
include 'config.php';

    $sql = "SELECT sde_name FROM ReadMe";
    $result = pg_query($sql);

    if (!$result) {
        echo "DB Error, could not list tables\n";
        echo 'MySQL Error: ' . pg_error();
        exit;
    }

    while ($row = pg_fetch_row($result)) {


   $tables .= "<option value={$row[0]}>{$row[0]}</option>";
    }

    pg_free_result($result);
    ?>