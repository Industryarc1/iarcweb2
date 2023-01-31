<?php include_once "includes/config.php"; ?>
<?php if(!isset($_SESSION['admin_id']) || $_SESSION['admin_id']==""){ $allClasses->forRedirect ("index.php"); } 

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
       
<style>
.list_btns{
  width:100%;
  text-align:center;
}
.pagin_btns{
  background-color:#336699;
  color:#FFF;
  text-decoration:none;
  padding:1px 6px;
  font-family: "OpenSans-Regular";
  border-radius:10%;
  font-size:14px;
  
}
.pagin_btns:hover{
  background-color:#9A0000;
  text-decoration:none;
  color:#FFFFFF;  
}
.activeBar{
  background-color:#000;
  color:#FFF;
  text-decoration:none;
  padding:1px 6px;
  font-family: "OpenSans-Regular";
  border-radius:10%;
  font-size:14px;
}
</style>
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
    <div class="width100">
    
    <div class="width100 left">
      <div class="head2"> <i class="fa fa-list"></i> Leads</div>
      <a href='downloadLeads.php?id=dl'>Download</a>
    </div>

          <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="width100 left border_bottom">
              <tr>
              <td align="left" valign="middle"><?php
              ?>
              <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#F0F0F0" >
              <tr border_bottom bgcolor1" style="background-color:#EAEAEA">
                <td width="10%" align="center" valign="middle" class="head3" >Fullname </td>
                <td width="10%" align="center" valign="middle" class="head3">Email</td>
                <td width="10%" align="center" valign="middle" class="head3">Phone </td>
<td width="10%" align="center" valign="middle" class="head3">Country </td>                
                <td width="10%" align="center" valign="middle" class="head3">Requirements</td>
                <td width="5%" align="center" valign="middle" class="head3">Date</td>
                <td width="10%" align="center" valign="middle" class="head3">Report</td>
                <td width="10%" align="center" valign="middle" class="head3">Type</td>
              </tr>
              
              <?php
              include_once "includes/pagination.php";
              $query = "SELECT * FROM zsp_leads order by dt_created desc ";

              $result = mysqli_query($mysqli,$query);
                $recsPerPage = 30;   //how many records to display on a page.
        
//getting current page number(if there is no page number it could be 1)
if(is_numeric(@$_REQUEST['pageId'])){
$pageId = $_REQUEST['pageId'];
}else{
$pageId = 1;
}

$returnArray = getPaging($mysqli,$query, $recsPerPage, $pageId);

if($returnArray[2] >0 ){
              $level="";
              if(mysqli_num_rows($result)>0){
              $level=$level+1;
              }
              $t=1;  
                while($row = mysqli_fetch_array($returnArray[0])){    
if($row['type']=='RB'){
  $type='PDF D/L';
}else if($row['type']=='RC'){
  $type='Req Customization';
}else if($row['type']=='RBB'){
  $type='Inq before buy';
}else if($row['type']=='RWD'){
  $type='Whitepaper D/L';
}else if($row['type']=='RAC'){
  $type='Req a call';
}else if($row['type']=='RPF'){
  $type='RFP Subscription';
}else if($row['type']=='AQ'){
  $type='Analyst Query';
}else if($row['type']=='SQ'){
  $type='Sales Query';
}else{
  $type=$row['type'];
}
              ?>
              <tr class="" style="font-family:Arial, Helvetica, sans-serif;font-size:12px">
                <td ><?=$row['fname'].'-'.$row['lname']?></td>
                <td ><?=$row['email']?></td>
                <td ><?=$row['phone']?></td>
<td ><?=$row['country']?></td>
                <td ><?=$row['comments']?></td>
                <td ><?php echo date('m/d/y',strtotime($row['dt_created'])); ?></td>
                <td>                
                <?php 
                $query1 = "SELECT * FROM zsp_posts where inc_id='".$row['rid']."'";
                $result1 = mysqli_query($mysqli,$query1);              
                while($row1 = mysqli_fetch_assoc($result1))
                {
                  echo "<span title='".$row1['title']."'>".substr($row1['title'],0,50).'...'."</span>";                  
                }
                ?>
                </td>
                <td ><?=$type?><?php if(@$row['industry']!=''){ echo "(".rtrim($row['industry']).")"; }?></td>
              </tr>
              <?php
              $t++;
              }
              $resss=(mysqli_num_rows($result));
          if($resss > 15){
      ?>
      <div class="bold_txt width100 list_btns"><?=$allClasses->showParingLinks($returnArray[1], $pageId, 'pagin_btns')?>&nbsp;</div>
      <?php } else{ } 
                
                
                }else{  ?>
     * No Record Found 
    <?php } ?>
              </table>    
              </td>
              </tr>
          </table>    
  </div>
  </div>      
</div>
<?php include_once "includes/ui_footer.php"; ?>
</body>
</html>