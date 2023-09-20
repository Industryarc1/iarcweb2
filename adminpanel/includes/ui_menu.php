<div class="navigation"><!--navigation-->
<div id="cssmenu">
	<ul>
		<li  class="current"><a href="index.php">Home</a></li>
		<li>
			<a href="industries.php">Categories</a>
			<?php /*?><ul>
				<?php 
				if ($stmt = $mysqli->prepare("select inc_id,name from zsp_catlog_categories where p_id=0 and status=1  order by sort_order asc")) {
					$stmt->execute();
					$stmt->store_result();
					$stmt->bind_result($inc_id22, $name22);
					$stmt1 = $mysqli->prepare("select inc_id,name from zsp_catlog_categories where p_id=? and status=1  order by sort_order asc ");
				}
				while( $stmt->fetch() ) {
				?>
				<li><a href="industries.php?id=<?=$name22?>"><?=$name22?></a>
					<ul>
						<?php
					$stmt1->bind_param('s',$inc_id22);
					$stmt1->execute();
					$stmt1->store_result();
					$stmt1->bind_result($inc_id33, $name33);
					$i=1;
					while( $stmt1->fetch() ) {
					?>
					<li><a href="reports.php?id=<?=$name33?>" ><?=$name33?></a></li>
                    <?php $i++; }  ?>
					</ul>
				</li>
				<?php }?>
			</ul><?php */?>
		</li>
       <li><a href="categories.php">List of Reports</a></li>
		<li><a href="publishers.php"> List of Publishers</a></li>
		<?php if(!isset($_SESSION['user_id'])){ ?>
		<li><a href="register.php">Register</a></li>
		<?php }?>
		<li><a href="plans.php">Subscription Plans</a></li>
         <li><a href="about.php" >About Us</a></li>
        <li><a href="contact.php">Contact Us</a></li>
		<?php if(isset($_SESSION['user_id'])){ ?>
		<li class="b_right"><a href="myAccount.php" class="button">My Account</a></li>
		<li class="b_right"><a href="logout.php" class="button">Logout</a></li>
		<?php }?>
	</ul>
</div>
</div>