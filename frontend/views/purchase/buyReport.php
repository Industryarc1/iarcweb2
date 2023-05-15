<?php

use yii\helpers\Html;
//use yii\bootstrap\ActiveForm;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Url;

$this->title = 'industryArc - Buy Now';

$utmsrc = !empty($_GET['utm_source']) ? urldecode($_GET['utm_source']) : '';
$utmmed = !empty($_GET['utm_medium']) ? urldecode($_GET['utm_medium']) : '';
$utmcmp = !empty($_GET['utm_campaign']) ? urldecode($_GET['utm_campaign']) : '';
$utmid = !empty($_GET['utm_id']) ? urldecode($_GET['utm_id']) : '';
$utmterm = !empty($_GET['utm_term']) ? urldecode($_GET['utm_term']) : '';
$utmcontent = !empty($_GET['utm_content']) ? urldecode($_GET['utm_content']) : '';
$utmParam = !empty($utmsrc) ? '' . $utmsrc . '&utm_medium=' . $utmmed . '&utm_campaign=' . $utmcmp . '&utm_id=' . $utmid . '&utm_term=' . $utmterm . '&utm_content=' . $utmcontent . '' : '';

$reportName = substr($report['title'], 0, strpos(strtolower($report['title']), 'market') + 6);
?>
<style>
    .error {
        color: red;
    }
</style>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<link rel="stylesheet" href="<?= Url::to('/css/checkout-new.css') ?>">
<script src="https://kit.fontawesome.com/4fa1db5095.js" crossorigin="anonymous"></script>


<body>
    <!-- Start Stepper HTML -->
    <div class="Checkout-main-sec">
        <div class="Checkout-con pt-4 ">
            <div class="Checkout-sec">
                <div class="row ">
                    <div class="col-12 col-md-10 col-lg-10 mx-auto">
                        <h1 class="text-center">Checkout</h1>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="acodian-con">
        <div class="row accodian-sec d-flex justify-content-between align-items-center mb-4">
        <div class="col-md-4 cir1">
                <p class="mt-5 d-flex justify-content-right">Full Order Details</p>
                <h6><i class="fa-solid fa-check"></i></h6>
            </div>


            <div class="col-md-4 cir1">
                <p class="mt-5 d-flex justify-content-right">Payment</p>
                <h6><i class="fa-solid fa-check"></i></h6>
            </div>
            
            
            <div class="col-md-1 cir1">
                <p class="mt-5 d-flex justify-content-right">Confirmation</p>
                <h6><i class="fa-solid fa-check"></i></h6>
            </div>
        </div>
    </div>

    <form id="purchase-report">
        <div class="billing-main-sec p-5">
            <div class="bill-review-sec-con">
                <div class="row billing-review-sec pb-5">
                    <div class="col-md-5   mx-auto">
                        <h4 class="text-center mt-3"> Billing Address</h4>
                        <div class="container mt-1">
                            <div class="row ">
                                <div class="col-lg-12">
                                    <div class="row g-3">
                                        <div class="col-md-12">
                                            <label for="firstName" class="form-label">First name</label>
                                            <input type="text" class="form-control" id="firstName" name="f_name" placeholder="" value="" onblur="essentialChecks(this)" required>
                                            <div class='error fname_err'></div>

                                        </div>
                                        <div class="col-md-12">
                                            <label for="lastName" class="form-label pb-1">Last name</label>
                                            <input type="text" class="form-control" id="lastName" name="l_name" placeholder="" value="">
                                            <div class='error lname_err'></div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="Email" class="form-label pb-1">Email</label>
                                            <input type="email" class="form-control" id="Email" name="email" placeholder="" onblur="essentialChecks(this)" required>
                                            <div class='error email_err'></div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="Company" class="form-label pb-1">Company Name</label>
                                            <input type="text" class="form-control" id="Company" name="company_name" placeholder="" onblur="essentialChecks(this)" required>
                                            <div class='error company_err'></div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="Contact">Contact Number</label>
                                            <input type="number" class="form-control" id="Contact" name="contact_number" placeholder="" onblur="essentialChecks(this)" required>
                                            <div class='error phone_err'></div>
                                        </div>
                                        <div class="col-12">
                                            <label for="address" class="form-label pb-1">Address</label>
                                            <textarea class="form-control" id="address" name="address" placeholder="Enter full address along with Country State Zipcode " rows="5" onblur="essentialChecks(this)" required></textarea>
                                            <div class='error address_err'></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 px-4 mx-auto">

                        <h4 class="text-center mt-3"> Review Order</h4>
                        <h6>Report</h6>
                        <h5><?= !empty($report['title']) ? $report['title'] : NULL; ?></h5>
                        <h6 class="mt-2"> Format Type:<img class="mx-2" src="<?= Url::to('/images/excel-doc.png') ?>"></h6>
                        <h6 class="mt-3">Licence Type</h6>
                        <div class="row mt-3 justify-content-center ">
                            <div class="col-md-4 ">
                                <div class="form-check px-4 ps-5">
                                    <input class="form-check-input mt-3" value="<?= !empty($report['slp']) ? $report['slp'] : 0; ?>" checked type="radio" name="licence_price" id="Single" value="option1">
                                    <label class="form-check-label ms-2" for="Single">
                                        Single User<br>
                                        <span>$ <?= !empty($report['slp']) ? $report['slp'] : 0; ?></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4 ">
                                <div class="form-check px-4 ps-5">
                                    <input class="form-check-input mt-3" type="radio" name="licence_price" id="Corporate" value="<?= !empty($report['clp']) ? $report['clp'] : 0; ?>">
                                    <label class="form-check-label ms-2" for="Corporate">
                                        Corporate User<br>
                                        <span>$ <?= !empty($report['clp']) ? $report['clp'] : 0; ?></span>
                                    </label>
                                </div>
                            </div>
                            <!-- <div class="col-md-4 ">
                                <div class="form-check px-4 ps-5">
                                    <input class="form-check-input mt-3" type="radio" name="exampleRadios" id="exampleRadios3" value="option3">
                                    <label class="form-check-label ms-2" for="exampleRadios3">
                                        Expert User<br>
                                        $ 9500
                                    </label>
                                </div>
                            </div> -->
                        </div>
                        <h6 class="mt-3">Have a Promo Code ?</h6>
                        <div class="input-group mb-3 mt-2">
                            <input type="text" class="form-control" name="coupons" id="couponaply" placeholder="Promo code">

                            <button type="button" class="btn btn-secondary" onclick="applyCoupon()">Apply</button>


                        </div>
                        <div class="prise-row d-flex justify-content-between align-items-center mt-3">
                            <h6>Discount</h6>
                            <h6>$ 0</h6>
                        </div>
                        <div class="prise-row2 d-flex justify-content-between align-items-center mt-2">
                            <h6>Total</h6>
                            <h6 id="total_price">$ <?= !empty($report['slp']) ? $report['slp'] : 0; ?></h6>
                        </div>
                        <div class="payment-sec">
                            <div class="row mt-3 justify-content-between ">
                                <div class="col-md-5 ">
                                    <div class="form-check1 px-4 pb-2 ps-2">
                                        <input class="form-check1-input mt-3 " id="cc" type="radio" name="payment_mode" id="exampleRadios1" value="paypal" checked>
                                        <label class="form-check1-label ms-2" for="cc">
                                            Paypal
                                        </label>

                                    </div>
                                </div>
                                <div class="col-md-5 ">
                                    <div class="form-check1 px-4 pb-2 ps-2">
                                        <input class="form-check2-input mt-3" type="radio" name="payment_mode" id="ccr" value="razorpay">
                                        <label class="form-check2-label ms-2" for="ccr">
                                            Pay with card
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="terms-Conditions">
                            <div class="col-12">
                                <p class="mt-3 mb-1">By clicking on <span class="font-bold">"proceed to payment"</span>
                                    you agree to
                                    our <span class="span-color">terms & condition</span> and <span class="span-color">
                                        privacy
                                        policy.</span> </p>
                                <div class="form-check3 mb-3">
                                    <input class="form-check3-input" type="checkbox" value="" id="invalidCheck" required>
                                    <label class="form-check3-label" for="invalidCheck">
                                        I have read and I agree to be bound by IndustryArc's terms & conditions
                                    </label>
                                    <div class="invalid-feedback">
                                        You must agree before submitting.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix">
                            <div class="checkout-coantainer-btn">
                                <?php if (!empty($report['slp']) || !empty($report['clp'])) { ?>
                                    <div id="paypalCheckoutContainer"></div>
                                    <button style="float:right;display:none;" id="rzp-button1" type="submit" class="btn btn-success" name="submitPayment" value="Confirm Payment">Confirm Payment <i class="fa fa-arrow-right"></i></button>
                                    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>">
                    <input type="hidden" name="report_id" value="<?= $reportId ?>">
                    <input type="hidden" name="is_feild_empty" value="0">
                    <input type="hidden" name="order_id">
                    <input type="hidden" name="title" value="<?= !empty($report['title']) ? $report['title'] : NULL; ?>">
                    <input type="hidden" name="discount" value="" id="discount">
                    <input type="hidden" name="utmParam" value="<?php echo $utmParam; ?>">
                </div>
            </div>
        </div>
    </form>
</body>


<?php
$js = <<<JS
	$( document ).ready(function() {
		$("input[name=licence_price]").on('change',function(){
			console.log($(this).val());
			var price = $(this).val();
			$("#total_price").html('$ '+price);
			var code = document.getElementById("couponaply").value;
			if(code!=""){
				applyCoupon();
			}
		});

        $("input[name=payment_mode]").on('change',function(){
			
            console.log($(this).val());
            var paymentMode = $(this).val();

			if(paymentMode == 'paypal'){
                $('#paypalCheckoutContainer').show();
                $('#rzp-button1').hide();
            }else{
                $('#rzp-button1').show();
                $('#paypalCheckoutContainer').hide();
            }
		});

        // purchase-report --> form-id
        // =// Url::to(['purchase/buy-report']); --> Action URL, method -> POST

        $('#purchase-report').on('submit',function(){
            event.preventDefault();
           
        });

	});
JS;
$this->registerJs($js);
?>

<script type="text/javascript">
    function applyCoupon() {
        var code = document.getElementById("couponaply").value;
        //console.log('ion ');return false;
        //var actualPrice='<?= $licenceAmount ?>';
        var actualPrice = document.querySelector('input[name="licence_price"]:checked').value;

        $.ajax({
            //url: '<?= Url::to('purchase/apply-coupon'); ?>',
            url: 'https://www.industryarc.com/purchase/apply-coupon',
            type: 'post',
            data: {
                'coupon_code': code,
                'price': actualPrice
            },
            success: function(response) {
                //alert(response);
                //console.log(response);
                var res = JSON.parse(response);
                if (typeof res['success'] !== 'undefined') {
                    $(".sub-total").show();
                    $(".coupon_err").html('');
                    //$("#actual_amount>span").html('$'+res['success']['actual_price']);
                    $("#discount_amount").html('-$' + res['success']['discount_price']);
                    $("#total_amount").html('$' + res['success']['sale_price']);
                    //$("#buyreportform-licence_amount").val(res['success']['sale_price']);
                    //$("#buyreportform-coupon_code").val(code);
                    $("#discount").val(res['success']['discount_price']);
                } else if (typeof res['error'] !== 'undefined') {
                    $(".sub-total").hide();
                    $(".coupon_err").html(res['error']);
                    $("#total_amount").html('$' + actualPrice);
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
        var check = $('#is_feild_empty');
        var error = 0;

        //console.log($(field).val());
        if (fieldName == 'f_name') {
            if ($(field).val() != '') {
                $(".fname_err").html('');
            } else {
                error++;
                $(".fname_err").html('First Name Can`t be blank.');
            }
        }
        if (fieldName == 'email') {
            if ($(field).val() != '') {
                var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                if (!regex.test($(field).val())) {
                    error++;
                    $(".email_err").html('Invalid Email Address given');
                } else {
                    $(".email_err").html('');
                }
            } else {
                error++;
                $(".email_err").html('Email Can`t be blank.');
            }
        }
        if (fieldName == 'company_name') {
            if ($(field).val() != '') {
                $(".company_err").html('');
            } else {
                error++;
                $(".company_err").html('Company Name Can`t be blank.');
            }
        }
        if (fieldName == 'contact_number') {
            if ($(field).val() != '') {
                $(".phone_err").html('');
            } else {
                error++;
                $(".phone_err").html('Phone Number Can`t be blank.');
            }
        }
        if (fieldName == 'address') {
            if ($(field).val() != '') {
                $(".address_err").html('');
            } else {
                error++;
                $(".address_err").html('Address Can`t be blank.');
            }
        }

        check.val(error);
    }
</script>

<!-- <script src="https://www.paypal.com/sdk/js?client-id=ATHj-BC-e8TmIXkAF-R0Fqy0j51ukGjztiSxWKE1MFpyK8WyrEVd29JLM2_2072130-KeL-2tf2pjCYI&currency=USD"></script> -->
<script src="https://www.paypal.com/sdk/js?client-id=ARnP6MdktzVpOtd2ps9mNJAC_n0uw6LBxsZliVdVwhRkkS80eO_VwnFrJOy_HDlezUGkFpWO3-5f3WD7&currency=USD"></script>
<!--<script src="<?= Url::base() . '/frontend/web/customAssets' ?>/js/paypall.config.js"></script>-->
<!-- PayPal In-Context Checkout script -->
<script type="text/javascript">
    var indexedFormData = {};
    paypal.Buttons({
        // Set your environment
        env: 'sandbox',
        // Set style of button
        /*style: {
            layout: 'horizontal', // horizontal | vertical
            size: 'responsive', // medium | large | responsive
            shape: 'pill', // pill | rect
            color: 'gold'       // gold | blue | silver | black
        },*/

        // Execute payment on authorize
        commit: true,

        // when button is clicked
        onClick: function() {

            var formData = $('#purchase-report').serializeArray();

            $.map(formData, function(n, i) {
                indexedFormData[n['name']] = n['value'];
            });

            $.ajax({
                url: "<?= Url::to(['purchase/buy-report']); ?>",
                method: "POST",
                data: indexedFormData,
                success: function(response) {
                    response = JSON.parse(response);
                    indexedFormData.order_id = response.id;
                }
            })
        },

        // Wait for the PayPal button to be clicked
        createOrder: function(data, actions) {
            // Set up the transaction
            return actions.order.create({
                intent: "CAPTURE",
                application_context: {
                    brand_name: "Industryarc",
                    user_action: "PAY_NOW",
                    shipping_preference: "NO_SHIPPING",
                    payment_method: {
                        payer_selected: "PAYPAL",
                        payee_preferred: "IMMEDIATE_PAYMENT_REQUIRED"
                    },
                    return_url: "https://www.industryarc.com?commit=true",
                    cancel_url: "https://www.industryarc.com?commit=false",
                },
                payer: {
                    name: {
                        given_name: indexedFormData.f_name,
                        surname: indexedFormData.l_name
                    },
                    email_address: indexedFormData.email,
                    phone: {
                        phone_number: {
                            national_number: indexedFormData.contact_number
                        }
                    }
                },
                purchase_units: [{
                    invoice_id: indexedFormData.order_id,
                    description: "Order Purchase",
                    amount: {
                        currency_code: 'USD',
                        value: indexedFormData.licence_price,
                        breakdown: {
                            item_total: {
                                currency_code: 'USD',
                                value: indexedFormData.licence_price,
                            },
                        },
                    },
                    items: [{
                        name: "IndustryARC™ - Market Report",
                        description: "<?= $reportName ?>",
                        sku: indexedFormData.order_id,
                        unit_amount: {
                            currency_code: 'USD',
                            value: indexedFormData.licence_price
                        },
                        quantity: "1",
                        category: "DIGITAL_GOODS"
                    }]
                }]
            });


        },

        // Wait for the payment to be authorized by the customer
        onApprove: function(data, actions) {
            console.log(data);
            $.ajax({
                url: "<?= Url::to(['purchase/payment-responce']) ?>",
                type: 'post',
                data: data,
                success: function(response) {
                    console.log(response);
                    //return false;
                }
            });

            window.location.href = "<?= Url::to(['purchase/payment-status']) ?>";
        }

    }).render('#paypalCheckoutContainer');


    // <!-- ** ** ** ** ** ** ** ** ** ** * Razorpay script start ** ** ** ** ** ** ** ** ** ** ** ** ** -->
    var options = {
        "key": "rzp_test_j24qXGQtpz0JWA", //test Key
        // "key": "rzp_live_PQ1RvvmG2UByh4", //Live Key
        "amount": (parseFloat(document.querySelector('input[name=licence_price]:checked').value) * 100), /// The amount is shown in currency subunits. Actual amount is ₹599.
        "name": "IndustryArc",
        "currency": "USD", // Optional. Same as the Order currency
        "description": "<?= $reportName; ?>",
        "image": "https://www.industryarc.com/images/Arc_logo.png",
        "handler": function(response) {
            var payId = response.razorpay_payment_id;
            if (payId != '') {
                $.ajax({
                    url: "<?= Url::to(['purchase/payment-status']); ?>", 
                    type: 'post',
                    data: {
                        razor_payId: payId
                    },
                    success: function(res) {
                        if (res != "") {
                            //console.log(res);
                            alert('Payment Done Successfully.');
                            //redirect to thank you page.
                            window.location.href = "<?= Url::to(['purchase/thank-you']) ?>";
                            return false;
                        }
                    }
                });
            } else {
                $.ajax({
                    url: "<?= Url::to(['purchase/payment-status']); ?>",
                    type: 'post',
                    data: {
                        razor_payId: ''
                    },
                    success: function(res) {
                        if (res != "") {
                            //console.log(res);
                            alert('Payment not done.');
                            return false;
                        }
                    }
                });
            }
        },
        "prefill": {
            "name": document.querySelector('input[name=f_name]').value,
            "email": document.querySelector('input[name=email]').value
        },
        "notes": {
            "address": document.querySelector('textarea[name=address]').value,
            "iarc_order_id": document.querySelector('input[name=order_id]').value
        },
        "theme": {
            "color": "#F37254"
        }
    };
    var rzp1 = new Razorpay(options);

    document.getElementById('rzp-button1').onclick = function(e) {
        var formData = $('#purchase-report').serializeArray();

        $.map(formData, function(n, i) {
            indexedFormData[n['name']] = n['value'];
        });

        $.ajax({
            url: "<?= Url::to(['purchase/buy-report']); ?>",
            method: "POST",
            data: indexedFormData,
            success: function(response) {
                response = JSON.parse(response);
                indexedFormData.order_id = response.id;
                document.querySelector('input[name=order_id]').value = response.id;
                options.notes.iarc_order_id = response.id;
                rzp1.open();
                e.preventDefault();
            }
        });
    }
</script>