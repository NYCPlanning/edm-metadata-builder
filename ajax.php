<?php
    include 'config.php';
//Getting value of "search" variable from "script.js".
if (isset($_POST['search'])) {
   //Search box value assigning to $Name variable.
   $Name = $_POST['search'];
   //Search query.
   $Query = "SELECT common_name FROM readme WHERE LOWER(common_name) LIKE LOWER('%$Name%') ORDER BY common_name ASC LIMIT 5 ";
   //Query execution
   $ExecQuery = pg_query($Query);
   //Creating unordered list to display result.
   echo '<ul>';
   //Fetching result from database.
   while ($Result = pg_fetch_array($ExecQuery)) {
?>

   <!-- Creating unordered list items. Calling javascript function named as "fill" found in "script.js" file. By passing fetched result as parameter. -->
   <li onclick='fill("<?php echo $Result['common_name']; ?>")'>

   <a>
       <!-- Assigning searched result in "Search box" in "navbar.php" file. -->
       <?php echo $Result['common_name']; ?>
   </li></a>

   <!-- Below php code is just for closing parenthesis. Don't be confused. -->
   <?php
}}





if (isset($_POST['filter_search'])) {
   //Search box value assigning to $Name variable.
   $Name = $_POST['filter_search'];
   //Search query.
   $Query = "SELECT uid, common_name, description, date_last_updated FROM readme WHERE LOWER(common_name) LIKE LOWER('%$Name%') ORDER BY common_name";
   //Query execution
   $ExecQuery = pg_query($Query);
   $row =pg_fetch_all($ExecQuery);


   foreach($row as $r) {
     echo "<a href='display.php?id=".$r["uid"]."'><h4>" .  $r["common_name"] . "</h4></a>";
     echo "<p><em>" . $r["description"] . "</em></p>";
     echo "<h6>Date Last Modified: " . $r["date_last_updated"] . "</h6>";
     echo "<hr>";
   }

}

if(isset($_POST['filter_search_blank'])) {
  //Search query.
  $Query = "SELECT uid, common_name, description, date_last_updated FROM readme";
  //Query execution
  $ExecQuery = pg_query($Query);
  $row =pg_fetch_all($ExecQuery);


  foreach($row as $r) {
    echo "<a href='display.php?id=".$r["uid"]."'><h4>" .  $r["common_name"] . "</h4></a>";
    echo "<p><em>" . $r["description"] . "</em></p>";
    echo "<h6>Date Last Modified: " . $r["date_last_updated"] . "</h6>";
    echo "<hr>";
  }
}





//Getting value of "common" variable from "script.js".
if (isset($_POST['common'])) {

   //Search box value assigning to $Name variable.
   $Name = $_POST['common'];
   //Search query.
   $Query = "SELECT common_name FROM readme WHERE LOWER(common_name) = LOWER('$Name')";
   //Query execution
   $ExecQuery = pg_query($Query);


   //Fetching result from database.
   while ($Result = pg_fetch_array($ExecQuery)) {
       $common = $Result['common_name'];
       echo $common;
   }
}





//Getting value of "sde" variable from "script.js".
if (isset($_POST['sde'])) {

   //Search box value assigning to $Name variable.
   $Name = $_POST['sde'];
   //Search query.
   $Query = "SELECT sde_name FROM readme WHERE LOWER(sde_name) = LOWER('$Name')";
   //Query execution
   $ExecQuery = pg_query($Query);


   //Fetching result from database.
   while ($Result = pg_fetch_array($ExecQuery)) {
       $sde = $Result['sde_name'];
       echo $sde;
   }
 }


 //Getting value of "deleteDataset" variable from "script.js".
 if (isset($_POST['deleteCommon'])) {

    $id = $_POST['deleteID'];
    $sde = $_POST['deleteSde'];
    $common = $_POST['deleteCommon'];
    $sde_space = str_replace('_', ' ', $sde);
    // Delete row from readme table.
    $Query1 = "DELETE FROM readme WHERE uid = $id";
    // Drop data dictionary table associated with that readme record
    $Query2 = "DROP TABLE $sde";
    //Query execution
    $Query3 = "DELETE FROM collaboration WHERE sdename = '$sde_space'";
    pg_query($Query1);
    pg_query($Query2);
    pg_query($Query3);

}


//Getting value of "sde table" variable from "script.js".
// if (isset($_POST['addSde'])) {
//    $sde = $_POST['addSde'];
//    $sql_add = "INSERT INTO $sde (orders,field_name,longform_name,description,geocoded,required,data_type,expected_allowed_values,last_modified_date,no_longer_in_use,notes)
//            VALUES ('','','','','','','','','','','')";
//    pg_query($sql_add);
//
//    $dd_query = "SELECT uid FROM $sde ORDER BY uid DESC LIMIT 1";
//
//    $dd_results = pg_query($dd_query);
//    $dd_row = pg_fetch_assoc($dd_results);
//    $uid_focus = $dd_row['uid'];
//    echo $uid_focus;
//
//
// }

?>
