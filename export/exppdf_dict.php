<?php
// reference the Dompdf namespace
use Dompdf\Dompdf;
require '../vendor/autoload.php';
include '../config.php';

$sde_underscore = $_GET['sde_underscore'];
 // Connect to the Database
if (isset($_POST["Expor2pdf"])) {
  $q = 'SELECT orders, field_name, longform_name, description, geocoded, required, data_type, expected_allowed_values, last_modified_date, no_longer_in_use, notes FROM '.$sde_underscore . ' ORDER BY uid';
  $data_dict = pg_query($q);

  //fetching the column names of the dd table
  $html = '<table class="form-table" style="border:1px solid black;"> <tr style="border:1px solid black;">';
  $i = 0;
  while ($i < pg_num_fields($data_dict))
  {
    $fieldName = pg_field_name($data_dict, $i);
    $fieldName = ucwords(str_replace("_"," ",$fieldName));
    if($fieldName == 'Orders') {
      $html .= '<th style="border:1px solid black;"> Order </th>';
    } else {
      $html .= '<th style="border:1px solid black;">' . $fieldName . '</th>';
    }
    $i = $i + 1;
  }
  $html .= '</tr>';
  $i = 0;

  //fetching and displaying the contents of the db table
  while ($row = pg_fetch_row($data_dict))
  {
    $html .= '<tr style="border:1px solid black;">';
    $count = count($row);
    for ($y = 0; $y < $count; $y+=1)
    {
      $c_row = current($row);
      $html .= '<td style="border:1px solid black;">' . $c_row . '</td>';
      next($row);
    }

    $i = $i + 1;
  }
  pg_free_result($data_dict);

  $html .= '</table>';

  // instantiate and use the dompdf class
  $dompdf = new DOMPDF();

  $dompdf->load_html($html);

  // (Optional) Setup the paper size and orientation
  $dompdf->setPaper('A4', 'landscape');

  // Render the HTML as PDF
  $dompdf->render();

  // Output the generated PDF to Browser
  $dompdf->stream($sde_underscore.'.pdf');


}
?>
