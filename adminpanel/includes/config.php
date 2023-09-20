<?php 
session_start();
//header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
//header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
//ini_set("display_errors",1);
foreach($_SESSION as $key => $val){
//echo "<br>&nbsp;&nbsp;<b>".$key."</b>&nbsp;&nbsp;:&nbsp;&nbsp;".$val;
}
if($_SERVER['HTTP_HOST'] == "localhost" || $_SERVER['HTTP_HOST'] == "192.168.1.9" || $_SERVER['HTTP_HOST'] == "172.16.0.3" || $_SERVER['HTTP_HOST'] == "172.16.0.4"){
  $host = "localhost";
  $user = "root";
  $password = "";
  $db = "db_industryarc";
  define ('DOC_ROOT_PATH', $_SERVER['DOCUMENT_ROOT'].'/industryarc/');
  define ('SITE_PATH', 'http://'.$_SERVER['HTTP_HOST'].'/industryarc/');  
  define ('SITE_IMG_PATH', 'http://'.$_SERVER['HTTP_HOST'].'/industryarc/images/');  
  define ('ROOT_IMG_PATH', $_SERVER['DOCUMENT_ROOT'].'/industryarc/images/');  
  define ('ROOT_ART_PATH', $_SERVER['DOCUMENT_ROOT'].'/industryarc/articleImages/');
    define ('SITE_ART_PATH', 'http://'.$_SERVER['HTTP_HOST'].'/industryarc/articleImages/');    
  
  define ('SITEDOC_ROOT_PATH', $_SERVER['DOCUMENT_ROOT'].'/industryarc/');  
}else{
   $host = "localhost";
  $user = "iarcdbmain";
  $password = "vpfjeVCuRqm4#5c9AhPeDdG6mGWX!jY6";
  $db = "iarcdb-live";  
  define (DOC_ROOT_PATH,'/var/www/html/adminpanel/');
  define (SITE_PATH, 'https://'.$_SERVER['HTTP_HOST'].'/adminpanel/');
  define (SITE_IMG_PATH, 'https://'.$_SERVER['HTTP_HOST'].'/adminpanel/images/');
  define (ROOT_IMG_PATH, '/var/www/html/adminpanel/images/');
  define (ROOT_ART_PATH, '/var/www/html/frontend/web/images/reports/');  
  define (SITE_ART_PATH, 'https://'.$_SERVER['HTTP_HOST'].'/images/reports/');      
  define (SITEDOC_ROOT_PATH, '/var/www/html/');
}

global $mysqli;
$mysqli = new mysqli($host, $user, $password, $db);
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
require DOC_ROOT_PATH."includes/pagedresults.php";
require_once DOC_ROOT_PATH."includes/forClasses.php"; 
$allClasses = new forClasses();


$pages = array(
'',
'Terms and Conditions',
'Privacy Policy',
'Research Methodology',
'About Us',
'Press Releases',
'News Articles',
'Home',  
'custom-research',  
'snapshot-research',  
'business-consulting',  
'revenue-growth-partnership',  
'Contact Us',  
'register',  
'payment-process',  
'business-analytics',  
'strategic-analytics',  
'analytics-case-studies',
'white-papers',
'Events',
'Webinars'  
);

$menu = array(
  '',
  'Analytics',
  'Consulting'
);

$order_stat=array('IP'=>'In Process','OP'=>'Order Placed','SHIP'=>'Shippin Done','DELV'=>'Order Delivered','CANC'=>'Order Canceled');
$arr_months=array(1=>'January',2=>'February',3=>'March',4=>'April',5=>'May',6=>'June',7=>'July',8=>'August',9=>'September',10=>'October',11=>'November',12=>'December');
$err=array('WP'=>'Invalid Details. Please try again.','SA'=>'Added Successfully.','FA'=>'Unable to Add. Please try again.','SE'=>'Updated Successfully.','FE'=>'Unable to edit. Please try again.','SD'=>'Removed Successfully.','FD'=>'Unable to remove. Please try again.');
function generateCode($characters) {
    /* list all possible characters, similar looking characters and vowels have been removed */
    $possible = '23456789bcdfghjkmnpqrstvwxyz';
    $code = '';
    $i = 0;
    while ($i < $characters) 
    { 
      $code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
      $i++;
    }
    return $code;
  }
$_SESSION['code'] = generateCode(6);
 if($_SERVER['QUERY_STRING'] != ""){
   $current_page = $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'];
 }else{
   $current_page = $_SERVER['PHP_SELF'];
 }
//$adminMail = 'sai@3kits.com';
$adminMail = 'sales@industryarc.com';
$pgTitle="IndustryARC";
$pgTitleStory="IndustryARC";
//FINDING CURRENT PAGE  
$pg = substr($_SERVER['PHP_SELF'], strrpos($_SERVER['PHP_SELF'], '/')+1, strlen($_SERVER['PHP_SELF']));
if($pg=="login.php" || $pg=="register.php" || $pg=="ajax.php" || $pg=="actions.php"){
    //$_SESSION['prev_url']=$current_page;
}else{
  $_SESSION['prev_url']=$current_page;
}
?> 
