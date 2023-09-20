<?php 
$host = "mysql.industryarc.com";
$user = "dbindustryarc1";
$password = "Reset!2345";
$db = "dbindustryarc"; 

global $mysqli;
$mysqli = new mysqli($host, $user, $password, $db);
if ($mysqli->connect_errno) {
  echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
  
function reformat_date($date, $format){
    $output = date($format, strtotime($date));
    return $output;
}

$cats=mysqli_query($mysqli,"select * from zsp_rss where status='1'");
while($cat=mysqli_fetch_array($cats))
{ 
mysqli_query($mysqli,"delete from zsp_rss_feed_items where feed_source_id='".$cat['cat']."'  ");

$xml = simplexml_load_file($cat['image']);

foreach($xml as $key0 => $value){
foreach($value as $key => $value2){
if($key=="item"){
$feed=array();
foreach($value2 as $key2 => $value3){
echo $feed[$key2]=$value3;
} 

$pubdate=reformat_date($feed['pubDate'], "Y-m-d H:i:s");
mysqli_query($mysqli,'insert into zsp_rss_feed_items(feed_source_id,title,link,guid,pubdate_text,pubdate_date,description,dt_created,cat)values("'.$feed['cat'].'","'.$feed['title'].'","'.$feed['link'].'","'.$feed['guid'].'","'.$feed['pubDate'].'","'.$pubdate.'","'.$feed['description'].'",now(),"'.$feed['cat'].'")');
}
}
echo '<br />';
}
} 
$allClasses->forRedirect ("feeds.php");
?>