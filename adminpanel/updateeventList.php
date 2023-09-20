<?php
include_once "includes/config.php";

if(isset($_POST["addArticle"]) && $_POST["addArticle"]=="Save Post"){
	$cat=$_POST['txtParent'];
	$subcat=$_POST['txtParent1'];
	$title = mysql_escape_string($_POST['txtName']);
	$rcode = mysql_escape_string($_POST['txtCode']);
	$short_descr = ($_POST['txtSDescr']);
	$description = base64_encode(($_POST['txtDescr']));
	$table_of_content = base64_encode(($_POST['txtTOC']));
	$taf = base64_encode(($_POST['txtTAF']));
	$cc = mysql_escape_string($_POST['txtCC']);
	
	$slp = mysql_escape_string($_POST['txtSLP']);
	$clp = mysql_escape_string($_POST['txtCLP']);
	$report_type = mysql_escape_string($_POST['radType']);
	$pub_date = mysql_escape_string($_POST['datetimepicker']);
	//$pub_date = date('Y-m-d h:i:s A', strtotime($pub_date));
	$report_del = mysql_escape_string($_POST['txtRD']);
	$del_time = mysql_escape_string($_POST['txtDT']);
	$file_format = mysql_escape_string($_POST['txtFF']);
	$no_pages = mysql_escape_string($_POST['txtNP']);
	
	$curl = mysql_escape_string($_POST['txtCURL']);
	$cbreadcrumb = mysqli_escape_string($mysqli,$_POST['txtCBCT']);
	$meta_title = mysql_escape_string($_POST['txtMetaTitle']);
	$meta_keywords = mysql_escape_string($_POST['txtMetaKeywords']);
	$meta_descr = mysql_escape_string($_POST['txtMetaDesc']);
	$seo_keyword = mysql_escape_string($_POST['txtSEOKeyword']);
	
	$pages=mysql_escape_string($_POST['txtPages']);
	$cat_but=mysql_escape_string($_POST['radCatBut']);
	$atag=mysql_escape_string($_POST['txtATag']);
	
	$rr = mysql_escape_string($_POST['txtRR']);
	$rid = mysql_escape_string($_POST['txtRID']);
	
	$status=1;
	 
	if($_FILES['txtImage']['name'] != ""){
		$result = $allClasses->forFileUpload_ren(ROOT_ART_PATH, 'txtImage');
		if($result){
			$image = $result;
			$result = $allClasses->resizeImage2(ROOT_ART_PATH.$image, ROOT_ART_PATH."thumbs/".$image, 100,'');
		}
	}
	
	$query = "insert into zsp_events(cat,subcat,title,code,short_descr,description,table_of_content,report_type,pub_date,report_del,del_time,file_format,no_pages,slp,clp,image,status,curl,meta_title,meta_keywords,meta_descr,seo_keyword,related,dt_created,taf,cc,pages,cat_but,atag,dup_inc_id,cbreadcrumb)values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,now(),?,?,?,?,?,?,?)";
		if ($stmt = $mysqli->prepare($query)){
			$sssssssssssssssssssssss='ssssssssssssssssssssssssssssss';
			$stmt->bind_param($sssssssssssssssssssssss, $cat,$subcat,$title,$rcode,$short_descr,$description,$table_of_content,$report_type,$pub_date,$report_del,$del_time,$file_format,$no_pages,$slp,$clp,$image,$status,$curl,$meta_title,$meta_keywords,$meta_descr,$seo_keyword,$rr,$taf,$cc,$pages,$cat_but,$atag,$rid,$cbreadcrumb);
			
			$flag=$stmt->execute();
			//echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
			if($flag){
				$_SESSION['stat']="SA";
				$allClasses->forRedirect ("events.php");
				exit;
			}else{
				$_SESSION['stat']="FA";
				$allClasses->forRedirect ("events.php");
				exit;
			}
			
		}
		
}

if(isset($_POST["eidtArticle"]) && $_POST["eidtArticle"]=="Save Post"){
	$cat=$_POST['txtParent'];
	$subcat=$_POST['txtParent1'];
	$title = mysql_escape_string($_POST['txtName']);
	$rcode = mysql_escape_string($_POST['txtCode']);
	$short_descr = ($_POST['txtSDescr']);
	$description = base64_encode(($_POST['txtDescr']));
	$table_of_content = base64_encode(($_POST['txtTOC']));
	$taf = base64_encode(($_POST['txtTAF']));
	$cc = (mysql_escape_string($_POST['txtCC']));
	
	$slp = mysql_escape_string($_POST['txtSLP']);
	$clp = mysql_escape_string($_POST['txtCLP']);
	$report_type = mysql_escape_string($_POST['radType']);	
	$pub_date = mysql_escape_string($_POST['datetimepicker']);	
	//$pub_date = date('Y-m-d h:i:s A', strtotime($pub_date));
	$report_del = mysql_escape_string($_POST['txtRD']);
	$del_time = mysql_escape_string($_POST['txtDT']);
	$file_format = mysql_escape_string($_POST['txtFF']);
	$no_pages = mysql_escape_string($_POST['txtNP']);
	
	$curl = mysql_escape_string($_POST['txtCURL']);
	$cbreadcrumb = mysql_escape_string($_POST['txtCBCT']);
	$meta_title = mysql_escape_string($_POST['txtMetaTitle']);
	$meta_keywords = mysql_escape_string($_POST['txtMetaKeywords']);
	$meta_descr = mysql_escape_string($_POST['txtMetaDesc']);
	$seo_keyword = mysql_escape_string($_POST['txtSEOKeyword']);
	
	$pages=mysql_escape_string($_POST['txtPages']);
	$cat_but=mysql_escape_string($_POST['radCatBut']);
	$atag=mysql_escape_string($_POST['txtATag']);
	
	$rr = mysql_escape_string($_POST['txtRR']);
	$rid = mysql_escape_string($_POST['txtRID']);
	
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
	
	$query = "update zsp_events set cat=?,subcat=?,title=?,code=?,short_descr=?,description=?,table_of_content=?,report_type=?,pub_date=?,report_del=?,del_time=?,file_format=?,no_pages=?,slp=?,clp=?,image=?,status=?,curl=?,meta_title=?,meta_keywords=?,meta_descr=?,seo_keyword=?,related=?,dt_created=now(),taf=?,cc=?,pages=?,cat_but=?,atag=?,dup_inc_id=?,cbreadcrumb=? where inc_id=?";
		if ($stmt = $mysqli->prepare($query)){
			$sssssssssssssssssssssss='sssssssssssssssssssssssssssssss';
			$stmt->bind_param($sssssssssssssssssssssss, $cat,$subcat,$title,$rcode,$short_descr,$description,$table_of_content,$report_type,$pub_date,$report_del,$del_time,$file_format,$no_pages,$slp,$clp,$image,$status,$curl,$meta_title,$meta_keywords,$meta_descr,$seo_keyword,$rr,$taf,$cc,$pages,$cat_but,$atag,$rid,$cbreadcrumb,$_POST['hid_article_id']);
			//echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
			$flag=$stmt->execute();
			if($flag){
				$_SESSION['stat']="SE";
				$allClasses->forRedirect ("events.php");
				exit;
			}else{
				$_SESSION['stat']="FE";
				$allClasses->forRedirect ("events.php");
				exit;
			}
			
		}
		echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}


?> 