<?php
if (isset($_POST['group'])) { // "group" is mutual name of radio buttons
  switch ($_POST['group']) {
    case 'Sec':  // Value of first radio button
      header('Location: readme_index.php');
      break;
    case 'SSec':  // Value of second radio button
      header('Location: dict_index.php');
      break;
    default:
      break;
  }    
}
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
<h2 style="text-align:center; vertical-align: middle; font-family:tahoma; color:black;">Exporting data </h2>



<td align="center" class="bgcolor_03">
  <form action="" method="POST" >
    <input type="radio" class="import" name="group" id="group" value="Sec" style="font-size:75%;color:green" />
    ReadMe
    <input type="radio" class="import" name="group" id="group2" value="SSec" style="font-size:75%;color:green" />
    Data Dictionary
    <br />
    <br>
    <input type="submit" value="Done" style="font-size:75%;color:green" />
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
</td>
</body>
