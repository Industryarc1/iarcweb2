<div class="row1_1 width100 mob_no" style="margin-top: 0px;">
                    <h1 class="hd1">
                        News Articles
                    </h1>
                    <ul class="news_art">
                        <?php
						$news=mysqli_query($mysqli,"select * from zsp_news order by prod_id desc limit 5");
						while($n=mysqli_fetch_array($news)){
						?>
						<li><a href="article.php?id=<?=$n['prod_id']?>&title=<?=$n['seo_keyword']?>">
						<div class="img">
						<?php if($n['image']!="" && file_exists('articleImages/'.$n['image'])){ ?>
						<img src="<?=SITE_ART_PATH.$n['image']?>" alt="<?=$n['seo_keyword']?>" width="100%" >
						<?php }else{ ?>
						<img src="<?=SITE_ART_PATH?>industryarc.png" alt="<?=$n['seo_keyword']?>" width="100%" >
						<?php }?>
						</div><div class="cont"><?=$n['title']?></div></a>
						</li>
                        <?php }?>
                        <a href="news-articles.php" class="viewall">View all</a>
                    </ul>
                </div>