(function($) {
function calculateScrollBarWidth() {
  return window.innerWidth - document.body.clientWidth;
}
  $.fn.menumaker = function(options) {
      
      var cssmenu = $(this), settings = $.extend({
        title: "Menu",
        format: "dropdown",
        breakpoint: 980 - calculateScrollBarWidth(),
        sticky: false
      }, options);

      return this.each(function() {
        cssmenu.find('li ul').parent().addClass('has-sub');
        if (settings.format != 'select') {
          cssmenu.prepend('<div id="menu-button">' + settings.title + '</div>');
          $(this).find("#menu-button").on('click', function(){
			  $('body').toggleClass('no-scroll');
			  $(this).parent().toggleClass('white-bg');
			  
            $(this).toggleClass('menu-opened');
            var mainmenu = $(this).next('ul');
            if (mainmenu.hasClass('open')) { 
              mainmenu.hide().removeClass('open');
            }
            else {
              mainmenu.show().addClass('open');
              if (settings.format === "dropdown") {
                mainmenu.find('ul').show();
              }
            }
          });

          multiTg = function() {
            cssmenu.find(".has-sub").prepend('<span class="submenu-button"></span>');
            cssmenu.find('.submenu-button').on('click', function() {
              $(this).toggleClass('submenu-opened');
              if ($(this).siblings('ul').hasClass('open')) {
                $(this).siblings('ul').removeClass('open').hide();
              }
              else {
                $(this).siblings('ul').addClass('open').show();
              }
            });
          };

          if (settings.format === 'multitoggle') multiTg();
          else cssmenu.addClass('dropdown');
        }

        else if (settings.format === 'select')
        {
          cssmenu.append('<select style="width: 100%"/>').addClass('select-list');
          var selectList = cssmenu.find('select');
          selectList.append('<option>' + settings.title + '</option>', {
                                                         "selected": "selected",
                                                         "value": ""});
          cssmenu.find('a').each(function() {
            var element = $(this), indentation = "";
            for (i = 1; i < element.parents('ul').length; i++)
            {
              indentation += '-';
            }
            selectList.append('<option value="' + $(this).attr('href') + '">' + indentation + element.text() + '</option');
          });
          selectList.on('change', function() {
            window.location = $(this).find("option:selected").val();
          });
        }

        if (settings.sticky === true) cssmenu.css('position', 'fixed');

        resizeFix = function() {
          if ($(window).width() > settings.breakpoint) {
            cssmenu.find('ul').show();
            cssmenu.removeClass('small-screen');
            if (settings.format === 'select') {
              cssmenu.find('select').hide();
            }
            else {
              cssmenu.find("#menu-button").removeClass("menu-opened");
            }
          }

          if ($(window).width() <= settings.breakpoint && !cssmenu.hasClass("small-screen")) {
            cssmenu.find('ul').hide().removeClass('open');
            cssmenu.addClass('small-screen');
            if (settings.format === 'select') {
              cssmenu.find('select').show();
            }
          }
        };
        resizeFix();
        return $(window).on('resize', resizeFix);

      });
  };
})(jQuery);


// Function to toggle Nav
function toggleNav(nav,menu_toggle_button) {
  nav.classList.toggle('open-nav');
  menu_toggle_button.classList.toggle('opened-menu');
  document.body.classList.toggle('no-scroll');
}

// Function to add click event listener on menu toggle button
function addToggleNavListener() {
  const nav = document.querySelector('.top-nav');
  const menu_toggle_button = document.querySelector('.menu-toggle');
  menu_toggle_button.addEventListener('click',function(){toggleNav(nav,menu_toggle_button)},false);
}

function showSearch(search_element,search_input) {
  document.querySelector('.fixed-bottom-div') ? document.querySelector('.fixed-bottom-div').style.zIndex = 1  : '';
  document.querySelector('.footer-container') ? document.querySelector('.footer-container').style.zIndex = 1 : '';
  document.querySelector('.related-reports-prev') ? document.querySelector('.related-reports-prev').style.zIndex = 1 : '';
  document.querySelector('.related-reports-next') ? document.querySelector('.related-reports-next').style.zIndex = 1 : '';
  document.querySelector('.carousel-nav') ? document.querySelector('.carousel-nav').style.zIndex = 0 : '';
  search_input.classList.add('show-search-input');
  search_element.classList.add('show-search-results');
  search_input.focus();
  document.body.classList.add('no-scroll');
}

function hideSearch(search_element,search_input) {
  document.querySelector('.fixed-bottom-div') ? document.querySelector('.fixed-bottom-div').style.zIndex = 25 : '';
  document.querySelector('.footer-container') ? document.querySelector('.footer-container').style.zIndex = 2 : '';
  document.querySelector('.related-reports-prev') ? document.querySelector('.related-reports-prev').style.zIndex = 2 : '';
  document.querySelector('.related-reports-next') ? document.querySelector('.related-reports-next').style.zIndex = 2 : '';
  document.querySelector('.carousel-nav') ? document.querySelector('.carousel-nav').style.zIndex = 2 : '';
  search_input.classList.remove('show-search-input');
  search_input.value = '';
  const search_results_list = document.querySelector('.search-results-list');  
  while (search_results_list.firstChild) search_results_list.removeChild(search_results_list.firstChild);
  search_element.classList.remove('show-search-results');
  search_input.blur();
  document.body.classList.remove('no-scroll');
}

function addShowSearchListener() {
  const search_element = document.querySelector('.search-results-container');
  const search_input = document.querySelector('.search-reports-input');
  search_input.addEventListener('click',function(){showSearch(search_element,search_input)},false);
}

function addHideSearchListener() {
  const search_input = document.querySelector('.search-reports-input');
  const search_element = document.querySelector('.search-results-container');
  const search_close_button = document.querySelector('.close-search-button');
  search_close_button.addEventListener('click',function(){hideSearch(search_element,search_input)},false);
}

window.addEventListener('DOMContentLoaded',function() {
  //addToggleNavListener();
  //addShowSearchListener();
  //addHideSearchListener();
});


	var dd_height = $('.mr-menu').height();
	
		$('.sub-dropdown-menu').height(dd_height);
	
/* validate business email Domain start */
function validateDomain(objform){
	var fieldId = '#'+objform.attr('id');
	var me= $(fieldId).val();
	var idx1 = me.indexOf("@");
	var domains = ["msn","yahoo","gmail","aol","Gigs","aim","aussie","bigstring","bluebottle","boarderemail","canada","canoe","care2","dcemail","dbzmail","didamail","fastermail","fastmail","gawab","graffiti","hotpop","hushmail","icqmail","inbox","inmail24","jubii","linuxmail","litepost","lycos","mail","mail2world","mailsnare","merseymail","hotmail","muchomail","myway","opera","outgun","postmaster","prontomail","rediff","runbox","sacmail","safe-mail","ureach","vfemail","zilladog","fuser","grab","jump2email","mail2web","myemail","tamadaa","techemail","futureme","earthclassmail","l8r","hoaxmail","postful","pranketh","2prong","shinyletter","e4ward","dodgeit","emailias","gishpuppy","guerrillamail","mailexpire","spam","pookmail","mailnator","spambox","spamex","spamgourmet","tempinbox","zoemail","rocketmail","163","btinernet","yandex"];
	if(idx1>-1){
		var splitStr = me.split("@");
		var sub = splitStr[1].split(".");
		console.log(sub[0]);
		if(domains.indexOf(sub[0].toLowerCase())> -1){
				$("#errorMessage").html('<b style="color:red;">&emsp;Note : We respond quickly to business emails. So please use your company email if available.</b>');
			//alert('We1 respond quickly to company emails, So if you are individual or consultant send your request to sales@industryarc.com');
			$(fieldId).val('');
			//$(fieldId).attr('placeholder', 'Enter your business or official Email' );
		}else{
			//$("#errorMessage").html();
		}
	 }
}
/* validate business email Domain end */