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


<div class="container mt-5 mb-5">
         <div class="row d-flex justify-content-center">
            <div class="col-md-8">
               <div class="card">
                 
                  <div class="invoice p-5">
                     <h5>Your order Confirmed!</h5>
                     <span class="font-weight-bold d-block mt-4">Hello,     Name</span> <span>You order has been confirmed and will be shipped in next two days!</span>
                     <div class="payment border-top mt-3 mb-3 border-bottom table-responsive">
                        <table class="table table-borderless">
                           <tbody>
                              <tr>
                                 <td>
                                    <div class="py-2"> <span class="d-block text-muted">Order Date</span> <span>05 March, 2023</span> </div>
                                 </td>
                                 <td>
                                    <div class="py-2"> <span class="d-block text-muted">Order No</span> <span>INARC12332345</span> </div>
                                 </td>
                                 <td>
                                    <div class="py-2"> <span class="d-block text-muted">Payment</span> <span><img src="https://img.icons8.com/color/48/000000/mastercard.png" width="20"></span> </div>
                                 </td>
                                 <td>
                                    <div class="py-2"> <span class="d-block text-muted">Shiping Address</span> <span>Hyderabad</span> </div>
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
                                    <span class="font-weight-bold">Flip Chip Market</span>
                                    <div class="product-qty"> <span class="d-block"> By Solder (Copper pillar, Tin, Tin-Lead, Lead free, High Lead, Gold, Electrically Conductive Epoxy Adhesives, Eutectic, Others)</span></div>
                                 </td>
                                 <td width="20%">
                                    <div class="text-right"> <span class="font-weight-bold">$6750</span> </div>
                                 </td>
                              </tr> 
                           </tbody>
                        </table>
                     </div>
                     <div class="row d-flex justify-content-end">
                        <div class="col-md-5">
                           <table class="table table-borderless">
                              <tbody class="totals">
                                 <tr>
                                    <td>
                                       <div class="text-left"> <span class="text-muted">Subtotal</span> </div>
                                    </td>
                                    <td>
                                       <div class="text-right"> <span>$168.50</span> </div>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td>
                                       <div class="text-left"> <span class="text-muted">Shipping Fee</span> </div>
                                    </td>
                                    <td>
                                       <div class="text-right"> <span>$22</span> </div>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td>
                                       <div class="text-left"> <span class="text-muted">Tax Fee</span> </div>
                                    </td>
                                    <td>
                                       <div class="text-right"> <span>$7.65</span> </div>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td>
                                       <div class="text-left"> <span class="text-muted">Discount</span> </div>
                                    </td>
                                    <td>
                                       <div class="text-right"> <span class="text-success">$168.50</span> </div>
                                    </td>
                                 </tr>
                                 <tr class="border-top border-bottom">
                                    <td>
                                       <div class="text-left"> <span class="font-weight-bold">Subtotal</span> </div>
                                    </td>
                                    <td>
                                       <div class="text-right"> <span class="font-weight-bold">$238.50</span> </div>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                     <p>We will be sending shipping confirmation email when the item shipped successfully!</p>
                     <p class="font-weight-bold mb-0">Thanks for shopping with us!</p>
                     <span>IndustryARC Team</span>
                  </div>
                  <div class="d-flex justify-content-between footer p-3"> <span>Need Help? visit our <a href="#"> help center</a></span> <span>05 March, 2023</span> </div>
               </div>
            </div>
         </div>
      </div>



        <div class="main-txt">

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

