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