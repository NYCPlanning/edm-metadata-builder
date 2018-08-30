<?php 

include ('readme_dropdown.php'); //this includes the php file that has the code for the dropdown menu of sde_names of the individual records of the readme

?> 
<body style="background-color:ivory;"> 
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<h2 style="text-align:center; vertical-align: middle; font-family:tahoma; color:black;">Select Table to be exported </h2>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" onchange="this.form.submit();">
<select name="Tables" id="ddTables" style="width:200px;font-size:65%;">
	<option selected>Select</option>
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

    <!--  <input type="submit" id="tableSubmit" value="Submit" style="font-size:65%;"/>
     </form> -->

<?php
 $selection = $_POST["Tables"];
 ?>

<!-- code for exporting the readme data as xml and csv files
 -->
 <br>
 <br>

  <form class="form-horizontal" action="expbut_readme.php?selection=<?php echo $selection;?>" method="post"  name="upload_excel" enctype="multipart/form-data">
                  <div class="form-group">
                            <div class="col-md-4 col-md-offset-4">
                                <input type="submit" name="Export" class="btn btn-success" value="export to csv" style="font-size:65%;color:green"/>
                            </div>
                   </div>                    
            </form> 

   <form class="form-horizontal" action="expxml_readme_ind.php?selection=<?php echo $selection;?>" method="post"  name="upload_excel" enctype="multipart/form-data">
                  <div class="form-group">
                            <div class="col-md-4 col-md-offset-4">
                                <input type="submit" name="Expor2xml" class="btn btn-success" value="export to xml" style="font-size:65%;color:green"/>
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