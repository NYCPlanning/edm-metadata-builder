<?php
    include 'config.php';

//Getting value of "search" variable from "script.js".
if (isset($_POST['search'])) {

//Search box value assigning to $Name variable.

   $Name = $_POST['search'];

//Search query.

   $Query = "SELECT common_name FROM readme WHERE LOWER(common_name) LIKE LOWER('%$Name%') LIMIT 5";

//Query execution

   $ExecQuery = pg_query($Query);

//Creating unordered list to display result.

   echo '

<ul>

   ';

   //Fetching result from database.

   while ($Result = pg_fetch_array($ExecQuery)) {

       ?>

   <!-- Creating unordered list items.

        Calling javascript function named as "fill" found in "script.js" file.

        By passing fetched result as parameter. -->

   <li onclick='fill("<?php echo $Result['common_name']; ?>")'>

   <a>

   <!-- Assigning searched result in "Search box" in "navbar.php" file. -->

       <?php echo $Result['common_name']; ?>

   </li></a>

   <!-- Below php code is just for closing parenthesis. Don't be confused. -->

   <?php

}}


?>

</ul>
