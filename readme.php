<!-- this php page creates a form for ReadMe where user inserts data to be accepted on submission 
 -->
<?php
include ('MaintFreq_dropdown.php');
?>

<!DOCTYPE html>
<head>
<title>Insert data in ReadMe</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
li {
list-style: none;
}
</style>
</head>
<body style="background-color:ivory;"> 
<h2>Enter the following details about the Table into ReadMe</h2>
<ul>
	<style>
	input {
		font-size:12pt;
		height:30px;
		width:350px;
	}
	</style>


<form name="readme" action="readme-p.php?selection=<?php echo $selection;?>" method="POST" >
<li>Common Name:</li><li><input type="text" name="common_name" /></li>
<li>SDE Name:</li><li><input type="text" name="sde_name" required/></li>  <!-- this field is made mandatory by adding 'required' -->
<li>Tags:</li><li><input type="text" name="tags" /></li>
<li>Summary:</li><li><input type="text" name="summary" /></li>
<li>Description:</li><li><input type="text" name="description" /></li>
<li>Data Steward:</li><li><input type="text" name="data_steward" /></li>
<li>Data Engineer:</li><li><input type="text" name="data_engineer" /></li>
<li>Credits:</li><li><input type="text" name="credits" /></li>
<li>Use Limitations:</li><li><input type="text" name="use_limitations" /></li>
<!-- <li>Update Frequency:</li><li><input type="text" name="update_freq" /></li> -->
<li>Update Frequency:</li><select required name="update_freq" id="ddTables" style="font-size:12pt;
		height:30px;
		width:350px;" >
	<option></option> 
	<?php
	echo $tables;
	?>
</select>
<li>Date of Last Update:</li><li><input type="text" name="date_last_update" /></li>
<li>Date of Underlying Data:</li><li><input type="text" name="date_underlying_data" /></li>
<li>Data Source:</li><li><input type="text" name="data_source" /></li>
<li>Version:</li><li><input type="text" name="version" /></li>
<li>Common Uses:</li><li><input type="text" name="common_uses" /></li>
<li>Data Quality:</li><li><input type="text" name="data_quality" /></li>
<li>Caveats:</li><li><input type="text" name="caveats" /></li>
<li>Future Plans:</li><li><input type="text" name="future_plans" /></li>
<li>Distribution:</li><li><input type="text" name="distribution" /></li>
<br>
<input type="submit" id="tableSubmit" value="Submit" style="width:auto"/>
</form>



</ul>
</body>
</html>
