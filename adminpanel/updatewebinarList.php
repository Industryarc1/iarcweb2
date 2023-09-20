<?php
include_once "includes/config.php";

if(isset($_POST["addArticle"]) && $_POST["addArticle"]=="Save Post"){
	$cat=$_POST['txtParent'];
	$subcat=$_POST['txtParent1'];
	$title = mysqli_escape_string($mysqli,$_POST['txtName']);
	$rcode = mysqli_escape_string($mysqli,$_POST['txtCode']);
	$short_descr = ($_POST['txtSDescr']);
	$description = base64_encode(($_POST['txtDescr']));
	$table_of_content = base64_encode(($_POST['txtTOC']));
	$taf = base64_encode(($_POST['txtTAF']));
	$cc = mysqli_escape_string($mysqli,$_POST['txtCC']);
	
	$slp = mysqli_escape_string($mysqli,$_POST['txtSLP']);
	$clp = mysqli_escape_string($mysqli,$_POST['txtCLP']);
	$report_type = mysqli_escape_string($mysqli,$_POST['radType']);
	$pub_date = mysqli_escape_string($mysqli,$_POST['datetimepicker']);
	//$pub_date = date('Y-m-d h:i:s A', strtotime($pub_date));
	$report_del = mysqli_escape_string($mysqli,$_POST['txtRD']);
	$del_time = mysqli_escape_string($mysqli,$_POST['txtDT']);
	$file_format = mysqli_escape_string($mysqli,$_POST['txtFF']);
	$no_pages = mysqli_escape_string($mysqli,$_POST['txtNP']);
	
	$curl = mysqli_escape_string($mysqli,$_POST['txtCURL']);
	$cbreadcrumb = mysqli_escape_string($mysqli,$_POST['txtCBCT']);
	$meta_title = mysqli_escape_string($mysqli,$_POST['txtMetaTitle']);
	$meta_keywords = mysqli_escape_string($mysqli,$_POST['txtMetaKeywords']);
	$meta_descr = mysqli_escape_string($mysqli,$_POST['txtMetaDesc']);
	$seo_keyword = mysqli_escape_string($mysqli,$_POST['txtSEOKeyword']);
	
	$pages=mysqli_escape_string($mysqli,$_POST['txtPages']);
	$cat_but=mysqli_escape_string($mysqli,$_POST['radCatBut']);
	$atag=mysqli_escape_string($mysqli,$_POST['txtATag']);
	
	$rr = mysqli_escape_string($mysqli,$_POST['txtRR']);
	$rid = mysqli_escape_string($mysqli,$_POST['txtRID']);
	
	$status=1;
	 
	if($_FILES['txtImage']['name'] != ""){
		$result = $allClasses->forFileUpload_ren(ROOT_ART_PATH, 'txtImage');
		if($result){
			$image = $result;
			$result = $allClasses->resizeImage2(ROOT_ART_PATH.$image, ROOT_ART_PATH."thumbs/".$image, 100,'');
		}
	}
	
	$query = "insert into zsp_webinars(cat,subcat,title,code,short_descr,description,table_of_content,report_type,pub_date,report_del,del_time,file_format,no_pages,slp,clp,image,status,curl,meta_title,meta_keywords,meta_descr,seo_keyword,related,dt_created,taf,cc,pages,cat_but,atag,dup_inc_id,cbreadcrumb)values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,now(),?,?,?,?,?,?,?)";
		if ($stmt = $mysqli->prepare($query)){
			$sssssssssssssssssssssss='ssssssssssssssssssssssssssssss';
			$stmt->bind_param($sssssssssssssssssssssss, $cat,$subcat,$title,$rcode,$short_descr,$description,$table_of_content,$report_type,$pub_date,$report_del,$del_time,$file_format,$no_pages,$slp,$clp,$image,$status,$curl,$meta_title,$meta_keywords,$meta_descr,$seo_keyword,$rr,$taf,$cc,$pages,$cat_but,$atag,$rid,$cbreadcrumb);
			
			$flag=$stmt->execute();
			if($flag){
				$_SESSION['stat']="SA";
				$allClasses->forRedirect ("webinars.php");
				exit;
			}else{
				$_SESSION['stat']="FA";
				$allClasses->forRedirect ("webinars.php");
				exit;
			}
			
		}
		
}

if(isset($_POST["eidtArticle"]) && $_POST["eidtArticle"]=="Save Post"){
	$cat=$_POST['txtParent'];
	$subcat=$_POST['txtParent1'];
	$title = mysqli_escape_string($mysqli,$_POST['txtName']);
	$rcode = mysqli_escape_string($mysqli,$_POST['txtCode']);
	$short_descr = ($_POST['txtSDescr']);
	$description = base64_encode(($_POST['txtDescr']));
	$table_of_content = base64_encode(($_POST['txtTOC']));
	$taf = base64_encode(($_POST['txtTAF']));
	$cc = (mysqli_escape_string($mysqli,$_POST['txtCC']));
	
	$slp = mysqli_escape_string($mysqli,$_POST['txtSLP']);
	$clp = mysqli_escape_string($mysqli,$_POST['txtCLP']);
	$report_type = mysqli_escape_string($mysqli,$_POST['radType']);	
	$pub_date = mysqli_escape_string($mysqli,$_POST['datetimepicker']);	
	//$pub_date = date('Y-m-d h:i:s A', strtotime($pub_date));
	$report_del = mysqli_escape_string($mysqli,$_POST['txtRD']);
	$del_time = mysqli_escape_string($mysqli,$_POST['txtDT']);
	$file_format = mysqli_escape_string($mysqli,$_POST['txtFF']);
	$no_pages = mysqli_escape_string($mysqli,$_POST['txtNP']);
	
	$curl = mysqli_escape_string($mysqli,$_POST['txtCURL']);
	$cbreadcrumb = mysqli_escape_string($mysqli,$_POST['txtCBCT']);
	$meta_title = mysqli_escape_string($mysqli,$_POST['txtMetaTitle']);
	$meta_keywords = mysqli_escape_string($mysqli,$_POST['txtMetaKeywords']);
	$meta_descr = mysqli_escape_string($mysqli,$_POST['txtMetaDesc']);
	$seo_keyword = mysqli_escape_string($mysqli,$_POST['txtSEOKeyword']);
	
	$pages=mysqli_escape_string($mysqli,$_POST['txtPages']);
	$cat_but=mysqli_escape_string($mysqli,$_POST['radCatBut']);
	$atag=mysqli_escape_string($mysqli,$_POST['txtATag']);
	
	$rr = mysqli_escape_string($mysqli,$_POST['txtRR']);
	$rid = mysqli_escape_string($mysqli,$_POST['txtRID']);
	
	$youtubeLink = mysqli_escape_string($mysqli,$_POST['txtYoutubeLink']);
	
	$status=1;
	
	if($_FILES['txtImage']['name'] != ""){
		$result = $allClasses->forFileUpload_ren(ROOT_ART_PATH, 'txtImage');
		if($result){
			$image = $result;
			$result = $allClasses->resizeImage2(ROOT_ART_PATH.$image, ROOT_ART_PATH."thumbs/".$image, 100,'');
			if($_POST['hidImage']!=""){
				unlink('../articleImages/'.$_POST['hidImage']);
				unlink('../articleImages/thumbs/'.$_POST['hidImage']);
			}
		}
	}else{
		$image = $_POST['hidImage'];
	}
	//echo $image;
	
	$query = "update zsp_webinars set cat=?,subcat=?,title=?,code=?,short_descr=?,description=?,table_of_content=?,report_type=?,pub_date=?,report_del=?,del_time=?,file_format=?,no_pages=?,slp=?,clp=?,image=?,status=?,curl=?,meta_title=?,meta_keywords=?,meta_descr=?,seo_keyword=?,related=?,dt_created=now(),taf=?,cc=?,pages=?,cat_but=?,atag=?,dup_inc_id=?,cbreadcrumb=? where inc_id=?";
		if ($stmt = $mysqli->prepare($query)){
			$sssssssssssssssssssssss='sssssssssssssssssssssssssssssss';
			$stmt->bind_param($sssssssssssssssssssssss, $cat,$subcat,$title,$rcode,$short_descr,$description,$table_of_content,$report_type,$pub_date,$report_del,$del_time,$file_format,$no_pages,$slp,$clp,$image,$status,$curl,$meta_title,$meta_keywords,$meta_descr,$seo_keyword,$rr,$taf,$cc,$pages,$cat_but,$atag,$rid,$cbreadcrumb,$_POST['hid_article_id']);
			$flag=$stmt->execute();
			if($flag){
				$getLink=mysqli_query($mysqli,"select * from webinar_videos where webinar_id='".$_POST['hid_article_id']."'");
				$getYouTubeLink = mysqli_fetch_array($getLink);
				
				if(!empty($getYouTubeLink)){
					$updateLink = $mysqli->prepare("update webinar_videos set youtube=? where webinar_id=?");
					$ss = 'ss';
					$updateLink->bind_param($ss,$youtubeLink,$_POST['hid_article_id']);
					$updateYouLink = $updateLink->execute();
				}else{
					$insertLink = mysqli_query($mysqli,"insert into webinar_videos(webinar_id,youtube,created)values(".$_POST['hid_article_id'].",'".$youtubeLink."',now())");
				}
				
				$_SESSION['stat']="SE";
				$allClasses->forRedirect ("webinars.php");
				exit;
			}else{
				$_SESSION['stat']="FE";
				$allClasses->forRedirect ("webinars.php");
				exit;
			}
			
		}
		echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}


?> 