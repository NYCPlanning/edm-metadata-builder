<?php
if (isset($_POST['group'])) { // "group" is mutual name of radio buttons
  switch ($_POST['group']) {
    case 'Sec':  // Value of first radio button
      header('Location: readme.php');
      break;
    case 'SSec':  // Value of second radio button
      header('Location: dict_name.php');
      break;
    default:
      break;
  }
}
include ('navbar.php');
?>


<body style="background-color:white;">
<style>
  * {
    box-sizing: border-box;
  }

  body {
    font-family: Arial, Helvetica, sans-serif;
  }

/* Style for buttons */

  .thumbnail {
    padding: 20px 0 10px;
    transition-duration: 2s;
    text-decoration: none !important;
  }

  .thumbnail-sub-container {
    border: 2px solid #d86b27;
    border-radius: 10px;
    padding: 10px 0;
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;
    cursor: pointer;
    color:black;
  }

  .thumbnail-sub-container:hover {
    color: white;
    background-color: #d86b27;
  }

  .thumbnail:hover a{
    color: white;
    display: block;
    text-decoration: none;

  }

  .thumbnail-container {
    margin: 0 25%;
  }

  a.thumbnail {
    border:none;
  }

/* Style the header */
  .header {
    padding: 15px;
    text-align: center;
    font-size: 15px;
    display: block;

  }

  .clearfix {
    overflow: auto;
}

  .img {
  background-color: #fff;
  width: 50px;
  height: 50px;
  display: block;
  vertical-align: middle;
  }

</style>
<body style="background-color: white; background-repeat: no-repeat; height: 100%; background-position: center;
  background-size: cover;
  position: relative; ">
  <div class="header">
<div class="clearfix">
<h1 align="center" style="display: inline;">Importing Data from Form</h1>
</div>
</div>
<br>
<br> <!-- just indenting -->
<br>
<br>
<br>
<br>
<br>
<br>
<br>

<div class="row thumbnail-container" style="text-align: center;">
  <div class="col-xs-12 col-md-6">
    <a href="readme.php" class="thumbnail">
      <div class="thumbnail-sub-container">
        ReadMe
      </div>
    </a>
  </div>
  <div class="col-xs-12 col-md-6">
    <a href="dict_name.php" class="thumbnail">
      <div class="thumbnail-sub-container">
        Data Dictionary
      </div>
    </a>
  </div>
</div>


</body>
