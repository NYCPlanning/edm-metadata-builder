<!-- this php page creates a form for ReadMe where user inserts data to be accepted on submission
 -->
<?php
include ('MaintFreq_dropdown.php');
?>

<!DOCTYPE html>
<head>
<link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
<title >Insert data in ReadMe</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
li {
list-style: none;
}

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
</head>
<body style="background-color: white; background-repeat: no-repeat; height: 100%; background-position: center;
  background-size: cover;
  position: relative; ">
  <div class="header">
<div class="clearfix">
<img class="img" src="logo.png" style="display: inline; float: left;"> <h1 align="center" style="color: #fff; display: inline;">Enter values into ReadMe</h1>
</div>
</div>
<ul>
	<style>


	input {
		font-size:12pt;
		height:40px;
		width:350px;
		border: 1px solid #D96B27;
	}

	form {
    display: inline-block;
    vertical-align: middle;

}
	</style>

<form name="readme" action="readme-p.php?selection=<?php echo $selection;?>" method="POST" >
<li>Common Name:</li><li><input type="text" name="common_name" style="width:400px;" /></li>
<br>
<li>SDE Name:</li><li><input type="text" name="sde_name" style="width:400px;" required/></li>  <!-- this field is made mandatory by adding 'required' -->
<br>
<li>Tags for Guide:</li><li><input type="text" name="tags_guide" style="width:500px;" /></li>
<br>
<li>Tags for SDE:</li><li><input type="text" name="tags_sde" style="width:500px;" /></li>
<br>
<li>Summary:</li><li><input type="text" name="summary" style="height:90px;width:800px;"/></li>
<br>
<li>Summary - Update Date:</li><li><input type="text" name="summary_update_date" style="height:40px;width:800px;"/></li>
<br>
<li>Description:</li><li><input type="text" name="description" style="height:90px;width:900px;"/></li>
<br>
<li>Description - Data Location:</li><li><input type="text" name="description_data_loc" style="width:500px;"/></li>
<br>
<li>Data Steward:</li><li><input type="text" name="data_steward" style="width:400px;"/></li>
<br>
<li>Data Engineer:</li><li><input type="text" name="data_engineer" style="width:400px;"/></li>
<br>
<li>Credits:</li><li><input type="text" name="credits" style="width:400px;"/></li>
<br>
<li>General Constraints Use Limitations:</li><li><input type="text" name="genconst" style="width:450px;"/></li>
<br>
<li>Legal Constraints Use Limitations:</li><li><input type="text" name="legconst" style="width:450px;"/></li>
<br>
<!-- <li>Update Frequency:</li><li><input type="text" name="update_freq" /></li> -->
<li>Update Frequency:</li><select required name="update_freq" id="ddTables" style="font-size:12pt;
		height:45px;
		width:400px;
		border: 1px solid #D96B27;" >
	<option></option>
	<?php
	echo $tables;
	?>
</select>
<br>
<br><li>Date of Last Update:</li><li><input type="text" name="date_last_update" style="width:400px;"/></li>
<br>
<li>Date of Underlying Data:</li><li><input type="text" name="date_underlying_data" style="width:400px;"/></li>
<br>
<li>Data Source:</li><li><input type="text" name="data_source" style="width:400px;"/></li>
<br>
<li>Version:</li><li><input type="text" name="version" style="width:400px;"/></li>
<br>
<li>Common Uses:</li><li><input type="text" name="common_uses" style="width:450px;"/></li>
<br>
<li>Data Quality:</li><li><input type="text" name="data_quality" style="width:400px;"/></li>
<br>
<li>Caveats:</li><li><input type="text" name="caveats" style="width:400px;"/></li>
<br>
<li>Future Plans:</li><li><input type="text" name="future_plans" style="width:450px;"/></li>
<br>
<li>Distribution:</li><li><input type="text" name="distribution" style="width:550px;"/></li>
<br>
<li>Contact:</li><li><input type="text" name="contact" style="width:400px;"/></li>
<br>
<br>
<input type="submit" id="tableSubmit" value="Submit" style="width:auto; color: black; background-color: lightgray"/>
</form>

</ul>
</body>
</html>
