/*
 *
 *		CUSTOM.JS
 *
 */

(function($){
	
	"use strict";
	
	// DETECT TOUCH DEVICE //
	function is_touch_device() {
		return !!('ontouchstart' in window) || ( !! ('onmsgesturechange' in window) && !! window.navigator.maxTouchPoints);
	}
	
	
	// SHOW/HIDE MOBILE MENU //
	function show_hide_mobile_menu() {
		
		$("#mobile-menu-button").on("click", function(e) {
            
			e.preventDefault();
			
			$("#mobile-menu").slideToggle(300);
			
        });	
		
	}
	
	
	// MOBILE MENU //
	function mobile_menu() {
		
		if ($(window).width() < 992) {
			
			if ($("#menu").length > 0) {
			
				if ($("#mobile-menu").length < 1) {
					
					$("#menu").clone().attr({
						id: "mobile-menu",
						class: ""
					}).insertAfter("#header");
					
					$("#mobile-menu .megamenu > a").on("click", function(e) {
                        
						e.preventDefault();
						
						$(this).toggleClass("open").next("div").slideToggle(300);
						
                    });
					
					$("#mobile-menu .dropdown > a").on("click", function(e) {
                        
						e.preventDefault();
						
						$(this).toggleClass("open").next("ul").slideToggle(300);
						
                    });
				
				}
				
			}
				
		} else {
			
			$("#mobile-menu").hide();
			
		}
		
	}
	
	
	// STICKY //
	function sticky() {
		
		var sticky_point = 200;
		
		if ($(window).scrollTop() > sticky_point) {  
			$("#header").addClass("header-sticky");
		} else {
			$("#header").removeClass("header-sticky");
		}
		
		if ($(window).scrollTop() > sticky_point){  
			$(".elements-menu").addClass("elements-menu-sticky");
		} else {
			$(".elements-menu").removeClass("elements-menu-sticky");
		}
		
	}
	
	
	// SEARCH //
	function header_search() {
	
		var inputWidth = '240px',
			inputWidthReturn = '34px';
			
		$('#search-form input[type="text"]').focus(function () {
			$(this).val(function () {
				$(this).addClass('open').attr('placeholder', 'Search...');
			}),
			$(this).animate({
				width: inputWidth
			}, "fast");
		});
		$('#search-form input[type="text"]').blur(function () {
			$(this).removeClass('open').animate({
				width: inputWidthReturn
			}, "fast");
			$(this).attr('placeholder', '').val('');
		});
		 
	 }
	
 
	// PROGRESS BARS // 
	function progress_bars() {
		
		$(".progress .progress-bar:in-viewport").each(function() {
			
			if (!$(this).hasClass("animated")) {
				$(this).addClass("animated");
				$(this).animate({
					width: $(this).attr("data-width") + "%"
				}, 2000);
			}
			
		});
		
	}


	// CHARTS //
	function pie_chart() {
		
		$(".pie-chart:in-viewport").each(function() {
			
			$(this).easyPieChart({
				animate: 1500,
				lineCap: "square",
				lineWidth: $(this).attr("data-line-width"),
				size: $(this).attr("data-size"),
				barColor: $(this).attr("data-bar-color"),
				trackColor: $(this).attr("data-track-color"),
				scaleColor: "transparent",
				onStep: function(from, to, percent) {
					$(this.el).find(".pie-chart-details .value").text(Math.round(percent));
				}
			});
			
		});
		
	}
	
	// COUNTER //
	function counter() {
		
		$(".counter .counter-value:in-viewport").each(function() {
			
			if (!$(this).hasClass("animated")) {
				$(this).addClass("animated");
				$(this).jQuerySimpleCounter({
					start: 0,
					end: $(this).attr("data-value"),
					duration: 2000
				});	
			}
		
		});
		
	}
	
	
	// LOAD MORE PROJECTS //
	function load_more_projects() {
	
		var number_clicks = 0;
		
		$(".load-more").on("click", function(e) {
			
			e.preventDefault();
			
			if (number_clicks == 0) {
				$.ajax({
					type: "POST",
					url: $(".load-more").attr("href"),
					dataType: "html",
					cache: false,
					msg : '',
					success: function(msg) {
						$(".isotope").append(msg);	
						$(".isotope").imagesLoaded(function() {
							$(".isotope").isotope("reloadItems").isotope();
							$(".fancybox-portfolio-gallery").attr("rel","group").fancybox({
								prevEffect: 'none',
								nextEffect: 'none'
							});
							$(".fancybox-blog-gallery").attr("rel","group").fancybox({
								prevEffect: 'none',
								nextEffect: 'none'
							});
						});
						number_clicks++;
						$(".load-more").html("No more project");
					}
				});
			}
			
		});
		
	}
	
	
	// SHOW/HIDE GO TOP //
	function show_hide_go_top() {
		
		if ($(window).scrollTop() > $(window).height()/2) {
			$("#go-top").fadeIn(300);
		} else {
			$("#go-top").fadeOut(300);
		}
		
	}
	
	
	// CONTACT TOGGLE //
	function contact_toggle() {
		
		$(".contact-toggle a").on("click", function(e){
			
			e.preventDefault();
			$(".contact-content").slideToggle(300);
			$(".contact-toggle").toggleClass("open");
			
		})
		
	}
	
	
	// SMOOTH SCROLLING //
	function smooth_scrolling() {
		
		$('.elements-menu a[href*=#]:not([href=#])').on("click", function() {
			
			if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
			
				var target = $(this.hash);
				target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
			
				if (target.length) {
					$('html,body').animate({
						scrollTop: target.offset().top
					}, 1000);
				
					return false;
				
				}
			
			}
			
		});
		
	}
	
	
	// GO TOP //
	function go_top() {				
		
		$("#go-top").on("click", function () {
			$("html, body").animate({
				scrollTop: 0
			}, 800);
			return false;
		});
		
	}
	
	// ANIMATIONS //
	function animations() {
		
		animations = new WOW({
			boxClass: 'wow',
			animateClass: 'animated',
			offset: 100,
			mobile: false,
			live: true
		})
		
		animations.init();
		
	}
	
	// DOCUMENT READY //
	$(document).ready(function(){
		
		// MENU //
		
		
		// SHOW/HIDE MOBILE MENU //
		show_hide_mobile_menu();
		
		
		// MOBILE MENU //
		mobile_menu();
		
		
		// SEARCH //
		header_search();
		
		
		// SHOW/HIDE GO TOP
		show_hide_go_top();
		
		
		// GO TOP //
		go_top();
		
		
		// CONTACT TOGGLE //
		contact_toggle();
		
		
		// SMOOTH SCROLLING //
		smooth_scrolling();
		
		
		// SCROLLSPY //
		$("body").scrollspy({
			target: '.elements-menu'
		});
		
		
		// ANIMATIONS //
		animations();
		
	});

	
	// WINDOW SCROLL //
	$(window).scroll(function(){
		
		progress_bars();
		pie_chart();
		counter();
		show_hide_go_top();
		sticky();
		
	});
	
	
	// WINDOW RESIZE //
	$(window).resize(function(e) {

		mobile_menu();
		
	});
	
	$.validator.addMethod('mobileno', function(value, element){
        var validMobileNo = /^[6-9]\d{9}$/;
        return validMobileNo.test(value) === true?true:false;
    }, 'Please enter valid mobile no.');

	const loadForm = function(response){
		var msg = '';
		if("verifyMobile" in response.error){
			msg = response.error.verifyMobile[0];
			setAlertMsg(msg, 'success');
			addOTPForm();
		}else if("setPassword" in response.error){
			msg = response.error.verifyMobile[0];
			setAlertMsg(msg, 'success');
			setPswdForm();
		}else if("verifyEmail" in response.error){
			msg = response.error.verifyMobile[0];
			setAlertMsg(msg, 'success');
		}else{
			setAlertMsg(response.error, 'error');
		}
	}

	$('#registration-form').validate({
		errorElement:'h6',
		rules: {
			CompanyGroupName:'required',
			EmailId : {
				required: true,
				email: true
			},
			MobileNumber: {
				required: true,
				mobileno: true
			},
			AlternateNumber: {
				required: true,
				mobileno: true
			}
		},
		messages: {
			CompanyGroupName:'This is field is required.',
			EmailId : {
				required: 'This is field is required.',
				email: 'Invalid email.'
			},
			MobileNumber: {
				required: 'This is field is required.'
			},
			AlternateNumber: {
				required: 'This is field is required.'
			}
		},
		submitHandler: function(){
			btnLoading();
			$.ajax({
				type:'post',
				url:siteUrl+'/register',
				data: $('#registration-form').serialize(),
				success: function(data){
					if(data.message === 'error'){
						setAlertMsg(data.response.error, 'error');
						$('#registration-form button').attr('disabled', false).html('Next');
						return false;
					}
					$('#uselect').children('li').removeClass('active').eq(1).addClass('active');
					addOTPForm();
					var msg = data.response.message 
					setAlertMsg(msg, 'success');
					return false;
				}
			});
			return false
		}
	});

})(window.jQuery);