<?php
include 'config.php';
include ('MaintFreq_dropdown.php');
include ('navbar.php');
$id = $_GET['id'];
$sql = "SELECT * FROM readme WHERE uid = $id";
$result = pg_query($sql);
if (!$result) {
  echo "An error occurred.\n";
  exit;
}
$row = pg_fetch_assoc($result);
    $uid = $row['uid'];
    $common_name = $row['common_name'];
    $sde_name = $row['sde_name'];
    $tags_guide = $row['tags_guide'];
    $tags_sde = $row['tags_sde'];
    $summary = $row['summary'];
    $summary_update_date = $row['summary_update_date'];
    $description = $row['description'];
    $description_data_loc = $row['description_data_loc'];
    $data_steward = $row['data_steward'];
    $data_engineer = $row['data_engineer'];
    $credits = $row['credits'];
    $genconst = $row['genconst'];
    $legconst = $row['legconst'];
    $update_freq = $row['update_freq'];
    $date_last_update = $row['date_last_update'];
    $date_underlying_data = $row['date_underlying_data'];
    $data_source = $row['data_source'];
    $version = $row['version'];
    $common_uses = $row['common_uses'];
    $data_quality = $row['data_quality'];
    $caveats = $row['caveats'];
    $future_plans = $row['future_plans'];
    $distribution = $row['distribution'];
    $contact = $row['contact'];
?>

<!DOCTYPE html>
<head>
<link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
<title >Edit data in ReadMe</title>
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
</head>
<body style="background-color: white; background-repeat: no-repeat; height: 100%; background-position: center;
  background-size: cover;
  position: relative; ">
  <div class="header">
<div class="clearfix">
<h1 align="center" style="display: inline;">Edit Values into ReadMe</h1>
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

<form name="readme" action="readme-p-edit-submission.php?selection=<?php echo $selection;?>" method="POST" >
<input type="hidden" name="id" value="<?php echo $uid; ?>"/>
<li>Common Name:</li><li><input type="text" name="common_name" style="width:400px;" value="<?php echo $common_name; ?>"/></li>
<br>
<li>SDE Name:</li><li><input type="text" name="sde_name" style="width:400px;" value="<?php echo $sde_name; ?>" required/></li>  <!-- this field is made mandatory by adding 'required' -->
<br>
<li>Tags for Guide:</li><li><input type="text" name="tags_guide" style="width:500px;" value="<?php echo $tags_guide; ?>"/></li>
<br>
<li>Tags for SDE:</li><li><input type="text" name="tags_sde" style="width:500px;" value="<?php echo $tags_sde; ?>"/></li>
<br>
<li>Summary:</li><li><input type="text" name="summary" style="height:90px;width:800px;" value="<?php echo $summary; ?>"/></li>
<br>
<li>Summary - Update Date:</li><li><input type="text" name="summary_update_date" style="height:40px;width:800px;" value="<?php echo $summary_update_date; ?>"/></li>
<br>
<li>Description:</li><li><input type="text" name="description" style="height:90px;width:900px;" value="<?php echo $description; ?>"/></li>
<br>
<li>Description - Data Location:</li><li><input type="text" name="description_data_loc" style="width:500px;" value="<?php echo $description_data_loc; ?>"/></li>
<br>
<li>Data Steward:</li><li><input type="text" name="data_steward" style="width:400px;" value="<?php echo $data_steward; ?>"/></li>
<br>
<li>Data Engineer:</li><li><input type="text" name="data_engineer" style="width:400px;" value="<?php echo $data_engineer; ?>"/></li>
<br>
<li>Credits:</li><li><input type="text" name="credits" style="width:400px;" value="<?php echo $credits; ?>"/></li>
<br>
<li>General Constraints Use Limitations:</li><li><input type="text" name="genconst" style="width:450px;"value="<?php echo $genconst; ?>"/></li>
<br>
<li>Legal Constraints Use Limitations:</li><li><input type="text" name="legconst" style="width:450px;" value="<?php echo $legconst; ?>"/></li>
<br>
<!-- <li>Update Frequency:</li><li><input type="text" name="update_freq" /></li> -->
<li>Update Frequency:</li>
<select required name="update_freq" id="ddTables" style="font-size:12pt; height:45px; width:400px; border: 1px solid #D96B27;">
	<option value="<?php echo $update_freq; ?>" selected><?php echo $update_freq; ?></option>
	<?php
	echo $tables;
	?>
</select>
<br>
<br><li>Date of Last Update:</li><li><input type="text" name="date_last_update" style="width:400px;" value="<?php echo $date_last_update; ?>"/></li>
<br>
<li>Date of Underlying Data:</li><li><input type="text" name="date_underlying_data" style="width:400px;" value="<?php echo $date_underlying_data; ?>"/></li>
<br>
<li>Data Source:</li><li><input type="text" name="data_source" style="width:400px;" value="<?php echo $data_source; ?>"/></li>
<br>
<li>Version:</li><li><input type="text" name="version" style="width:400px;" value="<?php echo $version; ?>"/></li>
<br>
<li>Common Uses:</li><li><input type="text" name="common_uses" style="width:450px;" value="<?php echo $common_uses; ?>"/></li>
<br>
<li>Data Quality:</li><li><input type="text" name="data_quality" style="width:400px;" value="<?php echo $data_quality; ?>"/></li>
<br>
<li>Caveats:</li><li><input type="text" name="caveats" style="width:400px;" value="<?php echo $caveats; ?>"/></li>
<br>
<li>Future Plans:</li><li><input type="text" name="future_plans" style="width:450px;" value="<?php echo $future_plans; ?>"/></li>
<br>
<li>Distribution:</li><li><input type="text" name="distribution" style="width:550px;" value="<?php echo $distribution; ?>"/></li>
<br>
<li>Contact:</li><li><input type="text" name="contact" style="width:550px;" value="<?php echo $contact; ?>"/></li>
<br>
<br>
<input type="submit" id="tableSubmit" value="Save" style="color: #D96B27;border: 1px solid #D96B27; width: auto;"/>
</form>

</ul>
</body>
</html>
