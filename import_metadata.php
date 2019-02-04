
<?php
include ('navbar.php');
?>

<style>
  .wrapper {
    max-width: 400px;
    width: 50%;
    margin: 10% auto;
  }
  .create-searchbar {
    width: 400px;
  }
  textarea:focus, input:focus{
      outline: none;
  }
</style>



<div class="wrapper">
  <h3>Create Table</h3>
  <form class="search" method="post" action="edit.php">
    <div class="form-group">
      <input type="text" class="form-control create-searchbar" name="common_name" id="commonName" placeholder="Common Name" autocomplete="off" required list="common_list">
      <datalist id="common_list">
      </datalist>
      <span id="common_status"></span>
    </div>
    <div class="form-group">
      <input type="text" class="form-control create-searchbar" name="sde_name" placeholder="SDE Name" id="sdeName"autocomplete="off" required list="sde_list">
      <datalist id="sde_list">
      </datalist>
      <span id="sde_status"></span>
    </div>
    <div class="button">
      <!-- Disabled will be removed when common name and sde is not blank and doesn't exist in database -->
      <button type="submit" class="btn btn-default" id="create_dataset">Create</button>
    </div>

  </form>
</div>
