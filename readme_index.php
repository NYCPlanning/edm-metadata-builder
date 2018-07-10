<?php 

include ('readme_dropdown.php'); 

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
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
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

echo $tables;
?>
     </select>

     <input type="submit" id="tableSubmit" value="Submit" style="font-size:65%;"/>
     </form>

<?php
 $selection = $_POST["Tables"];
 ?>

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