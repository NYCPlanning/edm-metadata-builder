<?php
include ('navbar.php');
require 'vendor/autoload.php';
$error = NULL;

if(isset($_POST['submit'])) {
  // Get form data after submission
  $email = $_POST['email'];
  $password = $_POST['psw'];
  $password_repeat = $_POST['psw-repeat'];

  // Validate Email
  if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = "<p>Please enter a valid E-Mail.</p>";
  // Validate Password
  } elseif($password != $password_repeat) {
    $error.= "Your passwords do not match.";
  // Check if password is at least 6 characters in length
  } elseif(strlen($password) < 5) {
    $error.= "Your password needs to be at least 6 characters in length.";
  // Insert into database
  } else {
    // Sanitize form data
    $email = pg_escape_string($email);
    $password = pg_escape_string($password);
    $password_repeat = pg_escape_string($password_repeat);
    $password = md5($password);
    // Generate Vkey
    $vkey = md5(time().$email);

    // Insert form data
    $query = "INSERT INTO users (email, password, vkey) VALUES ('$email','$password','$vkey')";
    $insert = pg_query($query);

    if($insert) {
      // echo '<div class="alert alert-success" role="alert">Success!</div>';
      // Send Verification Email
      $SGemail = new \SendGrid\Mail\Mail();
      $SGemail->setFrom("twang@planning.nyc.gov");
      $SGemail->setSubject("Verification Email For Metadata Management Tool");
      $SGemail->addTo($email);
      $SGemail->addContent(
          "text/html", "<a href='http://morning-stream-61756.herokuapp.com/verification.php?vkey=$vkey'>Verify Account</a>"
      );
      $sendgrid = new \SendGrid(getenv("SENDGRID_API"));
      try {
          $response = $sendgrid->send($SGemail);
          echo '<div class="alert alert-success alert-dismissible fade in">
                 <a class="close" data-dismiss="alert" aria-label="close">&times;</a>
                 <strong>A verification link has been sent to your email account.</strong>
               </div>';
      } catch (Exception $e) {
          echo 'Caught exception: '. $e->getMessage() ."\n";
      }
    } else {
      echo pg_last_error($insert);
    }
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
.registerbtn {
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
.signin {
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
      <h1>Register</h1>
      <p>Please fill in this form to create an account.</p>
      <hr>

      <label for="email"><b>Email</b></label>
      <input type="email" placeholder="Enter Email" name="email" id="email" required autofocus>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" id="psw" required>

      <label for="psw-repeat"><b>Repeat Password</b></label>
      <input type="password" placeholder="Repeat Password" name="psw-repeat" id="psw-repeat" required>
      <hr>

      <button type="submit" name="submit" class="registerbtn">Register</button>
    </div>

    <div class="container signin">
      <p>Already have an account? <a href="login.php">Sign in</a>.</p>
    </div>
  </form>
