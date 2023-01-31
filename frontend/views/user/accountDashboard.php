<?php
use yii\helpers\Url;

?>
<?php
//echo '<pre>';print_r($userInfo);exit;
$fname = !empty($userInfo[0]['fname']) ? $userInfo[0]['fname'] : NULL;
$lname = !empty($userInfo[0]['lname']) ? $userInfo[0]['lname'] : NULL;
$company = !empty($userInfo[0]['company']) ? $userInfo[0]['company'] : NULL;
$phone = !empty($userInfo[0]['phone']) ? $userInfo[0]['phone'] : NULL;
$email = !empty($userInfo[0]['login_id']) ? $userInfo[0]['login_id'] : NULL;
$password = !empty($userInfo[0]['password']) ? $userInfo[0]['password'] : NULL;
$billingAddrs=$s_addr1=$s_addr2=$s_city=$s_pincode=$s_state=$s_country=NULL;
$shippingAddrs=$b_addr1=$b_addr2=$b_city=$b_pincode=$b_state=$b_country=NULL;
foreach($userInfo as $user){
	if($user['addr_type']=='s'){
		$s_addr1 = !empty($user['addr1'])?$user['addr1']:NULL;
		$s_addr2 = !empty($user['addr2'])?$user['addr2']:NULL;
		$s_city = !empty($user['city'])?$user['city']:NULL;
		$s_pincode = !empty($user['pincode'])?$user['pincode']:NULL;
		$s_state = !empty($user['state'])?$user['state']:NULL;
		$s_country = !empty($user['country'])?$user['country']:NULL;
		$shippingAddrs = $s_addr1.'&nbsp'.$s_addr2.', '.$s_city.', '.$s_state.', '.$s_country.'-'.$s_pincode;
	}elseif($user['addr_type']=='b'){
		$b_addr1 = !empty($user['addr1'])?$user['addr1']:NULL;
		$b_addr2 = !empty($user['addr2'])?$user['addr2']:NULL;
		$b_city = !empty($user['city'])?$user['city']:NULL;
		$b_pincode = !empty($user['pincode'])?$user['pincode']:NULL;
		$b_state = !empty($user['state'])?$user['state']:NULL;
		$b_country = !empty($user['country'])?$user['country']:NULL;
		$billingAddrs = $b_addr1.'&nbsp'.$b_addr2.', '.$b_city.', '.$b_state.', '.$b_country.'-'.$b_pincode;
	}
}

?>

<div class="container">
	<div class="account-section">
		<div class="row">
			<div class="col-md-3">
				<div class="side-bar">
					<ul>
						<li class="active"><a href="<?= Url::to(['user/account-dashboard'])?>">Account Dashboard</a></li>
						<li><a href="<?= Url::to(['user/my-profile'])?>">My Profile</a></li>
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
						<h2>My Dashboard</h2>
						<p>From your My Account Dashboard you have the ability to view a snapshot of your recent account activity and update your account information. Select a link below to view or edit information.</p>
					</div>
					<div class="card">
						<h2>Account Information</h2>
						<div class="box">
							<h3>Contact Information <a class="eidt" href="<?= Url::to(['user/my-profile#contactInfo'])?>"><i class="icon-edit"></i>Edit</a></h3>
							<ul>
								<li><i class="icon-user"></i><?= $fname.'&nbsp'.$lname;?></li>
								<li><i class="icon-mail"></i><?= $email;?></li>
								<li><i class="icon-phone"></i><?= $phone;?></li>
								<li><i class="icon-lock"></i><a href="<?= Url::to(['user/my-profile#managePwd'])?>">Change Password</a></li>
							</ul>
						</div>
						<div class="box">
							<h3>Address Information <a class="eidt" href="<?= Url::to(['user/my-profile#billingAddrs'])?>"><i class="icon-location"></i>Manage Addresses</a></h3>
							<div class="row">
								<div class="col-md-6">
									<h4>Default Billing Address</h4>
									<ul>
										<li><i class="icon-location"></i><?= (!empty($billingAddrs))? $billingAddrs : 'You have not set a default billing address.';?><br>
											&nbsp; &nbsp; &nbsp; &nbsp;<a href="<?= Url::to(['user/my-profile#billingAddrs'])?>">Edit Address</a>
										</li>
									</ul>
								</div>
								<div class="col-md-6">
									<h4>Default Shipping Address</h4>
									<ul>
										<li><i class="icon-location"></i><?= (!empty($shippingAddrs))? $shippingAddrs : 'You have not set a default shipping address.';?><br>
											&nbsp; &nbsp; &nbsp; &nbsp;<a href="<?= Url::to(['user/my-profile#shippingAddrs'])?>">Edit Address</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
