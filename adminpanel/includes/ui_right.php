<div class="col3">
                	<a class="rfp" id="go" rel="leanModal" name="signup" href="#signup"><i class="fa fa-pencil-square-o"></i>Request For Proposal</a>
                    <div style="border-bottom:1px dashed #7c7c7c; margin-top:15px;"></div>
                    
                    <div class="o_clients">
                    	<h1 class="hd">Our Clients
                        	<div id="prev1" class="l_arrow"><img src="images/l_arrow1.jpg"></div>
     		    			<div id="next1" class="r_arrow"><img src="images/r_arrow1.jpg"></div>
                        </h1>
                        <div class="client_list">
                            
                            <ul id="clients1">
                            	<?php
								$cid='c_1';
								if ($stmt1 = $mysqli->prepare("select inc_img_id,img from zsp_off_imgs where exp_id=?")) {
								$stmt1->bind_param('s',$cid);
								$stmt1->execute();
								$stmt1->store_result();
								$stmt1->bind_result($inc_img_id, $img);
								while($stmt1->fetch()){
								?>
								<li><a><img src="off_imgs/<?=$img?>"></a></li>
                                <?php }
								}?>
                            </ul>
                        </div>
                        
                        
                        
                    </div>
                    
                    
                    
                    <!--<div class="discount">
                    	<div class="dis_hd">
                        	discount
                        </div>
                    	<ul id="disc1">
                        	<li>
                            	<a href="#">
                                    <div class="hd">
                                        12%
                                    </div>
                                    <div class="sub_hd">
                                        additional discount on all purchases
                                    </div>
                                </a>
                            </li>
                            
                            <li>
                            	<a href="#">
                                    <div class="hd">
                                        5%
                                    </div>
                                    <div class="sub_hd">
                                        additional discount on all purchases
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <a href="#" class="viewall" style="margin-top: 0px; margin-right: 10px; font-size: 13px;">View all</a>
                    </div>-->
                    
                    <div style="border-bottom:1px dashed #7c7c7c; margin-top:15px;"></div>
                    
                    <?php include_once "includes/ui_twitter.php"; ?>
                </div>