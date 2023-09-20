function confirm_delete()
{
var agree=confirm(" Do you wish to delete?");
if (agree)
	return true ;
else
	return false ;

}
function sub_frm()
{	
	window.parent.document.redirect_form.submit();
}

function writeobject(f){
			var str='<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="435" height="290"><param name="movie" value="Untitled-5.swf" /><param name=flashvars value="TargetFile='+f+'"><param name="quality" value="high" /> <embed src="Untitled-5.swf" flashvars="TargetFile='+f+'" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="435" height="290"></embed></object>';

			var t=null;
			t=document.getElementById("divobj");
			if(t)
				t.innerHTML=str;
			
}		

function checkFileType(imagePath)
{
	var pathLength = imagePath.length;
	var lastDot = imagePath.lastIndexOf(".");
	var fileType = imagePath.substring(lastDot,pathLength).toLowerCase() ;
	
	if((fileType == ".jpeg")||(fileType == ".jpg")||(fileType == ".gif")||(fileType == ".png")) {
		return true;
	} else {
		return false;
	}
}

function checkFileMp3(imagePath)
{
	var pathLength = imagePath.length;
	var lastDot = imagePath.lastIndexOf(".");
	var fileType = imagePath.substring(lastDot,pathLength).toLowerCase() ;
	
	if((fileType == ".mp3")||(fileType == ".wav")||(fileType == ".aac")) {
		return true;
	} else {
		return false;
	}
}

function videoFileType(imagePath)
{
	var pathLength = imagePath.length;
	var lastDot = imagePath.lastIndexOf(".");
	var fileType = imagePath.substring(lastDot,pathLength).toLowerCase() ;
	
	if((fileType == ".mp4")||(fileType == ".wmv")||(fileType == ".swf")) {
		return true;
	} else {
		return false;
	}
}

function checkFileType_new(imagePath)
{
	var pathLength = imagePath.length;
	var lastDot = imagePath.lastIndexOf(".");
	var fileType = imagePath.substring(lastDot,pathLength).toLowerCase() ;
	//alert(fileType);
	if((fileType == ".jpeg")||(fileType == ".jpg")||(fileType == ".gif")||(fileType == ".png" || fileType == ".JPEG")) 
	{
		return false;
	} 
	else 
	{
		return true;
	}
}

var popUpWin=0;
function popUpWindow(URLStr, left, top, width, height, features)
{
	//alert('"'+features+'width='+width+',height='+height+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'"');
	if(popUpWin)
	{
		if(!popUpWin.closed) popUpWin.close();
	}
		//toolbar=no, location=no ,directories=no, status=no, menubar=no, scrollbar=no, resizable=no, copyhistory=yes, 
		popUpWin = open(URLStr, 'popUpWin', '"'+features+',width='+width+',height='+height+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'"');
}

function MM_openBrWindow_noresize(theURL,winName,features) { //v2.0
  features = features + 'toolbar=no,location=no,status=yes,menubar=no,scrollbars=yes,resizable=no,width=400,height=200';
  window.open(theURL,winName,features);
}

<!--
function MM_swapImgRestore() 
{ //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}

function trim(str)
{
	return str.replace(/^\s*|\s*$/g,"");
}
function  validateNumeric( strValue )
{
  var objRegExp  =  /(^-?\d\d*\.\d*$)|(^-?\d\d*$)|(^-?\.\d\d*$)/;
  return objRegExp.test(strValue);
}
function isUrl2(s) 
{
	var regexp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/
	return regexp.test(s);
}
function isUrl(s) 
{
	var theurl=trim(s)
	var tomatch= /(ftp|http|https):\/\/[wW]{3}\.[A-Za-z0-9\-]{2,}(\.[A-Za-z]{2,3}\/|\.[A-Za-z]{2}\.[A-Za-z]{2}\/)/
	if (tomatch.test(theurl))
		return true;
	else
		return false; 
}

function checkURL(value) {
var urlregex = new RegExp("^(http:\/\/www.|https:\/\/www.|ftp:\/\/www.|www.){1}([0-9A-Za-z]+\.)");
//var urlregex = new RegExp("^(http:\/\/www.|https:\/\/www.|ftp:\/\/www.|www.){1}[0-9A-Za-z\.\-]*\.[0-9A-Za-z\.\-]*$");
if(urlregex.test(value))
{
return(true);
}
return(false);
}

function checkEmail(myForm)
{ 
	flag=false;
	if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(trim(myForm))) 
	{
			flag=true;
			flag=validate_tldextension(myForm);
	}
		
	if(flag==true)
	{
		return true;	
	}
	else
	{
		return false;
	}
}
function validate_tldextension(email)
{
	
	fullemail=email
	validtldlist="com,net,org,us,in,biz,info,tv,cc,ws,uk,au,name,de,jp,be,at,uk,nz,cn,tw,jobs,am,fm,gs,ms,nu,tc,tk,vg,eu,me"
	validtldlistarr=validtldlist.split(",")
	svalidtldlist="co.uk,me.uk,org.uk,co.nz,co.in,net.nz,org.nz,com.cn,org.cn,net.cn,com.tw,org.tw,idv.tw"
	svalidtldlistarr=svalidtldlist.split(",")
	fullemailarr=fullemail.split("@")
	dotcount=0
	for(i=0;i<fullemailarr[1].length;i++)
	{
		if(fullemailarr[1].charAt(i)==".")
		{
			dotcount++;	
		}
	}
	if(dotcount==2)
	{
		tldextention=fullemailarr[1].split(".")
		reqstring=tldextention[1]+"."+tldextention[2]
		flag1=false
		for(i=0;i<svalidtldlistarr.length;i++)
		{
			if(reqstring==svalidtldlistarr[i])
			{
				flag1=true
			}
		}
	}
	else if (dotcount==1)
	{
		tldextention=fullemailarr[1].split(".")
		reqstring=tldextention[1]
		flag1=false
		for(i=0;i<validtldlistarr.length;i++){
			if(reqstring==validtldlistarr[i]){
				flag1=true
			}
		}
	}
	else
	{
		flag1=false
	}
	if(flag1==true)
	{
		return true
	}
	else
	{
		return false
	}	
}
function checkforspecialchars(text)
{
	var iChars = "`~!@#$%^&*()+=-_[]\\\';,./{}|\":<>? ";
	for (var i = 0; i < text.length; i++) 
		if (iChars.indexOf(text.charAt(i)) != -1) 
			return true;
	return false;
}
// underscore allowed
function checkforspecialchars_us(text)
{
	var iChars = "`~!@#$%^&*()+=-[]\\\';,./{}|\":<>? ";
	for (var i = 0; i < text.length; i++) 
		if (iChars.indexOf(text.charAt(i)) != -1) 
			return true;
	return false;
}
// space allowed
function checkforspecialchars_sp(text)
{
	var iChars = "`~!@#$%^&*()+=-_[]\\\';,./{}|\":<>?";
	for (var i = 0; i < text.length; i++) 
		if (iChars.indexOf(text.charAt(i)) != -1) 
			return true;
	return false;
}
// space underscore allowed
function checkforspecialchars_sp_us(text)
{
	var iChars = "`~!@#$%^&*()+=-[]\\\';,./{}|\":<>?";
	for (var i = 0; i < text.length; i++) 
		if (iChars.indexOf(text.charAt(i)) != -1) 
			return true;
	return false;
}
// space hypen braces plus allowed
function checkforspecialchars_phone(text)
{
	var iChars = "`~!@#$%^&*=_[]\\\';,./{}|\":<>? ";
	for (var i = 0; i < text.length; i++) 
		if (iChars.indexOf(text.charAt(i)) != -1) 
			return true;
	return false;
}
// space underscore hypen allowed
function checkforspecialchars_sp_us_hy(text)
{
	var iChars = "`~!@#$%^&*()+=[]\\\';,./{}|\":<>?";
	for (var i = 0; i < text.length; i++) 
		if (iChars.indexOf(text.charAt(i)) != -1) 
			return true;
	return false;
}
// space hypen quote allowed
function checkforspecialchars_sp_hy_qu(text)
{
	var iChars = "`~!@#$%^&*()+=_[]\\;,./{}|\":<>?";
	for (var i = 0; i < text.length; i++) 
		if (iChars.indexOf(text.charAt(i)) != -1) 
			return true;
	return false;
}
// space hypen quote underscore allowed
function checkforspecialchars_sp_hy_qu_us(text)
{
	var iChars = "`~!@#$%^&*()+=[]\\;,./{}|\":<>?";
	for (var i = 0; i < text.length; i++) 
		if (iChars.indexOf(text.charAt(i)) != -1) 
			return true;
	return false;
}
// space hypen quote doublequotes underscore allowed
function checkforspecialchars_sp_hy_qu_dq_us(text)
{
	var iChars = "`~!@#$%^&*()+=[]\\;,./{}|:<>?";
	for (var i = 0; i < text.length; i++) 
		if (iChars.indexOf(text.charAt(i)) != -1) 
			return true;
	return false;
}

function isNumberInt(inputString)
{
  return (!isNaN(parseInt(inputString))) ? true : false;
}

function isNumberFloat(inputString)
{
  return (!isNaN(parseFloat(inputString))) ? true : false;
}


// Comma separated list of images to rotate
var imgs = new Array('images/inn_header1.jpg','images/inn_header2.jpg','images/inn_header3.jpg');
// delay in milliseconds between image swaps 1000 = 1 second
var delay = 3000;
var counter = 0;

function preloadImgs(){
  for(var i=0;i<imgs.length;i++){
    MM_preloadImages(imgs[i]);
  }
}

function randomImages(){
  if(counter == (imgs.length)){
    counter = 0;
  }
  MM_swapImage('rotator', '', imgs[counter++]);
  setTimeout('randomImages()', delay);
}

//function to add link to favourites starts here
var app = navigator.appName;
function add_to_fav()
{
	if(app=='Netscape')
	{
		alert('Your browser requires that you\nPress Ctrl & D to Bookmark this page.');
	}
	else if(app=='Opera')
	{
		alert('Your browser requires that you\nPress Ctrl & T to Bookmark this page.');
	}
	else
	{
		window.external.AddFavorite(location.href, document.title);
	}
}

function redirect(page,qur_str,target){
	
     var target = (target == null) ? " " : target;
	var input_elements = '<form id="redirect_form" name="redirect_form" method="post" action="'+page+'" '+target+'>\n';
	if(trim(qur_str)!=""){	
		var q_s = qur_str.split("&");
		for(i=0;i<q_s.length;i++){
			var q_s2 = q_s[i].split("=");
			input_elements += '<input type="hidden" name="'+q_s2[0]+'" value="'+q_s2[1]+'" />\n';
		}
	}
	input_elements += '</form>';

	window.parent.document.getElementById("redirect_form_elements").innerHTML = input_elements;
	window.parent.document.redirect_form.submit();	
}
// redirect to another page using post ending
function sub_frm()
{	
	window.parent.document.redirect_form.submit();
}

//view hide tooltip starts here
   //switch layers for different browsers
	var ie4 = (document.all) ? true : false;
	var ns4 = (document.layers) ? true : false;
	var ns6 = (document.getElementById && !document.all) ? true : false;
	function hidelayer(lay) {
		if (ie4) {document.all[lay].style.visibility = "hidden";}
		if (ns4) {document.layers[lay].visibility = "hide";}
		if (ns6) {document.getElementById([lay]).style.display = "none";}
	}
	function showlayer(lay) {
		if (ie4) {document.all[lay].style.visibility = "visible";}
		if (ns4) {document.layers[lay].visibility = "show";}
		if (ns6) {document.getElementById([lay]).style.display = "block";}
	}
//view hide tooltip ends here
// funtion show hide starts here
function show_hide(val)
{
	if(document.getElementById(val).style.display)
		document.getElementById(val).style.display = "";
	else
		document.getElementById(val).style.display = "none";
}
// funtion show hide ends here

// onload hide show left menu depending on cookie value starts here
function set_show_td()
{
	var val = readCookie("show_hide_td");
	if(val=="none")
		show_td()
}
// onload hide show left menu depending on cookie value ends here

// hide show left menu starts here
function show_td()
{
	if(document.getElementById("td1").style.display!="none")
	{
		if(document.getElementById("td1"))
			document.getElementById("td1").style.display = "none";
		if(document.getElementById("mt"))
			document.getElementById("mt").width = "100%";
		if(document.getElementById("leftmenuhide"))
			document.getElementById("leftmenuhide").innerHTML = '<img src="images/arrow_r.gif" width="17" height="13" alt="Show Control Panel" title="Show Control Panel">&nbsp;';
		writeCookie("show_hide_td", "none");
	}
	else
	{
		if(document.getElementById("td1"))
			document.getElementById("td1").style.display = "";
		if(document.getElementById("mt"))
			document.getElementById("mt").width = "603";
		if(document.getElementById("leftmenuhide"))
			document.getElementById("leftmenuhide").innerHTML = '<img src="images/arrow_l.gif" width="17" height="13" alt="Hide Control Panel" title="Hide Control Panel">&nbsp;';
		writeCookie("show_hide_td", "");
	}
}

function writeCookie(name, value, hours)
{
	var expire = "";
	if(hours != null)
	{
		expire = new Date((new Date()).getTime() + hours * 3600000);
		expire = "; expires=" + expire.toGMTString();
	}
	document.cookie = name + "=" + escape(value) + expire;
}

function readCookie(name)
{
	var cookieValue = "";
	var search = name + "=";
	if(document.cookie.length > 0)
	{ 
		offset = document.cookie.indexOf(search);
		if (offset != -1)
		{ 
			offset += search.length;
			end = document.cookie.indexOf(";", offset);
			if (end == -1) end = document.cookie.length;
			cookieValue = unescape(document.cookie.substring(offset, end))
		}
	}
	return cookieValue;
}
//read cookie ends here

function eraseCookie(name) {
	writeCookie(name,"",-1);
}	

/*************************   Credit card Number Validation    *****************************/

/*  ================================================================
   FUNCTION:  isVisa()

   INPUT:     cc - a string representing a credit card number

   RETURNS:  true, if the credit card number is a valid VISA number.

          false, otherwise

   Sample number: 4111 1111 1111 1111 (16 digits)
   ================================================================ */

function isVisa(cc)
{
 if (((cc.length == 16) || (cc.length == 13)) &&
     (cc.substring(0,1) == 4))
   return isCreditCard(cc);
 return false;
}  // END FUNCTION isVisa()


/*  ================================================================
   FUNCTION:  isMasterCard()

   INPUT:     cc - a string representing a credit card number

   RETURNS:  true, if the credit card number is a valid MasterCard
            number.

          false, otherwise

   Sample number: 5500 0000 0000 0004 (16 digits)
   ================================================================ */

function isMasterCard(cc)
{
 firstdig = cc.substring(0,1);
 seconddig = cc.substring(1,2);
 if ((cc.length == 16) && (firstdig == 5) &&
     ((seconddig >= 1) && (seconddig <= 5)))
   return isCreditCard(cc);
 return false;

} // END FUNCTION isMasterCard()

/*  ================================================================
   FUNCTION:  isAmericanExpress()

   INPUT:     cc - a string representing a credit card number

   RETURNS:  true, if the credit card number is a valid American
            Express number.

          false, otherwise

   Sample number: 340000000000009 (15 digits)
   ================================================================ */

function isAmericanExpress(cc)
{
 firstdig = cc.substring(0,1);
 seconddig = cc.substring(1,2);
 if ((cc.length == 15) && (firstdig == 3) &&
     ((seconddig == 4) || (seconddig == 7)))
   return isCreditCard(cc);
 return false;

} // END FUNCTION isAmericanExpress()

/*  ================================================================
   FUNCTION:  isDiscover()

   INPUT:     cc - a string representing a credit card number

   RETURNS:  true, if the credit card number is a valid Discover number.

          false, otherwise

   Sample number: 6011 0000 0000 0004 (16 digits)
   ================================================================ */

function isDiscover(cc)
{
  first4digs = cc.substring(0,4);
  if ((cc.length == 16) && (first4digs == "6011"))
    return isCreditCard(cc);
  return false;

} // END FUNCTION isDiscover()


function isCardMatch (cardType, cardNumber)
{

    cardType = cardType.toUpperCase();
     //alert(cardType); 
    var doesMatch = true;
	

    if ((cardType == "VISA") && (!isVisa(cardNumber)))
        doesMatch = false;
    if ((cardType == "MASTERCARD") && (!isMasterCard(cardNumber)))
        doesMatch = false;
	if ((cardType == "DISCOVER") && (!isDiscover(cardNumber))) 
	doesMatch = false;
    if ( ( (cardType == "AMERICANEXPRESS") || (cardType == "AMEX") )
               && (!isAmericanExpress(cardNumber))) doesMatch = false;
    
	return doesMatch;

}  // END FUNCTION CardMatch()

function IsValidDate(Day,Mn,Yr){
    var DateVal = Mn + "/" + Day + "/" + Yr;
	var dt = new Date(DateVal);
	stat = true;
    if(dt.getDate()!=Day){
        //alert('Invalid Date');
        //return(false);
		stat = false;
	}else if(dt.getMonth()!=Mn-1){
    //this is for the purpose JavaScript starts the month from 0
	    //alert('Invalid Date');
        //return(false);
		stat = false;
	}else if(dt.getFullYear()!=Yr){
        //alert('Invalid Date');
        //return(false);
		stat = false;
	}
	return stat;    
    //return(true);
 }
 
//===================		AJAX 	================================== 
function createxmlHttp(){
	try{
  		// Firefox, Opera 8.0+, Safari
  		xmlHttp=new XMLHttpRequest();
  	}catch (e){
  		// Internet Explorer
  		try{
    		xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
    	}catch (e){
    		try{
      			xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
      		}catch (e){
      			alert("Your browser does not support AJAX!");
      			return false;
      		}
    	}
  	}
} 
//===================		AJAX 	================================== 
function GetWidth()
{
	  var x = 0;
	  if (self.innerHeight)
	  {
			  x = self.innerWidth;
	  }
	  else if (document.documentElement && document.documentElement.clientHeight)
	  {
			  x = document.documentElement.clientWidth;
	  }
	  else if (document.body)
	  {
			  x = document.body.clientWidth;
	  }
	  return x;
	  //alert(x);
}
function GetHeight()
{
	  var y = 0;
	  if (self.innerHeight)
	  {
			  y = self.innerHeight;
	  }
	  else if (document.documentElement && document.documentElement.clientHeight)
	  {
			  y = document.documentElement.clientHeight;
	  }
	  else if (document.body)
	  {
			  y = document.body.clientHeight;
	  }
	  return y;
	  //alert(y);
}