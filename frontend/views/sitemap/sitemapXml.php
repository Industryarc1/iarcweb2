<?php
use yii\helpers\Url;

?>
<?php
$lastmod = date("Y-m-d").'T19:38:19+00:00';
//echo '<pre>';print_r($data);exit;
$sitemap = '<?xml version="1.0" encoding="UTF-8"?>
<urlset
      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xmlns:xhtml="http://www.w3.org/1999/xhtml"
      xsi:schemaLocation="
            http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
	/* print All the Others Link */
	foreach($data['others'] as $res){
		$sitemap .= '<url>
					   <loc>'.$res['link'].'</loc>
					   <lastmod>'.$lastmod.'</lastmod>
					   <changefreq>daily</changefreq>
					   <priority>0.8000</priority>
					</url>';
	}
	
	/* print All the Domain Link */
	foreach($data['domain'] as $res){
		$sitemap .= '<url>
					   <loc>'.$res['link'].'</loc>
					   <lastmod>'.$lastmod.'</lastmod>
					   <changefreq>daily</changefreq>
					   <priority>0.8000</priority>
					</url>';
	}
	
	/* print All the article Link */
	foreach($data['article'] as $res){
		$sitemap .= '<url>
					   <loc>'.$res['link'].'</loc>
					   <lastmod>'.$lastmod.'</lastmod>
					   <changefreq>daily</changefreq>
					   <priority>0.8000</priority>
					</url>';
	}
	
	/* print All the pressrelease Link */
	foreach($data['pressrelease'] as $res){
		$sitemap .= '<url>
					   <loc>'.$res['link'].'</loc>
					   <lastmod>'.$lastmod.'</lastmod>
					   <changefreq>daily</changefreq>
					   <priority>0.8000</priority>
					</url>';
	}
	
	/* print All the whitepaper Link */
	foreach($data['whitepaper'] as $res){
		$sitemap .= '<url>
					   <loc>'.$res['link'].'</loc>
					   <lastmod>'.$lastmod.'</lastmod>
					   <changefreq>daily</changefreq>
					   <priority>0.8000</priority>
					</url>';
	}
	
	/* print All the reports Links */
	foreach($data['report'] as $res){
		$sitemap .= '<url>
					   <loc>'.$res['link'].'</loc>
					   <lastmod>'.$lastmod.'</lastmod>
					   <changefreq>daily</changefreq>
					   <priority>0.8000</priority>
					</url>';
	}
	
$sitemap .= '</urlset>';
echo $sitemap;
?>
