<?php
if (isset($_POST['group'])) { // "group" is mutual name of radio buttons
  switch ($_POST['group']) {
    case 'Sec':  // Value of first radio button
      header('Location: readme.php');
      break;
    case 'SSec':  // Value of second radio button
      header('Location: dict_name.php');
      break;
    default:
      break;
  }    
}
?>
 



<!-- <h3>ReadMe allows you to access the information of tables in the database and insert new values as well to the existing ReadMe table.</h3>
<h3>Data Dictionary allows you to create a new Table. </h3>
<br><br> -->
<h2>CHOOSE ONE</h2>



<td align="center" class="bgcolor_03">
  <form action="" method="POST" >
    Select:
    <input type="radio" class="gender" name="group" id="group" value="Sec"  />
    ReadMe
    <input type="radio" class="gender" name="group" id="group2" value="SSec"  />
    Data Dictionary
    <br />
    <br>
    <input type="submit" value="Done" />
  </form>
</td>

<!-- <td align="center" class="bgcolor_03">
  <form action="" method="POST" >
    <input type="radio" class="gender" name="group" id="group" value="Sec"  />
    Secondary Section
    <input type="radio" class="gender" name="group" id="group2" value="SSec"  />
    Seniour Secondary Section
    <br />
    <input type="submit" value="Done" />
  </form>
</td> -->