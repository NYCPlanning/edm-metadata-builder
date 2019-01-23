<?php
include ('navbar.php');
?>

<style>
  .wrapper {
    width: 50%;
    margin: 0 auto;
  }
  .create-searchbar {
    width: 500px;
  }
</style>



<div class="wrapper">
  <h3>Create Table</h3>
  <form class="search" method="post" action="edit.php">
    <div class="form-group">
      <input type="text" class="form-control create-searchbar" name="common_name" placeholder="Common Name" required>
    </div>
    <div class="form-group">
      <input type="text" class="form-control create-searchbar" name="sde_name" placeholder="SDE Name" required>
    </div>
    <div class="button">
      <button type="submit" class="btn btn-default">Create</button>
    </div>

  </form>
</div>
