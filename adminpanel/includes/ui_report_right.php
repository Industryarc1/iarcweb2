
<?PHP
if($_POST['hid_submit'] == "Submit" ){
	$message="Enquiry From Market Intel Reports Website .<br>";
	
	$message= $message."<br>"."Report: ".$_POST['hidenqReport']."<br>"."Name: ".$_POST['hidenqName']."<br>"."Phone: ".$_POST['hidenqPhone']."<br>"."Email: ".$_POST['hidenqEMail']."<br>"."Nature of Enquiry: ".$_POST['hidenqNature']."<br>"."Enquiry: ".$_POST['txtEnquiry']."<br>";	
	$message = wordwrap($message, 70);
	
	//echo $message;
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From: '.$_POST['txtEmail'] . "\r\n";
	
	if(@mail($adminMail, 'Enquiry from '.$_POST['txtName'], $message, $headers)){
		$_SESSION['msg1'] = '<span style="font-family:Arial, Helvetica, sans-serif; font-size:13px;background-color:#FCF7EB; color:#009900"><b>Thank you.Your Enquiry will be responded soon.</span>';
		$_SESSION['stat']= 'success';
		
	}else{
		$_SESSION['msg1'] = '<span style="font-family:Arial, Helvetica, sans-serif; font-size:13px;background-color:#FCF7EB; color:#FF0000"><b>Error: Unable to send mail. Please try again.</b></span>';
		$_SESSION['stat']=  'fail';
	}
	$allClasses->forRedirect ($current_page);
	exit;

}	

	if($_SESSION['msg1'] != ''){
		$style='display:block;';
	}else{
		$style='display:none;';
	}
	

?>
<div class="rightenquiry" style="margin-top:20px;"><!--rightenquiry start-->


<div class="ContactAssistance"><!--MakeAnEnquiry start-->
<h2><i class="fa fa-envelope"></i> Make An Enquiry</h2>
<script language="javascript" >
	function trim(str)
	{
		return str.replace(/^\s*|\s*$/g,"");
	}
	
</script>
<form name="frmContact" class="Enquiry_form" action="" method="post" >
<input name="txtName"  id="txtName" class="Enquiry-field" type="text" placeholder="Full Name">
<input name="txtEmail" id="txtEmail" class="Enquiry-field" type="text" placeholder="Email Id">
<input name="txtPhone" id="txtPhone" class="Enquiry-field" type="text" placeholder="Phone Number">
<select name="txtEnqNature" id="txtEnqNature" class="Enquiry-field" style="width:100%" >
	<option value="" style="height:24px;border-bottom:1px solid #C9C9C9;padding:5px 0 0 5px">Nature of Enquiry</option>
	<?php 
	if ($stmt = $mysqli->prepare("select inc_id,name,code,status from zsp_enqs where status=1 order by dt_created asc")) {
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($inc_id, $name,$code,$status);
		while( $stmt->fetch() ) {
			?>
			<option value="<?=$name?>" style="height:24px;border-bottom:1px solid #C9C9C9;padding:5px 0 0 5px" ><?=$name?></option>
			<?php
		}
		$stmt->close();
	}
	?>
</select>
<input type="hidden" name="txtReport" value="<?=$title?>"  />
<input name="" type="button" value="Submit" onclick="openFeed()" class="enquirysubmit">
</form>
</div><!--MakeAnEnquiry stop-->

<div class="MakeAnEnquiry"><!--ContactAssistance-->
<h2><i class="fa fa-users"></i> Research Assistance</h2>
<div class="Assistance_content">
<?php
if ($cat = $mysqli->prepare("select content from zsp_content where page_name='Research Assistance'")) {
	$cat->execute();
	$cat->store_result();
	if($cat->num_rows>0){
		$cat->bind_result($Research);
		$cat->fetch();
	}
$Research = base64_decode($Research);
$Research = str_replace('\"', '"', $Research);
$Research = str_replace("\'", "'", $Research);
echo $Research;
}
?>
</div>
</div><!--ContactAssistance-->



</div>















<link rel="stylesheet" type="text/css" href="modelbox/style_36.css" media="all">
<div id="wrapperone">
 <div style="height:100%; width: 100%; <?=$style?>" id="layerpop1">
   
	<!--<div style="width:450px; margin:0px auto; display: block; top:90px;" id="popup" class="pop wdt550 hgt370">-->
	
	  <div style="" id="popup" class="pop wdt300 hgt470 myclass1"> <a href="javascript:void(0);" class="closePopUp" onclick="closeFeed()" title="Close" >close</a>
	
		<a href="javascript:void(0);" class="closePopUp" onclick="closeFeed()" title="Close" >close</a>
		<h3 class="popUpHead">Enquiry</h3>
		<div class="popUpBody clearfix" > 
			<div class="loginForm wdt230 fl popupDeviderRgt pr20">
				<div id="loginerror" style="display:block; "></div>
				<div style="padding-left:20px">
				
				
				
				
				
				
				
				<form name="frmfeedback" action="" method="post" onsubmit="return validateFeedback()">
				<?php 
				if($_SESSION['stat']!=""){
				if($_SESSION['stat'] == 'success'){
					
				 ?>
					<dl class="clearfix stat_msg"><?=$_SESSION['msg1']?></dl>
				<?php }
				if($_SESSION['stat']== 'fail'){
				?>
					<dl class="clearfix stat_err_msg"><?=$_SESSION['msg1']?></dl>
				<?php }	
				$_SESSION['stat']="";
				$_SESSION['msg1']="";
				}else{
				?>
				 
				<?php if($title!=""){ ?>	
				<dl class="clearfix mt15"><dt> Report  </dt><dt> <?=$title?></dt></dl>
				<?php }?>
				<dl class="clearfix mt15"><dt> Name </dt><dt id="enqName"> </dt></dl>
				<dl class="clearfix mt15"><dt> E Mail</dt><dt id="enqEMail"> </dt></dl>
				<dl class="clearfix mt15"><dt> Phone </dt><dt id="enqPhone"> </dt></dl>
				<dl class="clearfix mt15"><dt> Nature of Enquiry </dt><dt id="enqNature"> </dt></dl>
				
				<dl class="clearfix mt10">If you have any queries please feel free to ask us:</dl>
				<dl class="clearfix mt10"><textarea rows="3" id="txtEnquiry" name="txtEnquiry" style="width:100%" ></textarea></dl>
				
				
				
				<dl class="clearfix mt10"><dt>&nbsp;</dt><dd>
				<input type="hidden" name="hidenqReport" id="hidenqReport" value="<?=$title?>"  />
				<input type="hidden" name="hidenqName" id="hidenqName" value=""  />
				<input type="hidden" name="hidenqEMail" id="hidenqEMail" value=""  />
				<input type="hidden" name="hidenqPhone" id="hidenqPhone" value=""  />
				<input type="hidden" name="hidenqNature" id="hidenqNature" value=""  />
				
				<input name="hid_submit" type="submit" class="blueBtn" id="hid_submit" value="Submit">
				<!--<input id="butFeedback" name="butFeedback" value="Submit" class="blueBtn" type="submit">-->
				</dd>
				</dl>
				<?php }?>
				</form>
				</div>
				<dl class="clearfix"><dt>&nbsp;</dt></dl>
			</div>
			
		</div> 
	</div>
	<!-- function in js.js--> 
 <!-- added suggest a product -->
 <!-- end -->
</div>
 <!-- End -->
 	<!--<div class="spacer25" ></div>-->
		
</div>






	  
<!--	  <div style="position:fixed; right:0px; top:350px;"><a href="javascript:void(0)" onclick="openFeed()" ><img src="images/enqry_btn.gif" name="Image4" width="26" height="100" id="Image4" /></a></div> -->
<script language="javascript" >
	function openFeed(){
		
		 var sName=trim(document.frmContact.txtName.value);
		 var stxtPhone=trim(document.frmContact.txtPhone.value);
		 var sEmail=trim(document.frmContact.txtEmail.value);
		 var sEnq=trim(document.frmContact.txtEnqNature.value);
		 if(sName == ""){
			alert("Please provide your name");
			document.frmContact.txtName.focus();
			return false;
		  }
	      if(sEmail == ""){
			alert("Please provide your email");
			document.frmContact.txtEmail.focus();
			return false;
		  }
		  var regex = /^[a-zA-Z0-9_.]+@([a-zA-Z0-9_.]+\.)+[a-zA-Z0-9.-]{2,3}$/;	 	
		  match = regex.test(sEmail)
		  if(! match)
		   {
			 alert("Invalid email, please provide valid email");
			 document.frmContact.txtEmail.focus();
			 return false;   
		   }
		   if(stxtPhone!= ""){ }else{
			  alert("Please Enter your Phone Number");
			  document.frmContact.txtPhone.focus();
			  return false;
		  }
		  if(sEnq == "")
		  {
			alert("Please select nature of Enquiry");
			document.frmContact.txtEnqNature.focus();
			return false;
		  }
		  
		  document.getElementById('enqName').innerHTML=sName;
		  document.getElementById('enqEMail').innerHTML=sEmail;
		  document.getElementById('enqPhone').innerHTML=stxtPhone;
		  document.getElementById('enqNature').innerHTML=sEnq;
		  
		  document.getElementById('hidenqName').innerHTML=sName;
		  document.getElementById('hidenqEMail').innerHTML=sEmail;
		  document.getElementById('hidenqPhone').innerHTML=stxtPhone;
		  document.getElementById('hidenqNature').innerHTML=sEnq;
		  
		  document.getElementById('layerpop1').style.display='block';
	}
	function closeFeed(){
		document.getElementById('layerpop1').style.display='none';
	}
</script>