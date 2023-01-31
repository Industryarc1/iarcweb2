<?php include_once "includes/config.php"; ?>
<?php if(!isset($_SESSION['admin_id']) || $_SESSION['admin_id']==""){ $allClasses->forRedirect ("index.php"); } ?>

<?php 

if(@$_POST['butSubmit'] == "Submit"){

$query = "insert into zsp_careers(job_title,exp,no_jobs,skills,location,info,dt_created) values('".$_POST['txtTitle']."','".$_POST['txtExp']."','".$_POST['txtNoJobs']."','".$_POST['txtSkills']."','".$_POST['txtLocation']."','".$_POST['txtInfo']."',current_date())";
  if($query != ""){
    $result = mysqli_query($mysqli,$query);
    $error = mysqli_error($mysqli);
    if($error == ""){
      $_SESSION['stat']="SA";
      $allClasses->forRedirect ("viewCareers.php");
      exit;
    }else{
      $_SESSION['stat']="FA";
      $allClasses->forRedirect ("viewCareers.php");
      exit;
    }
  }
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
  <form name="frmCareers" action="" method="post"  enctype="multipart/form-data" >
  <div class="width100"  >
    <div class="width100 left">
      <div class="width50 left <?=$_SESSION['stat']?>"><?php if(@$_SESSION['stat']!=""){ echo $err[$_SESSION['stat']];unset($_SESSION['stat']);  }?></div>
    
    </div>
    <?php 
      if(@$_REQUEST['act']=="edit" && $_REQUEST['id']!=""){
        $mainTitle = "Edit Careers";
      }else{
        $mainTitle = "Add Careers";
      }
    ?>
    <div class="width100 left">
      <div class="head2"><i class="fa fa-newspaper-o"></i> <?=$mainTitle?></div>
    </div>
    
    <div class="width100 left pb50" >
      <div class="events">
          <script type="text/javascript">
            $(document).ready( function() {
            $('#tab-container').easytabs();
            });
          </script>        
          
          <div id="tab-container" class='tab-container'>
            <div class='panel-container'>  
                <div id="ctab1">
                <table width="80%" border="0" align="center" cellpadding="0" cellspacing="6">
            <tr>
              <td width="22%" align="left" valign="middle" class="head4 width180px left">Position ID:</td>
              <td width="78%" align="left" valign="middle"><input name="txtNoJobs" required type="text" class="forTextfield" id="txtNoJobs" value="" size="40" tabindex="1" ></td>
            </tr>
        
            <tr>
              <td width="22%" align="left" valign="middle" class="head4 width180px left">Job Title:</td>
              <td width="78%" align="left" valign="middle"><input name="txtTitle" required type="text" class="forTextfield" maxlength="255" id="txtTitle" value="" size="40" tabindex="1" ></td>
            </tr>
       
                 <tr>
              <td width="22%" align="left" valign="middle" class="head4 width180px left">Category:</td>
              <td width="78%" align="left" valign="middle"><input name="txtExp" required type="text" class="forTextfield"  id="txtExp" value="" size="40" tabindex="1" ></td>
            </tr>
                  
                 <tr>
              <td width="22%" height="78" align="left" valign="middle" class="head4 width180px left">Short Description:</td>
              <td width="78%" align="left" valign="middle"><textarea name="txtSkills" class="forTextfield" id="txtResp" style="width:60%;height:100px;"></textarea></td>
            </tr> 
         <tr>
              <td width="22%" height="78" align="left" valign="middle" class="head4 width180px left">Job Description:</td>
              <td width="78%" align="left" valign="middle"><textarea name="txtInfo" class="forTextfield" id="txtInfo" style="width:100%;height:250px;"></textarea>
          
          
          <script src="editor/nicEdit.js" type="text/javascript"></script>
          <script>
          var area4;
          
          function toggleArea4() {
            
            if(!area4) {
              area4 = new nicEditor({fullPane4 : true}).panelInstance('txtInfo',{hasPane4 : true});
            } else {
              area4.removeInstance('txtInfo');
              area4 = null;
            }
          }
          
          bkLib.onDomLoaded(function() { toggleArea4(); });
          </script>
          </td>
            </tr>           
         <tr>
              <td width="22%" align="left" valign="middle" class="head4 width180px left">Work Location:</td>
              <td width="78%" align="left" valign="middle"><input name="txtLocation" required type="text" class="forTextfield" maxlength="20" id="txtLocation" value="" size="40" tabindex="1" ></td>
            </tr>
                
        </table>
                
                </div>
              </div>
              
        
          </div>
          

                </div>
                <input name="butSubmit" type="submit" class="forButton" id="butSubmit" value="Submit" tabindex="2" onClick="return validate1()" /> 
      
    </div>
  </div>
  </form>
  </div>       
</div>
<?php include_once "includes/ui_footer.php"; ?>
</body>
</html>