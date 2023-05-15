<?php

use yii\helpers\Url;

//use frontend\helper\ReportHelper;
//$arrCountry = ReportHelper::getGoogleLocInfo();
//echo '<pre>';print_r($arrCountry);echo '</pre>';exit;
// echo $orderInfo['payment_mode'];
?>
<div class="row child-nav">
    <div class="breadcrumb col-8">
        <ul>
            <li><a href="<?= Yii::$app->request->baseUrl ?>">Home</a></li>
            <li>Order Review</li>
        </ul>
    </div>
    <div class="page-actions col-4 rsp-hide">
        <ul>
            <li><a href="mailto:<?= \Yii::$app->params['salesEmail'] ?>?subject=Share-<?= $this->title; ?>&body=<?= $_SERVER['HTTP_HOST'] . Yii::$app->request->url; ?>">
                    <img src="<?= Yii::$app->request->baseUrl ?>/images/mail.png" width="" height="" alt="Email"> Email</a></li>
            <li><a href="javascript:void(0);" onclick="window.print()"><img src="<?= Yii::$app->request->baseUrl ?>/images/printer.png" width="" height="" alt="Print"> Print</a></li>
        </ul>
        <div class="share">
            <p>Share</p>
            <span class="hover-options">
                <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?= $_SERVER['HTTP_HOST'] . Yii::$app->request->url; ?>" target='_blank'><img src="<?= Yii::$app->request->baseUrl ?>/images/linkedin.png" width="" height="" alt="Linkedin"></a>
                <a href="https://twitter.com/IndustryARC"><img src="<?= Yii::$app->request->baseUrl ?>/images/twitter.png" width="" height="" alt="Twitter"></a>
                <a href="https://in.pinterest.com/Industry_ARC"><img src="<?= Yii::$app->request->baseUrl ?>/images/pinterest.png" width="" height="" alt="Pinterest"></a>
            </span>
        </div>
    </div>
</div>
<div class="main-content payment-page">
    <div class="content-area">

        <div class="main-txt">
            <h1 class="text-center"><span>Review Order</span></h1>
            <div class="clearfix ordr-review-block">

                <div class="order-review-bl">
                    <div class="ordr-dtl-section">
                        <div class="brdr-hdr">Order Details</div>
                        <b>Report</b>
                        <p><?= $orderInfo['title'] ?></p>
                    </div>

                    <div class="ordr-dtl-section">
                        <div class="brdr-hdr">Billing Details</div>
                        <p class="mar-btm-30"><b>Delivery for:</b><br />

                            <span><?= $orderInfo['f_name'] . ' ' . $orderInfo['l_name'] ?></span><br />
                            <span>Email: <?= $orderInfo['user_id'] ?></span><br />
                            <span>Ph No: <?= $orderInfo['contact_number'] ?></span>
                        </p>
                        <p class="mar-btm-30"><b>Billing Address :</b><br /> <?= $orderInfo['address'] ?>
                        </p>
                    </div>

                </div>
                <div class="order-review-br">

                    <div class="">

                        <div class="checkout-block-row">
                            <div class="order-report">
                                <div class="brdr-hdr">Summary</div>

                            </div>
                        </div>


                        <div class="checkout-block-row">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td><b>Single User</b> </td>
                                    <td align="right">$ <?= $orderInfo['licence_amount'] ?></td>
                                </tr>

                                <!-- <tr>
                                   <td><b>Promo Discount</b></td>
                                   <td align="right">$ 0</td>
                                 </tr>-->
                                <tr>
                                    <td>&nbsp;</td>
                                    <td align="right"></td>
                                </tr>

                                <tr>
                                    <td colspan="2" style="border-top:1px solid #d5d5d5" height="5"></td>

                                </tr>

                                <tr>
                                    <td><b>Total Amount</b></td>
                                    <td align="right">$ <?= $orderInfo['licence_amount'] ?></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="border-top:1px solid #d5d5d5" height="5"></td>

                                </tr>
                                <tr>
                                    <!--<td ><button type="submit" class="btn btn-danger" name="submitCancel" value="Cancel">Cancel</button></td>-->
                                    <td align="right">
                                        <?php if ($orderInfo['payment_mode'] == 'paypal') { ?>
                                            <div id="paypalCheckoutContainer"></div>
                                        <?php } else if ($orderInfo['payment_mode'] == 'HDFC') { ?>
                                            <form method="POST" action="<?= yii\helpers\Url::to(['purchase/confirm-buy-report']) ?>">
                                                <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
                                                <button style="float:right" type="submit" class="btn btn-success" name="submitPayment" value="HDFC_Payment">Confirm Payment <i class="fa fa-arrow-right"></i></button>
                                            </form>
                                        <?php } else if (!empty($orderInfo['payment_mode']) && $orderInfo['payment_mode'] == 'razorpay') { ?>
                                            <button style="float:right" id="rzp-button1" type="submit" class="btn btn-success" name="submitPayment" value="Confirm Payment">Confirm Payment <i class="fa fa-arrow-right"></i></button>
                                            <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

                                        <?php } else { ?>
                                            <button style="float:right" type="submit" class="btn btn-success" name="submitPayment" value="Confirm Payment">Confirm Payment <i class="fa fa-arrow-right"></i></button>
                                        <?php } ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$arrAddress = $orderInfo['address'];
$add1 = $orderInfo['address'];
$add2 = '';
$city = 'Hyderabad';
$state = 'Telangana';
$reportName = substr($orderInfo['title'], 0, strpos(strtolower($orderInfo['title']), 'market') + 6); //strpos + 6 will give the position till market because characters in market =6
//echo '<pre>';print_r($orderInfo);exit;
//echo 'arrOrderHdrs======<pre>';print_r(explode('<br>',$arrOrderHdrs['cust_s_addr']));
?>

<!-- Javascript Import -->
<script src="https://www.paypal.com/sdk/js?client-id=ATHj-BC-e8TmIXkAF-R0Fqy0j51ukGjztiSxWKE1MFpyK8WyrEVd29JLM2_2072130-KeL-2tf2pjCYI&currency=USD"></script>
<!--<script src="https://www.paypal.com/sdk/js?client-id=ARnP6MdktzVpOtd2ps9mNJAC_n0uw6LBxsZliVdVwhRkkS80eO_VwnFrJOy_HDlezUGkFpWO3-5f3WD7&currency=USD"></script>-->
<!--<script src="<?= Url::base() . '/frontend/web/customAssets' ?>/js/paypall.config.js"></script>-->
<!-- PayPal In-Context Checkout script -->
<script type="text/javascript">
    paypal.Buttons({
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
                        given_name: "<?= $orderInfo['f_name'] ?>",
                        surname: "<?= $orderInfo['l_name'] ?>"
                    },
                    email_address: "<?= $orderInfo['user_id'] ?>",
                    phone: {
                        phone_number: {
                            national_number: "<?= $orderInfo['contact_number'] ?>"
                        }
                    }
                },
                purchase_units: [{
                    invoice_id: "<?= $orderInfo['order_id'] ?>",
                    description: "Order Purchase",
                    amount: {
                        currency_code: 'USD',
                        value: "<?= $orderInfo['licence_amount']; ?>",
                        breakdown: {
                            item_total: {
                                currency_code: 'USD',
                                value: "<?= $orderInfo['licence_amount']; ?>",
                            },
                        },
                    },
                    items: [{
                        name: "IndustryARC™ - Market Report",
                        description: "<?= $reportName ?>",
                        sku: "<?= $orderInfo['order_id'] ?>",
                        unit_amount: {
                            currency_code: 'USD',
                            value: "<?= $orderInfo['licence_amount']; ?>"
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
            //"key": "rzp_test_j24qXGQtpz0JWA",//test Key
            "key": "rzp_live_PQ1RvvmG2UByh4", //Live Key
            "amount": "<?= $orderInfo['licence_amount'] * 100; ?>", /// The amount is shown in currency subunits. Actual amount is ₹599.
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
                "name": "<?= $orderInfo['f_name']; ?>",
                "email": "<?= $orderInfo['user_id']; ?>"
            },
            "notes": {
                "address": "<?= urlencode($orderInfo['address']); ?>",
                "iarc_order_id": "<?php echo $orderInfo['order_id']; ?>"
            },
            "theme": {
                "color": "#F37254"
            }
        };
    var rzp1 = new Razorpay(options);

    document.getElementById('rzp-button1').onclick = function(e) {
            rzp1.open();
            e.preventDefault();
        } <
        !-- ** ** ** ** ** ** ** ** ** ** * Razorpay script end ** ** ** ** ** ** ** ** ** ** ** ** ** -- >
</script>