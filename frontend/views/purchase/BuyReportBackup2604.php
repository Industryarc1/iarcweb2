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
                <div class="clearfix">
                    <div class="checkout-coantainer">
                        <h3>Review Order</h3>
                        <div class="checkout-box">
                            <div class="checkout-block-row">
                                <div class="order-report">
                                    <b>Report</b>
                                    <p><?= !empty($report['title']) ? $report['title'] : NULL; ?></p>
                                </div>
                            </div>
                            <div class="checkout-block-row">
                                <div class="report-format"> <b class="d-inline-block">Format Type:</b>
                                    <span class="d-inline-block"><img src="<?= Yii::$app->request->baseUrl ?>/images/pdf2.png" alt="PDF" width="30" height=""> &nbsp;
                                        <img src="<?= Yii::$app->request->baseUrl ?>/images/excel-doc.png" alt="Excel" width="30" height=""> </span>
                                </div>
                            </div>
                            <div class="checkout-block-row">
                                <div class="licence-type">
                                    <b>Licence Type</b>
                                    <div class="licence-select-btn">
                                        <div>
                                            <label for="Single">
                                                <input type="radio" id="Single" name="licence_price" value="<?= !empty($report['slp']) ? $report['slp'] : 0; ?>" checked>
                                                Single User <span>$ <?= !empty($report['slp']) ? $report['slp'] : 0; ?></span></label>
                                        </div>
                                        <div>
                                            <label for="Corporate">
                                                <input type="radio" id="Corporate" name="licence_price" value="<?= !empty($report['clp']) ? $report['clp'] : 0; ?>">
                                                Corporate User <span>$ <?= !empty($report['clp']) ? $report['clp'] : 0; ?></span></label>
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
                                    <b id="total_amount" class="f-right w-50-percent text-right">$ <?= !empty($report['slp']) ? $report['slp'] : 0; ?></b>
                                </div>
                            </div>
                            <div class="checkout-block-row">By clicking on <b>"proceed to payment"</b> you agree to our <a href="terms-conditions.html">terms & condition</a> and <a href="privacy-policy.html">privacy policy</a>.</div>
                            <div class=""><label><input type="checkbox" name="tearm" required> I have read and I agree to be bound by IndustryArc's terms &amp; conditions</label></div>
                        </div>
                    </div>
                    <div class="billing-info">
                        <p>Payment Option</p>
                        <div class="payment-type ">
                            <div class="">
                                <label for="cc">
                                    <span class="cc-icon"><img src="<?= Yii::$app->request->baseUrl ?>/images/credit-card.png" width="" height="" alt="Credit Card"></span>
                                    <!--Pay with Credit Card -->
                                    Paypal
                                    <input type="radio" id="cc" name="payment_mode" value="paypal" checked>
                                    <!--<input type="radio" id="cc" name="payment_mode" value="HDFC" checked>-->
                                    <!--<input type="radio" id="cc" name="payment_mode" value="razorpay" checked>-->
                                </label>
                            </div>
                            <div class="">
                                <label for="ccr">
                                    <span class="cc-icon"><img src="<?= Yii::$app->request->baseUrl ?>/images/credit-card.png" width="" height="" alt="Credit Card"></span>
                                    Pay with Cards
                                    <!--<input type="radio" id="cc" name="payment_mode" value="HDFC">-->
                                    <input type="radio" id="ccr" name="payment_mode" value="razorpay">
                                </label>
                            </div>
                            <!--<div class="margin-zero">
                                <label for="wt">
                                    <span class="cc-icon"><img src="<?= Yii::$app->request->baseUrl ?>/images/money-transfer.png" width="" height="" alt="Credit Card"></span>
                                    Pay with Wire Transfer  <input type="radio" id="wt" name="payment_mode" value="Wire Transfer" disabled></label>
                            </div>-->
                        </div>
                        <div class="billing-form">
                            <p>Billing Address</p>
                            <div class="row row-mar">
                                <div class="col-md-6 mb-3 col-padding">
                                    <label for="firstName">First name</label>
                                    <input type="text" class="form-control" id="firstName" name="f_name" placeholder="" value="" onblur="essentialChecks(this)" required>
                                    <div class='error fname_err'></div>
                                </div>
                                <div class="col-md-6 mb-3 col-padding">
                                    <label for="lastName">Last name</label>
                                    <input type="text" class="form-control" id="lastName" name="l_name" placeholder="" value="">
                                    <div class='error lname_err'></div>
                                </div>
                            </div>
                            <div class="row row-mar">
                                <div class="col-md-4 mb-3 col-padding">
                                    <label for="Email">Email</label>
                                    <input type="email" class="form-control" id="Email" name="email" placeholder="" onblur="essentialChecks(this)" required>
                                    <div class='error email_err'></div>
                                </div>
                                <div class="col-md-4 mb-3 col-padding">
                                    <label for="Company">Company Name</label>
                                    <input type="text" class="form-control" id="Company" name="company_name" placeholder="" onblur="essentialChecks(this)" required>
                                    <div class='error company_err'></div>
                                </div>
                                <div class="col-md-4 mb-3 col-padding">
                                    <label for="Contact">Contact Number</label>
                                    <input type="number" class="form-control" id="Contact" name="contact_number" placeholder="" onblur="essentialChecks(this)" required>
                                    <div class='error phone_err'></div>
                                </div>
                            </div>
                            <div class="mb-3 ">
                                <label for="address">Address</label>
                                <textarea class="form-control" id="address" name="address" placeholder="Enter full address along with Country State Zipcode " rows="5" onblur="essentialChecks(this)" required></textarea>
                                <div class='error address_err'></div>
                            </div>
                            <div class="row row-mar">
                                <div class="col-md-6 mb-3 col-padding">
                                    <div class="g-recaptcha" data-sitekey="6LfezHYUAAAAALY0cymolKIrIfCgt689OVzCoQeY" style="transform:scale(0.77);-webkit-transform:scale(0.77);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix">
                    <div class="checkout-coantainer-btn">
                        <?php if (!empty($report['slp']) || !empty($report['clp'])) { ?>
                            <div class="md-3">
                                <button type="submit" class="btn-block">Proceed to Payment</button>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div>
                    <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>">
                    <input type="hidden" name="report_id" value="<?= $reportId ?>">
                    <input type="hidden" name="title" value="<?= !empty($report['title']) ? $report['title'] : NULL; ?>">
                    <input type="hidden" name="discount" value="" id="discount">
                    <input type="hidden" name="utmParam" value="<?php echo $utmParam; ?>">
                </div>
            </form>
        </div>
    </div>
</div>