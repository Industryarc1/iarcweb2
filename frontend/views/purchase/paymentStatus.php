<?php

use yii\helpers\Url;

//print_r($arrOrderDtls);exit;
?>
 <style>@import url('https://fonts.googleapis.com/css2?family=Montserrat&display=swap');
         body {
         /*background-color: #337ab7;*/
         font-family: 'Montserrat', sans-serif
         }
         .card {
         border: none
         }
         .totals tr td {
         font-size: 13px
         }
         .footer {
         background-color: #eeeeeea8
         }
         .footer span {
         font-size: 12px
         }
         .product-qty span {
         font-size: 12px;
         color: #dedbdb
         }
</style>

<div class="row child-nav">
    <div class="breadcrumb col-8">
        <ul>
            <li><a href="<?= Yii::$app->request->baseUrl ?>">Home</a></li>
            <li>Order Status</li>
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
                <a href="javascript:void(0);"><img src="<?= Yii::$app->request->baseUrl ?>/images/twitter.png" width="" height="" alt="Twitter"></a>
                <a href="javascript:void(0);"><img src="<?= Yii::$app->request->baseUrl ?>/images/pinterest.png" width="" height="" alt="Pinterest"></a>
            </span>
        </div>
    </div>
</div>
<div class="main-content payment-page">
    <div class="content-area">
        <div class="ordr-thnk-hdr"><?= ($payStatus == 'SUCCESS') ? 'Payment Done successfully' : 'Payment Failed! ' ?></div>


<?php
/*echo "<pre>";
print_r($arrOrderDtls);
echo "</pre>";
*/
?>

<div class="container mt-5 mb-5">
         <div class="row d-flex justify-content-center">
            <div class="col-md-8">
               <div class="card">
                 
                  <div class="invoice p-5">
                     <p class="text-center"><img src="/images/Arc_logo.png" style="width: 30%;"></p> 
                     <h5>Your order Confirmed!</h5>
                     <span class="font-weight-bold d-block mt-4">Hello, <?= $arrOrderDtls['f_name'] . ' ' . $arrOrderDtls['l_name'] ?></span> <span>Below are the order details</span>
                     <div class="payment border-top mt-3 mb-3 border-bottom table-responsive">
                        <table class="table table-borderless">
                           <tbody>
                              <tr>
                                 <td>
                                    <div class="py-2"> <span class="d-block">Order Date</span> 
                                        <span><?= date('d F, Y');?></span> 
                                    </div>
                                 </td>
                                 <td>
                                    <div class="py-2"> <span class="d-block">Order No</span> <span><?= $arrOrderDtls['order_id']; ?></span> </div>
                                 </td>
                                 <td>
                                    <div class="py-2"> <span class="d-block">Payment</span> <?= ucfirst($pay_mode)?> </div>
                                 </td>
                                 <td>
                                    <div class="py-2"> <span class="d-block">Licence Type</span> 
                                        
                                        <?php
                                        $licence_type = "";
                                        if($arrOrderDtls["licence_type"]=="SL"){
                                            $licence_type = "Basic";
                                        }
                                        if($arrOrderDtls["licence_type"]=="CL"){
                                            $licence_type = "Advanced";
                                        }
                                        if($arrOrderDtls["licence_type"]=="EL"){
                                            $licence_type = "Expert";
                                        }


                                        ?>
                                        <span><?= $licence_type?></span> 
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
                                    <p class=""><b>Report Code : <?= $arrOrderDtls["report_code"]?> <br>Report Title:  </b></p>
                                    <span class=""><?= $arrOrderDtls['title'] ?></span>
                                    <div class="product-qty" hidden> <span class="d-block"> By Solder (Copper pillar, Tin, Tin-Lead, Lead free, High Lead, Gold, Electrically Conductive Epoxy Adhesives, Eutectic, Others)</span></div>
                                 </td>
                                 <td width="20%">
                                    <div> <span class="font-weight-bold">$<?= $arrOrderDtls['licence_amount']?></span> </div>
                                 </td>
                              </tr> 
                           </tbody>
                        </table>
                     </div>

                     <div class="row" style="margin:0px 15px">
                        <div class="col-md-12">
                             <p class="mar-btm-30"><br><b>Delivery Details:</b><br/>

                            <span><?= $arrOrderDtls['f_name'] . ' ' . $arrOrderDtls['l_name'] ?></span><br/>
                            <span>Email: <?= $arrOrderDtls['user_id']; ?></span><br/>
                            <span>Ph No: <?= $arrOrderDtls['contact_number']; ?></span>
                        </p>
                        <p class="mar-btm-30"><b>Billing Address :</b><br/>
                            <?= $arrOrderDtls['address'] ?>
                        </p>

                        </div>    
                     </div>   
                     
                     <p>We will be sending across the full report PDF and quantitative excel data to your email directly in 48-72 hours.</p>
                     <p class="font-weight-bold mb-0"><i>Thanks for choosing IndustryARC as your preferred market research vendor.</i></p>
                     <span>IndustryARC Team</span>
                  </div>
                  <div class="d-flex justify-content-between footer p-3"> <span>Need Help? visit our <a href="/contact-us.php"> help center</a></span> <span><?= date('d F, Y');?></span> </div>
               </div>
            </div>
         </div>
      </div>



        <div class="main-txt" hidden>

            <div class="clearfix padd-top-20 ordr-review-block">

                <div class="order-review-bl">
                    <div class="ordr-dtl-section p-relative"><div class="brdr-hdr">Order number : <b><?= $arrOrderDtls['order_id']; ?></b> <div class="f-right"><button class="print-btn">Print</button></div></div>

                    </div>
                    <div class="ordr-dtl-section"><div class="brdr-hdr">Order Details</div>
                        <b>Report</b>
                        <p><?= $arrOrderDtls['title'] ?></p>
                    </div>
                    <div class="ordr-dtl-section"><div class="brdr-hdr">Billing Details</div>
                        <p class="mar-btm-30"><b>Delivery for:</b><br/>

                            <span><?= $arrOrderDtls['f_name'] . ' ' . $arrOrderDtls['l_name'] ?></span><br/>
                            <span>Email: <?= $arrOrderDtls['user_id']; ?></span><br/>
                            <span>Ph No: <?= $arrOrderDtls['contact_number']; ?></span>
                        </p>
                        <p class="mar-btm-30"><b>Billing Address :</b><br/>
							<?= $arrOrderDtls['address'] ?>
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
                                    <td align="right">$ <?= $arrOrderDtls['licence_amount'] ?></td>
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
                                    <td align="right">$ <?= $arrOrderDtls['licence_amount'] ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

