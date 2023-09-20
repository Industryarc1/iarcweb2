<?php
if(isset($_POST['token']) && $_POST['token']=="insertreport" && $_POST['title']!="" && $_POST['toc']!=""){
	$con=mysqli_connect("localhost","iarcdbmain","vpfjeVCuRqm4#5c9AhPeDdG6mGWX!jY6","iarcdb-live");
	if (mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$catCode = $_POST['category_code'];
	$reportCode = $catCode." ".rand(10000,99999);
	$date = date("Y-m-d");
	$cateID = $_POST['category_id'];
	$slp = $_POST['slp'];
	$clp = $_POST['clp'];
	//$title = mysqli_real_escape_string($con,$_POST['title']);
	$title = $_POST['title'];
	$toc = $_POST['toc'];
	$taf = $_POST['lot_lof'];
	$taf_new = $_POST['lot_lof_new'];
	$metaTitle = $_POST['meta_title'];
	$metaKeywords = $_POST['meta_keywords'];
	$metaDesc = $_POST['meta_description'];
	$seoKeywords = $_POST['seo_keywords'];
	$customUrl = $_POST['custom_url'];
	$customBreadcrumb = $_POST['custom_breadcrumb_tag'];
	$reportId = $_POST['report_id'];
	$query = "INSERT INTO zsp_posts(code,cat,title,table_of_content,taf,taf_new, report_type, pub_date, slp, clp,no_pages,cat_but,file_format,curl,cbreadcrumb, meta_title, meta_keywords, meta_descr, seo_keyword,dt_created,status,dup_inc_id,publish_type,is_publish,region_type) VALUES ('$reportCode','$cateID','$title','$toc','$taf','$taf_new','S','$date','$slp','$clp','IndustryARC','0','PDF','$customUrl','$customBreadcrumb','$metaTitle','$metaKeywords','$metaDesc','$seoKeywords','$date','0','$reportId','0','0','Global')";
	//echo $query;exit;
	mysqli_query($con,$query);
	mysqli_close($con);
	echo "Inserted";
}else{
	echo "failed";
}
?>
