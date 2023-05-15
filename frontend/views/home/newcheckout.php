<?php

use yii\helpers\Url;
?>
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
            <div class="col-md-1 cir1">
                <p class="mt-5 d-flex justify-content-center">Step1</p>
                <h6><i class="fa-solid fa-check"></i></h6>
            </div>
            <div class="col-md-1 cir2">
                <p class="mt-5 d-flex justify-content-center">Step2</p>
            </div>
            <div class="col-md-1 cir3">
                <p class="mt-5 d-flex justify-content-center">Step3</p>
            </div>
        </div>
    </div>

    <form>
        <div class="billing-main-sec p-5">
            <div class="bill-review-sec-con">
                <div class="row billing-review-sec pb-5">
                    <div class="col-md-5   mx-auto">
                        <h4 class="text-center mt-3"> Billing Address</h4>
                        <div class="container mt-1">
                            <div class="row ">
                                <div class="col-lg-12">
                                    <form>
                                        <div class="row g-3">
                                            <div class="col-md-12">
                                                <label for="first-name" class="form-labelc pb-1">First Name</label>
                                                <input type="text" class="form-control" id="first-name" name="first-name" required>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="last-name" class="form-label pb-1">Last Name</label>
                                                <input type="text" class="form-control" id="last-name" name="last-name" required>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="email" class="form-labelpb-1">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" required>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="company-name " class="form-label pb-1">Company
                                                    Name</label>
                                                <input type="text" class="form-control" id="company-name" name="company-name">
                                            </div>
                                            <div class="col-md-12">
                                                <label for="contact-number" class="form-label pb-1">Contact
                                                    Number</label>
                                                <input id="form_phone" type="tel" name="phone" class="form-control" name="contact-number">
                                            </div>
                                            <div class="col-12">
                                                <label for="adress" class="form-label pb-1">Adress</label>
                                                <textarea class="form-control" placeholder="Enter full address along with Country State Zipcode" id="adress" name="adress" rows="5" required></textarea>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 px-4 mx-auto">

                        <h4 class="text-center mt-3"> Review Order</h4>
                        <h6>Report</h6>
                        <h5>Pakistan Sugarcane Market: By Type (Crystallized Sugar and Non-Crystallized Sugar); By
                            Product type
                            (Raw, Refined, Brown and others) By End-user (Sweetener, Bakery Products, Confectionery,
                            Beverages
                            and others); & By Geography - Forecast(2021 - 2026)</h5>
                        <h6 class="mt-2"> Format Type:<img class="mx-2" src="<?= Url::to('/images/excel-doc.png') ?>"></h6>
                        <h6 class="mt-3">Licence Type</h6>
                        <div class="row mt-3 justify-content-center">
                        
                            <div class="col-md-4 ">
                                <div class="form-check px-4 ps-5">
                                    <input class="form-check-input mt-3 " type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                                    <label class="form-check-label ms-2" for="exampleRadios1">
                                        Basic User<br>
                                        $ 4900
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4 ">
                                <div class="form-check px-4 ps-5">
                                    <input class="form-check-input mt-3" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                                    <label class="form-check-label ms-2" for="exampleRadios2">
                                        Advanced User<br>
                                        $ 6900
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4 ">
                                <div class="form-check px-4 ps-5">
                                    <input class="form-check-input mt-3" type="radio" name="exampleRadios" id="exampleRadios3" value="option3">
                                    <label class="form-check-label ms-2" for="exampleRadios3">
                                        Expert User<br>
                                        $ 9500
                                    </label>
                                </div>
                            </div>
                        </div>
                        <h6 class="mt-3">Have a Promo Code ?</h6>
                        <div class="input-group mb-3 mt-2">
                            <input type="text" class="form-control p-1" placeholder="Promo Code" name="promo-code">
                            <button type="submit" class="btn">Apply</button>
                        </div>
                        <div class="prise-row d-flex justify-content-between align-items-center mt-3">
                            <h6>Discount</h6>
                            <h6>$ 0</h6>
                        </div>
                        <div class="prise-row2 d-flex justify-content-between align-items-center mt-2">
                            <h6>Total</h6>
                            <h6>$4900</h6>
                        </div>
                        <div class="payment-sec">
                            <div class="row mt-3 justify-content-between ">
                                <div class="col-md-5 ">
                                    <div class="form-check1 px-4 pb-2 ps-2">
                                        <input class="form-check1-input mt-3 " type="radio" name="exampleRadios1" id="exampleRadios1" value="option1" checked>
                                        <label class="form-check1-label ms-2" for="exampleRadios1">
                                            Paypal
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-5 ">
                                    <div class="form-check1 px-4 pb-2 ps-2">
                                        <input class="form-check2-input mt-3" type="radio" name="exampleRadios1" id="exampleRadios2" value="option2">
                                        <label class="form-check2-label ms-2" for="exampleRadios2">
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
                            <div class="row d-flex justify-content-between align-items-center mt-4">
                                <div class=" col-6 	g-recaptcha" data-sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI"></div>
                                <div class="col-6 ">
                                    <button class=" process-btn type="submit">Proceed to Payment</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>