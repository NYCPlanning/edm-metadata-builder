<?php

include 'config.php'; //including the configuration file that has the db connection details
//passing the values taken from readme.php as '$_POST[]'

 $query1 = pg_query("SELECT common_name FROM ReadMe WHERE common_name = '$_POST[common_name]'");
      if (pg_num_rows($query1) > 0) //checking if the dataset already exsits and prompting to enter a different Common Name
      {
        $message = "Table already exists. Please Enter different name in Common Name!";
        // echo "<script type='text/javascript'>alert('$message'); window.location.href = 'readme.php?' </script>";
              }
      else //if the dataset record does not exits, then adding the values to the ReadMe file
      {
        $selection = $_POST['update_freq']; //accepting the update frequency selection from the dropdown on previous php page as a variable
        $query = "INSERT INTO ReadMe(common_name, sde_name, tags_guide, tags_sde, summary, summary_update_date, description, description_data_loc,
        data_steward, data_engineer, credits, genconst, legconst, update_freq, date_last_update, date_underlying_data, data_source, version,
        common_uses, data_quality, caveats, future_plans, distribution, contact)
                  VALUES (
                    '$_POST[common_name]',
                    '$_POST[sde_name]',
                    '$_POST[tags_guide]',
                    '$_POST[tags_sde]',
                    '$_POST[summary]',
                    '$_POST[summary_update_date]',
                    '$_POST[description]',
                    '$_POST[description_data_loc]',
                    '$_POST[data_steward]',
                    '$_POST[data_engineer]',
                    '$_POST[credits]',
                    '$_POST[genconst]',
                    '$_POST[legconst]',
                    '$selection',
                    '$_POST[date_last_update]',
                    '$_POST[date_underlying_data]',
                    '$_POST[data_source]',
                    '$_POST[version]',
                    '$_POST[common_uses]',
                    '$_POST[data_quality]',
                    '$_POST[caveats]',
                    '$_POST[future_plans]',
                    '$_POST[distribution]',
                    '$_POST[contact]'
                  )";

$result = pg_query($query); //executing the query
      }
include ('MaintFreq_dropdown.php');
?>

<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<style>
li {
list-style: none;
}

* {
  box-sizing: border-box;
}
button {
  padding: 1.5em;
  color: black;
  font-weight: 700;

  cursor: pointer;
}
pre {
  background: #fafafa;
  padding: 15px;
  border: 1px #ccd dashed;
}
pre + p {
  margin: 5vh 0;
}

	body {
    font-family: Arial, Helvetica, sans-serif;
	}
/* code for creating a table structure using css */
  table, td, th {
      border: 0.5px solid #D96B27;
      text-align: left;
  }

  th, td {
      padding: 10px;
    }
 i {
   color: black;
 }
 i:hover {
   color: #D96B27;
 }
/* Hide the UID of the table */
.uid0 {
  display: none;
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
  input {
    font-size:12pt;
    height:40px;
    width:85%;
    border: 1px solid #D96B27;
  }
.noscroll { overflow: hidden; }
.open-overlay {
    position: fixed;
    border-color: none;
    bottom: 25px;
    right: 25px;
    box-shadow: 0 10px 15px 0 rgba(0,0,0,0.2), 0 5px 15px 0 rgba(0,0,0,0.1);
    border-radius: 50%;
    transition-duration: 0.4s;
}
.open-overlay:hover {
  font-size: 15px;

}

.overlay {
 position: fixed;
 overflow-y: scroll;
 top: 0; right: 0; bottom: 0; left: 0; }

[aria-hidden="true"] { display: none; }
[aria-hidden="false"] { display: block; }

.overlay div {
 margin: 15vh auto;
 width: 80%;
 max-width: 650px;
 padding: 30px;
 min-height: 200vh;
 background: rgba(255,255,255, .95);
}
.overlay {
  background:  rgba(40,40,40, .75);
}
.close-overlay {
  float:right;
  padding: 10px;
}

#form-overlay {
  padding-left: 15%;
}

.export-excel {
  width: 200px;
}



</style>

<button type="button" class="open-overlay"><i class="material-icons">add</i></button>
<!-- Add Form -->
<section class="overlay" aria-hidden="true">
  <div>
    <button type="button" class="close-overlay">X</button>
    <form name="readme" id= "form-overlay" action="readme-p.php?selection=<?php echo $selection;?>" method="POST" >
    <li>Common Name:</li><li><input type="text" name="common_name" /></li>
    <br>
    <li>SDE Name:</li><li><input type="text" name="sde_name" required/></li>  <!-- this field is made mandatory by adding 'required' -->
    <br>
    <li>Tags for Guide:</li><li><input type="text" name="tags_guide" /></li>
    <br>
    <li>Tags for SDE:</li><li><input type="text" name="tags_sde" /></li>
    <br>
    <li>Summary:</li><li><input type="text" name="summary" style="height:90px;"/></li>
    <br>
    <li>Summary - Update Date:</li><li><input type="text" name="summary_update_date" style="height:40px;"/></li>
    <br>
    <li>Description:</li><li><input type="text" name="description" style="height:90px;"/></li>
    <br>
    <li>Description - Data Location:</li><li><input type="text" name="description_data_loc"/></li>
    <br>
    <li>Data Steward:</li><li><input type="text" name="data_steward"/></li>
    <br>
    <li>Data Engineer:</li><li><input type="text" name="data_engineer"/></li>
    <br>
    <li>Credits:</li><li><input type="text" name="credits"/></li>
    <br>
    <li>General Constraints Use Limitations:</li><li><input type="text" name="genconst"/></li>
    <br>
    <li>Legal Constraints Use Limitations:</li><li><input type="text" name="legconst"/></li>
    <br>
    <!-- <li>Update Frequency:</li><li><input type="text" name="update_freq" /></li> -->
    <li>Update Frequency:</li><select required name="update_freq" id="ddTables" style="font-size:12pt;
    		height:45px;
    		width:75%;
    		border: 1px solid #D96B27;" >
    	<option></option>
    	<?php
    	echo $tables;
    	?>
    </select>
    <br>
    <br><li>Date of Last Update:</li><li><input type="text" name="date_last_update"/></li>
    <br>
    <li>Date of Underlying Data:</li><li><input type="text" name="date_underlying_data"/></li>
    <br>
    <li>Data Source:</li><li><input type="text" name="data_source"/></li>
    <br>
    <li>Version:</li><li><input type="text" name="version"/></li>
    <br>
    <li>Common Uses:</li><li><input type="text" name="common_uses"/></li>
    <br>
    <li>Data Quality:</li><li><input type="text" name="data_quality"/></li>
    <br>
    <li>Caveats:</li><li><input type="text" name="caveats"/></li>
    <br>
    <li>Future Plans:</li><li><input type="text" name="future_plans"/></li>
    <br>
    <li>Distribution:</li><li><input type="text" name="distribution"/></li>
    <br>
    <li>Contact:</li><li><input type="text" name="contact"/></li>
    <br>
    <br>
    <input type="submit" id="tableSubmit" value="Submit" style="width:auto; color: black; background-color: lightgray"/>
    </form>
  </div>
</section>



<script>
var body = document.body,
  overlay = document.querySelector('.overlay'),
  overlayBtts = document.querySelectorAll('button[class$="overlay"]');

[].forEach.call(overlayBtts, function(btt) {

btt.addEventListener('click', function() {

   var overlayOpen = this.className === 'open-overlay';

   overlay.setAttribute('aria-hidden', !overlayOpen);
   body.classList.toggle('noscroll', overlayOpen);

   overlay.scrollTop = 0;

}, false);

});

</script>
</html>

<?php

//the following php code is for displaying the table contents on the same page

include 'config.php';

$query = 'select * from readme';

$result = pg_query($query);


$i = 0;



echo '<html>
        <body>
          <table class="form-table">
            <tr>';


//fetching the column names of the db table
  echo '<th> Edit </th> <th> Delete </th> ';
while ($i < pg_num_fields($result))
{
  $fieldName = pg_field_name($result, $i);
  echo '<th class=uid' .$i . '>' . $fieldName . '</th>';
  $i = $i + 1;
}
echo '</tr>';
$i = 0;

//fetching and displaying the contents of the db table

$table_name = array("","common_name", "sde_name", "tags_guide", "tags_sde", "summary", "summary_update_date", "description", "description_data_loc",
"data_steward", "data_engineer", "credits", "genconst", "legconst", "update_freq", "date_last_update", "date_underlying_data", "data_source", "version",
"common_uses", "data_quality", "caveats", "future_plans", "distribution", "contact");

while ($row = pg_fetch_row($result))
{
  echo "<form action=readme-p-update.php?id=".$row[0]." method='post'>";
  echo "<tr>";
  $count = count($row);
  // Adds the Edit and Delete buttons to every row
  echo "<td style='text-align: center'><a href='readme-p-edit.php?id=".$row[0]."'><i class='material-icons'>edit</i></a></td>";
  echo "<td style='text-align: center'><a href='readme-p-delete.php?id=".$row[0]."'><i class='material-icons'>delete</i></a></td>";
  for ($y = 0; $y < $count; $y+=1)
  {
    $c_row = current($row);
    echo "<td class=uid" . $y . ">" . $c_row . "</td>";
    next($row);
  }



  $i = $i + 1;
}
pg_free_result($result);

echo '</form></table></body></html>';


?>


<!-- html code for the export to excel button with form action -->
<html>

    <div id="wrap">
        <div class="container">
            <div class="row">
  <br>
  <br>

            <form class="form-horizontal" action="expbut.php" method="post" name="upload_excel"
                      enctype="multipart/form-data" >
                  <div class="form-group">
                            <div class="col-md-4 col-md-offset-4">
                                <input type="submit" name="Export" class="btn btn-success" value="export to excel" style="color: #D96B27;border: 1px solid #D96B27; width: 200px;"/>
                            </div>
                   </div>
            </form>

 </div>
</div>
</div>
</body>
</html>
