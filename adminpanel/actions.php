<?php
//ini_set("display_errors",1); 
include_once "includes/config.php";
if(isset($_POST["logintoadmin"]) && $_POST["logintoadmin"]=="Submit")
{
	$id=$_POST["txtUser"];
	$pw=$_POST["txtPassword"];
	if($id=="admin" || $id=="dmadmin"){
		if ($stmt = $mysqli->prepare("select admin_username,admin_pwd from zsp_admin where BINARY  admin_username=? and BINARY  admin_pwd=?")) {
			/* Bind parameters. Types: s = string, i = integer, d = double,  b = blob */
			$stmt->bind_param('ss', $id, $pw);
			$stmt->execute();
			$stmt->store_result();
			if($stmt->num_rows>0){
				$stmt->bind_result($user_id, $user_pwd);
				$stmt->fetch();
				$_SESSION['admin_id']=$user_id;
				$_SESSION['admin_pwd']=$user_pwd;
				/* free results */
				$stmt->free_result();
				$allClasses->forRedirect ("index.php");
				exit;
			}else{
				$_SESSION['stat']="WP";
				$allClasses->forRedirect ("index.php");
				exit;
			}
			
		}
	}else{
		if ($stmt = $mysqli->prepare("select name,user_id,pwd,cat from zsp_users where BINARY  user_id=? and BINARY  pwd=? and status=1")) {
			/* Bind parameters. Types: s = string, i = integer, d = double,  b = blob */
			$stmt->bind_param('ss', $id, $pw);
			$stmt->execute();
			$stmt->store_result();
			if($stmt->num_rows>0){
				$stmt->bind_result($name,$user_id, $user_pwd,$cat);
				$stmt->fetch();
				$_SESSION['admin_user_id']=$user_id;
				$_SESSION['admin_user_pwd']=$user_pwd;
				$_SESSION['cat']=$cat;
				/* free results */
				$stmt->free_result();
				$allClasses->forRedirect ("index.php");
				exit;
			}else{
				$_SESSION['stat']="WP";
				$allClasses->forRedirect ("index.php");
				exit;
			}
			
		}
	}
}
if(isset($_POST["changePWD"]) && $_POST["changePWD"]=="Change Password"){
	if ($stmt = $mysqli->prepare("select * from zsp_admin where BINARY  admin_username='admin' and BINARY admin_pwd=?")) {
		/* Bind parameters. Types: s = string, i = integer, d = double,  b = blob */
		$stmt->bind_param('s', $_POST['txtOldPasswd']);
		$stmt->execute();
		$stmt->store_result();
		if($stmt->num_rows>0){
			$query = "update zsp_admin set admin_pwd=? where admin_username='admin' and admin_pwd=?";
			if ($stmt1 = $mysqli->prepare($query)) {
				/* Bind parameters. Types: s = string, i = integer, d = double,  b = blob */
				$stmt1->bind_param('ss', $_POST['txtNewPasswd'],$_POST['txtOldPasswd']);
				$flag=$stmt1->execute();
			}
			if($flag){
				$_SESSION['stat']="SE";
				$allClasses->forRedirect ("changepassword.php");
				exit;
			}else{
				$_SESSION['stat']="FE";
				$allClasses->forRedirect ("changepassword.php");
				exit;
			}
		}else{
			$_SESSION['stat']="FE";
$allClasses->forRedirect ("changepassword.php");
				exit;	
		}
	}
	
}
if(isset($_POST["updateContent"]) && $_POST["updateContent"]=="Save Page"){
	$pagename=$pages[$_POST['cmbPGNames']];
	$contnet=base64_encode($_POST['txtContent']);
	$txtMetaTitle=$_POST['txtMetaTitle'];
	$txtMetaKeywords=$_POST['txtMetaKeywords'];
	$txtMetaDesc=$_POST['txtMetaDesc'];
	if ($stmt = $mysqli->prepare("select content from zsp_content where page_name=?")) {
		$stmt->bind_param('s',$pagename);
		$stmt->execute();
		$stmt->store_result();
		if($stmt->num_rows>0){
			$query = "update zsp_content set content=?,meta_title=?,meta_keywords=?,meta_descr=? where page_name=?";
			$stmt1 = $mysqli->prepare($query);
			$stmt1->bind_param('sssss',$contnet,$txtMetaTitle,$txtMetaKeywords,$txtMetaDesc,$pagename);
		}else{
			
			$query = "insert into zsp_content(page_name,content,dt_created) values(?,?,now())";
			$stmt1 = $mysqli->prepare($query);
			$stmt1->bind_param('ss',$pagename,$contnet);
		}
		$flag=$stmt1->execute();
		if($flag){
			$_SESSION['stat']="SE";
			$allClasses->forRedirect ("updateContent.php?pgId=".$_POST['cmbPGNames']);
			exit;
		}else{
			$_SESSION['stat']="FE";
			$allClasses->forRedirect ("updateContent.php?pgId=".$_POST['cmbPGNames']);
			exit;
		}
	}
	

}
if(isset($_POST["updateMenuItem"]) && $_POST["updateMenuItem"]=="Save Menu Item"){
	$pagename=$_POST['cmbPGNames'];
	$title=$_POST['txtTitle'];
	$txtCURL=mysqli_real_escape_string($mysqli,$_POST['txtCURL']);
	$contnet=base64_encode($_POST['txtContent']);
	if($_POST['hidAction']=="EditContent" && $_POST['hid_inc_id']!=""){
		$query = "update zsp_menu_items set page_name=?,title=?,content=?,curl=? where inc_content_id=?";
		$stmt1 = $mysqli->prepare($query);
		$stmt1->bind_param('sssss',$pagename,$title,$contnet,$txtCURL,$_POST['hid_inc_id']);
		$flag=$stmt1->execute();
	}else{
		$query = "insert into zsp_menu_items(page_name,title,content,curl,dt_created) values(?,?,?,?,now())";
		$stmt1 = $mysqli->prepare($query);
		$stmt1->bind_param('ssss',$pagename,$title,$contnet,$txtCURL);
		$flag=$stmt1->execute();
		
	}
	if($flag){
			$_SESSION['stat']="SE";
			$allClasses->forRedirect ("contentPages.php?pgId=".$pagename);
			exit;
		}else{
			$_SESSION['stat']="FE";
			$allClasses->forRedirect ("contentPages.php?pgId=".$pagename);
			exit;
		}
	
}
if(isset($_POST["addCatalogcategory"]) && $_POST["addCatalogcategory"]=="Save Categories"){
	$cats=$_POST['txtCurecases'];
	$parent=$_POST['txtParent'];
	
	if($parent==""){ $parent=0; }
	$sql="insert into zsp_catlog_categories(p_id,name,descr,dt_created,code)values(?,?,?,now(),?)";
	$stmt = $mysqli->prepare($sql);
	//echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	if ($stmt && $cats>0){
		for($i=1;$i<=$cats;$i++){
			$name=$_POST['txtName'.$i];
			$code=$_POST['txtSortOrder'.$i];
			$descr=base64_encode($_POST['txtDescr'.$i]);
			
			//if($_FILES['txtImage'.$i]['name'] != ""){
			//	$result = $allClasses->forFileUpload_ren(ROOT_ART_PATH, 'txtImage'.$i);
			//	if($result){
			//		$image = $result;
			//	}
			//}
			
			$ssss='ssss';
			$stmt->bind_param($ssss, $parent,$name,$descr,$code);
			//echo $parent."-".$name."-".$sort."-".$descr."-".$code."<br>";
			//echo $sql;
			$flag=$stmt->execute();
			
		}
		//exit;
		if($flag){
			$_SESSION['stat']="SA";
			$allClasses->forRedirect ("categories.php?id=".$parent);
			exit;
		}else{
			$_SESSION['stat']="FA";
			$allClasses->forRedirect ("categories.php?id=".$parent);
			exit;
		}
	}
}
if(isset($_POST["editCatalogcategory"]) && $_POST["editCatalogcategory"]=="Save Category"){
	$id=0;
	$name=$_POST['txtName'];
	$p_name=$_POST['txtEmail']; //sales email
	$parent=$_POST['txtParent'];
	$code=$_POST['txtSortOrder'];
	$status=$_POST['txtActive'];
	$mtitle=$_POST['txtMetaTitle'];
	$txtMetaDesc1=$_POST['txtMetaDesc1'];
	$mkeywords=base64_encode($_POST['txtMetaKeywords']);
	$mdesc=base64_encode($_POST['txtMetaDesc']);
	$seokey=$_POST['txtSEOKeyword'];
	
	if($_FILES['txtImage']['name'] != ""){
		$result = $allClasses->forFileUpload_ren(ROOT_ART_PATH, 'txtImage');
		if($result){
			$image = $result;
			if($_POST['hidImage']!=""){
				unlink('../articleImages/'.$_POST['hidImage']);
			}
		}
	}else{
		$image = $_POST['hidImage'];
	}
	
	if($_POST['hid_action']=="editcat" && $_POST['hid_cat_id']!=""){
		$sql="update zsp_catlog_categories set p_name=?,p_id=?, name=?,title=?,keywords=?,descr=?,seo_keyword=?,sort_order=?,status=?,code=?,image=?,meta_desc=?,dt_created=now() where inc_id=?";
		
		if ($stmt = $mysqli->prepare($sql)){
			$isssssiissi='sssssssiisssi';
			$stmt->bind_param($isssssiissi, $p_name,$parent,$name,$mtitle,$mkeywords,$mdesc,$seokey,$sort,$status,$code,$image,$txtMetaDesc1,$_POST['hid_cat_id']);
			//echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
			$flag=$stmt->execute();
			if($flag){
				
				if($parent==0){
					$sql1="update zsp_catlog_categories set p_name=? where p_id=?";
					$stmt1 = $mysqli->prepare($sql1);
					$stmt1->bind_param("ss", $p_name,$_POST['hid_cat_id']);					
					$stmt1->execute();
					
				}				
				$_SESSION['stat']="SE";
				$allClasses->forRedirect ("categories.php?id=".$parent);
				exit;
			}else{
				$_SESSION['stat']="FE";
				$allClasses->forRedirect ("categories.php?id=".$parent);
				exit;
			}
			
		}
	}
	
}
if($_REQUEST['act']=="editHome" && $_REQUEST['id']!="" ){
	if( $_REQUEST['changeCatHome']=="0" || $_REQUEST['changeCatHome']=="1" ){
	$sql="select inc_id,p_id from zsp_catlog_categories where inc_id=?";
	if ($stmt = $mysqli->prepare($sql)){
		$i='i';
		$stmt->bind_param($i,$_REQUEST['id']);
		$flag=$stmt->execute();
		$stmt->store_result();
		if($stmt->num_rows>0){
			$stmt->bind_result($inc_id, $p_id);
			$stmt->fetch();
			$sql="update zsp_catlog_categories set home=? where inc_id=?";
			if ($stmt1 = $mysqli->prepare($sql)){
				$ii='ii';
				$stmt1->bind_param($ii,$_REQUEST['changeCatHome'],$_REQUEST['id']);
				$flag=$stmt1->execute();
				if($flag){
					$_SESSION['stat']="SE";
					$allClasses->forRedirect ("categories.php?id=".$p_id);
					exit;
				}else{
					$_SESSION['stat']="FE";
					$allClasses->forRedirect ("categories.php?id=".$p_id);
					exit;
				}
			}
		}
	}
	}

}
if($_REQUEST['act']=="editSatus" && $_REQUEST['id']!="" ){
	if( $_REQUEST['changeCatStatus']=="0" || $_REQUEST['changeCatStatus']=="1" ){
	$sql="select inc_id,p_id  from zsp_catlog_categories where inc_id=?";
	if ($stmt = $mysqli->prepare($sql)){
		$i='i';
		$stmt->bind_param($i,$_REQUEST['id']);
		$flag=$stmt->execute();
		$stmt->store_result();
		if($stmt->num_rows>0){
			$stmt->bind_result($inc_id, $p_id);
			$stmt->fetch();
			$sql="update zsp_catlog_categories set status=? where inc_id=?";
			if ($stmt = $mysqli->prepare($sql)){
				$ii='ii';
				$stmt->bind_param($ii,$_REQUEST['changeCatStatus'],$_REQUEST['id']);
				$flag=$stmt->execute();
				if($flag){
					$_SESSION['stat']="SE";
					$allClasses->forRedirect ("categories.php?id=".$p_id);
					exit;
				}else{
					$_SESSION['stat']="FE";
					$allClasses->forRedirect ("categories.php?id=".$p_id);
					exit;
				}
			}
		}
	}
	}
	if( $_REQUEST['changeMenuStatus']=="0" || $_REQUEST['changeMenuStatus']=="1" ){
	$sql="select inc_content_id,page_name  from zsp_menu_items where inc_content_id=?";
	if ($stmt = $mysqli->prepare($sql)){
		$i='i';
		$stmt->bind_param($i,$_REQUEST['id']);
		$flag=$stmt->execute();
		$stmt->store_result();
		if($stmt->num_rows>0){
			$stmt->bind_result($inc_id,$page_name);
			$stmt->fetch();
			$sql="update zsp_menu_items set status=? where inc_content_id=?";
			if ($stmt = $mysqli->prepare($sql)){
				$ii='ii';
				$stmt->bind_param($ii,$_REQUEST['changeMenuStatus'],$_REQUEST['id']);
				$flag=$stmt->execute();
				if($flag){
					$_SESSION['stat']="SE";
					$allClasses->forRedirect ("contentPages.php?pgId=".$page_name);
					exit;
				}else{
					$_SESSION['stat']="FE";
					$allClasses->forRedirect ("contentPages.php?pgId=".$page_name);
					exit;
				}
			}
		}
	}
	}
	if( $_REQUEST['changeRepStatus']=="0" || $_REQUEST['changeRepStatus']=="1" ){
	$sql="select inc_id from zsp_reports where inc_id=?";
	if ($stmt = $mysqli->prepare($sql)){
		$i='i';
		$stmt->bind_param($i,$_REQUEST['id']);
		$flag=$stmt->execute();
		$stmt->store_result();
		if($stmt->num_rows>0){
			$sql="update zsp_reports set status=? where inc_id=?";
			if ($stmt = $mysqli->prepare($sql)){
				$ii='ii';
				$stmt->bind_param($ii,$_REQUEST['changeRepStatus'],$_REQUEST['id']);
				$flag=$stmt->execute();
				if($flag){
					$_SESSION['stat']="SE";
					$allClasses->forRedirect ("reports.php");
					exit;
				}else{
					$_SESSION['stat']="FE";
					$allClasses->forRedirect ("reports.php");
					exit;
				}
			}
		}
	}
	}
	if( $_REQUEST['changeLscStatus']=="0" || $_REQUEST['changeLscStatus']=="1" ){
	$sql="select inc_id from zsp_licences where inc_id=?";
	if ($stmt = $mysqli->prepare($sql)){
		$i='i';
		$stmt->bind_param($i,$_REQUEST['id']);
		$flag=$stmt->execute();
		$stmt->store_result();
		if($stmt->num_rows>0){
			$sql="update zsp_licences set status=? where inc_id=?";
			if ($stmt = $mysqli->prepare($sql)){
				$ii='ii';
				$stmt->bind_param($ii,$_REQUEST['changeLscStatus'],$_REQUEST['id']);
				$flag=$stmt->execute();
				if($flag){
					$_SESSION['stat']="SE";
					$allClasses->forRedirect ("licences.php");
					exit;
				}else{
					$_SESSION['stat']="FE";
					$allClasses->forRedirect ("licences.php");
					exit;
				}
			}
		}
	}
	}
	if( $_REQUEST['changePubStatus']=="0" || $_REQUEST['changePubStatus']=="1" ){
	$sql="select inc_id from zsp_publishers where inc_id=?";
	if ($stmt = $mysqli->prepare($sql)){
		$i='i';
		$stmt->bind_param($i,$_REQUEST['id']);
		$flag=$stmt->execute();
		$stmt->store_result();
		if($stmt->num_rows>0){
			$sql="update zsp_publishers set status=? where inc_id=?";
			if ($stmt = $mysqli->prepare($sql)){
				$ii='ii';
				$stmt->bind_param($ii,$_REQUEST['changePubStatus'],$_REQUEST['id']);
				$flag=$stmt->execute();
				if($flag){
					$_SESSION['stat']="SE";
					$allClasses->forRedirect ("publishers.php");
					exit;
				}else{
					$_SESSION['stat']="FE";
					$allClasses->forRedirect ("publishers.php");
					exit;
				}
			}
		}
	}
	}
	if( $_REQUEST['changeEnqStatus']=="0" || $_REQUEST['changeEnqStatus']=="1" ){
	$sql="select inc_id from zsp_enqs where inc_id=?";
	if ($stmt = $mysqli->prepare($sql)){
		$i='i';
		$stmt->bind_param($i,$_REQUEST['id']);
		$flag=$stmt->execute();
		$stmt->store_result();
		if($stmt->num_rows>0){
			$sql="update zsp_enqs set status=? where inc_id=?";
			if ($stmt = $mysqli->prepare($sql)){
				$ii='ii';
				$stmt->bind_param($ii,$_REQUEST['changeEnqStatus'],$_REQUEST['id']);
				$flag=$stmt->execute();
				if($flag){
					$_SESSION['stat']="SE";
					$allClasses->forRedirect ("enqs.php");
					exit;
				}else{
					$_SESSION['stat']="FE";
					$allClasses->forRedirect ("enqs.php");
					exit;
				}
			}
		}
	}
	}
	if( $_REQUEST['changePostStatus']=="0" || $_REQUEST['changePostStatus']=="1" ){
	$sql="select inc_id,cat,subcat from zsp_posts where inc_id=?";
	if ($stmt = $mysqli->prepare($sql)){
		$i='i';
		$stmt->bind_param($i,$_REQUEST['id']);
		$flag=$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($inc_id,$cat,$subcat);
		$stmt->fetch();
		
		if($stmt->num_rows>0){
			$sql="update zsp_posts set status=? where inc_id=?";
			if ($stmt = $mysqli->prepare($sql)){
				$ii='ii';
				$stmt->bind_param($ii,$_REQUEST['changePostStatus'],$_REQUEST['id']);
				$flag=$stmt->execute();
				if($flag){
					$_SESSION['stat']="SE";
					$allClasses->forRedirect ("posts.php?id=".$cat."@$@".$subcat);
					exit;
				}else{
					$_SESSION['stat']="FE";
					$allClasses->forRedirect ("posts.php?id=".$cat."@$@".$subcat);
					exit;
				}
			}
		}
	}
	}
	if( $_REQUEST['changeUPostStatus']=="0" || $_REQUEST['changeUPostStatus']=="1" ){
	$sql="select inc_id,cat,subcat from zsp_posts where inc_id=?";
	if ($stmt = $mysqli->prepare($sql)){
		$i='i';
		$stmt->bind_param($i,$_REQUEST['id']);
		$flag=$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($inc_id,$cat,$subcat);
		$stmt->fetch();
		
		if($stmt->num_rows>0){
			$sql="update zsp_posts set status=? where inc_id=?";
			if ($stmt = $mysqli->prepare($sql)){
				$ii='ii';
				$stmt->bind_param($ii,$_REQUEST['changeUPostStatus'],$_REQUEST['id']);
				$flag=$stmt->execute();
				if($flag){
					$_SESSION['stat']="SE";
					$allClasses->forRedirect ("uposts.php?pageId=&txtParent=".$cat."&txtParent1=".$subcat."&searchName=&searchSubmit=Search");
					exit;
				}else{
					$_SESSION['stat']="FE";
					$allClasses->forRedirect ("uposts.php?pageId=&txtParent=".$cat."&txtParent1=".$subcat."&searchName=&searchSubmit=Search");
					exit;
				}
			}
		}
	}
	}
	if( $_REQUEST['changeEventStatus']=="0" || $_REQUEST['changeEventStatus']=="1" ){
	$sql="select inc_id,cat,subcat from zsp_events where inc_id=?";
	if ($stmt = $mysqli->prepare($sql)){
		$i='i';
		$stmt->bind_param($i,$_REQUEST['id']);
		$flag=$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($inc_id,$cat,$subcat);
		$stmt->fetch();
		
		if($stmt->num_rows>0){
			$sql="update zsp_events set status=? where inc_id=?";
			if ($stmt = $mysqli->prepare($sql)){
				$ii='ii';
				$stmt->bind_param($ii,$_REQUEST['changeEventStatus'],$_REQUEST['id']);
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
		}
	}
	}
	
	//edited by vishwadeep singh//
	if( $_REQUEST['changeWebinarStatus']=="0" || $_REQUEST['changeWebinarStatus']=="1" ){
	$sql="select inc_id,cat,subcat from zsp_webinars where inc_id=?";
	if ($stmt = $mysqli->prepare($sql)){
		$i='i';
		$stmt->bind_param($i,$_REQUEST['id']);
		$flag=$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($inc_id,$cat,$subcat);
		$stmt->fetch();
		
		if($stmt->num_rows>0){
			$sql="update zsp_webinars set status=? where inc_id=?";
			if ($stmt = $mysqli->prepare($sql)){
				$ii='ii';
				$stmt->bind_param($ii,$_REQUEST['changeWebinarStatus'],$_REQUEST['id']);
				$flag=$stmt->execute();
				if($flag){
					$_SESSION['stat']="SE";
					$allClasses->forRedirect ("webinars.php");
					exit;
				}else{
					$_SESSION['stat']="FE";
					$allClasses->forRedirect ("webinars.php");
					exit;
				}
			}
		}
	}
	}
	//edited by vishwadeep singh//
	
	if( $_REQUEST['changeUserStatus']=="0" || $_REQUEST['changeUserStatus']=="1" ){
	$sql="select inc_id from zsp_users where inc_id=?";
	if ($stmt = $mysqli->prepare($sql)){
		$i='i';
		$stmt->bind_param($i,$_REQUEST['id']);
		$flag=$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($inc_id);
		$stmt->fetch();
		
		if($stmt->num_rows>0){
			$sql="update zsp_users set status=? where inc_id=?";
			if ($stmt = $mysqli->prepare($sql)){
				$ii='ii';
				$stmt->bind_param($ii,$_REQUEST['changeUserStatus'],$_REQUEST['id']);
				$flag=$stmt->execute();
				if($flag){
					$_SESSION['stat']="SE";
					$allClasses->forRedirect ("users.php");
					exit;
				}else{
					$_SESSION['stat']="FE";
					$allClasses->forRedirect ("users.php");
					exit;
				}
			}
		}
	}
	}
	if( $_REQUEST['changeRUserStatus']=="0" || $_REQUEST['changeRUserStatus']=="1" ){
	$sql="select inc_user_id from zsp_user_accounts where inc_user_id=?";
	if ($stmt = $mysqli->prepare($sql)){
		$i='i';
		$stmt->bind_param($i,$_REQUEST['id']);
		$flag=$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($inc_id);
		$stmt->fetch();
		
		if($stmt->num_rows>0){
			$sql="update zsp_user_accounts set status=? where inc_user_id=?";
			if ($stmt = $mysqli->prepare($sql)){
				$ii='ii';
				$stmt->bind_param($ii,$_REQUEST['changeRUserStatus'],$_REQUEST['id']);
				$flag=$stmt->execute();
				if($flag){
					$_SESSION['stat']="SE";
					$allClasses->forRedirect ("registeredUsers.php");
					exit;
				}else{
					$_SESSION['stat']="FE";
					$allClasses->forRedirect ("registeredUsers.php");
					exit;
				}
			}
		}
	}
	}
	if( $_REQUEST['changeLinkStatus']=="0" || $_REQUEST['changeLinkStatus']=="1" ){
	$sql="select inc_id from zsp_videos where inc_id=?";
	if ($stmt = $mysqli->prepare($sql)){
		$i='i';
		$stmt->bind_param($i,$_REQUEST['id']);
		$flag=$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($inc_id);
		$stmt->fetch();
		
		if($stmt->num_rows>0){
			$sql="update zsp_videos set status=? where inc_id=?";
			if ($stmt = $mysqli->prepare($sql)){
				$ii='ii';
				$stmt->bind_param($ii,$_REQUEST['changeLinkStatus'],$_REQUEST['id']);
				$flag=$stmt->execute();
				if($flag){
					$_SESSION['stat']="SE";
					$allClasses->forRedirect ("recipes.php");
					exit;
				}else{
					$_SESSION['stat']="FE";
					$allClasses->forRedirect ("recipes.php");
					exit;
				}
			}
		}
	}
	}
	if( $_REQUEST['changeBlogStatus']=="0" || $_REQUEST['changeBlogStatus']=="1" ){
	$sql="select inc_id from zsp_blogs where inc_id=?";
	if ($stmt = $mysqli->prepare($sql)){
		$i='i';
		$stmt->bind_param($i,$_REQUEST['id']);
		$flag=$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($inc_id);
		$stmt->fetch();
		
		if($stmt->num_rows>0){
			$sql="update zsp_blogs set status=? where inc_id=?";
			if ($stmt = $mysqli->prepare($sql)){
				$ii='ii';
				$stmt->bind_param($ii,$_REQUEST['changeBlogStatus'],$_REQUEST['id']);
				$flag=$stmt->execute();
				if($flag){
					$_SESSION['stat']="SE";
					$allClasses->forRedirect ("blogs.php");
					exit;
				}else{
					$_SESSION['stat']="FE";
					$allClasses->forRedirect ("blogs.php");
					exit;
				}
			}
		}
	}
	}
	if( $_REQUEST['changeRSSStatus']=="0" || $_REQUEST['changeRSSStatus']=="1" ){
	$sql="select inc_id,cat from zsp_rss where inc_id=?";
	if ($stmt = $mysqli->prepare($sql)){
		$i='i';
		$stmt->bind_param($i,$_REQUEST['id']);
		$flag=$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($inc_id,$cat);
		$stmt->fetch();		
		if($stmt->num_rows>0){

			$sql="update zsp_rss set status=? where inc_id=?";
			if ($stmt = $mysqli->prepare($sql)){
				$ii='ii';
				$stmt->bind_param($ii,$_REQUEST['changeRSSStatus'],$_REQUEST['id']);
				$flag=$stmt->execute();
				if($flag){
					$_SESSION['stat']="SE";
					$allClasses->forRedirect ("rsscats.php");
					exit;
				}else{
					$_SESSION['stat']="FE";
					$allClasses->forRedirect ("rsscats.php");
					exit;
				}
			}
		}
	}
	}
	if( $_REQUEST['changeProdStatus']=="0" || $_REQUEST['changeProdStatus']=="1" ){
	$sql="select prod_id from zsp_news where prod_id=?";
	if ($stmt = $mysqli->prepare($sql)){
		$i='i';
		$stmt->bind_param($i,$_REQUEST['id']);
		$flag=$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($inc_id);
		$stmt->fetch();
		
		if($stmt->num_rows>0){
			$sql="update zsp_news set status=? where prod_id=?";
			if ($stmt = $mysqli->prepare($sql)){
				$ii='ii';
				$stmt->bind_param($ii,$_REQUEST['changeProdStatus'],$_REQUEST['id']);
				$flag=$stmt->execute();
				if($flag){
					$_SESSION['stat']="SE";
					$allClasses->forRedirect ("products.php");
					exit;
				}else{
					$_SESSION['stat']="FE";
					$allClasses->forRedirect ("products.php");
					exit;
				}
			}
		}
	}
	}
	if( $_REQUEST['changeWPStatus']=="0" || $_REQUEST['changeWPStatus']=="1" ){
	$sql="select prod_id from zsp_whitepapers where prod_id=?";
	if ($stmt = $mysqli->prepare($sql)){
		$i='i';
		$stmt->bind_param($i,$_REQUEST['id']);
		$flag=$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($inc_id);
		$stmt->fetch();
		
		if($stmt->num_rows>0){
			$sql="update zsp_whitepapers set status=? where prod_id=?";
			if ($stmt = $mysqli->prepare($sql)){
				$ii='ii';
				$stmt->bind_param($ii,$_REQUEST['changeWPStatus'],$_REQUEST['id']);
				$flag=$stmt->execute();
				if($flag){
					$_SESSION['stat']="SE";
					$allClasses->forRedirect ("whitepapers.php");
					exit;
				}else{
					$_SESSION['stat']="FE";
					$allClasses->forRedirect ("whitepapers.php");
					exit;
				}
			}
		}
	}
	}
	if( $_REQUEST['changePRStatus']=="0" || $_REQUEST['changePRStatus']=="1" ){
	$sql="select prod_id from zsp_prs where prod_id=?";
	if ($stmt = $mysqli->prepare($sql)){
		$i='i';
		$stmt->bind_param($i,$_REQUEST['id']);
		$flag=$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($inc_id);
		$stmt->fetch();
		
		if($stmt->num_rows>0){
			$sql="update zsp_prs set status=? where prod_id=?";
			if ($stmt = $mysqli->prepare($sql)){
				$ii='ii';
				$stmt->bind_param($ii,$_REQUEST['changePRStatus'],$_REQUEST['id']);
				$flag=$stmt->execute();
				if($flag){
					$_SESSION['stat']="SE";
					$allClasses->forRedirect ("prs.php");
					exit;
				}else{
					$_SESSION['stat']="FE";
					$allClasses->forRedirect ("prs.php");
					exit;
				}
			}
		}
	}
	}
	if( $_REQUEST['changeProdStatus']=="0" || $_REQUEST['changeProdStatus']=="1" ){
	$sql="select prod_id from zsp_news where prod_id=?";
	if ($stmt = $mysqli->prepare($sql)){
		$i='i';
		$stmt->bind_param($i,$_REQUEST['id']);
		$flag=$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($inc_id);
		$stmt->fetch();
		
		if($stmt->num_rows>0){
			$sql="update zsp_news set status=? where prod_id=?";
			if ($stmt = $mysqli->prepare($sql)){
				$ii='ii';
				$stmt->bind_param($ii,$_REQUEST['changeProdStatus'],$_REQUEST['id']);
				$flag=$stmt->execute();
				if($flag){
					$_SESSION['stat']="SE";
					$allClasses->forRedirect ("products.php");
					exit;
				}else{
					$_SESSION['stat']="FE";
					$allClasses->forRedirect ("products.php");
					exit;
				}
			}
		}
	}
	}
	if( $_REQUEST['changeFeedStatus']=="0" || $_REQUEST['changeFeedStatus']=="1" ){
	$sql="select inc_id,feed_source_id from zsp_rss_feed_items where inc_id=?";
	if ($stmt = $mysqli->prepare($sql)){
		$i='i';
		$stmt->bind_param($i,$_REQUEST['id']);
		$flag=$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($inc_id,$cat);
		$stmt->fetch();
		
		if($stmt->num_rows>0){
			$sql="update zsp_rss_feed_items set status=? where inc_id=?";
			if ($stmt = $mysqli->prepare($sql)){
				$ii='ii';
				$stmt->bind_param($ii,$_REQUEST['changeFeedStatus'],$_REQUEST['id']);
				$flag=$stmt->execute();
				if($flag){
					$_SESSION['stat']="SE";
					$allClasses->forRedirect ("feeds.php?id=".$cat);
					exit;
				}else{
					$_SESSION['stat']="FE";
					$allClasses->forRedirect ("feeds.php=".$cat);
					exit;
				}
			}
		}
	}
	}
}

if(isset($_POST["addVideo"]) && $_POST["addVideo"]=="Save Short Link"){
	
	$cat=$_POST['txtParent'];
	$title=$_POST['txtTitle'];
	$image=$_POST['txtImage'];
	$products=$_POST['txtProducts'];
	$instructions=base64_encode($_POST['txtInstructions']);
	$descr=base64_encode($_POST['txtDescr']);
	$status=1;
	$mtitle=$_POST['txtMetaTitle'];
	$mkeywords=base64_encode($_POST['txtMetaTitle']);
	$mdesc=base64_encode($_POST['txtMetaDesc']);
	$seokey=$_POST['txtSEOKeyword'];
	
	if($_POST['hid_action']=="editvideo" && $_POST['hid_recipe_code']!=""){
	
		$sql="update zsp_videos set title=?,image=?,products=?,instructions=?,descr=?,meta_title=?,meta_keywords=?,meta_descr=?,seo_keyword=?,status=?,dt_created=now(),cat=? where inc_id=?";
		if ($stmt = $mysqli->prepare($sql)){
	
			$sssssssssiis='sssssssssiis';
			$stmt->bind_param($sssssssssiis, $title,$image,$products,$instructions,$descr,$mtitle,$mkeywords,$mdesc,$seokey,$status,$cat,$_POST['hid_recipe_code']);
			$flag=$stmt->execute();
			if($flag){
				$_SESSION['stat']="SE";
				$allClasses->forRedirect ("recipes.php");
				exit;
			}else{
				$_SESSION['stat']="FE";
				$allClasses->forRedirect ("recipes.php");
				exit;
			}
		}
	}else{
		$sql="insert into zsp_videos(title,image,products,instructions,descr,meta_title,meta_keywords,meta_descr,seo_keyword,status,dt_created,cat)values(?,?,?,?,?,?,?,?,?,?,now(),?)";
		if ($stmt = $mysqli->prepare($sql)){
			$sssssssssis='sssssssssis';
			$stmt->bind_param($sssssssssis,$title,$image,$products,$instructions,$descr,$mtitle,$mkeywords,$mdesc,$seokey,$status,$cat);
			$flag=$stmt->execute();
			//echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
			if($flag){
				$_SESSION['stat']="SA";
				$allClasses->forRedirect ("recipes.php");
				exit;
			}else{
				$_SESSION['stat']="FA";
				$allClasses->forRedirect ("recipes.php");
				exit;
			}
		}
		
	}
}

if(isset($_POST["addrss"]) && $_POST["addrss"]=="Save RSS"){
	
	$cat=$_POST['txtParent'];
	
	$title=$_POST['txtTitle'];
	//$image=$_POST['txtImage'];
	$image=SITE_PATH.'s.xml';
	$products=$_POST['txtProducts'];
	$instructions=base64_encode($_POST['txtInstructions']);
	$descr=base64_encode($_POST['txtDescr']);
	$status=$_POST['txtActive'];
	$mtitle=$_POST['txtMetaTitle'];
	$mkeywords=base64_encode($_POST['txtMetaTitle']);
	$mdesc=base64_encode($_POST['txtMetaDesc']);
	$seokey=$_POST['txtSEOKeyword'];
	
	if($_POST['hid_action']=="editrss" && $_POST['hid_rss_code']!=""){
	
		$sql="update zsp_rss set title=?,image=?,products=?,instructions=?,descr=?,meta_title=?,meta_keywords=?,meta_descr=?,seo_keyword=?,status=?,dt_created=now(),cat=? where inc_id=?";
		if ($stmt = $mysqli->prepare($sql)){
	
			$ssssssssssss='ssssssssssss';
			$stmt->bind_param($ssssssssssss, $title,$image,$products,$instructions,$descr,$mtitle,$mkeywords,$mdesc,$seokey,$status,$cat,$_POST['hid_rss_code']);
			$flag=$stmt->execute();
			//echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
			if($flag){
				$_SESSION['stat']="SE";
				$allClasses->forRedirect ("rsscats.php");
				exit;
			}else{
				$_SESSION['stat']="FE";
				$allClasses->forRedirect ("rsscats.php");
				exit;
			}
		}
	}else{
		$sql="insert into zsp_rss(title,image,products,instructions,descr,meta_title,meta_keywords,meta_descr,seo_keyword,status,dt_created,cat)values(?,?,?,?,?,?,?,?,?,?,now(),?)";
		if ($stmt = $mysqli->prepare($sql)){
			$sssssssssis='sssssssssis';
			$stmt->bind_param($sssssssssis,$title,$image,$products,$instructions,$descr,$mtitle,$mkeywords,$mdesc,$seokey,$status,$cat);
			$flag=$stmt->execute();
			//echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
			if($flag){
				$_SESSION['stat']="SA";
				$allClasses->forRedirect ("rsscats.php");
				exit;
			}else{
				$_SESSION['stat']="FA";
				$allClasses->forRedirect ("rsscats.php");
				exit;
			}
		}
		
	}
}

if(isset($_POST["addReports"]) && $_POST["addReports"]=="Save Reports"){
	$cats=$_POST['txtCurecases'];
	$sql="insert into zsp_reports(name,code,dt_created)values(?,?,now())";
	$stmt = $mysqli->prepare($sql);
	if ($stmt && $cats>0){
		for($i=1;$i<=$cats;$i++){
			$name=$_POST['txtName'.$i];
			$code=$_POST['txtCode'.$i];
			$ss='ss';
			$stmt->bind_param($ss, $name,$code);
			//echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
			$flag=$stmt->execute();
		}
		if($flag){
			$_SESSION['stat']="SA";
			$allClasses->forRedirect ("reports.php");
			exit;
		}else{
			$_SESSION['stat']="FA";
			$allClasses->forRedirect ("reports.php");
			exit;
		}
	}
}
if(isset($_POST["editReport"]) && $_POST["editReport"]=="Save Report"){
	$name=$_POST['txtName'];
	$code=$_POST['txtCode'];
	$status=$_POST['txtActive'];
	
	if($_POST['hid_action']=="editreport" && $_POST['hid_report_id']!=""){
		$sql="update zsp_reports set  name=?,code=?,status=?,dt_created=now() where inc_id=?";
		
		if ($stmt = $mysqli->prepare($sql)){
			$ssii='ssii';
			$stmt->bind_param($ssii, $name,$code,$status,$_POST['hid_report_id']);
			//echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
			$flag=$stmt->execute();
			if($flag){
				$_SESSION['stat']="SE";
				$allClasses->forRedirect ("reports.php");
				exit;
			}else{
				$_SESSION['stat']="FE";
				$allClasses->forRedirect ("reports.php");
				exit;
			}
			
		}
	}
	
}
if(isset($_POST["addLicences"]) && $_POST["addLicences"]=="Save Licences"){
	$cats=$_POST['txtCurecases'];
	$sql="insert into zsp_licences(name,code,dt_created)values(?,?,now())";
	$stmt = $mysqli->prepare($sql);
	if ($stmt && $cats>0){
		for($i=1;$i<=$cats;$i++){
			$name=$_POST['txtName'.$i];
			$code=$_POST['txtCode'.$i];
			$ss='ss';
			$stmt->bind_param($ss, $name,$code);
			//echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
			$flag=$stmt->execute();
		}
		if($flag){
			$_SESSION['stat']="SA";
			$allClasses->forRedirect ("licences.php");
			exit;
		}else{
			$_SESSION['stat']="FA";
			$allClasses->forRedirect ("licences.php");
			exit;
		}
	}
}
if(isset($_POST["editLicence"]) && $_POST["editLicence"]=="Save Licence"){
	$name=$_POST['txtName'];
	$code=$_POST['txtCode'];
	$status=$_POST['txtActive'];
		if($_POST['hid_action']=="editlicence" && $_POST['hid_licence_id']!=""){
		$sql="update zsp_licences set  name=?,code=?,status=?,dt_created=now() where inc_id=?";
		
		if ($stmt = $mysqli->prepare($sql)){
			$ssii='ssii';
			$stmt->bind_param($ssii, $name,$code,$status,$_POST['hid_licence_id']);
			//echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
			$flag=$stmt->execute();
			if($flag){
				$_SESSION['stat']="SE";
				$allClasses->forRedirect ("licences.php");
				exit;
			}else{
				$_SESSION['stat']="FE";
				$allClasses->forRedirect ("licences.php");
				exit;
			}
			
		}
	}
	
}
if(isset($_POST["addPublishers"]) && $_POST["addPublishers"]=="Save Publishers"){
	$cats=$_POST['txtCurecases'];
	$sql="insert into zsp_publishers(name,code,descr,dt_created)values(?,?,?,now())";
	$stmt = $mysqli->prepare($sql);
	if ($stmt && $cats>0){
		for($i=1;$i<=$cats;$i++){
			$name=$_POST['txtName'.$i];
			$code=$_POST['txtCode'.$i];
			$descr=base64_encode($_POST['txtDescr'.$i]);
			$sss='sss';
			$stmt->bind_param($sss, $name,$code,$descr);
			//echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
			$flag=$stmt->execute();
		}
		if($flag){
			$_SESSION['stat']="SA";
			$allClasses->forRedirect ("publishers.php");
			exit;
		}else{
			$_SESSION['stat']="FA";
			$allClasses->forRedirect ("publishers.php");
			exit;
		}
	}
}
if(isset($_POST["editPublisher"]) && $_POST["editPublisher"]=="Save Publisher"){
	$name=$_POST['txtName'];
	$code=$_POST['txtCode'];
	$descr=base64_encode($_POST['txtDescr']);
	$status=$_POST['txtActive'];
		if($_POST['hid_action']=="editpublisher" && $_POST['hid_pub_id']!=""){
		$sql="update zsp_publishers set  name=?,code=?,descr=?,status=?,dt_created=now() where inc_id=?";
		
		if ($stmt = $mysqli->prepare($sql)){
			$sssii='sssii';
			$stmt->bind_param($sssii, $name,$code,$descr,$status,$_POST['hid_pub_id']);
			//echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
			$flag=$stmt->execute();
			if($flag){
				$_SESSION['stat']="SE";
				$allClasses->forRedirect ("publishers.php");
				exit;
			}else{
				$_SESSION['stat']="FE";
				$allClasses->forRedirect ("publishers.php");
				exit;
			}
			
		}
	}
	
}
if(isset($_POST["addEnqs"]) && $_POST["addEnqs"]=="Save Enquiries"){
	$cats=$_POST['txtCurecases'];
	$sql="insert into zsp_enqs(name,code,dt_created)values(?,?,now())";
	$stmt = $mysqli->prepare($sql);
	if ($stmt && $cats>0){
		for($i=1;$i<=$cats;$i++){
			$name=$_POST['txtName'.$i];
			$code=$_POST['txtCode'.$i];
			$ss='ss';
			$stmt->bind_param($ss, $name,$code);
			//echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
			$flag=$stmt->execute();
		}
		if($flag){
			$_SESSION['stat']="SA";
			$allClasses->forRedirect ("enqs.php");
			exit;
		}else{
			$_SESSION['stat']="FA";
			$allClasses->forRedirect ("enqs.php");
			exit;
		}
	}
}
if(isset($_POST["editEnq"]) && $_POST["editEnq"]=="Save Enquiry"){
	$name=$_POST['txtName'];
	$code=$_POST['txtCode'];
	$status=$_POST['txtActive'];
	
	if($_POST['hid_action']=="editenq" && $_POST['hid_enq_id']!=""){
		$sql="update zsp_enqs set  name=?,code=?,status=?,dt_created=now() where inc_id=?";
		
		if ($stmt = $mysqli->prepare($sql)){
			$ssii='ssii';
			$stmt->bind_param($ssii, $name,$code,$status,$_POST['hid_enq_id']);
			//echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
			$flag=$stmt->execute();
			if($flag){
				$_SESSION['stat']="SE";
				$allClasses->forRedirect ("enqs.php");
				exit;
			}else{
				$_SESSION['stat']="FE";
				$allClasses->forRedirect ("enqs.php");
				exit;
			}
			
		}
	}
	
}
if(isset($_POST["addStory"]) && $_POST["addStory"]=="Save Banner Story"){
	
	$title=$_POST['txtTitle'];
	$image=$_POST['txtImage'];
	$date=$_POST['txtDate'];
	$descr=base64_encode($_POST['txtDescr']);
	$status=1;
	
	if($_FILES['txtImage']['name'] != ""){
			$result = $allClasses->forFileUpload_ren(ROOT_ART_PATH, 'txtImage');
			if($result){
				$image = $result;
				$result = $allClasses->resizeImage2(ROOT_ART_PATH.$image, ROOT_ART_PATH."thumbs/".$image, 185,'');
				if($_POST['hidImage']!= ""){
					unlink(ROOT_ART_PATH.$_POST['hidImage']);
					unlink(ROOT_ART_PATH."thumbs/".$_POST['hidImage']);
				}

			}
		}else{
			$image = $_POST['hidImage'];
		}
	
	if($_POST['hid_action']=="editstory" && $_POST['hid_blog_code']!=""){
	
		$sql="update zsp_blogs set title=?,image=?,descr=?,posted_date=?,status=?,dt_created=now() where inc_id=?";
		if ($stmt = $mysqli->prepare($sql)){
		
			$ssssii='ssssii';
			$stmt->bind_param($ssssii, $title,$image,$descr,$date,$status,$_POST['hid_blog_code']);
			$flag=$stmt->execute();
			
			if($flag){
				$_SESSION['stat']="SE";
				$allClasses->forRedirect ("blogs.php");
				exit;
			}else{
				$_SESSION['stat']="FE";
				$allClasses->forRedirect ("blogs.php");
				exit;
			}
		}
	}else{
		$sql="insert into zsp_blogs(title,image,descr,posted_date,status,dt_created)values(?,?,?,?,?,now())";
		if ($stmt = $mysqli->prepare($sql)){
			$ssssi='ssssi';
			$stmt->bind_param($ssssi,$title,$image,$descr,$date,$status);
			$flag=$stmt->execute();
			if($flag){
				$_SESSION['stat']="SA";
				$allClasses->forRedirect ("blogs.php");
				exit;
			}else{
				$_SESSION['stat']="FA";
				$allClasses->forRedirect ("blogs.php");
				exit;
			}
		}
		echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}
}
if(isset($_POST["addRLink"]) && $_POST["addRLink"]=="Save Link"){
	
	$title=$_POST['txtTitle'];
	$image=$_POST['txtImage'];
	$date=$_POST['txtDate'];
	$descr=base64_encode($_POST['txtDescr']);
	$status=$_POST['txtActive'];
	
	if($_FILES['txtImage']['name'] != ""){
			$result = $allClasses->forFileUpload_ren(ROOT_ART_PATH, 'txtImage');
			if($result){
				$image = $result;
				$result = $allClasses->resizeImage2(ROOT_ART_PATH.$image, ROOT_ART_PATH."thumbs/".$image, 185,'');
				if($_POST['hidImage']!= ""){
					unlink(ROOT_ART_PATH.$_POST['hidImage']);
					unlink(ROOT_ART_PATH."thumbs/".$_POST['hidImage']);
				}

			}
		}else{
			$image = $_POST['hidImage'];
		}
	
	if($_POST['hid_action']=="editlink" && $_POST['hid_blog_code']!=""){
	
		$sql="update zsp_reviews set title=?,image=?,descr=?,posted_date=?,status=?,dt_created=now() where inc_id=?";
		if ($stmt = $mysqli->prepare($sql)){
		
			$ssssii='ssssii';
			$stmt->bind_param($ssssii, $title,$image,$descr,$date,$status,$_POST['hid_blog_code']);
			$flag=$stmt->execute();
			
			if($flag){
				$_SESSION['stat']="SE";
				$allClasses->forRedirect ("reviews.php");
				exit;
			}else{
				$_SESSION['stat']="FE";
				$allClasses->forRedirect ("reviews.php");
				exit;
			}
		}
	}else{
		$sql="insert into zsp_reviews(title,image,descr,posted_date,status,dt_created)values(?,?,?,?,?,now())";
		if ($stmt = $mysqli->prepare($sql)){
			$ssssi='ssssi';
			$stmt->bind_param($ssssi,$title,$image,$descr,$date,$status);
			$flag=$stmt->execute();
			if($flag){
				$_SESSION['stat']="SA";
				$allClasses->forRedirect ("reviews.php");
				exit;
			}else{
				$_SESSION['stat']="FA";
				$allClasses->forRedirect ("reviews.php");
				exit;
			}
		}
		echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}
}

if(isset($_POST["addArticle"]) && $_POST["addArticle"]=="Save Article"){

	$pname=$_POST['txtName'];	
	$parent[0]=$_POST['txtParent'];
	$parent[1]=$_POST['txtParent1'];
	$sort=$_POST['txtSortOrder'];
	$pplr=$_POST['txtPPLR'];
	$status=$_POST['txtActive'];
	$descr=base64_encode($_POST['txtDescr']);
	$short_descr=mysqli_real_escape_string($mysqli,trim($_POST['txtShortDescr']));
	$short_descr=base64_encode($short_descr);
	/*$image=$_POST['txtImage'];*/
	$mnfctr=$_POST['txtMnfctr'];
	
	$mtitle=$_POST['txtMetaTitle'];
	$mkeywords=base64_encode($_POST['txtMetaKeywords']);
	$mdesc=base64_encode($_POST['txtMetaDesc']);
	$seokey=$_POST['txtSEOKeyword'];
	$txtCustId=$_POST['txtCustId'];
	
	if($_FILES['txtImage']['name'] != ""){
			$result = $allClasses->forFileUpload_ren(ROOT_ART_PATH, 'txtImage');
			if($result){
				$image = $result;
				$result = $allClasses->resizeImage2(ROOT_ART_PATH.$image, ROOT_ART_PATH."thumbs/".$image, 115,'');
			}
	}
	
	$sql="insert into zsp_news(title,type,cat,mnfctr,image,descr,pplr,sort_order,meta_title,meta_keywords,meta_descr,seo_keyword,status,short_descr,custid,dt_created)values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,now())";
	if ($stmt = $mysqli->prepare($sql)){
		$ssssssiissssi='ssssssiissssisi';
		$stmt->bind_param($ssssssiissssi,$pname,$parent[0],$parent[1],$mnfctr,$image,$descr,$pplr,$sort,$mtitle,$mkeywords,$mdesc,$seokey,$status,$short_descr,$txtCustId);
		$flag=$stmt->execute();
	}
	if($flag){
		$_SESSION['stat']="SA";
		$allClasses->forRedirect ("products.php");
		exit;
	}else{
		$_SESSION['stat']="FA";
		$allClasses->forRedirect ("products.php");
		exit;
	}
}
if(isset($_POST["eidtArticle"]) && $_POST["eidtArticle"]=="Save Article" && $_POST['hid_article_id']!=""){
	
	/*$descr=base64_encode($_POST['txtDescr']);
	echo strlen($_POST['txtDescr']);
	exit;*/

	$pcode=$_POST['hid_article_id'];
	//echo $pcode;
	$pname=$_POST['txtName'];
	$parent[0]=$_POST['txtParent'];
	$parent[1]=$_POST['txtParent1'];
	$sort=$_POST['txtSortOrder'];
	$pplr=$_POST['txtPPLR'];
	$status=$_POST['txtActive'];
	$descr=base64_encode($_POST['txtDescr']);
	$short_descr=mysqli_real_escape_string($mysqli,trim($_POST['txtShortDescr']));
	$short_descr=base64_encode($short_descr);
	$image=$_POST['txtImage'];
	$mnfctr=$_POST['txtMnfctr'];
	
	$mtitle=$_POST['txtMetaTitle'];
	$mkeywords=base64_encode($_POST['txtMetaKeywords']);
	$mdesc=base64_encode($_POST['txtMetaDesc']);
	$seokey=$_POST['txtSEOKeyword'];
	$txtCustId=$_POST['txtCustId'];
	
	if($_FILES['txtImage']['name'] != ""){
			$result = $allClasses->forFileUpload_ren(ROOT_ART_PATH, 'txtImage');
			if($result){
				$image = $result;
				$result = $allClasses->resizeImage2(ROOT_ART_PATH.$image, ROOT_ART_PATH."thumbs/".$image, 115,'');
				if($_POST['hidImage']!= ""){
					unlink(ROOT_ART_PATH.$_POST['hidImage']);
					unlink(ROOT_ART_PATH."thumbs/".$_POST['hidImage']);
				}

			}
		}else{
			$image = $_POST['hidImage'];
		}
	
	$sql="update zsp_news set title=?,type=?,cat=?,mnfctr=?,image=?,descr=?,pplr=?,sort_order=?,meta_title=?,meta_keywords=?,meta_descr=?,seo_keyword=?,status=?,short_descr=?,custid=?,dt_created=now() where prod_id=?";
		if ($stmt = $mysqli->prepare($sql)){
			$ssssssiissssii='ssssssiissssisii';
					$stmt->bind_param($ssssssiissssii,$pname,$parent[0],$parent[1],$mnfctr,$image,$descr,$pplr,$sort,$mtitle,$mkeywords,$mdesc,$seokey,$status,$short_descr,$txtCustId,$pcode);
					$flag=$stmt->execute();
		}
		if($flag){
		$_SESSION['stat']="SE";
		$allClasses->forRedirect ("products.php");
		exit;
	}else{
		$_SESSION['stat']="FE";
		$allClasses->forRedirect ("products.php");
		exit;
	}
}
if(isset($_POST["addwhitepapers"]) && $_POST["addwhitepapers"]=="Save Whitepaper"){

	$pname=$_POST['txtName'];
	$parent[0]=$_POST['txtParent'];
	$parent[1]=$_POST['txtParent1'];
	$sort=$_POST['txtSortOrder'];
	$pplr=$_POST['txtPPLR'];
	$status=$_POST['txtActive'];
	$descr=base64_encode($_POST['txtDescr']);
	$short_descr=mysqli_real_escape_string($mysqli,trim($_POST['txtShortDescr']));
	$short_descr=base64_encode($short_descr);
	/*$image=$_POST['txtImage'];*/
	$mnfctr=$_POST['txtMnfctr'];
	
	$mtitle=$_POST['txtMetaTitle'];
	$mkeywords=base64_encode($_POST['txtMetaKeywords']);
	$mdesc=base64_encode($_POST['txtMetaDesc']);
	$seokey=$_POST['txtSEOKeyword'];
	
	if($_FILES['txtImage']['name'] != ""){
			$result = $allClasses->forFileUpload_ren(ROOT_ART_PATH, 'txtImage');
			if($result){
				$image = $result;
				$result = $allClasses->resizeImage2(ROOT_ART_PATH.$image, ROOT_ART_PATH."thumbs/".$image, 115,'');
			}
	}
	
	$sql="insert into zsp_whitepapers(title,type,cat,mnfctr,image,descr,pplr,sort_order,meta_title,meta_keywords,meta_descr,seo_keyword,status,short_descr,dt_created)values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,now())";
	if ($stmt = $mysqli->prepare($sql)){
		$ssssssiissssi='ssssssiissssis';
		$stmt->bind_param($ssssssiissssi,$pname,$parent[0],$parent[1],$mnfctr,$image,$descr,$pplr,$sort,$mtitle,$mkeywords,$mdesc,$seokey,$status,$short_descr);
		$flag=$stmt->execute();
	}
	if($flag){
		$_SESSION['stat']="SA";
		$allClasses->forRedirect ("whitepapers.php");
		exit;
	}else{
		$_SESSION['stat']="FA";
		$allClasses->forRedirect ("whitepapers.php");
		exit;
	}
}
if(isset($_POST["eidtwhitepapers"]) && $_POST["eidtwhitepapers"]=="Save Whitepaper" && $_POST['hid_article_id']!=""){
	
	$pcode=$_POST['hid_article_id'];
	//echo $pcode;
	$pname=$_POST['txtName'];
	$parent[0]=$_POST['txtParent'];
	$parent[1]=$_POST['txtParent1'];
	$sort=$_POST['txtSortOrder'];
	$pplr=$_POST['txtPPLR'];
	$status=$_POST['txtActive'];
	$descr=base64_encode($_POST['txtDescr']);
	$short_descr=mysqli_real_escape_string($mysqli,trim($_POST['txtShortDescr']));
	$short_descr=base64_encode($short_descr);
	$image=$_POST['txtImage'];
	$mnfctr=$_POST['txtMnfctr'];
	
	$mtitle=$_POST['txtMetaTitle'];
	$mkeywords=base64_encode($_POST['txtMetaKeywords']);
	$mdesc=base64_encode($_POST['txtMetaDesc']);
	$seokey=$_POST['txtSEOKeyword'];
	
	if($_FILES['txtImage']['name'] != ""){
			$result = $allClasses->forFileUpload_ren(ROOT_ART_PATH, 'txtImage');
			if($result){
				$image = $result;
				$result = $allClasses->resizeImage2(ROOT_ART_PATH.$image, ROOT_ART_PATH."thumbs/".$image, 115,'');
				if($_POST['hidImage']!= ""){
					unlink(ROOT_ART_PATH.$_POST['hidImage']);
					unlink(ROOT_ART_PATH."thumbs/".$_POST['hidImage']);
				}

			}
		}else{
			$image = $_POST['hidImage'];
		}
	
	$sql="update zsp_whitepapers set title=?,type=?,cat=?,mnfctr=?,image=?,descr=?,pplr=?,sort_order=?,meta_title=?,meta_keywords=?,meta_descr=?,seo_keyword=?,status=?,short_descr=?,dt_created=now() where prod_id=?";
		if ($stmt = $mysqli->prepare($sql)){
			$ssssssiissssii='ssssssiissssisi';
					$stmt->bind_param($ssssssiissssii,$pname,$parent[0],$parent[1],$mnfctr,$image,$descr,$pplr,$sort,$mtitle,$mkeywords,$mdesc,$seokey,$status,$short_descr,$pcode);
					$flag=$stmt->execute();
		}
		if($flag){
		$_SESSION['stat']="SE";
		$allClasses->forRedirect ("whitepapers.php");
		exit;
	}else{
		$_SESSION['stat']="FE";
		$allClasses->forRedirect ("whitepapers.php");
		exit;
	}
}
if(isset($_POST["addpressrelease"]) && $_POST["addpressrelease"]=="Save Pressrelease"){

	$pname=$_POST['txtName'];
	$parent[0]=$_POST['txtParent'];
	$parent[1]=$_POST['txtParent1'];
	$sort=$_POST['txtSortOrder'];
	$pplr=$_POST['txtPPLR'];
	$status=$_POST['txtActive'];
	$descr=base64_encode($_POST['txtDescr']);
	$short_descr=mysqli_real_escape_string($mysqli,trim($_POST['txtShortDescr']));
	$short_descr=base64_encode($short_descr);
	/*$image=$_POST['txtImage'];*/
	$mnfctr=$_POST['txtMnfctr'];
	$txtRelatedUrl=$_POST['txtRelatedUrl'];
	$txtReportCode=$_POST['txtReportCode'];
	
	$mtitle=$_POST['txtMetaTitle'];
	$mkeywords=base64_encode($_POST['txtMetaKeywords']);
	$mdesc=base64_encode($_POST['txtMetaDesc']);
	$seokey=$_POST['txtSEOKeyword'];
	
	if($_FILES['txtImage']['name'] != ""){
			$result = $allClasses->forFileUpload_ren(ROOT_ART_PATH, 'txtImage');
			if($result){
				$image = $result;
				$result = $allClasses->resizeImage2(ROOT_ART_PATH.$image, ROOT_ART_PATH."thumbs/".$image, 115,'');
			}
	}
	
	$sql="insert into zsp_prs(title,type,cat,mnfctr,image,descr,pplr,sort_order,meta_title,meta_keywords,meta_descr,seo_keyword,status,short_descr,related_report,report_code,dt_created)values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,now())";
	if ($stmt = $mysqli->prepare($sql)){
		$ssssssiissssi='ssssssiissssisss';
		$stmt->bind_param($ssssssiissssi,$pname,$parent[0],$parent[1],$mnfctr,$image,$descr,$pplr,$sort,$mtitle,$mkeywords,$mdesc,$seokey,$status,$short_descr,$txtRelatedUrl,$txtReportCode);
		$flag=$stmt->execute();
	}
	if($flag){
		$_SESSION['stat']="SA";
		$allClasses->forRedirect ("prs.php");
		exit;
	}else{
		$_SESSION['stat']="FA";
		$allClasses->forRedirect ("prs.php");
		exit;
	}
}
if(isset($_POST["eidtpressrelease"]) && $_POST["eidtpressrelease"]=="Save Pressrelease" && $_POST['hid_article_id']!=""){
	
	$pcode=$_POST['hid_article_id'];
	//echo $pcode;
	$pname=$_POST['txtName'];
	$parent[0]=$_POST['txtParent'];
	$parent[1]=$_POST['txtParent1'];
	$sort=$_POST['txtSortOrder'];
	$pplr=$_POST['txtPPLR'];
	$status=$_POST['txtActive'];
	$descr=base64_encode($_POST['txtDescr']);
	$short_descr=mysqli_real_escape_string($mysqli,trim($_POST['txtShortDescr']));
	$short_descr=base64_encode($short_descr);
	
	$image=$_POST['txtImage'];
	$mnfctr=$_POST['txtMnfctr'];
	$txtRelatedUrl=$_POST['txtRelatedUrl'];
	$txtReportCode=$_POST['txtReportCode'];
	
	$mtitle=$_POST['txtMetaTitle'];
	$mkeywords=base64_encode($_POST['txtMetaKeywords']);
	$mdesc=base64_encode($_POST['txtMetaDesc']);
	$seokey=$_POST['txtSEOKeyword'];
	
	if($_FILES['txtImage']['name'] != ""){
			$result = $allClasses->forFileUpload_ren(ROOT_ART_PATH, 'txtImage');
			if($result){
				$image = $result;
				$result = $allClasses->resizeImage2(ROOT_ART_PATH.$image, ROOT_ART_PATH."thumbs/".$image, 115,'');
				if($_POST['hidImage']!= ""){
					unlink(ROOT_ART_PATH.$_POST['hidImage']);
					unlink(ROOT_ART_PATH."thumbs/".$_POST['hidImage']);
				}

			}
		}else{
			$image = $_POST['hidImage'];
		}
	
	$sql="update zsp_prs set title=?,type=?,cat=?,mnfctr=?,image=?,descr=?,pplr=?,sort_order=?,meta_title=?,meta_keywords=?,meta_descr=?,seo_keyword=?,status=?,short_descr=?,related_report=?,report_code=?,dt_created=now() where prod_id=?";
		if ($stmt = $mysqli->prepare($sql)){
			$ssssssiissssisi='ssssssiissssisssi';
					$stmt->bind_param($ssssssiissssisi,$pname,$parent[0],$parent[1],$mnfctr,$image,$descr,$pplr,$sort,$mtitle,$mkeywords,$mdesc,$seokey,$status,$short_descr,$txtRelatedUrl,$txtReportCode,$pcode);
					$flag=$stmt->execute();
		}
		if($flag){
		$_SESSION['stat']="SE";
		$allClasses->forRedirect ("prs.php");
		exit;
	}else{
		$_SESSION['stat']="FE";
		$allClasses->forRedirect ("prs.php");
		exit;
	}
}
if(isset($_POST["addUser"]) && $_POST["addUser"]=="Save User"){
	if($_POST['hid_action']=="edituser" && $_POST['hid_user_id']!=""){
		//$cat=$_POST['txtParent'];
$cat="";
		$name=$_POST['txtName'];
		$user_id=$_POST['txtUID'];
		$pwd=$_POST['txtPWD'];
		$status=$_POST['txtActive'];
		$sql="update zsp_users set  name=?,user_id=?,pwd=?,status=?,dt_created=now(),cat=? where inc_id=?";
		if ($stmt = $mysqli->prepare($sql)){
			$sssiis='sssiis';
			$stmt->bind_param($sssiis, $name,$user_id,$pwd,$status,$cat,$_POST['hid_user_id']);
			//echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
			$flag=$stmt->execute();
		}
	}else{
		$sql="insert into zsp_users(name,user_id,pwd,status,dt_created,cat)values(?,?,?,?,now(),?)";		
		$stmt = $mysqli->prepare($sql);
		$cat="";
		$name=$_POST['txtName'];
		$user_id=$_POST['txtUID'];
		$pwd=$_POST['txtPWD'];
		$status=$_POST['txtActive'];
		$sssis='sssis';		
		$stmt->bind_param($sssis, $name,$user_id,$pwd,$status,$cat);
		//echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
		$flag=$stmt->execute();
	}
	if($flag){
		$_SESSION['stat']="SE";
		$allClasses->forRedirect ("users.php");
		exit;
	}else{
		$_SESSION['stat']="FE";
		$allClasses->forRedirect ("users.php");
		exit;
	}
}

if(isset($_POST["uploadProductImages"]) && $_POST["uploadProductImages"]=="Upload Images"){
	foreach($_FILES['txtImage']['tmp_name'] as $key => $tmp_name ){
		$file_name = $_FILES['txtImage']['name'][$key];
		$file_size =$_FILES['txtImage']['size'][$key];
		$file_tmp =$_FILES['txtImage']['tmp_name'][$key];
		$file_type=$_FILES['txtImage']['type'][$key];	
        if($file_size > 2097152){
			$errors[]='File size must be less than 2 MB';
        }		
        $desired_dir=SITEDOC_ROOT_PATH."articleImages/";
        if(empty($errors)==true){
            if(is_dir($desired_dir)==false){
                mkdir("$desired_dir", 0700);		// Create directory if it does not exist
            }
			
           $check = getimagesize($_FILES["txtImage"]["tmp_name"][$key]);
		   if($check !== false) {
		    move_uploaded_file($file_tmp,"$desired_dir/".$file_name);
		   }
        }else{
                print_r($errors);
        }
    }
	if($check){
		$_SESSION['stat']="SA";
	}else{
		$_SESSION['stat']="FA";
	}
	$allClasses->forRedirect ("uploadImages.php");
	exit;
}

if(isset($_POST["uploadDocuments"]) && $_POST["uploadDocuments"]=="Upload Documents"){
	foreach($_FILES['txtImage']['tmp_name'] as $key => $tmp_name ){
		$file_name = $_FILES['txtImage']['name'][$key];
		$file_size =$_FILES['txtImage']['size'][$key];
		$file_tmp =$_FILES['txtImage']['tmp_name'][$key];
		$file_type=$_FILES['txtImage']['type'][$key];	
        if($file_size > 2097152){
			$errors[]='File size must be less than 2 MB';
        }		
        $desired_dir=SITEDOC_ROOT_PATH."documents/";
        if(empty($errors)==true){
            if(is_dir($desired_dir)==false){
                mkdir("$desired_dir", 0777);		// Create directory if it does not exist
            }
			
           //$check = getimagesize($_FILES["txtImage"]["tmp_name"][$key]);
		   $ext      = substr(strrchr($file_name, "."), 1); 
    		$randName = md5(rand() * time()).".".$ext;
			 if($check !== false) {
		    move_uploaded_file($file_tmp,"$desired_dir/".$randName);
		   }
        }else{
                print_r($errors);
        }
    }
	
		$sql="insert into zsp_user_documents(user_id,document,document_name,dt_created)values(?,?,?,now())";
		$stmt = $mysqli->prepare($sql);
		$sss='sss';
		$stmt->bind_param($sss, $_POST['hidUID'],$randName,$file_name);
		
		$flag=$stmt->execute();
		//echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
		//echo $flag;
	if($flag){
		$_SESSION['stat']="SA";
	}else{
		$_SESSION['stat']="FA";
	}
	$allClasses->forRedirect ("addGalImages.php?id=".$_POST['hidUID']);
	exit;
}
if(isset($_POST["uploadOffImgs"]) && $_POST["uploadOffImgs"]=="Upload Images"){
	$sql="insert into zsp_off_imgs(exp_id,img,title,dt_created)values(?,?,?,now())";
	$stmt = $mysqli->prepare($sql);
	$sss='sss';
	foreach($_FILES['txtImage']['tmp_name'] as $key => $tmp_name ){
		$file_name = $_FILES['txtImage']['name'][$key];
		$file_size =$_FILES['txtImage']['size'][$key];
		$file_tmp =$_FILES['txtImage']['tmp_name'][$key];
		$file_type=$_FILES['txtImage']['type'][$key];	
        if($file_size > 2097152){
			$errors[]='File size must be less than 2 MB';
        }		
        $desired_dir=SITEDOC_ROOT_PATH."off_imgs/";
        if(empty($errors)==true){
            if(is_dir($desired_dir)==false){
                mkdir("$desired_dir", 0777);		// Create directory if it does not exist
            }
			
           //$check = getimagesize($_FILES["txtImage"]["tmp_name"][$key]);
		   $ext      = substr(strrchr($file_name, "."), 1); 
    		$randName = md5(rand() * time()).".".$ext;
			 if($check !== false) {
		    move_uploaded_file($file_tmp,"$desired_dir/".$randName);
		   }
        }else{
                print_r($errors);
        }
		$stmt->bind_param($sss, $_POST['hidUID'],$randName,$file_name);
		
		$flag=$stmt->execute();
    }
	
		
		
		
		//echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
		//echo $flag;
	if($flag){
		$_SESSION['stat']="SA";
	}else{
		$_SESSION['stat']="FA";
	}
	$allClasses->forRedirect ("addCorpImages.php?id=".$_POST['hidUID']);
	exit;
}
?>
