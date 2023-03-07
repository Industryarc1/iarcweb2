<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<?php
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
.rounded {
  border-radius: 15px !important;
}

.hidden {
  visibility: hidden;
  opacity: 0;
}

.bg-teal {
/*  background: #34cb85;*/
}

.btn {
  transition: all 0.25s ease-in-out;
}

.btn-teal {
  background: #0E5CA3;
  color: #fff;
}
.btn-teal:hover {
  background: #212529;
  color: #fff;
}

.pricing-intro .sub-title {
  font-size: 1.15em;
}

.pricing-plan {
  background: #f7f7f7;
  border: 1px solid #fff;
  cursor: pointer;
  transition: all 0.25s ease-in-out;
}
.pricing-plan:hover {
  background: #34cb85;
  color: #fff;
}
.pricing-plan.active-btn {
  background: #34cb85;
  color: #fff;
}
.pricing-plan h4 {
  font-size: 1em;
}

.pricing-table h2 {
  font-size: 1.2em;
}
.pricing-table .sub-title {
  font-size: 0.7em;
  font-weight: initial;
}
.pricing-table .active-plan {
  display: block !important;
}

.col-compare .title-row {
  border-top-left-radius: 10px;
}

.col-enterprise .title-row {
  border-top-right-radius: 10px;
}

.pricing-compare {
  border-top-left-radius: 10px;
  border-bottom-left-radius: 10px;
}

.pricing-enterprise {
  border-bottom-right-radius: 10px;
}

.col-pricing:hover {
  z-index: 1;
}

.pricing-single {
  background: #f7f7f7;
  min-height: 400px;
  margin-left: 1px;
  margin-right: 1px;
  transition: all 0.25s ease-in-out;
}
.pricing-single:hover:not(.pricing-compare) {
  box-shadow: 0 0 30px rgba(0, 0, 0, 0.25);
  transform: scale(1.005);
}
.pricing-single:last-of-type {
  border-top-right-radius: 10px;
}

.title-row {
  background: #0E5CA3;
  color: #fff;
  min-height: 60px;
  padding: 0 10px;
}

.pricing-popular {
  min-height: 40px;
  border-radius: 5px;
  z-index: 2;
}
.pricing-popular h4 {
  font-size: 1em;
}
.pricing-popular.active {
  background: #62bdde;
  color: #fff;
}

.col-popular .pricing-single {
  background: #62bdde;
}
.col-popular .bg-teal {
/*  background: #fff;*/
}
.col-popular .btn-teal {
  background: #fff;
  color: #212529;
}
.col-popular .btn-teal:hover {
  background: #212529;
  color: #fff;
}

.cost-row {
  border-bottom: 1px solid #fff;
  min-height: 120px;
}
.cost-row .cost {
  font-size: 1.5em;
  font-weight: 800;
  line-height: 1em;
}

.compare-item-row {
  border-bottom: 1px solid #fff;
  height: 35px;
}
.compare-item-row:last-of-type {
  border-bottom: none;
}
.compare-item-row .circle {
  height: 20px;
  width: 20px;
  border-radius: 50%;
}


.compare-item-row .circle {
    position: relative;
    display: inline-block;
}

.compare-item-row .circle::before {
    position: absolute;
    left: 0;
    top: 50%;
    height: 50%;
    width: 3px;
    background-color: #336699;
    content: "";
    transform: translateX(10px) rotate(-45deg);
    transform-origin: left bottom;
}

.compare-item-row .circle::after {
    position: absolute;
    left: 0;
    bottom: 0;
    height: 3px;
    width: 100%;
    background-color: #336699;
    content: "";
    transform: translateX(10px) rotate(-45deg);
    transform-origin: left bottom;
}


.cross{
        display: inline-block;
        width: 15px;
        height: 15px;
/*        border: 7px solid #fff;*/
        background:
            linear-gradient(45deg, rgba(0,0,0,0) 0%,rgba(0,0,0,0) 43%,#000 45%,#000 55%,rgba(0,0,0,0) 57%,rgba(0,0,0,0) 100%),
            linear-gradient(135deg, #fff 0%,#fff 43%,#000 45%,#000 55%,#fff 57%,#fff 100%);
    }
.compare-item-row .compare-title {
 font-weight: 600;
    font-size: 13px;
}

@media screen and (max-width: 1199px) {
  .compare-item-row {
    height: 70px;
  }
}
@media screen and (max-width: 991px) {
  .pricing-table {
    font-size: 14px;
  }
}
@media screen and (max-width: 767px) {
  .pricing-single:not(.pricing-compare) {
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px;
  }
  .pricing-single:not(.pricing-compare) .title-row {
    border-top-right-radius: 10px;
  }

  .pricing-single:hover {
    box-shadow: none !important;
    transform: none !important;
  }
}
@media screen and (max-width: 460px) {
  .cost-row .cost {
    font-size: 2.5em;
  }

  .compare-item-row {
    height: 80px;
  }
}
</style>

<div class="row child-nav">
    <div class="breadcrumb col-8 ">
        <ul>
            <li><a href="<?= Url::to(['site/index']); ?>">Home</a></li>
            <li>View Licenses</li>
        </ul>
    </div>
</div>

<!-- partial-->
<div class='container my-5'>
  <div class='row pricing-intro'>
    <div class='col-12 col-md-10 col-lg-8 mx-auto text-center'>
      <h4>Select a license type that suits your business needs</h4>
    </div>
  </div>
  <div class='row d-block d-md-none pricing-plans d-flex justify-content-center mb-2'>
    <div class='col-4 pricing-plan text-center' data-plan='basic-plan'>
      <h4 class='py-3 mb-0'>Basic</h4>
    </div>
    <div class='col-4 pricing-plan text-center active-btn' data-plan='pro-plan'>
      <h4 class='py-3 mb-0'>Advanced</h4>
    </div>
    <div class='col-4 pricing-plan text-center' data-plan='enterprise-plan'>
      <h4 class='py-3 mb-0'>Expert</h4>
    </div>
  </div>
  <div class='row pricing-table'>
    <div class='col-6 col-md-3 px-0 col-compare'>
      <div class='pricing-popular mb-2'></div>
      <div class='pricing-single pricing-compare'>
        <div class='title-row d-flex justify-content-start align-items-center px-3'>
          <div class='title-wrap'>
            <h2>Compare Plans</h2>
            <!-- <h4 class='sub-title mb-0'>Additional fees may apply</h4> -->
          </div>
        </div>
        <div class='cost-row d-flex justify-content-start align-items-center px-3'>
          <div class='cost-wrap'>
            <h3 class='cost mb-1'>Chapters Available</h3>
          </div>
        </div>
<div class='compare-item-row d-flex justify-content-start align-items-center px-3'>
          <span class='compare-title'>Overview</span></div>
<div class='compare-item-row d-flex justify-content-start align-items-center px-3'>
          <span class='compare-title'>Executive Summary</span></div>
<div class='compare-item-row d-flex justify-content-start align-items-center px-3'>
          <span class='compare-title'>Market Landscape</span></div>
<div class='compare-item-row d-flex justify-content-start align-items-center px-3'>
          <span class='compare-title'>Startup Company Scenario</span></div>
<div class='compare-item-row d-flex justify-content-start align-items-center px-3'>
          <span class='compare-title'>Market Entry Scenario</span></div>
<div class='compare-item-row d-flex justify-content-start align-items-center px-3'>
          <span class='compare-title'>Market Forces</span></div>
<div class='compare-item-row d-flex justify-content-start align-items-center px-3'>
          <span class='compare-title'>Strategic Analysis</span></div>
<div class='compare-item-row d-flex justify-content-start align-items-center px-3'>
          <span class='compare-title'>By Product & All Types listed</span></div>
<div class='compare-item-row d-flex justify-content-start align-items-center px-3'>
          <span class='compare-title'>By Geography</span></div>
<div class='compare-item-row d-flex justify-content-start align-items-center px-3'>
          <span class='compare-title'>By Application/End Use</span></div>
<div class='compare-item-row d-flex justify-content-start align-items-center px-3'>
          <span class='compare-title'>Market Entropy</span></div>
<div class='compare-item-row d-flex justify-content-start align-items-center px-3'>
          <span class='compare-title'>Market Share - Global Top 10</span></div>
<div class='compare-item-row d-flex justify-content-start align-items-center px-3'>
          <span class='compare-title'>Market Share by Country & Region</span></div>
<div class='compare-item-row d-flex justify-content-start align-items-center px-3'>
          <span class='compare-title'>Key Company List by Country</span></div>
<div class='compare-item-row d-flex justify-content-start align-items-center px-3'>
          <span class='compare-title'>Company Analysis</span></div>
<div class='compare-item-row d-flex justify-content-start align-items-center px-3'>
          <span class='compare-title'>Cross Segmentation</span></div>
<div class='compare-item-row d-flex justify-content-start align-items-center px-3'>
          <span class='compare-title'>By Geography x By Application</span></div>
<div class='compare-item-row d-flex justify-content-start align-items-center px-3'>
          <span class='compare-title'>By Geography x By Product</span></div>
<div class='compare-item-row d-flex justify-content-start align-items-center px-3'>
          <span class='compare-title'>By Geography x By Product x By Application </span></div>
      </div>
    </div>
    <div class='d-none d-md-block col-6 col-md-3 px-0 col-pricing col-basic' id='basic-plan'>
      <div class='pricing-popular mb-2'></div>
      <div class='pricing-single pricing-basic'>
        <div class='title-row d-flex justify-content-center align-items-center'>
          <div class='title-wrap text-center'>
            <h2>Basic</h2>
            <!-- <h4 class='sub-title mb-0'>Essential services to resolve everyday tech headaches.</h4> -->
          </div>
        </div>
        <div class='cost-row d-flex justify-content-center align-items-center'>
          <div class='cost-wrap text-center'>
            <h3 class='cost mb-1'>$<?= !empty($report['slp'])?$report['slp']:0; ?></h3>
            <span class='d-block sub-title fw-bold mb-3'>2 Days / Report Devlivery Timeline</span>
            <a href="purchasereport.php?id=<?= $reportId?>&license_type=Basic" class='btn btn-teal btn-sm'>Buy Now</a>
          </div>
        </div>
        <div class='compare-item-row d-flex justify-content-center align-items-center'>
        <i class="fa fa-check"></i>

        </div>
        <div class='compare-item-row d-flex justify-content-center align-items-center'>
         <i class="fa fa-check"></i>
        </div>
        <div class='compare-item-row d-flex justify-content-center align-items-center'>
         <i class="fa fa-check"></i>
        </div>
        <div class='compare-item-row d-flex justify-content-center align-items-center'>
          <i class="fa fa-times"></i>
        </div>
        <div class='compare-item-row d-flex justify-content-center align-items-center'>
          <i class="fa fa-times"></i>
        </div>
        <div class='compare-item-row d-flex justify-content-center align-items-center'>
         <i class="fa fa-check"></i>
        </div>
        <div class='compare-item-row d-flex justify-content-center align-items-center'>
         <i class="fa fa-check"></i>
        </div>
        <div class='compare-item-row d-flex justify-content-center align-items-center'>
         <i class="fa fa-check"></i>
        </div>
        <div class='compare-item-row d-flex justify-content-center align-items-center'>
         <i class="fa fa-check"></i>
        </div>
        <div class='compare-item-row d-flex justify-content-center align-items-center'>
         <i class="fa fa-check"></i>
        </div>
        <div class='compare-item-row d-flex justify-content-center align-items-center'>
          <i class="fa fa-check"></i>
        </div>
        <div class='compare-item-row d-flex justify-content-center align-items-center'>
          <i class="fa fa-check"></i>
        </div>
        <div class='compare-item-row d-flex justify-content-center align-items-center'>
          <i class="fa fa-times"></i>
        </div>
        <div class='compare-item-row d-flex justify-content-center align-items-center'>
          <i class="fa fa-times"></i>
        </div>
        <div class='compare-item-row d-flex justify-content-center align-items-center'>
          <i class="fa fa-check"></i>
        </div>
        <div class='compare-item-row d-flex justify-content-center align-items-center'>
          <i class="fa fa-times"></i>
        </div>
        <div class='compare-item-row d-flex justify-content-center align-items-center'>
          <i class="fa fa-times"></i>
        </div>
        <div class='compare-item-row d-flex justify-content-center align-items-center'>
          <i class="fa fa-times"></i>
        </div>
        <div class='compare-item-row d-flex justify-content-center align-items-center'>
          <i class="fa fa-times"></i>
        </div>
      </div>
    </div>
    <div class='d-none d-md-block col-6 col-md-3 px-0 col-pricing col-pro col-popular active-plan' id='pro-plan'>
      <div class='pricing-popular active w-100 d-flex justify-content-center align-items-center mb-2'>
        <h4 class='mb-0'>Most Popular</h4>
      </div>
      <div class='pricing-single pricing-pro'>
        <div class='title-row d-flex justify-content-center align-items-center'>
          <div class='title-wrap text-center'>
            <h2>Advanced</h2>
            <!-- <h4 class='sub-title mb-0'>Advanced services to meet the needs of small and mid-market businesses.</h4> -->
          </div>
        </div>
        <div class='cost-row d-flex justify-content-center align-items-center'>
          <div class='cost-wrap text-center'>
            <h3 class='cost mb-1'>$<?= !empty($report['clp'])?$report['clp']:0; ?></h3>
            <span class='d-block sub-title fw-bold mb-3'>7 Days / Report Devlivery Timeline</span>
            <a href="purchasereport.php?id=<?= $reportId?>&license_type=Advanced" class='btn btn-teal btn-sm'>Buy Now</a>
          </div>
        </div>
        <div class='compare-item-row d-flex justify-content-center align-items-center'>
         <i class="fa fa-check"></i>
        </div>
        <div class='compare-item-row d-flex justify-content-center align-items-center'>
         <i class="fa fa-check"></i>
        </div>
        <div class='compare-item-row d-flex justify-content-center align-items-center'>
         <i class="fa fa-check"></i>
        </div>
        <div class='compare-item-row d-flex justify-content-center align-items-center'>
          <i class="fa fa-times"></i>
        </div>
        <div class='compare-item-row d-flex justify-content-center align-items-center'>
          <i class="fa fa-times"></i>
        </div>
        <div class='compare-item-row d-flex justify-content-center align-items-center'>
         <i class="fa fa-check"></i>
        </div>
        <div class='compare-item-row d-flex justify-content-center align-items-center'>
         <i class="fa fa-check"></i>
        </div>
        <div class='compare-item-row d-flex justify-content-center align-items-center'>
         <i class="fa fa-check"></i>
        </div>
        <div class='compare-item-row d-flex justify-content-center align-items-center'>
         <i class="fa fa-check"></i>
        </div>
        <div class='compare-item-row d-flex justify-content-center align-items-center'>
         <i class="fa fa-check"></i>
        </div>
        <div class='compare-item-row d-flex justify-content-center align-items-center'>
         <i class="fa fa-check"></i>
        </div>
        <div class='compare-item-row d-flex justify-content-center align-items-center'>
         <i class="fa fa-check"></i>
        </div>
        <div class='compare-item-row d-flex justify-content-center align-items-center'>
          <i class="fa fa-times"></i>
        </div>
        <div class='compare-item-row d-flex justify-content-center align-items-center'>
          <i class="fa fa-check"></i>
        </div>
        <div class='compare-item-row d-flex justify-content-center align-items-center'>
          <i class="fa fa-check"></i>
        </div>
        <div class='compare-item-row d-flex justify-content-center align-items-center'>
          <i class="fa fa-times"></i>
        </div>
        <div class='compare-item-row d-flex justify-content-center align-items-center'>
          <i class="fa fa-times"></i>
        </div>
        <div class='compare-item-row d-flex justify-content-center align-items-center'>
          <i class="fa fa-times"></i>
        </div>
        <div class='compare-item-row d-flex justify-content-center align-items-center'>
          <i class="fa fa-times"></i>
        </div>
      </div>
    </div>
    <div class='d-none d-md-block col-6 col-md-3 px-0 col-pricing col-enterprise' id='enterprise-plan'>
      <div class='pricing-popular mb-2'></div>
      <div class='pricing-single pricing-enterprise'>
        <div class='title-row d-flex justify-content-center align-items-center'>
          <div class='title-wrap text-center'>
            <h2>Expert</h2>
            <!-- <h4 class='sub-title mb-0'>Enterprise services w/ reports, server backups, and advanced Microsoft 365 licensing.</h4> -->
          </div>
        </div>
        <div class='cost-row d-flex justify-content-center align-items-center'>
          <div class='cost-wrap text-center'>
            <h3 class='cost mb-1'>$9500</h3>
            <span class='d-block sub-title fw-bold mb-3'>12 - 15 Days / Report Devlivery Timeline</span>
            <a href="purchasereport.php?id=<?= $reportId?>&license_type=Expert" class='btn btn-teal btn-sm'>Buy Now</a>
          </div>
        </div>
        <div class='compare-item-row d-flex justify-content-center align-items-center'>
         <i class="fa fa-check"></i>
        </div>
        <div class='compare-item-row d-flex justify-content-center align-items-center'>
         <i class="fa fa-check"></i>
        </div>
        <div class='compare-item-row d-flex justify-content-center align-items-center'>
         <i class="fa fa-check"></i>
        </div>
        <div class='compare-item-row d-flex justify-content-center align-items-center'>
         <i class="fa fa-check"></i>
        </div>
        <div class='compare-item-row d-flex justify-content-center align-items-center'>
         <i class="fa fa-check"></i>
        </div>
        <div class='compare-item-row d-flex justify-content-center align-items-center'>
         <i class="fa fa-check"></i>
        </div>
        <div class='compare-item-row d-flex justify-content-center align-items-center'>
         <i class="fa fa-check"></i>
        </div>
        <div class='compare-item-row d-flex justify-content-center align-items-center'>
         <i class="fa fa-check"></i>
        </div>
        <div class='compare-item-row d-flex justify-content-center align-items-center'>
         <i class="fa fa-check"></i>
        </div>
        <div class='compare-item-row d-flex justify-content-center align-items-center'>
         <i class="fa fa-check"></i>
        </div>
        <div class='compare-item-row d-flex justify-content-center align-items-center'>
         <i class="fa fa-check"></i>
        </div>
        <div class='compare-item-row d-flex justify-content-center align-items-center'>
         <i class="fa fa-check"></i>
        </div>
        <div class='compare-item-row d-flex justify-content-center align-items-center'>
          <i class="fa fa-check"></i>
        </div>
        <div class='compare-item-row d-flex justify-content-center align-items-center'>
         <i class="fa fa-check"></i>
        </div>
        <div class='compare-item-row d-flex justify-content-center align-items-center'>
         <i class="fa fa-check"></i>
        </div>
        <div class='compare-item-row d-flex justify-content-center align-items-center'>
         <i class="fa fa-check"></i>
        </div>
        <div class='compare-item-row d-flex justify-content-center align-items-center'>
         <i class="fa fa-check"></i>
        </div>
        <div class='compare-item-row d-flex justify-content-center align-items-center'>
         <i class="fa fa-check"></i>
        </div>
        <div class='compare-item-row d-flex justify-content-center align-items-center'>
         <i class="fa fa-check"></i>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- partial -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
	var planBtn = $('.pricing-plan');
var pricingCol = $('.col-pricing');

planBtn.click(function() {
  var planId = $(this).data('plan');
  var activePlan = $('#' + planId);

  planBtn.removeClass('active-btn');
  $(this).addClass('active-btn');
  pricingCol.removeClass('active-plan');
  activePlan.addClass('active-plan');
});
</script>