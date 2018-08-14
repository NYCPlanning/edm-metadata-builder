<!-- code for getting the dropdown list for Maintenance Frequency
 -->
<?php
include 'config.php';

    $sql = "SELECT * FROM MaintFreq";
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


