<?php

pg_connect("host=localhost dbname=postgres user=amolivani") or die("Couldn't Connect ".pg_last_error()); // Connect to the Database

$select = "SELECT * FROM info";
$export = pg_query ( $select ) or die ( "Sql error : " . pg_error( ) );
$fields = pg_num_fields ( $export );

for ( $i = 0; $i < $fields; $i++ )
{
    $header .= pg_field_name( $export , $i ) . "\t";
}

while( $row = pg_fetch_row( $export ) )
{
    $line = '';
    foreach( $row as $value )
    {
        if ( ( !isset( $value ) ) || ( $value == "" ) )
        {
            $value = "\t";
        }
        else
        {
            $value = str_replace( '"' , '""' , $value );
            $value = '"' . $value . '"' . "\t";
        }
        $line .= $value;
    }
    $data .= trim( $line ) . "\n" ;
}
$data = str_replace( "\r" , "" , $data );



if ( $data == "" )
{
    $data = "\n(0) Records Found!\n";
}

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=OUTPUT.csv");
header("Pragma: no-cache");
header("Expires: 0");
print "$header\n$data";

?>
