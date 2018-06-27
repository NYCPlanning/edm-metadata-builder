<?php
if (isset($_POST['group'])) { // "group" is mutual name of radio buttons
  switch ($_POST['group']) {
    case 'Sec':  // Value of first radio button
      header('Location: ins.php');
      break;
    case 'SSec':  // Value of second radio button
      header('Location: impcsv.php');
      break;
    default:
      break;
  }    
}
?>
<td align="center" class="bgcolor_03">
  <form action="" method="POST" >
    <input type="radio" class="gender" name="group" id="group" value="Sec"  />
    ReadMe
    <input type="radio" class="gender" name="group" id="group2" value="SSec"  />
    Data Dictionary
    <br />
    <input type="submit" value="Done" />
  </form>
</td>