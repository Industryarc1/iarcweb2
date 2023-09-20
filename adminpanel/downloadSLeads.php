<?php 
  $host = "34.90.23.238";
$user = "iarcdb";
$password = "Iarcgpc@123";
$db = "iarcdb-live"; 
global $mysqli;
$mysqli = new mysqli($host, $user, $password, $db);
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}  
if(isset($_REQUEST['id']) && $_REQUEST['id']=='dl')
{
  $export = mysqli_query($mysqli,"SELECT l.nl_id as SNO,l.nl_email as Email,l.nl_subcribed_date as SubscribedDate,c.name as Industry FROM zsp_newsletters l inner join zsp_catlog_categories c on l.nl_industry=c.inc_id order by l.nl_subcribed_date desc");
   
$fields = mysqli_num_fields ( $export );

//create csv header row, to contain table headers 
//with database field names
/*for ( $i = 0; $i < $fields; $i++ ) {
  $header .= mysqli_field_name( $export , $i ) . ",";
}*/
while ($property = mysqli_fetch_field($export)) {
    @$header .= $property->name. ",";
}

//this is where most of the work is done. 
//Loop through the query results, and create 
//a row for each
while( $row = mysqli_fetch_row( $export ) ) {
  $line = '';
  
  //for each field in the row
  foreach( $row as $key => $value ) {
    //if null, create blank field
    
    if ( ( !isset( $value ) ) || ( $value == "" ) ){
      $value = ",";
    }
    //else, assign field value to our data
    else {
      $value = str_replace( '"' , '""' , $value );
      $value = '"' . $value . '"' . ",";
    }
    //add this field value to our row
    $line .= $value;
  }
  @$data .= trim( $line ) . "\n";
  
  //trim whitespace from each row
  
}
//remove all carriage returns from the data
$data = str_replace( "\r" , "" , $data );
$file_name="Subscription Leads ".date("d/m/y");

//create a file and send to browser for user to download
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: csv" . date("Y-m-d") . ".csv");
header( "Content-disposition: filename=".$file_name.".csv");
print "$header\n$data";
exit;
}
?>