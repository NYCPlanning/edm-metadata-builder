<?php
include ('navbar.php');
$error = NULL;

// Display Email Verification Success Message
if(!empty($_SESSION['message'])) {
   $message = $_SESSION['message'];
   echo '<div class="alert alert-success alert-dismissible fade in">
          <a class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success! '.$message.'</strong>
        </div>';
   unset($_SESSION['message']);
}

// USE THIS METHOD TO VERIFY PASSWORD
// https://secure.php.net/manual/en/function.password-verify.php
if(isset($_POST['submit'])) {
  $email = pg_escape_string($_POST['email']);
  $pass = pg_escape_string($_POST['psw']);
  $query = "SELECT * FROM users WHERE email = '$email'";
  $results = pg_query($query);
  $row = pg_fetch_assoc($results);
  $hash = $row['password'];
  $verified = $row['verified'];

  if(!password_verify($pass, $hash)) {
    $error = "Incorrect Email or Password.";
  } else if(!$verified) {
    $error = "Please verify you account first.";
  } else {
    $_SESSION['user'] = $email;
    header('location: Main.php');
  }
}


?>

<style>
* {box-sizing: border-box}

/* Add padding to containers */
.container {
  padding: 16px;
}

/* Full-width input fields */
#email, input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

#email:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Overwrite default styles of hr */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for the submit/register button */
.loginBtn {
  background-color: #D96B27;
  color: white;
  padding: 16px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.registerbtn:hover {
  opacity:1;
}

/* Add a blue text color to links */
a {
  color: dodgerblue;
}

/* Set a grey background color and center the text of the "sign in" section */
.register {
  background-color: #f1f1f1;
  text-align: center;
}
@media (min-width: 800px) {
  .container {
    width:650px;
  }
}
</style>
<?php
  if($error != NULL) {
    echo '<div class="alert alert-danger alert-dismissible">
                <a class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>'.$error.'</strong>
              </div>';
  }
?>
  <form method="POST" action="">
    <div class="container">
      <h1>Login</h1>
      <p>Please fill in this form to login.</p>
      <hr>

      <label for="email"><b>Email</b></label>
      <input type="email" placeholder="Enter Email" name="email" id="email" required autofocus>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" id="psw" required>
      <hr>

      <button type="submit" name="submit" class="loginBtn">Login</button>
    </div>

    <div class="container register">
      <p>Don't have an account yet? <a href="register.php">Register</a>.</p>
    </div>
  </form>
