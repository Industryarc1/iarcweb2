<?php
	$onloadScript ="document.getElementById('id01').style.display='block'";
	$isValidLogin =FALSE;
	$loginErr = NULL;
	session_start();
	$timeout=60*60;//1 hour
	if(isset($_SESSION['timeout'])){
		// See if the number of seconds since the last
		// visit is larger than the timeout period.
		$duration = time() - (int)$_SESSION['timeout'];
		if($duration > $timeout) {
			// Destroy the session and restart it.
			session_destroy();
			session_start();
		}
	}
	if($_SERVER['REQUEST_METHOD']=='POST' || (!empty($_SESSION["username"]) && !empty($_SESSION["password"]))){
		//echo "<pre>";print_r($_POST);exit;
		$username = !empty($_POST['username'])?$_POST['username']:$_SESSION['username'];
		$password = !empty($_POST['password'])?$_POST['password']:$_SESSION['password'];
		
		$validCrential = [
		'iarc'=>'Iarc@123',
		'amit'=>'amit395',
		];
		$valid_users = array_keys($validCrential);
		$isValidLogin = ((in_array($username,$valid_users)) && ($password ===$validCrential[$username]));
		$loginErr= ($isValidLogin)? '' :'Invalid Login Credential';
	}
	if($isValidLogin){
		$_SESSION["username"] = $username;
		$_SESSION["password"] = $password;
		// Update the timout field with the current time.
		$_SESSION['timeout'] = time();
	?>
	<!DOCTYPE html>
	<html>
		<head>
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<style>
				body{
				font-family:Sans-serif,"Times New Roman";
				font-size:18px;
				}
				p {
				
				text-align:justify;
				/* background-color:yellow; */
				}
				a {
				text-decoration: none;
				}
				
				.container_main{
				width:80%;
				margin-left:auto;
				margin-right:auto;
				
				}
				.comment:before {
				content: "##";
				margin-right: 10px;
				}
				.comment{
				padding-left:100px;
				font-size:15px;
				font-style:italic;
				color:#928f8f;
				}
				.code-snippet{
				background-color:#f2f9fa;
				border-left:5px solid #bf945e;
				border-radius: 15px;
				padding:10px 15px 10px 20px;
				overflow:auto;
				}
				.mheading {
				background-color:#efece2;
				padding-left:15px;
				border-left:5px solid #885c4b;
				}
				
			</style>
		</head>
		<body>
			<div class="container_main">
				<h1 align="center">industryarc.com</h1>
				<h3 class="mheading">Application configuration</h3>
				<p>
					industryarc.com website is built to market the reports and capture the leads.<br>
					The Website is build using below technology
				</p>
				<ul>
					<li>PHP</li>
					<li>mysql</li>
					<li>Yii2 Framework</li>
					<li>Html5, css, jquery, bootstrap</li>
				</ul>
				<p>
					In this project  all the configuration is done from the config file which is at below location 
				</p>
				<div class="code-snippet">
					C:\xampp\htdocs\project_folder\frontend\config<br><br>
					
					and inside the config we  have below files
					<dl>
						<dt>config</dt>
						<dd>main.php<span class="comment">Its the main configuration file where we configure basepath, url_routing, params..etc. All the remaining config files are either being included or linked with this file. </span></dd>
						<dd>main-local.php</dd>
						<dd>params.php<span class="comment"> Define the common parameter or important parameter which will be used throughout the website. And this file is included in main.php</span></dd>
						<dd>params-local.php</dd>
						<dd>url-rules.php<span class="comment">url_routing rules is defined in this file ,and the file is included in main.php</span></dd>
					</dl>
				</div>
				
				<p>And all the logic is defined in the <em>\frontend\controllers</em>.</p>
				<p>The first <u>Landing page</u> or <u>Home page</u> is comes from SiteController action index. 
					Because action index of the site controller is the first action which executes as per the default configuration comes with Yii2 framework.
					If in case you want to change this to some other action you can do it.
					use the <a href="https://github.com/yiisoft/yii2/blob/master/docs/guide/structure-controllers.md#default-controller-" target="_blank">Link</a> to know more.<br>
					The default controller and default action is been defined in the library files at below location
					
				</p>
				<div class="code-snippet">
					<p>Default controller is defined in this &#8595; File</p>
					C:\xampp\htdocs\industryarc\vendor\yiisoft\yii2\web\Application.php
					
					<p># Code Snippet #</p>
					<code>public $defaultRoute = 'site';</code><br>
					-------------------------------------------------------------------------------------------------
					<p>Default action is defined in this &darr; File</p>
					C:\xampp\htdocs\stagging_industryarc\vendor\yiisoft\yii2\base\Controller.php
					<p># Code Snippet #</p>
					<code>public $defaultAction = 'index';</code><br><br>
				</div>
				<b>Note:</b> Suggested not to change the default controller/action form Library file.
				<p>
					The other configuration such as DB, common emails, and email server configuration are explained below. 
				</p>
				<div class="code-snippet">
					<p>The DB and mail server is configured in below file.</p>
					&rarr; C:\xampp\htdocs\stagging_industryarc\common\config\main-local.php
					<p>And the common emails is defined in below file.</p>
					&rarr; C:\xampp\htdocs\stagging_industryarc\common\config\params.php
					<p># Code Snippet #</p>
					<code>
						'adminEmail' => 'admin@example.com',<br>
						'salesEmail'=>'sales@industryarc.com',<br>
						'testEmail'=>'test@test.com',<br>
						'communicationEmail'=>'communication-received@industryarc.com',
					</code>
					<br><br>
				</div>
				<h3 class="mheading">SiteController</h3>
				<p>
					Site controller is the main controller where we write the logic for
					landing page, Login Page,  contact and  Registration pages.
					Since this is the first controller which executes when the application is loaded.<br>
					In our case we have below methods.
					<ul>
						<li>actionIndex <span class="comment">It render the home page </span></li>
						<li>actionError</li>
						<li>actionAbout <span class="comment"> This action renders a static page.</span></li>
						<li>actionTeam <span class="comment"> This action renders a static page.</span></li>
						<li>actionCareer <span class="comment"> This action renders a static page.</span></li>
						<li>actionLogin <span class="comment"> This action renders the login screen page. </span></li>
					</ul>
				</p>
				<p>
					<b>actionError : </b>This action gets called when any exception found in the Application.
				</p>
				<div class="code-snippet">
					<code>
						public function actionError(){<br>
						&nbsp;&nbsp;&nbsp;$exception = Yii::$app->errorHandler->exception;<br>
						&nbsp;&nbsp;&nbsp;if($exception->statusCode == 404){<span class="comment">check if its 404(Page not found) Error</span><br>
						&nbsp;&nbsp;&nbsp;return $this->goHome();<span class="comment"> Redirect to home page </span><br>
						&nbsp;&nbsp;&nbsp;}else{<br>
						&nbsp;&nbsp;&nbsp;echo $exception->statusCode .'-'.$exception->getMessage();<br>
						}
						}
					</code>
				</div>
				<h3 class="mheading">HomeController</h3>
				<p>
					Home controller is mainly deals with the content present on the Home page.<br>
					In this controller we have below methods.
					<ul>
						<li>actionOurServices</li>
						<li>actionPrivacy <span class="comment"> This action renders the  industryarc.com/privacy-policy.php page. </span></li>
						<li>actionTerms <span class="comment"> This action renders the industryarc.com/term-and-conditions.php page.</span></li>
						<li>actionContactUs</li>
						<li>actionNewsLatter</li>
					</ul>
				</p>
				<p>
					<b>actionOurServices : </b>This action render the articles present in the our services section of the home page.<br>
					every article content is written in different view page, so we are using <code>switch condition</code> to render the respective page.
				</p>
				<p>
					<b>actionContactUs : </b>It renders a form page for capturing the lead contact details.<br>
					once form is submitted, a mail will be sent to <em>sales@industryarc.com</em> with the lead details.
				</p>
				<p>
					<b>actionNewsLatter : </b> This action capture the details for subscription.<br>
					Once a user subscribed, he/she will be prompted with a thankyou message and the mail will be sent to the sales team as well as to the user.
				</p>
				<h3 class="mheading">NewsArticleController</h3>
				<p>
					It display the article present in our website.In this controller we have below methods.
				</p>
				<ul>
					<li>actionListArticle <span class="comment"> display all the list of article presents. </span></li>
					<li>actionArticle <span class="comment"> display the individual article details once its clicked from the list page.</span></li>
				</ul>
				
				<h3 class="mheading">PressReleasesController</h3>
				<p>
					It display the press release present in our website.In this controller we have below methods.
				</p>
				<ul>
					<li>actionListPress <span class="comment"> display all the list of Press release presents. </span></li>
					<li>actionPressReport <span class="comment"> display the individual Press release details once its clicked from the list page.</span></li>
				</ul>
				
				<h3 class="mheading">WebinarController</h3>
				<p>
					It display the webinar page in our website.In this controller we have below methods.
				</p>
				<ul>
					<li>actionListWebinar <span class="comment"> display all the list of webinars. </span></li>
					<li>actionWebinarDetail <span class="comment"> display the individual webinar details once its clicked from the list page.</span></li>
					<li>actionRegistration</li>
				</ul>
				<p>
					<b>actionRegistration : </b> This is a form present on the webinar details page. it capture the lead details who's want to join the webinar session.
					Once  the form is submitted a mail will be sent to Sales team .
				</p>
				<h3 class="mheading">WhitepaperController</h3>
				<p>
					It display the Whitepaper page in our website.In this controller we have below methods.
				</p>
				<ul>
					<li>actionListWhitepaper <span class="comment"> display all the list of Whitepaper. </span></li>
					<li>actionWhitepaperDetail <span class="comment"> display the individual Whitepaper details once its clicked from the list page.</span></li>
					<li>actionWhitepaperDownload</li>
				</ul>
				<p>
					<b>actionWhitepaperDownload : </b> It`s a form page along with some static content on the page which comes after we click on the individual whitepaper from the list page. it capture the form details and sent it to the sales team through mail.
					if the whitepaper details is present in the form of file it will be downloaded after the form is filled-up and submitted otherwise it will be redirect to actionWebinarDetail and display the data saved in the DB.
				</p>
				<h3 class="mheading">ReportsController</h3>
				<p>
					Reports is the main module of our web application in this project.
					Here in this we are displaying the category wise reports list.Below listed are 
					the methods in this controller.
				</p>
				<ul>
					<li>actionCategoryWiseReport <span class="comment"> Display the list of category wise research reports.</span></li>
					<li>actionReport</li>
					<li>actionResearch</li>
					<li>actionReportsegment</li>
					<li>actionResearchsegment</li>
					<li>actionSampleRequest</li>
					<li>actionAnalystQuery</li>
					<li>actionSalesQuery</li>
					<li>actionInquiry</li>
					<li>actionRequestQuote</li>
				</ul>
				<p>
					<b>actionReport, actionResearch : </b> The one which have dup_inc_id
					less then 5 lakh goes with the actionReport and uses the Report key in the URL, 
					and the one which is have more than 5lakh goes with the actionResearch and uses the Research key in the URL.<br>For example check below URLs.
				</p>
				<div class="code-snippet">
					<code>
						&rarr;<a href="https://www.industryarc.com/Report/18478/thail-sugarcane-market-research-report-analysis.html">https://www.industryarc.com/Report/18478/thail-sugarcane-market-research-report-analysis.html</a><br><br>
						&rarr;<a href="https://www.industryarc.com/Research/Plant-Growth-Chambers-Market-Research-505094">https://www.industryarc.com/Research/Plant-Growth-Chambers-Market-Research-505094</a><br>
					</code>
				</div>
				<p>
					<b>actionReportsegment, actionResearchsegment : </b> There were few reports in our old industryarc website in below format.
					For these repors marketing was already been done using the same url pattern as explained. so in order to make those urls working we 
					created actionReportsegment, actionResearchsegment in which if the dup_inc_id less then 5 lakh, it will redirect to actionReport.
					and if it`s more than 5lakh then, it will redirect to actionResearch.
					
				</p>
				<div class="code-snippet">
					<p>Note: below is url format, not the actual URL.</p>
					<code>
						&rarr;https://www.industryarc.com/Report/inc_id/curl/seg<br>
						&rarr;https://www.industryarc.com/Research/inc_id/curl/seg
					</code>
				</div>
				
				<p>
					<b>actionSampleRequest, actionAnalystQuery, actionSalesQuery, actionInquiry, actionRequestQuote : </b>
					These are the form pages to capture the leads. out of all five forms display interface(button) 
					is given only for two forms(actionSampleRequest and actionRequestQuote) whereas all five forms are working in backend.<br><br>
					Once the form is submitted data will be entered to the CRM using API calls and a mail will be sent
					to Sales team with the lead details.
				</p>
				
				<h3 class="mheading">PurchaseController</h3>
				<p> 
					This controller mainly deals with the payment process in the website. Below 
					are the list of action in this controller.
				</p>
				<ul>
					<li>actionBuyReport</li>
					<li>actionConfirmBuyReport</li>
					<li>actionPaymentStatus</li>
				</ul>
				<p> Once user click on the report BUY NOW button,it will be redirected to this <b>actionBuyReport</b>.
					and after filling the buy now form. It will be redirected to <b>actionConfirmBuyReport</b>, where it will show all the 
					details in one screen such as name, address, email, contact, and report details which you willing to purchase.
					after user conforms the details it will go to the Payment page and once payment is done it will redirect to the 
					<b>actionPaymentStatus</b>.in this action if the payment is success it will send an email to sales team with client details.
				</p>
				
				<h3 class="mheading">MessageController</h3>
				<p>
					This controller is used to display the thankyou template once user submit the form .
					it have only one method.
				</p>
				<ul>
					<li>actionThanks <span class="comment"> Display thanks message template.</span></li>
				</ul>
				
				<h3 class="mheading">SearchController</h3>
				<p>
					This controller used to display the search result.the websites. it have below methods.
				</p>
				<ul>
					<li>actionSearchOptions <span class="comment"> display the auto suggestion in search bar. </span></li>
					<li>actionSearch</li>
					<li>actionSearchReport</li>
					<li>actionSearchPressRelease</li>
					<li>actionSearchWhitepapers</li>
					<li>actionSearchArticles</li>
				</ul>
				<p>
					when user search for any thing it will hit the search action only and here 
					based on the user search key it will fetch the details from report, press-release, 
					white paper and article using actionSearchReport, actionSearchPressRelease, 
					actionSearchWhitepapers, actionSearchArticles respectively. after collecting 
					all the data form all the other methods it will merge the data and send it to user as search result.
				</p>
				
				<h3 class="mheading">SitemapController</h3>
				<p>
				This is been used to generate the site maps for the website.
				</p>
				
				
				<h3 class="mheading">UserController</h3>
				<p>
				This controller is designed for the future purpose. for example once the user loged in we can write the 
				code here for displaying his dashboard or his profile details and settings such as change password or change billing address etc.
				</p>
				
				
				
				
				
			</div>
		</body>
	</html>
	
	<?php }else{ ?>
	
	<!--
		* This Part of the code is completely about the Login model popup and Credential validation;
		*
		*
		* Code reference 
		* https://www.w3schools.com/howto/howto_css_login_form.asp
	-->
	<!DOCTYPE html>
	<html>
		<head>
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<style>
				body {font-family: Arial, Helvetica, sans-serif;}
				
				/* Full-width input fields */
				input[type=text], input[type=password] {
				width: 100%;
				padding: 12px 20px;
				margin: 8px 0;
				display: inline-block;
				border: 1px solid #ccc;
				box-sizing: border-box;
				}
				
				/* Set a style for all buttons */
				button {
				background-color: #4CAF50;
				color: white;
				padding: 14px 20px;
				margin: 8px 0;
				border: none;
				cursor: pointer;
				width: 100%;
				}
				
				button:hover {
				opacity: 0.8;
				}
				
				/* Extra styles for the cancel button */
				.cancelbtn {
				width: auto;
				padding: 10px 18px;
				background-color: #f44336;
				}
				
				/* Center the image and position the close button */
				.imgcontainer {
				text-align: center;
				margin: 24px 0 12px 0;
			position: relative;
			}
			
			.container {
			padding: 16px;
			}
			
			/* The Modal (background) */
			.modal {
			display: none; /* Hidden by default */
			position: fixed; /* Stay in place */
			z-index: 1; /* Sit on top */
			left: 0;
			top: 0;
			width: 100%; /* Full width */
			height: 100%; /* Full height */
			overflow: auto; /* Enable scroll if needed */
			background-color: rgb(0,0,0); /* Fallback color */
			background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
			padding-top: 60px;
			}
			
			/* Modal Content/Box */
			.modal-content {
			background-color: #fefefe;
			margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
			border: 1px solid #888;
			width: 50%; /* Could be more or less, depending on screen size */
			}
			
			/* The Close Button (x) */
			.close {
			position: absolute;
			right: 25px;
			top: 0;
			color: #000;
			font-size: 35px;
			font-weight: bold;
			}
			
			.close:hover,
			.close:focus {
			color: red;
			cursor: pointer;
			}
			
			/* Add Zoom Animation */
			.animate {
			-webkit-animation: animatezoom 0.6s;
			animation: animatezoom 0.6s
			}
			
			@-webkit-keyframes animatezoom {
			from {-webkit-transform: scale(0)} 
			to {-webkit-transform: scale(1)}
			}
			
			@keyframes animatezoom {
			from {transform: scale(0)} 
			to {transform: scale(1)}
			}
			.error{
			word-wrap: break-word;
			}
			</style>
			</head>
			<body onload="<?=$onloadScript?>">
			<div id="id01" class="modal">
			<form class="modal-content animate" method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"])?>">
			<div class="imgcontainer">
			<!--<span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>-->
			<img src="images/Arc_logo.png" alt="IndustryArc" class="avatar">
			</div>
			<div class="container">
			
			<label for="username"><b>Username</b></label>
			<input type="text" placeholder="Enter Username" name="username" required>
			
			<label for="password"><b>Password</b></label>
			<input type="password" placeholder="Enter Password" name="password" required>
			
			<button type="submit">Login</button>
			</div>
			<div class="container" style="background-color:#f1f1f1">
			<span style="color:red;" class="error"><?=$loginErr;?></span>
			</div>
			</form>
			</div>
			
			<script>
			// Get the modal
			var modal = document.getElementById('id01');
			// When the user clicks anywhere outside of the modal, close it
			/*
			window.onclick = function(event) {
			if (event.target == modal) {
			modal.style.display = "none";
			}
			}
			*/
			</script>
			</body>
			</html>
			<?php } ?>						