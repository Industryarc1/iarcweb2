<?php 
$host = "34.90.23.238";
$user = "iarcdb";
$password = "Iarcgpc@123";
$db = "iarcdb-live";
/*$host = "localhost";
$user = "root";
$password = "";
$db = "db_industryarc";*/
global $mysqli;
$mysqli = new mysqli($host, $user, $password, $db);
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}  
if(isset($_REQUEST['id']) && $_REQUEST['id']=='dl')
{
	$export = mysqli_query($mysqli,"SELECT l.inc_id as SNo, l.fname as Firstname,l.lname as Lastname,l.email as Email,l.phone as Phone,l.job as JobTitle,l.company as Company,l.country as Country,l.ip as IP,l.pincode as Pincode,l.comments as Requirement,l.type as Type,l.comp_titles as RequestCompanyTitle,l.scid as Event,date_format(l.dt_created, '%d/%m/%Y')as EntryDate FROM zsp_leads_consulting l order by l.dt_created desc");
 
$fields = mysqli_num_fields ( $export );
 
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
$file_name="Event Consulting Leads ".date("d/m/y");

//create a file and send to browser for user to download
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: csv" . date("Y-m-d") . ".csv");
header( "Content-disposition: filename=".$file_name.".csv");
print "$header\n$data";
exit;
}  
?>