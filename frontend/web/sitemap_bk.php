<?php
header("Content-type: text/xml");
$sitemap = '<?xml version="1.0" encoding="UTF-8"?>
<urlset
      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xmlns:xhtml="http://www.w3.org/1999/xhtml"
      xsi:schemaLocation="
            http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';

$con=mysqli_connect("34.90.23.238","iarcdb","Iarcgpc@123","iarcdb-live");
if (mysqli_connect_errno()){
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$date = date("Y-m-d");
$sitemap .= '
   <url>
       <loc>https://www.industryarc.com/</loc>
       <priority>1.0000</priority>
  </url>  
  <url>
       <loc>https://www.industryarc.com/press-releases.php</loc>
       <priority>0.8000</priority>
  </url>  
  <url>
       <loc>https://www.industryarc.com/contact-us.php</loc>
       <priority>0.8000</priority>
  </url>
  <url>
       <loc>https://www.industryarc.com/team.php</loc>
       <priority>0.8000</priority>
  </url>
  <url>
       <loc>https://www.industryarc.com/about-us.php</loc>
       <priority>0.8000</priority>
  </url>
  <url>
       <loc>https://www.industryarc.com/privacy-policy.php</loc>
       <priority>0.8000</priority>
  </url>
  <url>
       <loc>https://www.industryarc.com/term-and-conditions.php</loc>
       <priority>0.8000</priority>
  </url>
';

$query = "SELECT CONCAT('https://www.industryarc.com/Domain/',zp.code,'/',zp.seo_keyword) AS link FROM zsp_catlog_categories zp WHERE zp.status=1 AND zp.seo_keyword<>'' AND zp.seo_keyword NOT LIKE '%&%'";
$domainData = mysqli_query($con,$query);

while($rowDomain = mysqli_fetch_assoc($domainData)){
	$sitemap .= '
		<url>
		   <loc>'.$rowDomain['link'].'</loc>
		   <priority>0.8000</priority>
		</url>
	';
}

$queryarticle = "SELECT CONCAT('https://www.industryarc.com/Article/',zp.custid,'/',zp.seo_keyword) AS link
FROM zsp_news zp WHERE zp.status=1 AND zp.seo_keyword<>'' AND zp.seo_keyword NOT LIKE '%&%'";
$queryarticle = mysqli_query($con,$queryarticle);

while($rowArticle = mysqli_fetch_assoc($queryarticle)){
	$sitemap .= '
		<url>
		   <loc>'.$rowArticle['link'].'</loc>
		   <priority>0.8000</priority>
		</url>
	';
}

$querypressrelease = "SELECT CONCAT('https://www.industryarc.com/PressRelease/',zp.prod_id,'/',zp.seo_keyword) as link
FROM zsp_prs zp WHERE `status`=1 AND zp.seo_keyword<>'' AND zp.seo_keyword NOT LIKE '%&%'";
$querypressrelease = mysqli_query($con,$querypressrelease);

while($rowPrs = mysqli_fetch_assoc($querypressrelease)){
	$sitemap .= '
		<url>
		   <loc>'.$rowPrs['link'].'</loc>
		   <priority>0.8000</priority>
		</url>
	';
}

$querywhitepapers = "SELECT CONCAT('https://www.industryarc.com/WhitePaperDownload/',zp.prod_id,'/',zp.seo_keyword) AS link
FROM zsp_whitepapers zp WHERE zp.status=1 AND zp.seo_keyword<>'' AND zp.seo_keyword NOT LIKE '%&%'";
$querywhitepapers = mysqli_query($con,$querywhitepapers);

while($rowWhiteP = mysqli_fetch_assoc($querywhitepapers)){
	$sitemap .= '
		<url>
		   <loc>'.$rowWhiteP['link'].'</loc>
		   <priority>0.8000</priority>
		</url>
	';
}

$queryReport = "SELECT IF(zp.dup_inc_id<500000,CONCAT('https://www.industryarc.com/Report/',zp.dup_inc_id,'/',zp.curl),
CONCAT('https://www.industryarc.com/Research/',zp.curl,'-',zp.dup_inc_id)) AS link
FROM zsp_posts zp  WHERE zp.status=1 AND zp.curl<>'' AND zp.curl NOT LIKE '%&%'";
$queryReport = mysqli_query($con,$queryReport);

while($rowReport = mysqli_fetch_assoc($queryReport)){
	$sitemap .= '
		<url>
		   <loc>'.$rowReport['link'].'</loc>
		   <priority>0.8000</priority>
		</url>
	';
}

$sitemap .= '</urlset>';

mysqli_close($con);
//echo $sitemap;

/*unlink('sitemap.xml');
$xmlDoc = new DOMDocument();
$xmlDoc->preserveWhiteSpace = false;
$xmlDoc->formatOutput = true;
$xmlDoc->loadXML ( $sitemap );
$xmlDoc->save('sitemap.xml');
echo $xmlDoc->saveXml();*/


?>