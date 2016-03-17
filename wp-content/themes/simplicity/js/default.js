var $j = jQuery.noConflict();
var logo_height;
var logo_height_sticky;
var header_height;
var scroll = 0;

$j(document).ready(function() {
	"use strict";
	
	header_height = $j('header').height() + 1; // 1 is for bottom border
	
	dropDownMenu();

	dropDownWpml();
	
	setDropDownMenuPosition();

	initSelectMenu();

	initCouroselSlider();

	initFlexSlider();
	
	fitVideo();

	prettyPhoto();

	initNiceScroll();

	initMessages();

	initAccordion();
	
	socialShare();

	initAccordionContentLink();

	initTestimonialSlider();

	placeholderReplace();

	addPlaceholderSearchWidget();

	checkIfBrowserIsSafariMac();
	
	if($j('.animation_content').length === 0){
		initToCounter();
		initCounter();
		initListAnimation();
		initServices();
		initProgressBars();
		initProgressBarsVertical();
		initProgressBarsIcon();
		initElements();
		initPieChart();
	}
	
	initButtonHover();
	
	loadMore();

	initMoreFacts();
	
	initParallax(parallax_speed);
	
	backButtonInterval();
	
	backToTop();
});

$j(window).load(function(){
	"use strict";

	$j('.touch .main_menu li:has(div.second)').doubleTapToGo(); // load script to close menu on youch devices
	logo_height = $j('.logo img.normal').height();
	logo_height_sticky = $j('.logo img.sticky').height();
	
	checkLogo();
	$j('.logo a').css('visibility','visible');
	
	startAnimation();

	initPortfolio();

	initPortfolioSingleInfo();
	
	initBlog();
	
	fitAudio();

	initTabs();

	initSocialWidget();
});

$j(window).scroll(function() {
	"use strict";
	
	scroll = $j(window).scrollTop();
	if($j(window).width() > 768){
		initStickyHeader(scroll);
	}else{
		$j('header').removeClass('sticky_animate');
		$j('header').removeClass('sticky');
		$j('.content').css('padding-top','0px');
	}
	header_height = $j('header').height() + 1; // 1 is for bottom border
	checkLogo();
});

$j(window).resize(function() {
	"use strict";
	
	header_height = $j('header').height() + 1; // 1 is for bottom border
	setDropDownMenuPosition();
	checkLogo();
	initSocialWidget();
	initMoreFacts();
	fitAudio();
	
	if($j(window).width() < 768){
		$j('header').removeClass('sticky_animate');
		$j('header').removeClass('sticky');
		$j('.content').css('padding-top','0px');
	}
});

function startAnimation(){
	"use strict";

	$j('.wrapper').addClass('start_animation');
	
	var spectar_num = $j('.spectar.head span').length;
	var main_nav_num = $j('nav.main_menu > ul > li').length;
	$j('.header_right_widget').css('transition-delay',0.5+main_nav_num*0.1+0.1+'s'); // 0.5 is for first menu item delay, 0.1 is for header widget delay itself
	
	setTimeout(function(){
		$j('header').addClass('header_loaded');
		setTimeout(function(){
			
			$j('.title').addClass('loaded');
			setTimeout(function(){
				$j('.animation_content').addClass('start');
				showElementFadeIn(); 
				showPortfolioItems();	
				
				if($j('.animation_content').length){
					$j('.animation_content .container_inner, .animation_content .full_width_inner').css('-webkit-transform','none'); // removed because of Chrome bug
					initToCounter();
					initCounter();
					initListAnimation();
					initServices();
					initProgressBars();
					initProgressBarsVertical();
					initProgressBarsIcon();
					initElements();
					initPieChart();
				}
			},700); //700 is duration of title showing
		},main_nav_num*100 + 1200); //1200 is 500+700, 500 is delay for first item in menu, 700 is duration of menu item showing
	},spectar_num*200);
}

function showElementFadeIn(){
	"use strict";
	
	$j('.element_fade_in').appear( function() {
		$j(this).addClass('show_item');
	}, { accX: 0, accY: -150 });
	
}

function dropDownMenu(){
	"use strict";
	
	var menu_items = $j('.no-touch .drop_down > ul > li');

	menu_items.each( function(i) {

		if ($j(menu_items[i]).find('.second').length > 0) {
		
			$j(this).data('original_height', $j(this).find('.second').height() + 'px');
			$j(this).find('.second').hide();
			
			$j(this).mouseenter(function(){
				$j(this).find('.second').css({'visibility': 'visible', 'opacity': '0', 'display': 'block', 'margin-top': '40px'});
				$j(this).find('.second').stop().animate({'height': $j(this).data('original_height'),'margin-top': '0px',opacity:1}, 400, function() {
					$j(this).find('.second').css('overflow', 'visible');
				});

				dropDownMenuThirdLevel();
			}).mouseleave( function(){
				$j(this).find('.second').css('display', 'none').stop().animate(100 , function() {
					$j(this).find('.second').css({'overflow': 'hidden', 'visibility': 'hidden'});
				});
			});
		}
	});
}

function dropDownMenuThirdLevel(){
	"use strict";

	var menu_items2 = $j('.no-touch .drop_down ul li > .second > .inner > .inner2 > ul > li');
	menu_items2.each( function(i) {
		if ($j(menu_items2[i]).find('ul').length > 0) {
			var sum=0;
			$j(menu_items2[i]).find('ul li').each( function(){ sum+=$j(this).find('a').height()+8;});
			
			$j(menu_items2[i]).data('original_height', sum + 'px');
			
			$j(menu_items2[i]).mouseenter(function(){
				$j(menu_items2[i]).find('ul').css({'visibility': 'visible', 'opacity':'0', 'height': $j(menu_items2[i]).data('original_height'), 'display': 'block', 'margin-top': '40px'});
				$j(menu_items2[i]).find('ul').stop().animate({'margin-top': '0px',opacity:1}, 300, function() {
					$j(menu_items2[i]).find('ul').css('overflow', 'visible');
				});
			}).mouseleave(function(){
				$j(menu_items2[i]).find('ul').css('height', '0px').stop().animate(100, function() {
					$j(menu_items2[i]).find('ul').css({'overflow': 'hidden', 'visibility': 'hidden'});
				});
			});

			$j(menu_items2[i]).find('ul').mouseenter(function(){
				$j(menu_items2[i]).addClass('change_hover');
			}).mouseleave(function(){
				$j(menu_items2[i]).removeClass('change_hover');
			});
		}
	});
}

function setDropDownMenuPosition(){
	"use strict";

	var menu_items = $j(".drop_down > ul > li");
	menu_items.each( function(i) {

		var browser_width = $j(window).width()-16; // 16 is width of scroll bar
		var boxed_layout = 1150; // boxed layout width
		var menu_item_position = $j(menu_items[i]).offset().left;
		var sub_menu_width = $j('.drop_down .second .inner2 ul').width();
		var menu_item_from_left = 0;
		if($j('body').hasClass('boxed')){
			menu_item_from_left = boxed_layout - (menu_item_position - (browser_width - boxed_layout)/2) + 30; // 30 is right padding between menu elements
		} else {
			menu_item_from_left = browser_width - menu_item_position + 30; // 30 is right padding between menu elements
		}
		var sub_menu_from_left;
			
		if($j(menu_items[i]).find('li.sub').length > 0){
			sub_menu_from_left = menu_item_from_left - sub_menu_width;
		}
		
		if(menu_item_from_left < sub_menu_width || sub_menu_from_left < sub_menu_width){
			$j(menu_items[i]).find('.second').addClass('right');
			$j(menu_items[i]).find('.second .inner .inner2 ul').addClass('right');
		}
	});
}

function dropDownWpml(){
	"use strict";
	
	var menu_items = $j('.no-touch #lang_sel > ul > li');

	menu_items.each( function(i) {

		if ($j(menu_items[i]).find('ul').length > 0) {
		
			$j(this).data('original_height', $j(this).find('ul').height() + 'px');
			$j(this).find('ul').hide();
			
			$j(this).mouseenter(function(){
				$j(this).find('ul').css({'visibility': 'visible', 'opacity': '0', 'display': 'block', 'top': '200%'});
				$j(this).find('ul').stop().animate({'height': $j(this).data('original_height'),'top': '100%',opacity:1}, 400, function() {
					$j(this).find('ul').css('overflow', 'visible');
				});

				dropDownMenuThirdLevel();
			}).mouseleave( function(){
				$j(this).find('ul').css('display', 'none').stop().animate(100 , function() {
					$j(this).find('ul').css({'overflow': 'hidden', 'visibility': 'hidden'});
				});
			});
		}
	});
}


function socialShare(){
	"use strict";
	
	var menu_item = $j('.no-touch .social_share_dropdown');

		if ($j(menu_item).length > 0) {
			menu_item.each( function(i) {
				var maxWidthImage = Math.max.apply( null, $j('.social_image').map( function () {
					return $j(this).outerWidth(true);
				}).get());
				var maxWidthText = Math.max.apply( null, $j('.share_text').map( function () {
					return $j(this).outerWidth(true);
				}).get());
				var ul_width = maxWidthImage + maxWidthText + 5; //padding 20
				//$j(menu_item).hide();
				$j(menu_item[i]).parent().mouseenter(function(){
					$j(menu_item[i]).find('ul').css({'width': ul_width});
					$j('.share_text').css({'width': maxWidthText - 10});
					$j(menu_item[i]).css({'visibility':'visible','overflow': 'visible','opacity': '0','display': 'block','margin-top':'40px','margin-left': - ul_width/2});
					$j(menu_item[i]).stop().animate({'margin-top': '0px','opacity':'1'}, 400);
				}).mouseleave( function(){
					$j(menu_item[i]).css({'overflow':'hidden','visibility': 'hidden','display':'none'});
				});
			});
		}
}

function initNiceScroll(){
	"use strict";

	if($j('.smooth_scroll').length){	
		$j("html").niceScroll({ 
			scrollspeed: 60, 
			mousescrollstep: 35, 
			cursorwidth: 20, 
			cursorborder: 0, 
			cursorcolor: "#ffffff",
			autohidemode: false, 
			horizrailenabled: false
		});
	}
}

function initPortfolio(){
	"use strict";
	
	if($j('.projects_holder_outer').length){
	
		$j('.projects_holder_outer').each(function(){
		
			$j(this).find('.projects_holder').mixitup({
				showOnLoad: 'all',
				transitionSpeed: 600,
				minHeight: 150
			});
		});
	}
}

function showPortfolioItems(){
	"use strict";

	$j('.projects_holder .mix').appear( function() {
		if(!$j(this).hasClass('show_item')){
			$j(this).addClass('show_item');
		}
	}, { accX: 0, accY: -150 });
	
}

function initBlog(){
	"use strict";
	
	if($j('.blog_holder_v3').length){
		var $container = $j('.blog_holder_v3');
		var $cols = 4;
			
		if($j('.container_inner').width() === 420) {
			$cols = 2;
		} else if($j('.container_inner').width() === 768) {
			$cols = 3;
		}
		
		$container.isotope({
			itemSelector: 'article',
			resizable: false,
			masonry: { columnWidth: $j('.blog_holder_v3').width() / $cols }
		});

		$j(window).resize(function(){
			if($j('.container_inner').width() === 420) {
				$cols = 2;
			} else if($j('.container_inner').width() === 768){
				$cols = 3;
			}  else {
				$cols = 4;
			}
		});
		
		$j(window).smartresize(function(){
			$container.isotope({
				masonry: { columnWidth: $j('.blog_holder_v3').width() / $cols}
			});
		});
	}	
}

(function($) {
	"use strict";

	$.fn.countTo = function(options) {
		// merge the default plugin settings with the custom options
		options = $.extend({}, $.fn.countTo.defaults, options || {});

		// how many times to update the value, and how much to increment the value on each update
		var loops = Math.ceil(options.speed / options.refreshInterval),
		increment = (options.to - options.from) / loops;

		return $(this).each(function() {
			var _this = this,
			loopCount = 0,
			value = options.from,
			interval = setInterval(updateTimer, options.refreshInterval);

			function updateTimer() {
				value += increment;
				loopCount++;
				$(_this).html(value.toFixed(options.decimals));

				if (typeof(options.onUpdate) === 'function') {
					options.onUpdate.call(_this, value);
				}

				if (loopCount >= loops) {
					clearInterval(interval);
					value = options.to;

					if (typeof(options.onComplete) === 'function') {
						options.onComplete.call(_this, value);
					}
				}
			}
		});
	};

	$.fn.countTo.defaults = {
		from: 0,  // the number the element should start at
		to: 100,  // the number the element should end at
		speed: 1000,  // how long it should take to count between the target numbers
		refreshInterval: 100,  // how often the element should be updated
		decimals: 0,  // the number of decimal places to show
		onUpdate: null,  // callback method for every time the element is updated,
		onComplete: null,  // callback method for when the element finishes updating
	};
})(jQuery);

function initToCounter(){
	"use strict";
	
	if($j('.counter.type1').length){
		$j('.counter.type1').each(function() {
			$j(this).appear(function() {
				$j(this).parent().css('opacity', '1');
				var $max = parseFloat($j(this).text());
				$j(this).countTo({
					from: 0,
					to: $max,
					speed: 1500,
					refreshInterval: 50
				});
			},{accX: 0, accY: -200});
		});
	}
}

function initCounter(){
	"use strict";
	
	if($j('.counter.type2').length){
		$j('.counter.type2').each(function() {
			
			if(!$j(this).hasClass('executed')){
				$j(this).addClass('executed');
				$j(this).appear(function() {
					$j(this).parent().css('opacity', '1');
					$j(this).absoluteCounter({
						speed: 2000,
						fadeInDelay: 1000
					});
				},{accX: 0, accY: -200});
			}
		});
	}
}

function initCouroselSlider(){
	"use strict";

	if($j('.carousel_slider li').length > 0){

		var speed = $j('.carousel_slider li').length*4000;

		$j('.carousel_slider').bxSlider({
			pager: false,
			controls: false,
			speed: speed,
			ticker: true,
			tickerHover: true,
			useCSS: false,
			minSlides: 1,
			maxSlides: 20,
			slideWidth: 200,
			slideMargin: 20
		});
	}
}

function fitVideo(){
	"use strict";
	
	$j(".portfolio_images").fitVids();
	$j(".video_holder").fitVids();
	$j(".post_image_video").fitVids();
}
function fitAudio(){
	"use strict";
	
	$j('audio').mediaelementplayer({
		audioWidth: '100%'
	});
}
function initFlexSlider(){
	"use strict";
	
	$j('.flexslider').flexslider({
		animationLoop: true,
		controlNav: false,
		useCSS: false,
		pauseOnAction: true,
		pauseOnHover: true,
		slideshow: true,
		animation: 'slides',
		animationSpeed: 600,
		slideshowSpeed: 8000,
		start: function(){
			setTimeout(function(){$j(".flexslider").fitVids(); initNiceScroll();},100);
		}
	});
	
	$j('.flex-direction-nav a').click(function(e){
		e.preventDefault();
		e.stopImmediatePropagation();
		e.stopPropagation();
	});
}

function prettyPhoto(){
	"use strict";		

	$j('a[data-rel]').each(function() {
		$j(this).attr('rel', $j(this).data('rel'));
	});

	$j("a[rel^='prettyPhoto']").prettyPhoto({
		animation_speed: 'fast', /* fast/slow/normal */
		slideshow: false, /* false OR interval time in ms */
		autoplay_slideshow: false, /* true/false */
		opacity: 0.80, /* Value between 0 and 1 */
		show_title: true, /* true/false */
		allow_resize: true, /* Resize the photos bigger than viewport. true/false */
		default_width: 500,
		default_height: 344,
		counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
		theme: 'pp_default', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
		hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
		wmode: 'opaque', /* Set the flash wmode attribute */
		autoplay: true, /* Automatically start videos: True/False */
		modal: false, /* If set to true, only the close button will close the window */
		overlay_gallery: false, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
		keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
		deeplinking: false,
		social_tools: false
	});
}

var $scrollHeight;
function initPortfolioSingleInfo(){
	"use strict";

	var $sidebar   = $j(".portfolio_single_follow");
	if($j(".portfolio_single_follow").length > 0){
	
		var offset = $sidebar.offset();
		$scrollHeight = $j(".portfolio_container").height();
		var $scrollOffset = $j(".portfolio_container").offset();
		var $window = $j(window);
		
		var $headerHeight = $j('header').height();
		
		$window.scroll(function() {
			if($window.width() > 960){
				if ($window.scrollTop() + $headerHeight + 3 > offset.top) {
					if ($window.scrollTop() + $headerHeight + $sidebar.height() + 24 < $scrollOffset.top + $scrollHeight) {
						$sidebar.stop().animate({
							marginTop: $window.scrollTop() - offset.top + $headerHeight
						});
					} else {
						$sidebar.stop().animate({
							marginTop: $scrollHeight - $sidebar.height() - 24
						});
					}
				} else {
					$sidebar.stop().animate({
						marginTop: 0
					});
				}		
			}else{
				$sidebar.css('margin-top',0);
			}
		});
	}
}

function checkLogo(){
	"use strict";

	var padding = 0;
	if($j(window).width() < 752){
		if(logo_height >= 90){
			$j('.logo a').height(90);
			$j('.logo').css('padding','5px 0px');
		}else{
			padding = (90-logo_height)/2;
			$j('.logo').css('padding',padding+'px 0px');
		}
	}else{
		if(header_height - logo_height >= 10){
			$j('.logo a').height(logo_height);
		}else if(header_height - logo_height < 10){
			$j('.logo a').height(header_height - 10);
		}
	}
	
	$j('.logo a img').css('height','100%');
	$j('.logo a img.normal').css('display','block'); // iPad fix for logo on load
}

function initSelectMenu(){
	"use strict";
	
	$j(".mobile_menu_button span").click(function () {
		if ($j(".mobile_menu > ul").is(":visible")){
			$j(".mobile_menu > ul").slideUp();
		} else {
			$j(".mobile_menu > ul").slideDown();
		}
	});
	
	$j(".mobile_menu > ul > li.has_sub > a > span.mobile_arrow").click(function () {
		if ($j(this).closest('li.has_sub').find("> ul.sub_menu").is(":visible")){
			$j(this).closest('li.has_sub').find("> ul.sub_menu").slideUp();
			$j(this).closest('li.has_sub').removeClass('open_sub');
		} else {
			$j(this).closest('li.has_sub').addClass('open_sub');
			$j(this).closest('li.has_sub').find("> ul.sub_menu").slideDown();
		}
	});

	$j(".mobile_menu > ul > li.has_sub > ul.sub_menu > li.has_sub > a > span.mobile_arrow").click(function () {
		if ($j(this).parent().parent().find("ul.sub_menu").is(":visible")){
			$j(this).parent().parent().find("ul.sub_menu").slideUp();
			$j(this).parent().parent().removeClass('open_sub');
		} else {
			$j(this).parent().parent().addClass('open_sub');
			$j(this).parent().parent().find("ul.sub_menu").slideDown();
		}
	});
	
	$j(".mobile_menu ul li a").click(function () {
		if(($j(this).attr('href') !== "http://#") && ($j(this).attr('href') !== "#")){
			$j(".mobile_menu > ul").slideUp();
		}else{
			return false;
		}
	});

	$j(".mobile_menu ul li a span.mobile_arrow").click(function () {
		return false;
	});
}

function initMessages(){
	"use strict";

	$j('.message').each(function(){
		$j(this).find('.close').click(function(e){
			e.preventDefault();
			$j(this).parent().fadeOut(500);
		});
	});
}

function initAccordion(){
	"use strict";
	
	$j( ".accordion" ).accordion({
		animate: "swing",
		collapsible: true,
		icons: "",
		heightStyle: "content"
	});
	
	$j(".toggle").addClass("accordion ui-accordion ui-accordion-icons ui-widget ui-helper-reset")
	.find("h5")
	.addClass("ui-accordion-header ui-helper-reset ui-state-default ui-corner-top ui-corner-bottom")
	.hover(function() { $j(this).toggleClass("ui-state-hover"); })
	.click(function() {
	$j(this)
		.toggleClass("ui-accordion-header-active ui-state-active ui-state-default ui-corner-bottom")
		.next().toggleClass("ui-accordion-content-active").slideToggle(200);
		return false;
	})
	.next()
	.addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom")
	.hide(); 
}

function initAccordionContentLink(){
	"use strict";

	$j('.accordion_holder .accordion_inner .accordion_content a').click(function(){
		if($j(this).attr('target') === '_blank'){
			window.open($j(this).attr('href'),'_blank');
		}else{
			window.open($j(this).attr('href'),'_self');
		}
		return false;
	});
}

function initTestimonialSlider(){
	"use strict";

	if($j('.testimonial_slider').length > 0){
		$j('.testimonial_slider').bxSlider({
			auto: true,
			mode: 'fade',
			pager: false,
			controls: true,
			speed: 2000,
			infiniteLoop: true,
			slideMargin: 5
		});
	}
}

function initTabs(){
	"use strict";

	var $tabsNav = $j('.tabs-nav');
	var $tabsNavLis = $tabsNav.children('li');
	$tabsNav.each(function() {
		var $this = $j(this);
		$this.next().children('.tab-content').stop(true,true).hide().first().show();
		$this.children('li').first().addClass('active').stop(true,true).show();
	});
	$tabsNavLis.on('click', function(e) {
		var $this = $j(this);
		$this.siblings().removeClass('active').end().addClass('active');
		$this.parent().next().children('.tab-content').stop(true,true).hide().siblings( $this.find('a').attr('href') ).fadeIn();
		e.preventDefault();
	}); 
}

function placeholderReplace(){
	"use strict";

	$j('[placeholder]').focus(function() {
		var input = $j(this);
		if (input.val() === input.attr('placeholder')) {
			if (this.originalType) {
				this.type = this.originalType;
				delete this.originalType;
			}
			input.val('');
			input.removeClass('placeholder');
		}
	}).blur(function() {
		var input = $j(this);
		if (input.val() === '') {
			if (this.type === 'password') {
				this.originalType = this.type;
				this.type = 'text';
			}
			input.addClass('placeholder');
			input.val(input.attr('placeholder'));
		}
	}).blur();

	$j('[placeholder]').parents('form').submit(function () {
		$j(this).find('[placeholder]').each(function () {
			var input = $j(this);
			if (input.val() === input.attr('placeholder')) {
				input.val('');
			}
		});
	});
}

function addPlaceholderSearchWidget(){
	"use strict";
	
	$j('.header_right_widget #searchform input:text, .widget.widget_search form input:text, footer .footer_top_inner #searchform input:text').each(
		function(i,el) {
		if (!el.value || el.value === '') {
			el.placeholder = 'Search';
		}
	});
}

function initListAnimation(){
	"use strict";
	
	$j('.animate_list').each(function(){
		$j(this).appear(function() {
			$j(this).find("li").each(function (l) {
				var k = $j(this);
				setTimeout(function () {
					k.animate({
						opacity: 1,
						top: 0
					}, 1500);
				}, 100*l);
			});
		},{accX: 0, accY: -200});
	});
}

function initServices(){
	"use strict";
	
	$j('.services_holder.yes').appear(function() {
			$j(this).addClass('animate_services');
	},{accX: 0, accY: -200});
}

function initProgressBars(){
	"use strict";

	if($j('.progress_bars').length){
		$j('.progress_bars').each(function() {
			$j(this).appear(function() {
				initToCounterHorizontalProgressBar($j(this));
				$j(this).find('.progress_bar').each(function() {
					var percentage = $j(this).find('.progress_content').data('percentage');
					var percent_width = $j(this).find('.progress_number').width();
					$j(this).find('.progress_content').css('width', '0%');
					$j(this).find('.progress_content').animate({'width': percentage+'%'}, 1500);
					$j(this).find('.progress_number').css('width', percent_width+'px');
				});
			},{accX: 0, accY: -200});
		});
	}
}

function initToCounterHorizontalProgressBar($this){
	"use strict";

	if($this.find('.progress_number span').length){
		$this.find('.progress_number span').each(function() {
			$j(this).parent().css('opacity', '1');
			var $max = parseFloat($j(this).text());
			$j(this).countTo({
				from: 0,
				to: $max,
				speed: 1500,
				refreshInterval: 50
			});
		});
	}
}

function initProgressBarsVertical(){
	"use strict";

	if($j('.progress_bars_vertical_holder').length){
		$j('.progress_bars_vertical_holder').each(function() {

			var progress_bar_number = 0;

			$j(this).find('.progress_bars_vertical').each(function(){
				progress_bar_number ++; 
			});

			$j(this).find('.progress_bars_vertical').css('width', 100/progress_bar_number-0.3 + '%');		

			$j(this).appear(function() {
				initToCounterVerticalProgressBar();
				$j(this).find('.progress_bars_vertical').each(function() {
					var percentage = $j(this).find('.progress_content').data('percentage');
					$j(this).find('.progress_content').css('height', '0%');
					$j(this).find('.progress_content').animate({
						height: percentage+'%'
					}, 1500);
				});
			},{accX: 0, accY: -200});
		});
	}
}

function initToCounterVerticalProgressBar(){
	"use strict";

	if($j('.progress_bars_vertical .progress_number span').length){
		$j('.progress_bars_vertical .progress_number span').each(function() {
			var $max = parseFloat($j(this).text());
			$j(this).countTo({
				from: 0,
				to: $max,
				speed: 1500,
				refreshInterval: 50
			});
		});
	}
}

var timeOuts = new Array(); 
function initProgressBarsIcon(){
	"use strict";

	if($j('.progress_bars_with_image_holder').length){
		$j('.progress_bars_with_image_holder').each(function() {
			var $this = $j(this);
			$this.appear(function() {
				$this.find('.progress_bars_with_image').each(function(i) {
					var number = $j(this).find('.progress_bars_with_image_content').data('number');
					var bars = $j(this).find('.bar');
				
					bars.each(function(i){
						if(i < number){
							var time = (i + 1)*150;
							timeOuts[i] = setTimeout(function(){
								$j(bars[i]).addClass('active');
							},time);
						}
					});
				});
			},{accX: 0, accY: -200});
		});
	}
}

function initPieChart(){
	"use strict";
 
	if($j('.percentage').length){
		$j('.percentage').each(function() {

			var $barColor = '#e84c3d';

			if($j(this).data('active') !== ""){
				$barColor = $j(this).data('active');
			}

			var $trackColor = '#263244';

			if($j(this).data('noactive') !== ""){
				$trackColor = $j(this).data('noactive');
			}

			var $line_width = 28;

			if($j(this).data('linewidth') !== ""){
				$line_width = $j(this).data('linewidth');
			}
			
			var $size = 178;

			$j(this).appear(function() {
				initToCounterPieChart($j(this));
				$j(this).parent().css('opacity', '1');
				
				$j(this).easyPieChart({
					barColor: $barColor,
					trackColor: $trackColor,
					scaleColor: false,
					lineCap: 'butt',
					lineWidth: $line_width,
					animate: 1500,
					size: $size
				}); 
			},{accX: 0, accY: -200});
		});
	}
}

function initToCounterPieChart($this){
	"use strict";

	$j($this).css('opacity', '1');
	var $max = parseFloat($j($this).find('.tocounter').text());
	$j($this).find('.tocounter').countTo({
		from: 0,
		to: $max,
		speed: 1500,
		refreshInterval: 50
	});
}

function initSocialWidget(){
	"use strict";

	if($j(window).width() > 768){
		$j('#social_icons_widget .social_icons_widget_inner').css({'height': $j('#social_icons_widget .social_icons_widget_inner').height(), 'visibility': 'visible'});
	}
}

function initElements(){
	"use strict";

	if($j(".element_from_fade").length){
		$j('.element_from_fade').each(function(){
			var $this = $j(this);
						
			$this.appear(function() {
				$this.addClass('element_from_fade_on');	
			},{accX: 0, accY: -200});
		});
	}
	
	if($j(".element_from_left").length){
		$j('.element_from_left').each(function(){
			var $this = $j(this);
						
			$this.appear(function() {
				$this.addClass('element_from_left_on');	
			},{accX: 0, accY: -200});		
		});
	}
	
	if($j(".element_from_right").length){
		$j('.element_from_right').each(function(){
			var $this = $j(this);
						
			$this.appear(function() {
				$this.addClass('element_from_right_on');	
			},{accX: 0, accY: -200});
		});
	}
	
	if($j(".element_from_top").length){
		$j('.element_from_top').each(function(){
			var $this = $j(this);
						
			$this.appear(function() {
				$this.addClass('element_from_top_on');	
			},{accX: 0, accY: -200});
		});
	}
	
	if($j(".element_from_bottom").length){
		$j('.element_from_bottom').each(function(){
			var $this = $j(this);
						
			$this.appear(function() {
				$this.addClass('element_from_bottom_on');	
			},{accX: 0, accY: -200});			
		});
	}
	
	if($j(".element_transform").length){
		$j('.element_transform').each(function(){
			var $this = $j(this);
						
			$this.appear(function() {
				$this.addClass('element_transform_on');	
			},{accX: 0, accY: -200});	
		});
	}	
}

function checkIfBrowserIsSafariMac(){
	"use strict";
	
	if (navigator.userAgent.indexOf('Safari') !== -1 && navigator.userAgent.indexOf('Mac') !== -1 && navigator.userAgent.indexOf('Chrome') === -1) {	
		$j('html').addClass('safari-mac');
	}
}

function initButtonHover(){
	"use strict";

	$j('.button, .portfolio_navigation .portfolio_prev a, .portfolio_navigation .portfolio_next a, .portfolio_navigation .portfolio_button a, .tagcloud a, .single_tags a, #submit_comment, .comment-reply-link, .load_more a, #back_to_top').mouseleave(function(){
		$j(this).removeClass('button_pressed');
	}).mousedown(function(){
		$j(this).addClass('button_pressed');
    });
}

function loadMore(){
	"use strict";
	
	var i = 1;
	
	$j('.load_more a').on('click', function(e)  {
		e.preventDefault();
		
		var link = $j(this).attr('href');
		var $content = '.projects_holder';
		var $anchor = '.portfolio_paging .load_more a';
		var $next_href = $j($anchor).attr('href'); // Get URL for the next set of posts
		var filler_num = $j('.projects_holder .filler').length;
		$j.get(link+'', function(data){
			$j('.projects_holder .filler').slice(-filler_num).remove();
			var $new_content = $j($content, data).wrapInner('').html(); // Grab just the content
			$next_href = $j($anchor, data).attr('href'); // Get the new href
			$j('article.mix:last').after($new_content); // Append the new content
			
			var min_height = $j('article.mix:first').height();
			$j('article.mix').css('min-height',min_height);
			
			$j('.projects_holder').mixitup('remix','all');
			prettyPhoto();
			if($j('.load_more').attr('rel') > i) {
				$j('.load_more a').attr('href', $next_href); // Change the next URL
			} else {
				$j('.load_more').remove(); 
			}
			$j('.projects_holder .portfolio_paging:last').remove(); // Remove the original navigation
			$j('article.mix').css('min-height',0);
			
			showPortfolioItems();
		});
		i++;
	});
}

function initMoreFacts(){
	"use strict";

	$j('.more_facts_holder').each(function(){
		var $more_label = 'More Facts';

		if($j(this).find('.more_facts_button').data('morefacts') !== ""){
			$more_label = $j(this).find('.more_facts_button').data('morefacts');
		}

		var $less_label = 'Less Facts';

		if($j(this).find('.more_facts_button').data('lessfacts') !== ""){
			$less_label = $j(this).find('.more_facts_button').data('lessfacts');
		}

		var height = $j(this).find('.more_facts_outer').height();

		var speed;
		if(height > 0 && height < 601){
			speed = 1000;
		} else if(height > 600 && height < 1201){
			speed = 2000;
		} else{
			speed = 2500;
		}
		$j(this).find('.more_facts_outer').css({'height':'0px','display':'none'});	

		$j(this).find('.more_facts_button').click(function(){
			if(!$j(this).hasClass('facts_opened')){
				$j(this).parent().parent().find('.more_facts_outer').css('display', 'block').stop().animate({'height': height+30}, speed);
				$j(this).text($less_label);
				$j(this).addClass('facts_opened');
			} else {
				$j(this).parent().parent().find('.more_facts_outer').stop().animate({'height': '0px'}, speed,function(){
					$j(this).css('display', 'none');
				});
				$j(this).text($more_label);
				$j(this).removeClass('facts_opened');
			}
		});
	});	
}

function initParallax(speed){
	"use strict";
	
	if($j('.parallax section').length){
		if($j('html').hasClass('touch')){
			$j('.parallax section').each(function() {
				var $self = $j(this);
				var section_height = $self.data('height');
				$self.height(section_height);
				var rate = 0.5;
				
				var bpos = (- $j(this).offset().top) * rate;
				$self.css({'background-position': 'center ' + bpos  + 'px' });
				
				$j(window).bind('scroll', function() {
					var bpos = (- $self.offset().top + $j(window).scrollTop()) * rate;
					$self.css({'background-position': 'center ' + bpos  + 'px' });
				});
			});
		}else{
			$j('.parallax section').each(function() {
				var $self = $j(this);
				var section_height = $self.data('height');
				$self.height(section_height);
				var rate = (section_height / $j(document).height()) * speed;
				
				var distance = $j.elementoffset($self);
				var bpos = - (distance * rate);
				$self.css({'background-position': 'center ' + bpos  + 'px' });
				
				$j(window).bind('scroll', function() {
					var distance = $j.elementoffset($self);
					var bpos = - (distance * rate);
					$self.css({'background-position': 'center ' + bpos  + 'px' });
				});
			});
		}
		return this;
	}
	
}

$j.elementoffset = function($element) {
	"use strict";
	
	var fold = $j(window).scrollTop();
	return (fold) - $element.offset().top +104;
};

function initStickyHeader(scroll){
	"use strict";
	
	if(scroll > header_height){
		
		if(!$j('header').hasClass('sticky')){
			$j('header').addClass('sticky');
			$j('.content').css('padding-top',header_height);
			// if($j('header.sticky').height() - logo_height_sticky >= 10){
				// $j('.logo a').height(logo_height_sticky);
			// }else if($j('header.sticky').height() - logo_height_sticky < 10){
				// $j('.logo a').height($j('header.sticky').height() - 10);
			// }
			
			setTimeout(function(){
				$j('header').addClass('sticky_animate');
			},100);
		}
	}else{
		if($j('header').hasClass('sticky')){
			// if(header_height - logo_height >= 10){
				// $j('.logo a').height(logo_height);
			// }else if(header_height - logo_height < 10){
				// $j('.logo a').height(header_height - 10);
			// }
			
			$j('header').removeClass('sticky_animate');
			$j('header').removeClass('sticky');
			$j('.content').css('padding-top','0px');
		}
	}
}

function totop_button(a) {
	"use strict";

	var b = $j("#back_to_top");
	b.removeClass("off on");
	if (a === "on") { b.addClass("on"); } else { b.addClass("off"); }
}

function backButtonInterval(){
	"use strict";

	window.setInterval(function () {
		var b = $j(this).scrollTop();
		var c = $j(this).height();
		var d;
		if (b > 0) { d = b + c / 2; } else { d = 1; }
		if (d < 1e3) { totop_button("off"); } else { totop_button("on"); }
	}, 300);
}

function backToTop(){
	"use strict";
	
	$j(document).on('click','#back_to_top',function(e){
		e.preventDefault();
		
		$j('body,html').animate({scrollTop: 0}, $j(window).scrollTop()/3, 'swing');
	});
}