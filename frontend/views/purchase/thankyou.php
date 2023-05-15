<?php

use yii\helpers\Html;
use yii\helpers\Url;

$session = Yii::$app->session;

?>
<link rel="stylesheet" href="<?= Url::to('/css/thankyou.css') ?>">
<script src="https://kit.fontawesome.com/4fa1db5095.js" crossorigin="anonymous"></script>

<body>
<div class="main-content payment-page">
    <div class="content-area">
        <div class="ordr-thnk-hdr">Payment Done successfully</div>



<div class="container mt-5 mb-5">
         <div class="row d-flex justify-content-center">
            <div class="col-md-8">
               <div class="card">
                 
                  <div class="invoice p-5">
                     <p class="text-center"><img src="/images/Arc_logo.png" alt="img" style="width: 30%;"></p> 
                     <h5>Your Order is Confirmed! </h5>
                     <span class="font-weight-bold d-block mt-4">Hello, Ray Frazier</span> <span>Below are the order details:</span>
                     <div class="payment border-top mt-3 mb-3 border-bottom table-responsive">
                        <table class="table table-borderless">
                           <tbody>
                              <tr>
                                 <td>
                                    <div class="py-2"> <span class="d-block">Order Date</span> 
                                        <span>03 May, 2023</span> 
                                    </div>
                                 </td>
                                 <td>
                                    <div class="py-2"> <span class="d-block">Order No</span> <span>2pdsyvh9</span> </div>
                                 </td>
                                 <td>
                                    <div class="py-2"> <span class="d-block">Payment Gateway</span> Razorpay </div>
                                 </td>
                                 <td>
                                    <div class="py-2"> <span class="d-block">Licence Type</span> 
                                        
                                                                                <span>Basic</span> 
                                    </div>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                     <div class="product border-bottom table-responsive">
                        <table class="table table-borderless">
                           <tbody>
                              <tr>
                                 <td width="60%">
                                    <p class=""><b>Report Code : AGR 0006 <br></b></p>
                                    <span class=""><b>Report Title:</b>  <br>Farm Equipment Market: By Type (Tractors, Fertilizing, Plant Protection Equipment, Harvesting Equipment, Irrigation Equipment, Hay and Forage Equipment, Crop processing Equipment, Seeding Equipment, Grain Handling Equipment, Cutters and Shredders, Sprayers ); By Phase (Land Development, Sowing, Planting, Cultivation, Harvesting, Threshing, Others); By Application (Agri Equipment, Construction Equipment, Chemical Applications, Financing Equipment,  Material Handling Equipment, Snow Removal Equipment, Property Maintainance Equipment); By Geography - Forecast (2021-2026)</span>
                                    <div class="product-qty" hidden=""> <span class="d-block"> By Solder (Copper pillar, Tin, Tin-Lead, Lead free, High Lead, Gold, Electrically Conductive Epoxy Adhesives, Eutectic, Others)</span></div>
                                 </td>
                                 <td width="20%">
                                    <div> <span class="font-weight-bold">Amount (USD$)</span>
                                          <p class="text-center font-weight-bold">$4500</p>
                                     </div>
                                 </td>
                              </tr> 
                           </tbody>
                        </table>
                     </div>

                     <div class="row" style="margin:0px 15px">
                        <div class="col-md-12">
                             <p class="mar-btm-30"><br><b>Delivery Details:</b><br>

                            <span>Ray Frazier</span><br>
                            <span>Email: tugy@mailinator.com</span><br>
                            <span>Ph No: 343</span>
                        </p>
                        <p class="mar-btm-30"><b>Billing Address :</b><br>
                            Libero consectetur                         </p>

                        </div>    
                     </div>   
                     
                     
                     <p>
                        We will be sending across the full report PDF and quantitative excel data to your email directly in 48-72 hours.                     </p>

                     <p class="font-weight-bold mb-0"><i>Thanks for choosing IndustryARC as your preferred market research vendor.</i></p>
                     <span>IndustryARC Team</span>
                     <p>
                        Email : <a href="mailto:sales@industryarc.com">sales@industryarc.com</a><br>
                        Phone : <a href="tel:+1970-236-3677">+1970-236-3677</a>
                     </p>
                  </div>
                  <div class="d-flex justify-content-between footer p-3"> <span>Need Help? visit our <a href="/contact-us.php"> help center</a></span> <span>03 May, 2023</span> </div>
               </div>
            </div>
         </div>
      </div>



        <div class="main-txt" hidden="">

            <div class="clearfix padd-top-20 ordr-review-block">

                <div class="order-review-bl">
                    <div class="ordr-dtl-section p-relative"><div class="brdr-hdr">Order number : <b>2pdsyvh9</b> <div class="f-right"><button class="print-btn">Print</button></div></div>

                    </div>
                    <div class="ordr-dtl-section"><div class="brdr-hdr">Order Details</div>
                        <b>Report</b>
                        <p>Farm Equipment Market: By Type (Tractors, Fertilizing, Plant Protection Equipment, Harvesting Equipment, Irrigation Equipment, Hay and Forage Equipment, Crop processing Equipment, Seeding Equipment, Grain Handling Equipment, Cutters and Shredders, Sprayers ); By Phase (Land Development, Sowing, Planting, Cultivation, Harvesting, Threshing, Others); By Application (Agri Equipment, Construction Equipment, Chemical Applications, Financing Equipment,  Material Handling Equipment, Snow Removal Equipment, Property Maintainance Equipment); By Geography - Forecast (2021-2026)</p>
                    </div>
                    <div class="ordr-dtl-section"><div class="brdr-hdr">Billing Details</div>
                        <p class="mar-btm-30"><b>Delivery for:</b><br>

                            <span>Ray Frazier</span><br>
                            <span>Email: tugy@mailinator.com</span><br>
                            <span>Ph No: 343</span>
                        </p>
                        <p class="mar-btm-30"><b>Billing Address :</b><br>
							Libero consectetur                         </p>
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
                                <tbody><tr>
                                    <td><b>Single User</b> </td>
                                    <td align="right">$ 4500</td>
                                </tr>

							  <!-- <tr>
								  <td><b>Promo Discount</b></td>
								  <td align="right">$ 0</td>
								</tr>-->
                                <tr>
                                    <td></td>
                                    <td align="right"></td>
                                </tr>

                                <tr>
                                    <td colspan="2" style="border-top:1px solid #d5d5d5" height="5"></td>
                                </tr>
                                <tr>
                                    <td><b>Total Amount</b></td>
                                    <td align="right">$ 4500</td>
                                </tr>
                            </tbody></table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>