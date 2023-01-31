<?php
use yii\helpers\Url;
// echo 'u r in '. __FILE__;
?>
<?php
//echo '<pre>';print_r($userInfo);exit;
$fname = !empty($userInfo[0]['fname']) ? $userInfo[0]['fname'] : NULL;
$lname = !empty($userInfo[0]['lname']) ? $userInfo[0]['lname'] : NULL;
$company = !empty($userInfo[0]['company']) ? $userInfo[0]['company'] : NULL;
$phone = !empty($userInfo[0]['phone']) ? $userInfo[0]['phone'] : NULL;
$email = !empty($userInfo[0]['login_id']) ? $userInfo[0]['login_id'] : NULL;
$password = !empty($userInfo[0]['password']) ? $userInfo[0]['password'] : NULL;
$s_addr1=$s_addr2=$s_city=$s_pincode=$s_state=$s_country=NULL;
$b_addr1=$b_addr2=$b_city=$b_pincode=$b_state=$b_country=NULL;
foreach($userInfo as $user){
	if($user['addr_type']=='s'){
		$s_addr1 = !empty($user['addr1'])?$user['addr1']:NULL;
		$s_addr2 = !empty($user['addr2'])?$user['addr2']:NULL;
		$s_city = !empty($user['city'])?$user['city']:NULL;
		$s_pincode = !empty($user['pincode'])?$user['pincode']:NULL;
		$s_state = !empty($user['state'])?$user['state']:NULL;
		$s_country = !empty($user['country'])?$user['country']:NULL;
	}elseif($user['addr_type']=='b'){
		$b_addr1 = !empty($user['addr1'])?$user['addr1']:NULL;
		$b_addr2 = !empty($user['addr2'])?$user['addr2']:NULL;
		$b_city = !empty($user['city'])?$user['city']:NULL;
		$b_pincode = !empty($user['pincode'])?$user['pincode']:NULL;
		$b_state = !empty($user['state'])?$user['state']:NULL;
		$b_country = !empty($user['country'])?$user['country']:NULL;
	}
}

?>
<style>
.err{
	color:red;
}
</style>
<div class="container">
	<div class="account-section">
		<div class="row">
			<div class="col-md-3">
				<div class="side-bar">
					<ul>
						<li><a href="<?= Url::to(['user/account-dashboard'])?>">Account Dashboard</a></li>
						<li class="active"><a href="<?= Url::to(['user/my-profile'])?>">My Profile</a></li>
						<!--<li><a href="javascript:void(0)">My Requests</a></li>
						<li><a href="javascript:void(0)">Purchased Reports</a></li>
						<li><a href="javascript:void(0)">Suggested Reports</a></li>-->
						<li><a href="<?=Url::to(['site/logout'])?>" data-method="post">Logout</a></li>
					</ul>
				</div>
			</div>
			<div class="col-md-9">
				<div class="content-bar">
					<div class="card">
						<h2>My Profile</h2>
						<div class="profile-form">
						<!-- ############# Form Start ################-->
							<form action="<?=Url::to(['user/my-profile'])?>" method="post">
								<h3 id="contactInfo">Contact Information</h3>
								<input type="hidden" name="<?= Yii::$app->request->csrfParam;?>" value="<?= Yii::$app->request->csrfToken;?>">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-addon">
													<i class="icon-user"></i>
												</div>
												<input class="form-control" name="fname" value="<?=$fname;?>" placeholder="First Name" type="text" required>
												
											</div>
											<div><span></span></div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-addon">
													<i class="icon-user"></i>
												</div>
												<input class="form-control" name="lname" value="<?=$lname;?>" placeholder="Last Name" type="text">
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-addon">
													<i class="icon-mail"></i>
												</div>
												<input class="form-control" name="email" value="<?=$email;?>" placeholder="amit@industryarc.com" type="email" readOnly>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-addon">
													<i class="icon-fillter"></i>
												</div>
												<input class="form-control" name="company" value="<?=$company;?>" placeholder="Company, Ex:IndustryARC™" type="text">
											</div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-addon">
													<i class="icon-phone"></i>
												</div>
												<input class="form-control" name="phone" value="<?=$phone;?>" placeholder="Phone, Ex: +917419871230" type="text" required>
											</div>
										</div>
									</div>
								</div>
								<h3 id="billingAddrs">Billing Address</h3>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-addon">
													<i class="icon-location"></i>
												</div>
												<input class="form-control" name="b_address_line1" value="<?=$b_addr1;?>" placeholder="Address Line 1" type="text" required>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-addon">
													<i class="icon-location"></i>
												</div>
												<input class="form-control" name="b_address_line2" value="<?=$b_addr2;?>" placeholder="Address Line 2" type="text">
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-addon">
													<i class="icon-location"></i>
												</div>
												<input class="form-control" name="b_city" value="<?=$b_city;?>" placeholder="City" type="text" required>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-addon">
													<i class="icon-location"></i>
												</div>
												<input class="form-control" name="b_state" value="<?=$b_state;?>" placeholder="State/Province" type="text" required>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-addon">
													<i class="icon-location"></i>
												</div>
												<input class="form-control" name="b_pincode" value="<?=$b_pincode;?>" placeholder="Zip/Postal Code" type="text" required>
											</div>
											<div><span class="err"><?= !empty($error['b_pincode'][0])?$error['b_pincode'][0]:NULL;?></span></div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-addon">
													<i class="icon-location"></i>
												</div>
												<input class="form-control" name="b_country" value="<?=$b_country;?>" placeholder="Country" type="text" required>
											</div>
										</div>
									</div>
								</div>
								<h3 id="shippingAddrs">Shipping Address</h3>
								<input type="checkbox" name="is_same_address" value="yes" onclick="fillShipping()"> &nbsp &nbsp Same As Billing Address
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-addon">
													<i class="icon-location"></i>
												</div>
												<input class="form-control" name="s_address_line1" value="<?=$s_addr1;?>" placeholder="Address Line 1" type="text" required>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-addon">
													<i class="icon-location"></i>
												</div>
												<input class="form-control" name="s_address_line2" value="<?=$s_addr2;?>" placeholder="Address Line 2" type="text">
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-addon">
													<i class="icon-location"></i>
												</div>
												<input class="form-control" name="s_city" value="<?=$s_city;?>" placeholder="City" type="text" required>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-addon">
													<i class="icon-location"></i>
												</div>
												<input class="form-control" name="s_state" value="<?=$s_state;?>" placeholder="State/Province" type="text" required>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-addon">
													<i class="icon-location"></i>
												</div>
												<input class="form-control" name="s_pincode" value="<?=$s_pincode;?>" placeholder="Zip/Postal Code" type="text" required>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-addon">
													<i class="icon-location"></i>
												</div>
												<input class="form-control" name="s_country" value="<?=$s_country;?>" placeholder="Country" type="text" required>
											</div>
										</div>
									</div>
								</div>
								<!--=============-->
								<h3 id="managePwd">Manage Password</h3>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-addon">
													<i class="icon-lock"></i>
												</div>
												<input class="form-control" id="main_pwd" value="<?=$password?>" name="password" placeholder="Current Password" type="password">
												<div class="input-group-addon"><a><i onclick="seePassword()" id="icon_eye" class="glyphicon glyphicon-eye-open"></i></a></div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-addon">
													<i class="icon-lock"></i>
												</div>
												<input class="form-control" name="new_password" placeholder="New Password" type="password">
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-addon">
													<i class="icon-lock"></i>
												</div>
												<input class="form-control" name="cnf_password" placeholder="Confirm Password" type="password">
											</div>
										</div>
									</div>
								</div>
								<!--=============-->
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<input class="btn btn-primary" type="submit" value="SAVE CHANGES">
										</div>
									</div>
								</div>
							</form>
							<!-- ############# Form End ################-->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
<?php
$script=<<<js
	$('input[type="submit"]').click(function(e){
		//e.preventDefault();
		var newPwd = $('input[name="new_password"]').val();
		var cnfPwd = $('input[name="cnf_password"]').val();
		if(newPwd !="" || cnfPwd !=""){
			if(newPwd != cnfPwd){
				alert('New Password and Confirm Password must be same'); return false;
			}else{
				//console.log('do Nothing');
			}
		}
	});
js;
$this->registerJs($script);
?>
<script type="text/javascript">
function fillShipping(){
	if($("input[name=is_same_address]").is(':checked')){
		$("input[name=s_address_line1]").val($("input[name=b_address_line1]").val());
		$("input[name=s_address_line2]").val($("input[name=b_address_line2]").val());
		$("input[name=s_city]").val($("input[name=b_city]").val());
		$("input[name=s_state]").val($("input[name=b_state]").val());
		$("input[name=s_pincode]").val($("input[name=b_pincode]").val());
		$("input[name=s_country]").val($("input[name=b_country]").val());
	}else{
		$("input[name=s_address_line1]").val('');
		$("input[name=s_address_line2]").val('');
		$("input[name=s_city]").val('');
		$("input[name=s_state]").val('');
		$("input[name=s_pincode]").val('');
		$("input[name=s_country]").val('');
	}
	
}

function seePassword() {
  var x = document.getElementById("main_pwd");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
} 


</script>