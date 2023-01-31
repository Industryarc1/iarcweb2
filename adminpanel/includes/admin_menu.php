<link href="css/acc_menu.css" rel="stylesheet" type="text/css">
<div class="leftmenu" >
<div class="head1"><i class="fa fa-cog"></i> Administration</div>
<ul id="accordion" class="accordion">
   
    <?php 
 if($pg=="reports.php" || $pg=="publishers.php" || $pg=="licences.php" || $pg=="enqs.php" || $pg=="addReports.php" || $pg=="addPublishers.php" || $pg=="addEnqs.php" || $pg=="addLicences.php" || $pg=="editReport.php" || $pg=="editPublisher.php" || $pg=="editEnq.php" || $pg=="editLicence.php"  ){
   $open1='class="open"';
  $st1='style="display:block" ';
 }else{
   $open1='';
  $st1='';
 }
 
 if($pg=="addCategory.php" || $pg=="addSubCategory.php" || $pg=="categories.php" || $pg=="editCategory.php"  ){
   $open1='class="open"';
  $st1='style="display:block" ';
 }else{
   $open1='';
  $st1='';
 }
 ?> 
  <li <?=$open1?>>
    <div class="link"><i class="fa fa-database"></i>Categories<i class="fa fa-chevron-down"></i></div>
    <ul class="submenu" <?=$st1?> >
       <li><div class="link1" ><i class="fa fa-chevron-right"></i> <a href="addCategory.php">Add Categories</a></div></li>
     <li><div class="link1" ><i class="fa fa-chevron-right"></i> <a href="addSubCategory.php">Add Sub Categories</a></div></li>
     <li><div class="link1" ><i class="fa fa-chevron-right"></i> <a href="categories.php">Categories</a></div></li>
    </ul>
  </li>
	
	<?php 
 if($pg=="addPosts.php" || $pg=="posts.php" || $pg=="editPost.php" || $pg=="uploadImages.php" || $pg=="addPost.php" || $pg=="filter.php" || $pg=="discount.php"){
   $open1='class="open"';
  $st1='style="display:block" ';
 }else{
   $open1='';
  $st1='';
 }
 ?> 
  <li <?=$open1?>>
    <div class="link"><i class="fa fa-bars"></i>Reports<i class="fa fa-chevron-down"></i></div>
    <ul class="submenu" <?=$st1?> >
       <li><div class="link1" ><i class="fa fa-chevron-right"></i> <a href="addPost.php">Add Reports</a></div></li>
     <li><div class="link1" ><i class="fa fa-chevron-right"></i> <a href="posts.php">View reports</a></div></li>
    
     <li><div class="link1" ><i class="fa fa-chevron-right"></i> <a href="uploadImages.php">Upload Images</a></div></li>
      <li><div class="link1" ><i class="fa fa-chevron-right"></i> <a href="filter.php">Latest & Top Reports</a></div></li>
      <li><div class="link1" ><i class="fa fa-chevron-right"></i> <a href="discount.php">Discount</a></div></li>
	  <li><div class="link1" ><i class="fa fa-chevron-right"></i> <a href="posts_rtts.php">RTTS Updates</a></div></li>
    </ul>
  </li>
	<?php 
	if($pg=="addUPost.php" || $pg=="uposts.php" || $pg=="editUPost.php" || $pg=="addExcelPost.php" || $pg=="editExcelPost.php"){
		$open1='class="open"';
		$st1='style="display:block" ';
	}else{
		$open1='';
		$st1='';
	}
	?> 
	<li <?=$open1?>>
		<div class="link"><i class="fa fa-bars"></i>Unpublished - Reports<i class="fa fa-chevron-down"></i></div>
		<ul class="submenu" <?=$st1?> >
			<li><div class="link1" ><i class="fa fa-chevron-right"></i> <a href="addUPost.php">Add Unpublished Report</a></div></li>
			<li><div class="link1" ><i class="fa fa-chevron-right"></i> <a href="uposts.php">View Unpublished reports</a></div></li>
			<li><div class="link1" ><i class="fa fa-chevron-right"></i> <a href="addExcelPost.php">Upload Unpublished Report</a></div></li>
			<li><div class="link1" ><i class="fa fa-chevron-right"></i> <a href="editExcelPost.php">Edit Uploaded Unpublished Report</a></div></li>
		</ul>
	</li>
	<?php 
 if($pg=="evnt_list.php" || $pg=="evnt_about.php" || $pg=="evnt_reports.php" || $pg=="evnt_whitepapers.php" || $pg=="evnt_videos.php" || $pg=="evnt_news.php" || $pg=="evnt_reports_add.php" || $pg=="evnt_whitepapers_add.php" || $pg=="evnt_videos_add.php" || $pg=="evnt_news.php" || $pg=="evnt_news_add.php"){
   $open1='class="open"';
  $st1='style="display:block" ';
 }else{
   $open1='';
  $st1='';
 }
 ?> 
  <li <?=$open1?>>
    <div class="link"><i class="fa fa-bars"></i>Events Consulting<i class="fa fa-chevron-down"></i></div>
    <ul class="submenu" <?=$st1?> >
      <li><div class="link1" ><i class="fa fa-chevron-right"></i> <a href="evnt_list.php">Events List</a></div></li>
			<li><div class="link1" ><i class="fa fa-chevron-right"></i> <a href="evnt_reports.php">Reports</a></div></li>
			<li><div class="link1" ><i class="fa fa-chevron-right"></i> <a href="evnt_whitepapers.php">White Papers</a></div></li>
			<li><div class="link1" ><i class="fa fa-chevron-right"></i> <a href="evnt_videos.php">Videos</a></div></li>
			<li><div class="link1" ><i class="fa fa-chevron-right"></i> <a href="evnt_news.php">News</a></div></li>
    </ul>
  </li>
	<?php 
 if($pg=="addevent.php" || $pg=="events.php" || $pg=="editevent.php" ){
   $open1='class="open"';
  $st1='style="display:block" ';
 }else{
   $open1='';
  $st1='';
 }
 ?> 
  <li <?=$open1?>>
    <div class="link"><i class="fa fa-calendar-o"></i>Events<i class="fa fa-chevron-down"></i></div>
    <ul class="submenu" <?=$st1?> >
       <li><div class="link1" ><i class="fa fa-chevron-right"></i> <a href="addevent.php">Add Events</a></div></li>
     <li><div class="link1" ><i class="fa fa-chevron-right"></i> <a href="events.php">View Events</a></div></li>
    </ul>
  </li>
  
    <!--Edited by Vishwadeep Singh-->
  	<?php 
 if($pg=="addwebinar.php" || $pg=="webinars.php" || $pg=="editwebinar.php" ){
   $open1='class="open"';
  $st1='style="display:block" ';
 }else{
   $open1='';
  $st1='';
 }
 ?> 
  <li <?=$open1?>>
    <div class="link"><i class="fa fa-calendar-o"></i>Webinar<i class="fa fa-chevron-down"></i></div>
    <ul class="submenu" <?=$st1?> >
       <li><div class="link1" ><i class="fa fa-chevron-right"></i> <a href="addwebinar.php">Add Webinar</a></div></li>
     <li><div class="link1" ><i class="fa fa-chevron-right"></i> <a href="webinars.php">View Webinar</a></div></li>
    </ul>
  </li>
  <!--Edited by Vishwadeep Singh-->
  
<?php if(isset($_SESSION['admin_id'])){ ?>  

  <?php 
 if($pg=="users.php" || $pg=="Registeredusers.php" || $pg=="addGalImages.php" || $pg=="subscribers.php"  || $pg=="addUsers.php" ){
   $open1='class="open"';
  $st1='style="display:block" ';
 }else{
   $open1='';
  $st1='';
 }
 ?> 
  <li <?=$open1?>>
    <div class="link"><i class="fa fa-user"></i> Users<i class="fa fa-chevron-down"></i></div>
    <ul class="submenu" <?=$st1?>>
      <li><div class="link1" ><i class="fa fa-chevron-right"></i> <a href="users.php">Admin Users</a></div></li>
    <li><div class="link1" ><i class="fa fa-chevron-right"></i> <a href="Registeredusers.php">Registered Users</a></div></li>
    <li><div class="link1" ><i class="fa fa-chevron-right"></i> <a href="addGalImages.php"> Users Documents</a></div></li>
    <li><div class="link1" ><i class="fa fa-chevron-right"></i> <a href="subscribers.php">Subscribers</a></div></li>
    </ul>
  </li>
  
<?php 
 if($pg=="ordersList.php" || $pg=="orderDetails.php"  ){
   $open1='class="open"';
  $st1='style="display:block" ';
 }else{
   $open1='';
  $st1='';
 }
 ?> 
  <li >
    <div class="link"><i class="fa fa-shopping-cart"></i> Orders<i class="fa fa-chevron-down"></i></div>
    <ul class="submenu" <?=$st1?>>
      <li><div class="link1" ><i class="fa fa-chevron-right"></i> <a href="ordersList.php">Orders</a></div></li>
      
    </ul>
  </li>
   <?php }?>
   <?php 
 if($pg=="updateContent.php" || $pg=="contactUs.php" || $pg=="addAddress.php" || $pg=="products.php" || $pg=="updateContactUS.php"  || $pg=="addProduct.php" || $pg=="editProduct.php" || $pg=="whitepapers.php"  || $pg=="addwhitepapers.php" || $pg=="editwhitepapers.php" || $pg=="prs.php"  || $pg=="addprs.php" || $pg=="editprs.php"){
   $open1='class="open"';
  $st1='style="display:block" ';
 }else{
   $open1='';
  $st1='';
 }
 ?> 
  <li <?=$open1?>>
    <div class="link"><i class="fa fa-pencil"></i> Content Pages<i class="fa fa-chevron-down"></i></div>
    <ul class="submenu" <?=$st1?>>
       <?php if(isset($_SESSION['admin_id'])){ ?>  
      <li><div class="link1" ><i class="fa fa-chevron-right"></i> <a href="updateContent.php">Update Content</a></div></li>
      <li><div class="link1" ><i class="fa fa-chevron-right"></i> <a href="updateContactUS.php">Update Contact Info </a></div></li>
      <li><div class="link1" ><i class="fa fa-chevron-right"></i> <a href="contactUs.php">Contact US</a></div></li>
    <?php } ?>
     <li><div class="link1" ><i class="fa fa-chevron-right"></i> <a href="products.php">Articles</a></div></li>
     <li><div class="link1" ><i class="fa fa-chevron-right"></i> <a href="whitepapers.php">White Papers</a></div></li>
     <li><div class="link1" ><i class="fa fa-chevron-right"></i> <a href="prs.php">Press Releases</a></div></li>
	 <li><div class="link1" ><i class="fa fa-chevron-right"></i> <a href="prs_rtts.php">RTTS PRS</a></div></li>
     
    </ul>
  </li>
  <?php if(isset($_SESSION['admin_id'])){ ?>  
  <?php 
 if($pg=="addCareers.php" || $pg=="editCareers.php" || $pg=="viewCareers.php"){
   $open1='class="open"';
  $st1='style="display:block" ';
 }else{
   $open1='';
  $st1='';
 }
 ?> 
  <li <?=$open1?>>
    <div class="link"><i class="fa fa-pencil"></i> Careers <i class="fa fa-chevron-down"></i></div>
    <ul class="submenu" <?=$st1?>>
      <li><div class="link1"><i class="fa fa-book"  ></i> <a href="addCareers.php">Add Careers</a></div></li>
      <li><div class="link1"><i class="fa fa-database"  ></i> <a href="viewCareers.php">View Careers</a></div></li>
    </ul>
  </li>
  <?php 
 if($pg=="viewLeads.php" || $pg=="viewSubscriptionLeads.php"  || $pg=="viewConsultingLeads.php" ){
   $open1='class="open"';
  $st1='style="display:block" ';
 }else{
   $open1='';
  $st1='';
 }
 ?> 
  <li <?=$open1?>>
    <div class="link"><i class="fa fa-pencil"></i> Leads <i class="fa fa-chevron-down"></i></div>
    <ul class="submenu" <?=$st1?>>
      <li><div class="link1"><i class="fa fa-book"  ></i> <a href="viewLeads.php">Leads </a></div></li>      
      <li><div class="link1"><i class="fa fa-book"  ></i> <a href="viewSubscriptionLeads.php">Subscriber Leads </a></div></li>      
      <li><div class="link1"><i class="fa fa-book"  ></i> <a href="viewConsultingLeads.php">Consulting Leads </a></div></li>      
    </ul>
  </li>
  
  
     <?php 
 if($pg=="blogs.php"  || $pg=="addBlog.php"  || $pg=="reviews.php" || $pg=="addBlog.php" || $pg=="addRLink.php" ||  $pg=="addCorpImages.php" || $pg=="recipes.php" || $pg=="addRecipe.php" || $pg=="rsscats.php" || $pg=="addrsscat.php" || $pg=="feeds.php" || $pg=="contentPages.php" || $pg=="addContentPages.php" ){
   $open1='class="open"';
  $st1='style="display:block" ';
 }else{
   $open1='';
  $st1='';
 }
 ?> 
  <li <?=$open1?>>
    <div class="link"><i class="fa fa-pencil"></i> CMS<i class="fa fa-chevron-down"></i></div>
    <ul class="submenu"  <?=$st1?>>
    <li><div class="link1" ><i class="fa fa-chevron-right"></i> <a href="contentPages.php">Menu Items</a></div></li>   
     
    <li><div class="link1" ><i class="fa fa-chevron-right"></i> <a href="addCorpImages.php">Images</a></div></li>
    
    <?php ?><li><div class="link1" ><i class="fa fa-chevron-right"></i> <a href="rsscats.php">RSS Links</a></div></li>
    <li><div class="link1" ><i class="fa fa-chevron-right"></i> <a href="rsfeed.php">Get Feeds</a></div></li>
    <li><div class="link1" ><i class="fa fa-chevron-right"></i> <a href="feeds.php">RSS Feeds</a></div></li><?php ?>
    </ul>
  </li>
  
  <?php }?>

</ul>
</div>

<script>
$(function() {
  var Accordion = function(el, multiple) {
    this.el = el || {};
    this.multiple = multiple || false;

    // Variables privadas
    var links = this.el.find('.link');
    // Evento
    links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown)
  }

  Accordion.prototype.dropdown = function(e) {
    var $el = e.data.el;
      $this = $(this),
      $next = $this.next();

    $next.slideToggle();
    $this.parent().toggleClass('open');

    if (!e.data.multiple) {
      $el.find('.submenu').not($next).slideUp().parent().removeClass('open');
    };
  }  

  var accordion = new Accordion($('#accordion'), false);
});
</script>