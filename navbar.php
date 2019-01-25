<?php
include 'config.php';
$selection = $_POST['update_freq'];
?>


<html lang="en">
<head>
  <title>Metadata Management Tool</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<style>
  * {
    box-sizing: border-box;
  }

  body {
    margin: 0;
    padding: 0;
    font-family: Arial, Helvetica, sans-serif;
    background-color: white;
  }
  .navbar-default {
    padding: 12px 0 10px;
    background-color: white;
    width: 100%;
    margin-bottom: 0;
    z-index: 9999;
  }
  #navbar-title {
    padding-bottom: 0;
    padding-top: 15px;
  }
  .spacing {
      margin-bottom: 100px;
  }
  .searchbar {
    width: 200px;
    transition: width 2s;
  }

  #searchbar:focus {
    width: 300px;
  }
  .img {
  background-color: #fff;
  width: 50px;
  height: 50px;
  display: block;

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
  #top-div h5 {
    font-weight: bold;
  }

</style>

<body>

  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="Main.php"><img class="img" src="logo.png"></a>
        <a class="navbar-brand" id="navbar-title" href="Main.php">Metadata Management Web Tool</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

        <ul class="nav navbar-nav navbar-right">
          <li><a href="import_metadata.php">Import Metadata</a></li>
          <li><a href="export_metadata.php">Export Metadata</a></li>
          <form class="navbar-form navbar-left">
            <div class="form-group">
              <input type="text" id="searchbar" class="form-control" placeholder="Search Dataset">
            </div>
            <button type="submit" class="btn btn-default">Search</button>
          </form>
        </ul>

      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
