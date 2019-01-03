<html lang="en">
<head>
  <title>Metadata Management Tool</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<style>
  .navbar-default {
    padding: 12px 0 10px;
    background-color: white;
    width: 100%;
  }
  .spacing {
      margin-bottom: 100px;
  }
  .navbar-brand {
    padding-top: 0;
  }
  .nav-pills {
    margin-top: 4px;
  }
  .nav>li>a {
    color: black;
  }

  .nav .open>a, .nav .open>a:focus, .nav .open>a:hover {
        background-color: #D96B27;
  }

 a.dropdown-toggle:focus {

    color: white;
  }
</style>

<body>

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="Main.php"><img class="img" src="logo.png"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav nav-pills">
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Import Data from Form <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="readme.php">Readme</a></li>
            <li><a href="dict_name.php">Data Dictionary</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Import Data from File <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="readme_csv.php">Readme</a></li>
            <li><a href="dict_csv.php">Data Dictionary</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Export Metadata <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="readme_index.php">Readme</a></li>
            <li><a href="dict_index.php">Data Dictionary</a></li>
          </ul>
        </li>
      </ul>

    </div>
  </div>
</nav>
<div class="spacing">

</div>
