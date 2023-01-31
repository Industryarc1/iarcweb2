<?php include_once "includes/config.php"; ?>
<?php if(!isset($_SESSION['admin_id']) && $_SESSION['admin_user_id']==""){ $allClasses->forRedirect ("index.php"); } ?>
<?php
if(@$_REQUEST['act']=="delete" && $_REQUEST['pid']!=""){
$sql="delete from zsp_events where inc_id='".$_REQUEST['pid']."'";
mysqli_query($mysqli,$sql);
}
if(@$_REQUEST['act']=="editSatus" && @$_REQUEST['id']!=""){
	$query = "update zsp_events_welcome set status=? where inc_cat_id=?";
	$stmt1 = $mysqli->prepare($query);
	$stmt1->bind_param('ss',$_REQUEST['changeEventStatus'],$_REQUEST['id']);
	$flag=$stmt1->execute();
	if($flag){
		$_SESSION['stat']="SE";
		}else{
		$_SESSION['stat']="FE";
		}
		$allClasses->forRedirect ("evnt_list.php");
		exit;	
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE7">
<meta http-equiv="X-UA-Compatible" content="chrome=1">
<meta name = "viewport" content = "user-scalable=no, width=device-width">
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--[if lte IE 8]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!--[if lt IE 9]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js&quot; type="text/javascript"></script>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/ie7-squish.js&quot; type="text/javascript"></script>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js&quot; type="text/javascript"></script>
<![endif]-->
<script>
  "'article footer header nav section'".replace(/\w+/g,function(n){document.createElement(n)})
</script>
<title>IndustryARC</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/tabs.css" rel="stylesheet" type="text/css">
<link href="css/font-awesome.css" rel="stylesheet" type="text/css">
<?php
include_once "includes/js.php";
?>
</head>
<body>
  <div class="wrapper">
      <?php include_once "includes/ui_top.php"; ?>
</div>
<div class="container">
    <div class="con_left">
    <!--<i class="fa fa-list" ></i>-->
    <?php include_once "includes/admin_menu.php"; ?>
  </div>
  <div class="con_right">
    <div class="width100"  >
    <div class="topright width100 left">
      
      <ul >
        <?php /*?><li ><a href="addPost.php" class="forButton" >Add List</a> &nbsp;</li>
        <li ><a href="uploadImages.php" class="forButton" >Upload Images</a> &nbsp;</li><?php */?>
        
        <?php /*?><li><a href="featured.php" class="forButton"  >Featured</a> &nbsp;</li><?php */?>
        <li><a href="evnt_about.php" ><i class="fa fa-plus-square"></i></a></li>
        <?php /*?><li><a href="" ><i class="fa fa-trash"></i></a></li><?php */?>
      </ul>
    </div>
    <div class="width100 left">
      <div class="head2"> <i class="fa fa-list"></i> Events List</div>
      <div class="left <?=$_SESSION['stat']?>"><?php if(@$_SESSION['stat']!=""){ echo $err[$_SESSION['stat']];unset($_SESSION['stat']);  }?>
      <?php if(isset($_SESSION['status'])){ if($_SESSION['status']=="FDD"){echo "<font color='red'>Select Category/publisher </font>";}unset($_SESSION['status']);  }?>
      </div>
		</div> 
    
     
    <form name="frmAddCategory" action="" method="post" >  
			
    <div class="width100 left border">
      <div class="width100 left border_bottom bgcolor1">
				<div class="head2 width70 left">Event Name</div>        				
				<div class="head2 width10 left">Type</div>        				
				<div class="head2 width10 right onoff">Action</div>
      </div>
      <?php 
        include_once "includes/pagination.php";
        
        $query = "SELECT * FROM zsp_events_welcome order by dt_created desc ";

              $result = mysqli_query($mysqli,$query);
                $recsPerPage = 50;   //how many records to display on a page.
        
//getting current page number(if there is no page number it could be 1)
if(is_numeric(@$_REQUEST['pageId'])){
$pageId = $_REQUEST['pageId'];
}else{
$pageId = 1;
}

$returnArray = getPaging($mysqli,$query, $recsPerPage, $pageId);
//echo mysqli_num_rows($result);
if($returnArray[2] >0 ){
              $level="";
              if(mysqli_num_rows($result)>0){
              $level=$level+1;
              }
              $pf=1;  
          
        while($row = mysqli_fetch_array($returnArray[0])){
        if($row['status']==0){ $inactve='inactive';}else{ $inactve=""; }
      ?>
      <input type="hidden" name="hidID<?=$pf?>" value="<?=$row['inc_cat_id']?>"  />
      <div class="width100 left border_bottom <?=$inactve?>">
				<div class="head4 width70 left padding10 bdr_right" style="text-transform:none;"><?=$row['title']?></div>
				<div class="head4 width10 left padding10 bdr_right" style="text-transform:none;">
				<?php if($row['link']=='LP'){echo "Main Page";}else{ echo "Event"; }?>
				</div>        
        <div class="head4 width10 right onoff">					
				<a href="evnt_about.php?act=edit&id=<?=$row['inc_cat_id']?>" ><i class="fa fa-pencil-square"></i></a>
        &nbsp;
				<?php  if($row['status']==1){ ?>
        <a href="evnt_list.php?act=editSatus&id=<?=$row['inc_cat_id']?>&changeEventStatus=0" ><i class="fa fa-check-circle"></i></a>
        <?php }else{?>
        <a href="evnt_list.php?act=editSatus&id=<?=$row['inc_cat_id']?>&changeEventStatus=1" ><i class="fa fa-circle-thin"></i></a>
				<?php } ?>
        &nbsp;
        <!-- <a href="events.php?act=delete&pid=<?=$row['inc_cat_id']?>" ><i class="fa fa-trash"></i></a>-->
        </div>
      </div>
      <?php $pf++;
      }      
      ?>
      <input type="hidden"  name="hidTotal" id="hidTotal" value="<?=$pf?>" />
              <?php
              $resss=(mysqli_num_rows($result));
          if($resss > 15){
      ?>
      <div class="bold_txt width100 list_btns"><?=$allClasses->showParingLinks($returnArray[1], $pageId, 'pagin_btns')?>&nbsp;</div>
      <?php } else{ } 
                
                
                }else{  ?>
     * No Record Found 
    <?php } ?>
    </div>
    </form>
  </div>
  </div>      
</div>
<?php include_once "includes/ui_footer.php"; ?>
</body>
</html>