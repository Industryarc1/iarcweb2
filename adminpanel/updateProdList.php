<?php
//ini_set('display_errors',1); error_reporting(E_ALL);
include_once "includes/config.php";
if(isset($_POST["addArticle"]) && $_POST["addArticle"]=="Save Posts"){
		$cat=$_POST['txtParent'];
		$subcat=$_POST['txtParent1'];
		
		error_reporting(0);
		require_once 'ExcelReader.php';
		
		if($_FILES['excelfile']['name'] == '' || $_FILES['excelfile']['size'] == 0)
		{
			$_SESSION['status'] = 'INV';
			 $allClasses->forRedirect ("addPost.php");
			exit;
		}
		else if($_FILES['excelfile']['type'] != 'application/vnd.ms-excel')
		{
			$_SESSION['status'] = 'INV';
			$allClasses->forRedirect ("addPost.php");
			exit;
		}
		
		$excel_file = $_FILES['excelfile']['tmp_name'];
		$data = new Spreadsheet_Excel_Reader($excel_file);
		$total_rows = $data->rowcount();
		
		function match($pos, $val, $req){
			if($val != $req)
			{
				echo '<font color="#FF0000">Invalid Header in Field '.$pos.'. Required Header is \''.$req.$val.'\'';
				exit;
			}
			else
			{ //echo 'Header in Field '.$pos.' is '.$val.'<br>';
			}
		}
		
		
		for($i=1;$i<$total_rows;$i++)
		{
			switch($i)
			{
				case 1 : match($i,$data->val(1,$i),'title'); break;
				case 2 : match($i,$data->val(1,$i),'code'); break;
				case 3 : match($i,$data->val(1,$i),'short_descr'); break;
				case 4 : match($i,$data->val(1,$i),'description'); break;
				case 5 : match($i,$data->val(1,$i),'table_of_content'); break;
				case 6 : match($i,$data->val(1,$i),'report_type'); break;
				case 7 : match($i,$data->val(1,$i),'pub_date'); break;
				case 8 : match($i,$data->val(1,$i),'report_del'); break;
				case 9 : match($i,$data->val(1,$i),'del_time'); break;
				case 10 : match($i,$data->val(1,$i),'file_format'); break;
				case 11 : match($i,$data->val(1,$i),'author'); break;
				case 12 : match($i,$data->val(1,$i),'single_price'); break;
				case 13 : match($i,$data->val(1,$i),'corporate_price'); break;
				case 14 : match($i,$data->val(1,$i),'image'); break;
				case 15 : match($i,$data->val(1,$i),'url'); break;
				case 16 : match($i,$data->val(1,$i),'meta_title'); break;
				case 17 : match($i,$data->val(1,$i),'meta_keywords'); break;
				case 18 : match($i,$data->val(1,$i),'meta_descr'); break;
				case 19 : match($i,$data->val(1,$i),'seo_keyword'); break;
				case 20 : match($i,$data->val(1,$i),'related'); break;
			}
		}
		
		for($row = 2; $row <= $total_rows; $row++)
		{
			$title = mysqli_real_escape_string($mysqli,$data->val($row,1));
			$publisher = mysqli_real_escape_string($mysqli,$data->val($row,2));
			$short_descr = mysqli_real_escape_string($mysqli,$data->val($row,3));
			$description = base64_encode(mysqli_real_escape_string($mysqli,$data->val($row,4)));
			$table_of_content = base64_encode(mysqli_real_escape_string($mysqli,$data->val($row,5)));
			$report_type = mysqli_real_escape_string($mysqli,$data->val($row,6));
			$pub_date = mysqli_real_escape_string($mysqli,$data->val($row,7));
			$report_del = mysqli_real_escape_string($mysqli,$data->val($row,8));
			$del_time = mysqli_real_escape_string($mysqli,$data->val($row,9));
			$file_format = mysqli_real_escape_string($mysqli,$data->val($row,10));
			$no_pages = mysqli_real_escape_string($mysqli,$data->val($row,11));
			$slp = mysqli_real_escape_string($mysqli,$data->val($row,12));
			$clp = mysqli_real_escape_string($mysqli,$data->val($row,13));
			$image = mysqli_real_escape_string($mysqli,$data->val($row,14));
			$url = mysqli_real_escape_string($mysqli,$data->val($row,15));
			$meta_title = mysqli_real_escape_string($mysqli,$data->val($row,16));
			$meta_keywords = mysqli_real_escape_string($mysqli,$data->val($row,17));
			$meta_descr = mysqli_real_escape_string($mysqli,$data->val($row,18));
			$seo_keyword = mysqli_real_escape_string($mysqli,$data->val($row,19));
			$rr = mysqli_real_escape_string($mysqli,$data->val($row,20));
			
			$status=1;
			
			$inserts[]=array($cat,$subcat,$title,$publisher,$short_descr,$description,$table_of_content,$report_type,$pub_date,$report_del,$del_time,$file_format,$no_pages,$slp,$clp,$image,$status,$meta_title,$meta_keywords,$meta_descr,$seo_keyword,$url,$rr);
		}
		
		
		$query = "INSERT INTO zsp_posts (cat,subcat,title,code,short_descr,description,table_of_content,report_type,pub_date,report_del,del_time,file_format,no_pages,slp,clp,image,status,meta_title,meta_keywords,meta_descr,seo_keyword,curl,related,dt_created) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,now())";
		$stmt = $mysqli->prepare($query);
		$mysqli->query("START TRANSACTION");
		
		//$delquery="delete from zsp_pricelist where hub_code=?";
		//$delstmtstmt = $mysqli->prepare($delquery);
		//$delstmtstmt ->bind_param("s", $hub_code);
		//$delstmtstmt->execute();
		
		foreach ($inserts as $one) {
			
			$stmt ->bind_param("sssssssssssssssssssssss", $one[0],$one[1],$one[2],$one[3],$one[4],$one[5],$one[6],$one[7],$one[8],$one[9],$one[10],$one[11],$one[12],$one[13],$one[14],$one[15],$one[16],$one[17],$one[18],$one[19],$one[20],$one[21],$one[22]);
			$flag=$stmt->execute();
			//echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
		}
		$stmt->close();
		$mysqli->query("COMMIT");
		if($flag){
				$_SESSION['stat']="SE";
				$allClasses->forRedirect ("posts.php");
				exit;
			}else{
				$_SESSION['stat']="FE";
				$allClasses->forRedirect ("posts.php");
				exit;
			}
}


if(isset($_POST["addArticle1"]) && $_POST["addArticle1"]=="Save Post"){
	$cat=$_POST['txtParent'];
	$subcat=$_POST['txtParent1'];
	$title = mysqli_real_escape_string($mysqli,$_POST['txtName']);
	$rcode = mysqli_real_escape_string($mysqli,$_POST['txtCode']);
	$short_descr = ($_POST['txtSDescr']);
	$description = base64_encode(($_POST['txtDescr']));
	$table_of_content = base64_encode(($_POST['txtTOC']));
	$taf = base64_encode(($_POST['txtTAF']));
	$cc = (mysqli_real_escape_string($mysqli,$_POST['txtCC']));
	
	$slp = mysqli_real_escape_string($mysqli,$_POST['txtSLP']);
	$clp = mysqli_real_escape_string($mysqli,$_POST['txtCLP']);
	$report_type = mysqli_real_escape_string($mysqli,$_POST['radType']);
	$pub_date = mysqli_real_escape_string($mysqli,$_POST['txtPD']);
	$pub_date_new = mysqli_real_escape_string($mysqli,$_POST['txtPDN']);
	$report_del = mysqli_real_escape_string($mysqli,$_POST['txtRD']);
	$del_time = mysqli_real_escape_string($mysqli,$_POST['txtDT']);
	$file_format = mysqli_real_escape_string($mysqli,$_POST['txtFF']);
	$no_pages = mysqli_real_escape_string($mysqli,$_POST['txtNP']);
	
	$curl = mysqli_real_escape_string($mysqli,$_POST['txtCURL']);
	$cbreadcrumb = mysqli_escape_string($mysqli,$_POST['txtCBCT']);
	$meta_title = mysqli_real_escape_string($mysqli,$_POST['txtMetaTitle']);
	$meta_keywords = mysqli_real_escape_string($mysqli,$_POST['txtMetaKeywords']);
	$meta_descr = mysqli_real_escape_string($mysqli,$_POST['txtMetaDesc']);
	$seo_keyword = mysqli_real_escape_string($mysqli,$_POST['txtSEOKeyword']);
	
	$pages=mysqli_real_escape_string($mysqli,$_POST['txtPages']);
	$cat_but=mysqli_real_escape_string($mysqli,$_POST['radCatBut']);
	$atag=mysqli_real_escape_string($mysqli,$_POST['txtATag']);
	
	$rr = mysqli_real_escape_string($mysqli,$_POST['txtRR']);
	$rid = mysqli_real_escape_string($mysqli,$_POST['txtRID']);
	
	$txtRegionType=$_POST['txtRegionType'];
	$txtRegion=$_POST['txtRegion'];
	
	$status=1;
	
	if($_FILES['txtImage']['name'] != ""){
		$result = $allClasses->forFileUpload_ren(ROOT_ART_PATH, 'txtImage');
		if($result){
			$image = $result;
			$result = $allClasses->resizeImage2(ROOT_ART_PATH.$image, ROOT_ART_PATH."thumbs/".$image, 100,'');
		}
	}
	
	$query = "insert into zsp_posts(cat,subcat,title,code,short_descr,description,table_of_content,report_type,pub_date,report_del,del_time,file_format,no_pages,slp,clp,image,status,curl,meta_title,meta_keywords,meta_descr,seo_keyword,related,dt_created,taf,cc,pages,cat_but,atag,dup_inc_id,cbreadcrumb,pub_date_new,region_type,region)values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,now(),?,?,?,?,?,?,?,?,?,?)";
		if ($stmt = $mysqli->prepare($query)){			
			$sssssssssssssssssssssss='sssssssssssssssssssssssssssssssss';
			$stmt->bind_param($sssssssssssssssssssssss, $cat,$subcat,$title,$rcode,$short_descr,$description,$table_of_content,$report_type,$pub_date,$report_del,$del_time,$file_format,$no_pages,$slp,$clp,$image,$status,$curl,$meta_title,$meta_keywords,$meta_descr,$seo_keyword,$rr,$taf,$cc,$pages,$cat_but,$atag,$rid,$cbreadcrumb,$pub_date_new,$txtRegionType,$txtRegion);
			//echo $stmt;exit;
			$flag=$stmt->execute();
			//echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;exit;
			if($flag){
				$_SESSION['stat']="SA";
				$allClasses->forRedirect ("posts.php");
				exit;
			}else{
				$_SESSION['stat']="FA";
				$allClasses->forRedirect ("posts.php");
				exit;
			}
			
		}
		
}

if(isset($_POST["eidtArticle"]) && $_POST["eidtArticle"]=="Save Post"){

	/*echo "<pre>";	
		print_r($_POST);
		exit;*/

	$cat=$_POST['txtParent'];
	$subcat=$_POST['txtParent1'];
	$title = mysqli_escape_string($mysqli,$_POST['txtName']);
	$rcode = mysqli_escape_string($mysqli,$_POST['txtCode']);
	$short_descr = ($_POST['txtSDescr']);
	$description = base64_encode(($_POST['txtDescr']));
	$table_of_content = base64_encode(($_POST['txtTOC']));
	$taf = base64_encode(($_POST['txtTAF']));
	$tafNew = base64_encode(($_POST['txtTAFNew']));
	$cc = mysqli_escape_string($mysqli,$_POST['txtCC']);
	
	$slp = mysqli_escape_string($mysqli,$_POST['txtSLP']);
	$clp = mysqli_escape_string($mysqli,$_POST['txtCLP']);
	$report_type = mysqli_escape_string($mysqli,$_POST['radType']);
	$pub_date = mysqli_escape_string($mysqli,$_POST['txtPD']); //updated data
	$pub_date_new = mysqli_escape_string($mysqli,$_POST['txtPDN']); //published date
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
	
	$copies_sold=(isset($_POST['txtCopies']))?$_POST['txtCopies']:1;
	$rating=$_POST['txtRating'];
	
	$txtRegionType=$_POST['txtRegionType'];
	$txtRegion=$_POST['txtRegion'];
	
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
	
	$query = "update zsp_posts set cat=?,subcat=?,title=?,code=?,short_descr=?,description=?,table_of_content=?,report_type=?,pub_date=?,report_del=?,del_time=?,file_format=?,no_pages=?,slp=?,clp=?,image=?,status=?,curl=?,meta_title=?,meta_keywords=?,meta_descr=?,seo_keyword=?,related=?,dt_created=now(),taf=?,taf_new=?,cc=?,pages=?,cat_but=?,atag=?,dup_inc_id=?,cbreadcrumb=?,pub_date_new=?,copies_sold=?,rating=?,region_type=?,region=? where inc_id=?";
		
		if ($stmt = $mysqli->prepare($query)){
			$sssssssssssssssssssssss='sssssssssssssssssssssssssssssssssssss';
			$stmt->bind_param($sssssssssssssssssssssss, $cat,$subcat,$title,$rcode,$short_descr,$description,$table_of_content,$report_type,$pub_date,$report_del,$del_time,$file_format,$no_pages,$slp,$clp,$image,$status,$curl,$meta_title,$meta_keywords,$meta_descr,$seo_keyword,$rr,$taf,$tafNew,$cc,$pages,$cat_but,$atag,$rid,$cbreadcrumb,$pub_date_new,$copies_sold,$rating,$txtRegionType,$txtRegion,$_POST['hid_article_id']);
			//echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
			//echo $stmt;
			$flag=$stmt->execute();
			
			//var_dump($stmt);exit;
			if($flag){
				$stn1 =0;
				$sqlQuery  =  "update zsp_faqsqa set status=? WHERE inc_id=?";
				$statement = $mysqli->prepare($sqlQuery);
				$statement->bind_param("ii", $stn1,$_POST['hid_article_id']);
				$statement->execute();

				for($ai=1;$ai<=5;$ai++){
				$q1 = mysqli_real_escape_string($mysqli,$_POST['q'.$ai]);
				$faq1 =  mysqli_real_escape_string($mysqli,$_POST['faq'.$ai]);
				$newSql = "insert into zsp_faqsqa(inc_id,question,answer,priority,status,created_date)values(?,?,?,1,1,now())";
				$statement1 = $mysqli->prepare($newSql);
				$statement1->bind_param("iss", $_POST['hid_article_id'],$q1,$faq1);
				$statement1->execute();
				}


				$_SESSION['stat']="SE";
				$allClasses->forRedirect ("posts.php");
				exit;
			}else{
				$_SESSION['stat']="FE";
				$allClasses->forRedirect ("posts.php");
				exit;
			}
			
		}
		echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}


?> 