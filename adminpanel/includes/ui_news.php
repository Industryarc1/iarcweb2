<link rel="stylesheet" href="css/bjqs.css">

<!-- demo.css contains additional styles used to set up this demo page - not required for the slider -->
<link rel="stylesheet" href="css/demo.css">

<!-- load jQuery and the plugin -->
<script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
<script src="js/bjqs-1.3.min.js"></script>
<div  id="banner-fade1" style="margin-top:95px;padding:0px 10px;">
<ul class="bjqs">
<?php 
if ($stmt = $mysqli->prepare("select prod_id,title,mnfctr from zsp_news  order by dt_created desc limit 9")) {
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($prod_id, $title,$mnfctr);
}
while( $stmt->fetch() ) {  if($mnfctr!=""){ $link=$mnfctr;}else{ $link='news.php?id='.$prod_id;}
?>
<li><a href="<?=$link?>"  ><?=$title?></a></li>
<?php /*?><li><a href="<?=$link?>" ><?=$title?></a></li><?php */?>
<?php }?>
</ul>
</div>

<script class="secret-source">
        jQuery(document).ready(function($) {

          $('#banner-fade1').bjqs({
            height      : 272,
            width       : 270,
			animtype    : 'slide',
            responsive  : true
          });

        });
      </script>