<?php
require 'vendor/autoload.php';
include 'config.php';
use League\HTMLToMarkdown\HtmlConverter;
$sde_underscore = $_GET['sde_underscore'];
 // Connect to the Database
if (isset($_POST["Expor2md"])) {
  //get records from database
  header('Content-Type: text/md;');
  header('Content-Disposition: attachment; filename='.$sde_underscore .'.md'); //this dowloads the csv file with the given name
  //opening the md file to be downloaded
  $fp = fopen("php://output", "w");
  $html = '| order | field_name | longform_name | description | geocoded | required | data_type | expected_allowed_values | last_modified_date | no_longer_in_use | notes |<br />';
  $html .= '| --- | --- | --- | --- | --- | --- | --- | --- | --- | --- | --- |<br />';
  $q = 'select * from '.$sde_underscore ;
  $query = pg_query($q);
  //fetching values to write into the md file
  while ($row = pg_fetch_row($query))
  {
    $count = count($row);
    for ($y = 0; $y < $count; $y+=1)
    {
      $c_row = current($row);
      $html.= "|" . $c_row;
      next($row);
    }
      $html .= "<br />";
  }
  $converter = new HtmlConverter();

  $markdown = $converter->convert($html);
  echo $markdown;

  fclose($fp);
}
?>
