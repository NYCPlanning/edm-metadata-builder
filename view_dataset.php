<?php
include ('navbar.php');
$email = $_SESSION['user'];
$u_type = $_SESSION['type'];
?>
<div class="container">
  <h3>Your Datasets</h3>
  <br><br>
  <!-- Retrieve data from database -->
  <?php
  function custom_echo($x, $length)
  {
    if(strlen($x)<=$length)
    {
      echo $x;
    }
    else
    {
      $y=substr($x,0,$length) . '...';
      echo $y;
    }
  }
  if($u_type == 'basic'){
    $query = "SELECT common_name, description FROM readme, collaboration WHERE sdename = sde_name AND email = '$email' ORDER BY common_name";
  } elseif($u_type == 'admin' || $u_type == 'superuser') {
    $query = "SELECT common_name, description FROM readme ORDER BY common_name";
  }

  $result = pg_query($query);
  $row =pg_fetch_all($result);

  // Displays all the retrieved data from the database
  foreach($row as $r) {
    echo "<a href='#'><h4>" .  $r["common_name"] . "</h4></a>";
    echo "<p><em>" . custom_echo($r['description'], 350) . "</em></p>";
    echo "<hr>";
  }


  ?>
</div>
