<?php
include ('navbar.php');
$u_type = $_SESSION['type'];
$email = $_SESSION['user'];
$delete_email = $_GET['delete_email'];


if(isset($_POST['save-email'])) {
  $save_email = $_POST['save-email'];
  $save_type = $_POST['s0'];
  $save_verified = intval($_POST['s2']);
  $save_email = str_replace("%40", "@", $save_email);
  $s_query = "UPDATE users
              SET type = '$save_type', verified = '$save_verified'
              WHERE email = '$save_email'";
  pg_query($s_query);
}


if(isset($_GET['delete'])) {
  // If user is deleting their own account they cannot delete it.
  if($email == $delete_email){
    echo '<script>';
    echo 'alert("You cannot delete your own account!")';
    echo '</script>';
    // Else delete user from users table and all the datasets they have access to in the collaboration table
  } else {
    $d_query  = "DELETE FROM collaboration WHERE email = '$delete_email';";
    $d_query .= "DELETE FROM users WHERE email = '$delete_email'";
    pg_query($d_query);
  }

}
?>

<style>
table, td, th {
    border: 0.5px solid #D6D7DB;
    text-align: left;
}

th {
    padding: 10px;
  }

</style>

<div class="container">
  <h3>Manage Users</h3>
  <br><br>
  <!-- Retrieve data from database -->
  <?php
  // If user is admin
  if($u_type == 'admin') {
    $query = "SELECT type, email,verified FROM users ORDER BY email, type";
    $result = pg_query($query);
    $i = 0;
    echo '<div style="width:680px; margin:0 auto;"><table><tr>';
    echo '<th>Type</th><th>Email</th><th>Verified</th><th>Edit</th><th>Delete</th></tr>';

    while($row = pg_fetch_row($result)) {
      echo "<tr>";
      $count = count($row);
      $email_var;

            for ($y = 0; $y < $count; $y+=1)
            {
              $c_row = current($row);

              if($y == 0){
                echo "<td class='uid" . $y . "' >
                        <select name='s" .$y. "' style='font-size:12pt; height:40px; width:105px;border:none; border: 0;' disabled class='textedit" .$i. "' form='form".$i."'>
                          <option value='". $c_row ."' selected>" . $c_row . "</option>
                          <option value='basic'>basic</option>
                          <option value='superuser'>superuser</option>
                          <option value='admin'>admin</option>
                        </select>
                     </td>";
              } else if ($y == 1) {
                $email_var = $c_row;
                echo "<td><input type='text' name='save-email' form='form".$i."' value='".$c_row."' disabled style='width:350px; border:none; padding-left:10px;'></td>";
              } else if ($y == 2) {
                $v = "False";
                $v_value = 0;
                if($c_row == 1) {
                  $v = "True";
                  $v_value = 1;
                } else {
                  $v = "False";
                  $v_value = 0;
                }
                echo "<td class='uid" . $y . "' >
                        <select name='s" .$y. "' style='font-size:12pt; height:40px; width:100px;border:none; border: 0;' disabled class='textedit" .$i. "' form='form".$i."'>
                          <option value='". $v_value ."' selected>" . $v . "</option>
                          <option value='1'>True</option>
                          <option value='0'>False</option>
                        </select>
                     </td>";

              }
            next($row);
            }
            //Adds the Edit and Delete buttons to every row
            echo "<td style='text-align: center;'>
                      <button class='btn' id='edit".$i. "' onClick='editFunc(this.id)'>
                        <i class='far fa-edit'></i>
                      </button>
                      <form action='manage_user.php' id='form".$i."' method='post' style='margin-bottom:0px;'>
                      <button class='btn save-btn' id='saveedit" .$i."' type='submit' name='save-submit' form='form".$i."' style='display:none;'>
                        <i class='far fa-save'></i>
                        <input type='hidden' class='textedit" .$i. "'name='save-email' form='form".$i."' value='".$email_var."' disabled>
                      </button>
                      </form>
                  </td>";


            echo "<td style='text-align: center;'>
                    <a id=".$email_var.">  <i id=".$email_var." class='far fa-trash-alt' onClick='deleteUser(this.id)' style='margin-right:5px;'></i></a>
                  </td>";

            echo "</form>";
            $i += 1;
          }
          pg_free_result($result);

          echo '</table></div>';
    }

  // If user isn't admin
  else {
    // Brings user back to home page.
  }


?>

<script>
  // Counter to limit row that can be edited at a time to 1;
  var counter = 0;
  // Data dictionary Edit event listener
  function editFunc(clicked_id) {
    var editbtn = document.getElementById(clicked_id);
    var savebtn = document.getElementById("save" + clicked_id);
    var allClasses = document.getElementsByClassName("text" + clicked_id);
    if(counter < 1) {
      for (var i = 0; i < allClasses.length; i++) {
        allClasses[i].disabled = false;
        allClasses[i].style.border = "0.8px solid #bababa";
      }
      editbtn.style.display = "none";
      savebtn.style.display = "inline-block";
      counter++;
    }
    else {
      alert("Please save the other row first");
    }

  }


  function deleteUser(id) {
      if (confirm("Are you sure you want to delete this user?")) {
          window.location.href= "manage_user.php?delete=True&delete_email="+id;
      }
  }

</script>
