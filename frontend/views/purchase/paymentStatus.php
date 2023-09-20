<?php

use yii\helpers\Url;

//print_r($arrOrderDtls);exit;
?>
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

