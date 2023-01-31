<?php $host = "mysql.industryarc.com";
$user = "dbindustryarc1";
$password = "Reset!2345";
$db = "dbindustryarc"; 

global $mysqli;
$mysqli = new mysqli($host, $user, $password, $db);
if ($mysqli->connect_errno) {
  echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
header("Content-Type: application/rss+xml; charset=ISO-8859-1");
$rss_txt="";
unlink('/home/industryarc/industryarc.com/repadindmin/s.xml');
$cats=mysqli_query($mysqli,"select * from zsp_rss where status='1' order by inc_id desc");
$myFile ="s.xml";
$fh = fopen($myFile, 'w') or die("can't open file");
$rss_txt .= '<?xml version="1.0" encoding="utf-8"?>';
$rss_txt .= "<rss version='2.0'>";
$rss_txt .= '<channel>';
while($cat=mysqli_fetch_array($cats))
{
$query = mysqli_query($mysqli,"SELECT * FROM zsp_posts where cat = '".$cat['cat']."'");
while($values_query = mysqli_fetch_array($query))
{
$rss_txt .= '<item>';
$rss_txt .= '<title>' .str_replace('&','and',$values_query['title']). '</title>';
$rss_txt .= '<link>Report/' .$values_query['dup_inc_id']. '/' .$values_query['curl']. '</link>';
$rss_txt.='<pubDate>'.$values_query['dt_created'].'GMT</pubDate>';
$rss_txt.='<guid>'.rand(000000,999999).'</guid>';
$rss_txt.='<cat>'.$values_query['cat'].'</cat>';
$rss_txt .= '<description>' .$values_query['curl']. '</description>';
$rss_txt .= '</item>';
}
}
$rss_txt .= '</channel>';
$rss_txt .= '</rss>';
fwrite($fh, $rss_txt);
fclose($fh);
header("location:getfeeds.php");
?>