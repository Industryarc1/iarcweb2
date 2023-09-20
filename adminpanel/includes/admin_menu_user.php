<link href="css/acc_menu.css" rel="stylesheet" type="text/css">
<div class="leftmenu" >
<div class="head1"><i class="fa fa-cog"></i> Adminidtration</div>
<ul id="accordion" class="accordion">
   <?php if(isset($_SESSION['admin_id'])){ ?>
   <li>
    <div class="link"><i class="fa fa-database"></i>Pre Fields<i class="fa fa-chevron-down"></i></div>
    <ul class="submenu">
	<li><div class="link1" ><i class="fa fa-chevron-right"></i> <a href="reports.php">Report Types</a></div></li>
     <li><div class="link1" ><i class="fa fa-chevron-right"></i> <a href="publishers.php">Publishers</a></div></li>
      <li><div class="link1" ><i class="fa fa-chevron-right"></i> <a href="licences.php">Licences</a></div></li>
	  <li><div class="link1" ><i class="fa fa-chevron-right"></i> <a href="enqs.php">Nature of Enqury</a></div></li>
	  <!--   <li><div class="link1" ><i class="fa fa-chevron-right"></i> <a href="bundles.php">Bundles</a></div></li>
	   <li><div class="link1" ><i class="fa fa-chevron-right"></i> <a href="pricelist.php">Price List</a></div></li>-->
    </ul>
  </li>
  <li>
    <div class="link"><i class="fa fa-database"></i>Categories<i class="fa fa-chevron-down"></i></div>
    <ul class="submenu">
       <li><div class="link1" ><i class="fa fa-chevron-right"></i> <a href="addCategory.php">Add Categories</a></div></li>
	   <li><div class="link1" ><i class="fa fa-chevron-right"></i> <a href="addSubCategory.php">Add Sub Categories</a></div></li>
	   <li><div class="link1" ><i class="fa fa-chevron-right"></i> <a href="categories.php">Categories</a></div></li>
    </ul>
  </li>
  <li>
    <div class="link"><i class="fa fa-database"></i>Reports<i class="fa fa-chevron-down"></i></div>
    <ul class="submenu">
       <li><div class="link1" ><i class="fa fa-chevron-right"></i> <a href="addPost.php">Add Reports</a></div></li>
	   <li><div class="link1" ><i class="fa fa-chevron-right"></i> <a href="posts.php">View reports</a></div></li>
	   <li><div class="link1" ><i class="fa fa-chevron-right"></i> <a href="uploadImages.php">Upload Images</a></div></li>
    </ul>
  </li>
  
  <li>
    <div class="link"><i class="fa fa-pencil"></i> Content Pages<i class="fa fa-chevron-down"></i></div>
    <ul class="submenu">
      <li><div class="link1" ><i class="fa fa-chevron-right"></i> <a href="updateContent.php">Update Content</a></div></li>
    </ul>
  </li>
	  <?php }?>
	 <?php if(isset($_SESSION['admin_user_id'])){ ?>
	 <li>
    <div class="link"><i class="fa fa-database"></i>Reports<i class="fa fa-chevron-down"></i></div>
    <ul class="submenu">
       <li><div class="link1" ><i class="fa fa-chevron-right"></i> <a href="addPost.php">Add Reports</a></div></li>
	   <li><div class="link1" ><i class="fa fa-chevron-right"></i> <a href="posts.php">View reports</a></div></li>
	   <li><div class="link1" ><i class="fa fa-chevron-right"></i> <a href="uploadImages.php">Upload Images</a></div></li>
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