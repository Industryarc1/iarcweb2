<div class="top" style="background-color:#EAEFFD;border-bottom:6px solid #1565B5">
        	<div class="wrapper_inner top_inner">
           	  	<div class="logo">
                	<a href="index.php" ><img src="images/logo.png" height="40" ></a>
                </div>
				<div class="s_icons">
                	<ul>
						<?php if(isset($_SESSION['admin_id']) || @$_SESSION['admin_user_id']!=""){ ?>
						<li><a href="javascript:void(0)" onclick="javascript:document.getElementById('righttopbox').style.display='';" ><i class="fa fa-cog" style="color:#666666"></i>
						<div class="rightpop1" id="righttopbox" style="display:none">
							<div class="linkarrow" ></div>
							<div class="rightpop2">
								<ul>
									<li> <i class="fa fa-user" ></i> Welcome <?php if(@$_SESSION['admin_id']==""){echo $_SESSION['admin_user_id']; }else{ echo $_SESSION['admin_id']; } ?></li>
<?php  if(@$_SESSION['admin_user_id']==""){ ?>									
<li><a href="changepassword.php" >Change Password</a></li>
<?php } ?>
									<li style="border:none"><a href="logout.php" >Logout</a></li>
								</ul>
							</div>
						</div>
						</a></li>
                    	<li><a href="logout.php" ><i class="fa fa-sign-out" style="color:#666666" title="Logout"></i></a></li>
						<?php }?>
                    </ul>
              	</div>
                
            </div>
        </div>