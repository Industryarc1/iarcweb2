<?php
if(isset($_POST['token']) && $_POST['token']=="updatereportfromcrm"){
	$con=mysqli_connect("localhost","iarcdbmain","vpfjeVCuRqm4#5c9AhPeDdG6mGWX!jY6","iarcdb-live");
	if (mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	$date = date("Y-m-d");
	$cat = $_POST['cat'];
	$slp = $_POST['slp'];
	$clp = $_POST['clp'];
	$title = mysqli_real_escape_string($con,$_POST['title']);
	//$title = $_POST['title'];
	$toc = $_POST['toc'];
	//$taf = $_POST['lotlof'];
	$regiontype = $_POST['region_type'];
	$taf_new = $_POST['lotlof'];
	$rdesc = $_POST['description'];
	$metaTitle = mysqli_real_escape_string($con,$_POST['metatitle']);
	$metaKeywords = mysqli_real_escape_string($con,$_POST['metakeyword']);
	$metaDesc = mysqli_real_escape_string($con,$_POST['metadesc']);
	$seoKeywords = mysqli_real_escape_string($con,$_POST['seokeyword']);
	$curl = $_POST['curl'];
	$customBreadcrumb = $_POST['breadcrumbs'];
	$incid = $_POST['inc_id'];
	$status = $_POST['status'];
	$atag = $_POST['atag'];
	
	$query = "update zsp_posts set cat=$cat,title='$title',description='$rdesc',table_of_content='$toc',report_type='S',pub_date='$date',file_format='PDF',no_pages='IndustryARC',slp=$slp,clp=$clp,status=$status,curl='$curl',meta_title='$metaTitle',meta_keywords='$metaKeywords',meta_descr='$metaDesc',seo_keyword='$seoKeywords',atag='$atag',dt_created=NOW(),taf_new='$taf_new',cc=0,cat_but=0,cbreadcrumb='$customBreadcrumb',region_type='$regiontype' where inc_id=$incid";
	//echo $query;exit;
	$result = mysqli_query($con,$query);
	mysqli_close($con);
	if($result){
		echo "Updated";
	}else{
		echo "failed";
	}	
}else{
	echo "failed";
}
?>
