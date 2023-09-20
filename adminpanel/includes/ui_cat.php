<div class="col1 mob_no">
<h1 class="hd">categories</h1>
<div class="reports1">
                        <ul>
                        	<?php
							$res=mysqli_query($mysqli,"select * from zsp_catlog_categories where p_id='0' and status='1' order by sort_order asc");
							while($row=mysqli_fetch_array($res)){
							?>
							<li><a href="reports.php?title=<?=$row['name']?>"><?=$row['name']?></a>
							<?php
							if($row['inc_id']==$rcat){
							$res1=mysqli_query($mysqli,"select * from zsp_catlog_categories where p_id='".$row['inc_id']."' and status='1' order by sort_order asc");
							if(mysqli_num_rows($res1)>0){
							echo '<ul class="sub_cat">';
							while($row1=mysqli_fetch_array($res1)){
							?>
							<li><a href="reports.php?title=<?=$row1['name']?>" style="background-image:none"><?=$row1['name']?></a></li>
                            <?php } 
							echo '</ul>';
							} ?>
                            <?php } ?>
							</li>
							<?php } ?>
                        </ul>
                    	
                    </div>
					</div>