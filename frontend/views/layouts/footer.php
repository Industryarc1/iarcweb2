<?php
use frontend\widgets\Newsletters;
use common\models\Category;
use yii\helpers\Url;

?>
<!--<script type="text/javascript">
(function(d, src, c) { var t=d.scripts[d.scripts.length - 1],s=d.createElement('script');s.id='la_x2s6df8d';s.async=true;s.src=src;s.onload=s.onreadystatechange=function(){var rs=this.readyState;if(rs&&(rs!='complete')&&(rs!='loaded')){return;}c(this);};t.parentElement.insertBefore(s,t.nextSibling);})(document,
'https://industryarc.ladesk.com/scripts/track.js',
function(e){ LiveAgent.createButton('26tepf98', e); });
</script>-->

<!--<script>
    /*
    here you can add user_data to config object
    eg.   
    custom_user_data = {
            externalId: "your_id_for_user",
            email: "email",
            username: "username",
            firstname: "user_first_name",
            lastname: "user_last_name",
            additionalFields: "nickname=userNickname; phoneNumber=121212"
    };
    */

     if("undefined"!==typeof requirejs)window.onload=function(e){requirejs(["https://paldesk.io/api/widget-client?apiKey=bfd9641889e1ad09e258c1a1deb4b543"],function(e){"undefined"!==typeof custom_user_data&&(beebeeate_config.user_data=custom_user_data),BeeBeeate.widget.new(beebeeate_config)})};
    else{var s=document.createElement("script");s.async=!0,s.src="https://paldesk.io/api/widget-client?apiKey=bfd9641889e1ad09e258c1a1deb4b543",s.onload=function(){"undefined"!==typeof custom_user_data&&(beebeeate_config.user_data=custom_user_data),BeeBeeate.widget.new(beebeeate_config)};
    if(document.body){
        document.body.appendChild(s)
    }
    else if(document.head){
        document.head.appendChild(s)
    }
    }

</script>-->

<!-- Hey Oliver -->
     <!--<script type='text/javascript'>
     var _hoid = _hoid || []; _hoid.push('ho_gT7YQAumw2KtJBXWqMd3NDbeZkcG1RCfP6HEhznv5y4Uj8S');
     var heyopath = (('https:' == document.location.protocol) ? 'https://www.heyoliver.com/webroot/ho-ui/v2/' :
     'http://www.heyoliver.com/webroot/ho-ui/v2/');
     var heyop = (('https:' == document.location.protocol) ? 'https://' : 'http://');
     var heyospt = document.createElement('script'); heyospt.type = 'text/javascript';
     heyospt.async = true; heyospt.src = heyopath + 'ho2.js';
     var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(heyospt, s);
     </script>-->
 <!-- End of Hey Oliver  -->
 
<script>var continuallySettings = { appID: "jenrj3qk5ym7" };</script>
<script src="https://cdn-app.continual.ly/js/embed/continually-embed.latest.min.js"></script>

<script>window._nQc="89143392";</script>
<script async src="https://serve.albacross.com/track.js"></script>

<script type="text/javascript">
    (function(c,l,a,r,i,t,y){
        c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
        t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
        y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
    })(window, document, "clarity", "script", "3ymn0bpv3p");
</script>


<!-- Zoom.ai inline embed script begin -->
<!--<div class="zoomai-slideout-widget-url" data-url="https://meeting.zoom.ai/meeting/new/5fb78f7a1ad3c90020be5515/meeting"></div>
<script type="text/javascript" src="https://app.zoom.ai/assets/widget.js"></script>-->
<!-- Zoom.ai inline embed script end -->

<footer>
  <div class="footer-nav row">
    <div class="nav-section-1a f-nav subscribe">
           <?= Newsletters::widget() ?>
    </div>
    <div class="nav-section-1a f-nav">
      <h3>Useful Links</h3>
      <ul>
        <li><a href="http://industryarcblog.com">Blog</a></li>
        <li><a href="<?=Url::to(['site/career'])?>">Career</a></li>
        <li><a href="https://www.industryarc.com/sitemap.xml">XML</a></li>
        <li><a href="<?=Url::to(['sitemap/sitemap-html'])?>">Sitemap</a></li>
        <li><a href="<?=Url::to(['home/privacy'])?>">Privacy Policy</a></li>
        <li><a href="<?=Url::to(['home/terms'])?>">Terms and Conditions</a></li>

      </ul>
    </div>
    <div class="nav-section-1a f-nav contact">
      <h3>Contact Us</h3>
      <!--<p class="address">Plot No. 56, HUDA Techno Enclave LP Towers, Opp. Melange Tower, Madhapur, Hyderabad, Telangana 500081</p>-->
      <p class="mail">sales@industryarc.com</p>
      <p class="phone"> +1970-236-3677</p>
    </div>
  </div>
    <div class="row">
  <div class="copyright-section">
    <p>Copyrights &copy; Furion analytics Research & Consulting LLP<sup>TM</sup> All Rights Reserved. test<?= date("Y")?></p>
  </div>
  <div class="social-footer">
      <ul>
       <li><a href="https://www.linkedin.com/company/industryarc"><img src="<?= Yii::$app->request->baseUrl ?>/images/linkedin-footer.svg" alt="LinkedIn"></a></li>
       <li><a href="https://www.instagram.com/industry_arc/"><img src="<?= Yii::$app->request->baseUrl ?>/images/instagram-footer.svg" alt="Instagram"></a></li>
       <li><a href="https://twitter.com/IndustryARC"><img src="<?= Yii::$app->request->baseUrl ?>/images/twitter-footer.svg" alt="Twitter"></a></li>
       <li><a href="https://www.youtube.com/watch?v=Ico4CGzBlO0"><img src="<?= Yii::$app->request->baseUrl ?>/images/youtube-footer.svg" alt="Youtube"></a></li>
      </ul>
    </div>
  </div>
</footer>
<!--<script src=https://my.hellobar.com/46619d99830b96b77a9ae8077b9cb1d9bdfdd170.js type="text/javascript" charset="utf-8" async="async"> </script>-->
