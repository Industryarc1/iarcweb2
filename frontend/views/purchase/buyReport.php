<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<?php

use yii\helpers\Html;
//use yii\bootstrap\ActiveForm;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Url;

$this->title = 'IndustryARC - Buy Now';

$utmsrc = !empty($_GET['utm_source'])?urldecode($_GET['utm_source']):'';
$utmmed = !empty($_GET['utm_medium'])?urldecode($_GET['utm_medium']):'';
$utmcmp = !empty($_GET['utm_campaign'])?urldecode($_GET['utm_campaign']):'';	
$utmid = !empty($_GET['utm_id'])?urldecode($_GET['utm_id']):'';	
$utmterm = !empty($_GET['utm_term'])?urldecode($_GET['utm_term']):'';	
$utmcontent = !empty($_GET['utm_content'])?urldecode($_GET['utm_content']):'';	
$utmParam = !empty($utmsrc)?''.$utmsrc.'&utm_medium='.$utmmed.'&utm_campaign='.$utmcmp.'&utm_id='.$utmid.'&utm_term='.$utmterm.'&utm_content='.$utmcontent.'':'';
?>
<style>
    .error{
        color:red;
    }
</style>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<div class="row child-nav">
    <div class="breadcrumb col-8 ">
        <ul>
            <li><a href="<?= Url::to(['site/index']); ?>">Home</a></li>
            <li>Payment Process</li>
        </ul>
    </div>
</div>
<div class="main-content payment-page">
    <div class="content-area">
        <div class="main-txt">
            <form action="<?= Url::to(['purchase/buy-report']); ?>" method="post">
                <h1 class="text-center"><span>Checkout</span></h1>
                <div class="clearfix" style="background: #f6f6f6;border-radius: 0 0 5px 5px;padding: 25px;">
                    <div class="checkout-coantainer">
                        <h3>Review Order</h3>
                        <div class="checkout-box">
                            <div class="checkout-block-row"><div class="order-report">
                                    <b>Report</b>
                                    <p><?= !empty($report['title']) ? $report['title'] : NULL; ?></p>
                                </div>
                            </div>
                            <div class="checkout-block-row"><div class="report-format"> <b class="d-inline-block">Format Type:</b>
                                    <span class="d-inline-block"><img src="<?= Yii::$app->request->baseUrl ?>/images/pdf2.png" alt="PDF" width="30" height=""> &nbsp;
                                        <img src="<?= Yii::$app->request->baseUrl ?>/images/excel-doc.png" alt="Excel" width="30" height=""> </span>
                                </div>
                            </div>
                            <div class="checkout-block-row"><div class="licence-type">
                                    <b>Licence Type</b>
                                    <div class="licence-select-btn">
                                        <div>
                                            <label for="Single">
                                                <input type="radio" id="Single" name="licence_price" value="<?= !empty($report['slp'])?$report['slp']:0; ?>" <?= $_GET['license_type']=="Basic" ? "checked": "" ?>>
                                                Basic User <span>$ <?= !empty($report['slp'])?$report['slp']:0; ?></span></label>
                                        </div>
                                        <div>
                                            <label for="Corporate">
                                                <input type="radio" id="Corporate" name="licence_price" value="<?= !empty($report['clp'])?$report['clp']:0; ?>" <?= $_GET['license_type']=="Advanced" ? "checked": "" ?>>
                                                Advanced User <span>$ <?= !empty($report['clp'])?$report['clp']:0; ?></span></label>
                                        </div>
                                        <div>
                                            <label for="Expert">
                                                <input type="radio" id="Expert" name="licence_price" value="9500" <?= $_GET['license_type']=="Expert" ? "checked": "" ?>>
                                                Expert User <span>$ 9500</span></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="checkout-block-row">
                                <b>Have a Promo Code?</b>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="coupons" id="couponaply" placeholder="Promo code">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-secondary" onclick="applyCoupon()">Apply</button>
                                    </div>
                                </div>
                            </div>
                            <div class="checkout-block-row">
								<div class="row"><b class="f-left w-50-percent">Discount</b>
                                    <b id="discount_amount" class="f-right w-50-percent text-right">$ 0</b>
                                </div>
                                <div class="row"><b class="f-left w-50-percent">Total</b>
                                    <b id="total_amount" class="f-right w-50-percent text-right">
                                        <?php
                                            $total_amount = 0;
                                            
                                            if($_GET['license_type']=="Basic"){
                                              $total_amount = !empty($report['slp'])?$report['slp']:0;  
                                            }

                                            if($_GET['license_type']=="Advanced"){
                                               $total_amount = !empty($report['clp'])?$report['clp']:0;
                                            }

                                            if($_GET['license_type']=="Expert"){
                                                $total_amount = 9500;
                                            }

                                        ?>
                                        $ <?= $total_amount?>
                                        


                                            
                                    </b>
                                </div>

                                
                                    <div>
                                    <input type="radio" id="cc" name="payment_mode" value="paypal" checked> Paypal<span>
                                    <img src="https://www.logolynx.com/images/logolynx/c3/c36093ca9fb6c250f74d319550acac4d.jpeg" alt="Paypal Card" width="100">
                                    </span>
                                    </div>
                                    <div>
                                    <input type="radio" id="ccr" name="payment_mode" value="razorpay"> Pay with Cards <span>
                                    <img src="https://www.clipartmax.com/png/middle/255-2550378_credit-card-logo-credit-card-icons-png.png"  alt="Credit Card" width="100">
                                    </span>
                                    </div>
                            </div>
                            <div class="checkout-block-row">By clicking on <b>"proceed to payment"</b> you agree to our <a href="terms-conditions.html">terms & condition</a> and <a href="privacy-policy.html">privacy policy</a>.</div>
                            <div class=""><label><input type="checkbox" name="tearm" required> I have read and I agree to be bound by IndustryArc's terms &amp; conditions</label></div>
                        </div>
                    </div>
                    <div class="billing-info">
                        <!-- <p>Payment Option</p>
                        <div class="payment-type ">
                            <div class="">
                                <label for="cc">
                                    <span class="cc-icon"><img src="<?= Yii::$app->request->baseUrl ?>/images/credit-card.png" width="" height="" alt="Credit Card"></span>
									Paypal
									<input type="radio" id="cc" name="payment_mode" value="paypal" checked>
								</label>
                            </div>
							<div class="">
                                <label for="ccr">
                                    <span class="cc-icon"><img src="<?= Yii::$app->request->baseUrl ?>/images/credit-card.png" width="" height="" alt="Credit Card"></span>
                                    Pay with Cards 
									<input type="radio" id="ccr" name="payment_mode" value="razorpay">
								</label>
                            </div>
                        </div> -->
                        <div class="billing-form">
                            <p>Billing Address</p>
                            <div class="row row-mar">
                                <div class="col-md-12 mb-3 col-padding">
                                    <label for="firstName">First name</label>
                                    <input type="text" class="form-control" id="firstName" name="f_name" placeholder="" value="" onblur="essentialChecks(this)" required>
                                   <div class='error fname_err'></div>
                                </div>
                                <div class="col-md-12 mb-3 col-padding">
                                    <label for="lastName">Last name</label>
                                    <input type="text" class="form-control" id="lastName" name="l_name"  placeholder="" value="">
                                    <div class='error lname_err'></div>
                                </div>
                                <div class="col-md-12 mb-3 col-padding">
                                    <label for="Email">Email</label>
                                    <input type="email" class="form-control" id="Email" name="email" placeholder="" onblur="essentialChecks(this)" required>
                                    <div class='error email_err'></div>
                                </div>
                                <div class="col-md-12 mb-3 col-padding">
                                    <label for="Company">Company Name</label>
                                    <input type="text" class="form-control" id="Company"  name="company_name" placeholder="" onblur="essentialChecks(this)" required>
                                     <div class='error company_err'></div>
                                </div>
                                <div class="col-md-12 mb-3 col-padding">
                                    <label for="Contact">Contact Number</label>
                                    <input type="number" class="form-control" id="Contact"  name="contact_number" placeholder="" onblur="essentialChecks(this)" required>
                                     <div class='error phone_err'></div>
                                </div>
                                <div class="col-md-12 mb-3 col-padding">
                                <label for="address">Address</label>
                                <textarea class="form-control" id="address" name="address" placeholder="Enter full address along with Country State Zipcode " rows="3" onblur="essentialChecks(this)" required></textarea>
                                <div class='error address_err'></div>
                                </div>
                            </div>
							<div class="row row-mar">
                                <div class="col-md-6 mb-3 col-padding">
                                    <!--iarc main - 6LfezHYUAAAAALY0cymolKIrIfCgt689OVzCoQeY-->
                                    <div class="g-recaptcha" data-sitekey="6LerueYkAAAAAANDh4s45tQI9riFB5d_PnbTeHJR" style="transform:scale(0.77);-webkit-transform:scale(0.77);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix">
                    <div class="checkout-coantainer-btn">
						<?php if(!empty($report['slp']) || !empty($report['clp'])){ ?>
                        <div class="md-3">
                            <button type="submit" class="btn-block">Proceed to Payment</button>
                        </div>
						<?php } ?>
                    </div>


                    <button id="custombutton" type="button">Pay with PayPal</button>
                    <div id="paypalCheckoutContainer"></div>

                </div>
                <div>
                    <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>">
                    <input type="hidden" name="report_id" value="<?= $reportId ?>">
                    <input type="hidden" name="title" value="<?= !empty($report['title'])?$report['title']:NULL; ?>">
					<input type="hidden" name="discount" value="" id="discount">
					<input type="hidden" name="utmParam" value="<?php echo $utmParam; ?>">
                </div>
            </form>
        </div>
    </div>
</div>

<?php
$js = <<<JS
	$( document ).ready(function() {
		$("input[name=licence_price]").click(function(){
			//console.log($(this).val());
			var price = $(this).val();
			$("#total_amount").html('$ '+price);
			var code = document.getElementById("couponaply").value;
			if(code!=""){
				applyCoupon();
			}
		});

	});
JS;
$this->registerJs($js);
?>



<script src="https://www.paypal.com/sdk/js?client-id=ATHj-BC-e8TmIXkAF-R0Fqy0j51ukGjztiSxWKE1MFpyK8WyrEVd29JLM2_2072130-KeL-2tf2pjCYI&currency=USD"></script>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script type="text/javascript">



               var paypalInstance  = paypal.Buttons({
                    // Set your environment
                    env: 'production',
                    // Set style of button
                    /*style: {
                        layout: 'horizontal', // horizontal | vertical
                        size: 'responsive', // medium | large | responsive
                        shape: 'pill', // pill | rect
                        color: 'gold'       // gold | blue | silver | black
                    },*/

                    // Execute payment on authorize
                    commit: true,

                    // Wait for the PayPal button to be clicked
                    createOrder: function (data, actions) {
                        // Set up the transaction
                        return actions.order.create({
                            intent: "CAPTURE",
                            application_context: {
                                brand_name:"Industryarc",
                                user_action:"PAY_NOW",
                                shipping_preference: "NO_SHIPPING",
                                payment_method:{
                                    payer_selected:"PAYPAL",
                                    payee_preferred:"IMMEDIATE_PAYMENT_REQUIRED"
                                },
                                return_url: "https://www.industryarc.com?commit=true",
                                cancel_url: "https://www.industryarc.com?commit=false",
                            },
                            payer:{
                                    name:{
                                        given_name:"Abc",
                                        surname:"G"
                                    },
                                    email_address:"rajesh.gajula505@gmail.com",
                                    phone: {
                                        phone_number: {                                     
                                            national_number: "7207670165"
                                        }
                                    }
                                },
                            purchase_units: [{
                                    invoice_id:"ABC123",
                                    description:"Order Purchase",
                                    amount: {
                                        currency_code: 'USD',
                                        value: "1",
                                        breakdown: {
                                            item_total: {
                                                currency_code: 'USD',
                                                value: "1",
                                            },
                                        },
                                    },
                                    items: [{
                                            name: "IndustryARC™ - Market Report",
                                            description: "AUTOMO Report",
                                            sku: "34532",
                                            unit_amount: {
                                                currency_code: 'USD',
                                                value: "1"
                                            },
                                            quantity: "1",
                                            category: "DIGITAL_GOODS"
                                        }]
                                }]
                        });
                    },

                    // Wait for the payment to be authorized by the customer
                    onApprove: function (data, actions) {
                        console.log(data);
                        $.ajax({
                            url: "<?= Url::to(['purchase/payment-responce']) ?>",
                            type: 'post',
                            data: data,
                            success: function (response) {
                                console.log(response);
                                //return false;
                            }
                        });

                        window.location.href = "<?= Url::to(['purchase/payment-status']) ?>";
                    }

                    

        }).render('#paypalCheckoutContainer');



$(document).ready(function(){
 
$("#custombutton").on("click",function(){

//paypalInstance.dispatch('initiate');
/*
<!--*********************Razorpay script start**************************-->
var options = {
                            //"key": "rzp_test_j24qXGQtpz0JWA",//test Key
                            "key": "rzp_live_PQ1RvvmG2UByh4",//Live Key
                            "amount": "<?= 1*100;?>", /// The amount is shown in currency subunits. Actual amount is ₹599.
                            "name": "IndustryArc",
                            "currency": "USD", // Optional. Same as the Order currency
                            "description": "Demo Testing Report",
                            "image": "https://www.industryarc.com/images/Arc_logo.png",
                            "handler": function (response){
                                var payId = response.razorpay_payment_id;
                                if(payId != ''){
                                    $.ajax({
                                        url: "<?=Url::to(['purchase/payment-status']);?>",
                                        type: 'post',
                                        data: {razor_payId:payId},
                                        success: function (res) {
                                            if(res != ""){
                                                //console.log(res);
                                                alert('Payment Done Successfully.');
                                                return false;
                                            }
                                        }
                                    });
                                }else{
                                    $.ajax({
                                        url: "<?=Url::to(['purchase/payment-status']);?>",
                                        type: 'post',
                                        data: {razor_payId:''},
                                        success: function (res) {
                                            if(res != ""){
                                                //console.log(res);
                                                alert('Payment not done.');
                                                return false;
                                            }
                                        }
                                    });
                                }
                            },
                            "prefill": {
                                "name": "Raj",
                                "email": "raj.gajula@gmail.com"
                            },
                            "notes": {
                                "address": "HYD",
                                "iarc_order_id": "3489"
                            },
                            "theme": {
                                "color": "#F37254"
                            }
                        };
                        var rzp1 = new Razorpay(options);

                        rzp1.open();

                        document.getElementById('custombutton').onclick = function(e){
                            rzp1.open();
                            e.preventDefault();
                        }
<!--*********************Razorpay script end**************************-->
*/

});

});


</script>




<script type="text/javascript">
	function applyCoupon(){
		var code = document.getElementById("couponaply").value;
		//console.log('ion ');return false;
		//var actualPrice='<?= $licenceAmount?>';
		var actualPrice= document.querySelector('input[name="licence_price"]:checked').value;

		$.ajax({
			//url: '<?=Url::to('purchase/apply-coupon');?>',
			url: 'http://34.67.44.136/purchase/apply-coupon',
			type: 'post',
			data: {'coupon_code':code,'price':actualPrice},
			success: function (response) {
				//alert(response);
				//console.log(response);
				var res = JSON.parse(response);
				if(typeof res['success'] !=='undefined'){
					$(".sub-total").show();
					$(".coupon_err").html('');
					//$("#actual_amount>span").html('$'+res['success']['actual_price']);
					$("#discount_amount").html('-$'+res['success']['discount_price']);
					$("#total_amount").html('$'+res['success']['sale_price']);
					//$("#buyreportform-licence_amount").val(res['success']['sale_price']);
					//$("#buyreportform-coupon_code").val(code);
					$("#discount").val(res['success']['discount_price']);
				}else if(typeof res['error'] !== 'undefined'){
					$(".sub-total").hide();
					$(".coupon_err").html(res['error']);
					$("#total_amount").html('$'+actualPrice);
					//$("#buyreportform-licence_amount").val(actualPrice);
					//$("#buyreportform-coupon_code").val('');
					//$("#buyreportform-discount").val('');
				}
			}
		});
	}
</script>

<script type="text/javascript">
    function essentialChecks(field) {
        var fieldName = $(field).attr('name');
        //console.log($(field).val());
        if (fieldName == 'f_name') {
            if ($(field).val() != '') {
                $(".fname_err").html('');
            } else {
                $(".fname_err").html('First Name Can`t be blank.');
            }
        }
        if (fieldName == 'email') {
            if ($(field).val() != '') {
                var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                if (!regex.test($(field).val())) {
                    $(".email_err").html('Invalid Email Address given');
                } else {
                    $(".email_err").html('');
                }
            } else {
                $(".email_err").html('Email Can`t be blank.');
            }
        }
        if (fieldName == 'company_name') {
            if ($(field).val() != '') {
                $(".company_err").html('');
            } else {
                $(".company_err").html('Company Name Can`t be blank.');
            }
        }
        if (fieldName == 'contact_number') {
            if ($(field).val() != '') {
                $(".phone_err").html('');
            } else {
                $(".phone_err").html('Phone Number Can`t be blank.');
            }
        }
        if (fieldName == 'address') {
            if ($(field).val() != '') {
                $(".address_err").html('');
            } else {
                $(".address_err").html('Address Can`t be blank.');
            }
        }

    }
</script>


<script type="text/javascript">
    
$(document).ready(function(){
    alert("hi...");
    $("#paypalCheckoutContainer").click();
});

</script>