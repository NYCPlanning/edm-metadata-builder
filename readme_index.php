<?php

include ('readme_dropdown.php'); //this includes the php file that has the code for the dropdown menu of sde_names of the individual records of the readme

?>
<body style="background-color:white;">
<style>
  * {
    box-sizing: border-box;
  }

  body {
    font-family: Arial, Helvetica, sans-serif;
  }

/* Style the header */
  .header {
    background-color: #D96B27;
    padding: 15px;
    text-align: center;
    font-size: 15px;
    color: #fff;
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
<img class="img" src="logo.png" style="display: inline; float: left;"> <h1 align="center" style="color: #fff; display: inline;">Select table to be exported</h1>
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

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" >
<select name="Tables" id="ddTables" style="height: 30px;width:300px;font-size:65%; border: 1px solid #D96B27" onchange="this.form.submit();">
	<option disabled selected>Select</option>
 <style>
 form {
  text-align: center;
  vertical-align: middle;
  font-family: tahoma;
  color: black;
  font-size:150%;
}
</style>
<?php

//displaying the dropdown list
echo $tables;
?>
     </select>

     </form>

<?php
 $selection = $_POST["Tables"];
 ?>

<!-- code for exporting the readme data as xml and csv files -->
 <br>
 <br>
 <br>

  <form class="form-horizontal" action="expbut_readme.php?selection=<?php echo $selection;?>" method="post"  name="upload_excel" enctype="multipart/form-data">
                  <div class="form-group">
                            <div class="col-md-4 col-md-offset-4">
                                <input type="submit" name="Export" class="btn btn-success" value="export to csv" style="font-size:65%;color: #D96B27;border: 1px solid #D96B27 "/>
                            </div>
                   </div>
            </form>

   <form class="form-horizontal" action="expxml_readme_ind.php?selection=<?php echo $selection;?>" method="post"  name="upload_excel" enctype="multipart/form-data">
                  <div class="form-group">
                            <div class="col-md-4 col-md-offset-4">
                                <input type="submit" name="Expor2xml" class="btn btn-success" value="export to xml" style="font-size:65%;color: #D96B27;border: 1px solid #D96B27 "/>
                            </div>
                   </div>
            </form>
            <style>
 form {
  text-align: center;
  vertical-align: middle;
  font-family: tahoma;
  color: black;
  font-size:150%;

}
</style>
