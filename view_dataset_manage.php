<?php
include ('navbar.php');
$email = $_SESSION['user'];
$u_type = $_SESSION['type'];

$sde = $_GET['sde'];
$common = $_GET['common'];
$delete_email = $_GET['delete_email'];

if(isset($_GET['delete'])) {
  if($email == $delete_email && $u_type == 'basic'){
    $d_query = "DELETE FROM collaboration WHERE sdename = '$sde' AND email = '$delete_email'";
    pg_query($d_query);
    echo '<script>';
    echo 'window.location.href="view_dataset.php"';  //not showing an alert box.
    echo '</script>';
  } elseif($u_type == 'basic') {
    $d_query = "DELETE FROM collaboration WHERE sdename = '$sde' AND email = '$delete_email'";
    pg_query($d_query);
  } elseif ($u_type == 'admin' || $u_type == 'superuser'){
      echo '<script>';
      echo 'alert("User cannot be removed.")';  //not showing an alert box.
      echo '</script>';
  }

}
$query = "SELECT email FROM collaboration WHERE sdename = '$sde' ORDER BY email";
$result = pg_query($query);
$row =pg_fetch_all($result);



?>

<!-- Modal -->
<div id="exportReadme" class="modal fade " role="dialog" style="margin-top: 200px;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content ">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title text-left" style="">Add Collaborators</h3>
      </div>
      <div class="modal-body">
        <div class="">
          <form class="" method="post">

            <div class="col-md-8">
              <label for="email">Email:</label>
              <input type="text" name="email" id="email">
            </div>
            <input type="submit" name="submit" value="Add">
          </form>

        </div>

      </div>

    </div>

  </div>
</div>

<div class="container">
  <h3><?php echo $common; ?></h3>
  <hr>
  <h3>Collaborators</h3>
  <button type="button" class="btn btn-default btn-rounded mb-4 export-file" data-toggle="modal" data-target="#exportReadme"><i class="fas fa-plus-circle"></i></button>
  <br>
  <?php
    // Displays all the retrieved data from the database
    foreach($row as $r) {
      echo "<p style='display:inline-block;'>".$r["email"]."  </p><a id=".$r["email"].">  <i id=".$r["email"]." class='far fa-trash-alt' onClick='deleteUser(this.id)'></i></a><br>";

    }
  ?>
</div>
<script>

   function deleteUser(id) {
       if (confirm("Are you sure you want to delete this user?"))
       {
           window.location.href= "view_dataset_manage.php?delete=True&sde=<?php echo $sde.'&common='.$common.'&delete_email=';?>"+id;
       }
       else
       {
          window.location.href = "view_dataset_manage.php?sde=<?php echo $sde.'&common='.$common.'';?>";
       }
   }

</script>
