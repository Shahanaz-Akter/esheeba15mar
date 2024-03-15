jQuery(function ($) {
    'use strict';

    // Menu JS
    $(window).on('scroll', function() {
        if ($(this).scrollTop() >50) {
            $('.navbar-light').addClass('menu-shrink');
        } else {
            $('.navbar-light').removeClass('menu-shrink');
        }
    });			
    $('.navbar-nav .nav-item .nav-link').on('click', function(e){
        var anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $(anchor.attr('href')).offset().top - 30
        }, 1500);
        e.preventDefault();
    });
    $(document).on('click','.navbar-collapse.show',function(e) {
        if( $(e.target).is('a') && $(e.target).attr('class') != 'dropdown-toggle' ) {
            $(this).collapse('hide');
        }
    });	
    $('.side-nav a').on('click', function(e){
        var anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $(anchor.attr('href')).offset().top - 50
        }, 1500);
        e.preventDefault();
    });

    // Nice Select
    $('select').niceSelect();

    // Accordion 
	$('.accordion > li:eq(0) .faq-head').addClass('active').next().slideDown();
	$('.accordion .faq-head').on('click', function(j) {
		var dropDown = $(this).closest('li').find('.faq-content');
		$(this).closest('.accordion').find('.faq-content').not(dropDown).slideUp(300);
		if ($(this).hasClass('active')) {
			$(this).removeClass('active');
		} else {
			$(this).closest('.accordion').find('.faq-head.active').removeClass('active');
			$(this).addClass('active');
		}
		dropDown.stop(false, true).slideToggle(300);
		j.preventDefault();
    });

    // Accordion Two
	$('.accordion-two > li:eq(0) .faq-head').addClass('active').next().slideDown();
	$('.accordion-two .faq-head').on('click', function(j) {
		var dropDown = $(this).closest('li').find('.faq-content');
		$(this).closest('.accordion-two').find('.faq-content').not(dropDown).slideUp(300);
		if ($(this).hasClass('active')) {
			$(this).removeClass('active');
		} else {
			$(this).closest('.accordion-two').find('.faq-head.active').removeClass('active');
			$(this).addClass('active');
		}
		dropDown.stop(false, true).slideToggle(300);
		j.preventDefault();
    });

    // Modal Video
    $('.js-modal-btn').modalVideo();

    // Pricing Switcher
    let el = document.getElementById('filt-monthly');
    if(el){
        let e = document.getElementById("filt-monthly"),
        d = document.getElementById("filt-yearly"),
        t = document.getElementById("switcher"),
        m = document.getElementById("monthly"),
        y = document.getElementById("yearly");
        e.addEventListener("click", function(){
            t.checked = false;
            e.classList.add("toggler--is-active");
            d.classList.remove("toggler--is-active");
            m.classList.remove("hide");
            y.classList.add("hide");
        });
        d.addEventListener("click", function(){
            t.checked = true;
            d.classList.add("toggler--is-active");
            e.classList.remove("toggler--is-active");
            m.classList.add("hide");
            y.classList.remove("hide");
        });
        t.addEventListener("click", function(){
            d.classList.toggle("toggler--is-active");
            e.classList.toggle("toggler--is-active");
            m.classList.toggle("hide");
            y.classList.toggle("hide");
        });
    }

    // Slick Slider
    $('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        autoplay: false,
        autoplaySpeed: 4000,
        asNavFor: '.slider-nav'
    });
    $('.slider-nav').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: '.slider-for',
        arrows: false,
        dots: false,
        centerMode: true,
        focusOnSelect: true,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 4,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                }
            },
            {
                breakpoint: 320,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    });

    // Partner Slider
	$('.partner-slider').owlCarousel({
		loop: true,
		margin: 30,
		singleItem: true,
		nav: false,
		dots: false,
		smartSpeed: 1000,
		autoplay: false,
		autoplayTimeout: 4000,
        autoplayHoverPause: true,
        responsive:{
            0:{
                items: 2,
            },
            768:{
                items: 4,
            },
            992:{
                items: 5,
            }
        }    
    });

    // Odometer 
	$('.odometer').appear(function(e) {
		var odo = $('.odometer');
		odo.each(function() {
			var countNumber = $(this).attr('data-count');
			$(this).html(countNumber);
		});
    });

    // Review Slider
	$('.review-slider').owlCarousel({
        items: 1,
		loop: true,
		margin: 30,
		singleItem: true,
		nav: true,
		dots: false,
		smartSpeed: 1000,
		autoplay: false,
		autoplayTimeout: 4000,
        autoplayHoverPause: true,
        navText: [
            "<i class='fa-solid fa-chevron-left'></i>",
            "<i class='fa-solid fa-chevron-right'></i>"
        ],
    });

    // Screenshots Slider
	$('.screenshots-slider').owlCarousel({
		loop: true,
		margin: 30,
        center: true,
		nav: true,
		dots: false,
		smartSpeed: 1000,
		autoplay: false,
		autoplayTimeout: 4000,
        autoplayHoverPause: true,
        navText: [
            "<i class='fa-solid fa-chevron-left'></i>",
            "<i class='fa-solid fa-chevron-right'></i>"
        ],
        responsive:{
            0:{
                items: 2,
            },
            768:{
                items: 4,
            },
            992:{
                items: 6,
            }
        }   
    });

    // Swiper Slider
    var swiper = new Swiper('.swiper-container', {
        pagination: '.swiper-pagination',
        effect: 'coverflow',
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: 'auto',
        coverflow: {
            rotate: 50,
            stretch: 0,
            depth: 100,
            modifier: 1,
            slideShadows : true
        },
        loop: true,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });

    // Review Slider Two
	$('.review-slider-two').owlCarousel({
		loop: true,
		margin: 50,
		nav: true,
		dots: false,
		smartSpeed: 1000,
		autoplay: false,
		autoplayTimeout: 4000,
        autoplayHoverPause: true,
        navText: [
            "<i class='fa-solid fa-chevron-left'></i>",
            "<i class='fa-solid fa-chevron-right'></i>"
        ],
        responsive:{
            0: {
                items: 1
            },
            768: {
                items: 1
            },
            1200: {
                items: 2
            }
        }   
    });

    // Testimonials Slider
	$('.testimonials-slider').owlCarousel({
		loop: true,
		margin: 0,
		nav: true,
		dots: false,
		smartSpeed: 1000,
		autoplay: false,
		autoplayTimeout: 4000,
        autoplayHoverPause: true,
        navText: [
            "<i class='fa-solid fa-chevron-left'></i>",
            "<i class='fa-solid fa-chevron-right'></i>"
        ],
        responsive:{
            0:{
                items: 1,
            },
            600:{
                items: 2,
            },
            1000:{
                items: 2,
            }
        }
    });
        // Testimonials Slider Two
	$('.services').owlCarousel({
		loop: true,
		margin: 30,
		nav: false,
		dots: true,
		smartSpeed: 1000,
		autoplay: false,
		autoplayTimeout: 4000,
        autoplayHoverPause: true,
        responsive:{
            0:{
                items: 1,
            },
            600:{
                items: 2,
            },
            1000:{
                items: 3,
            }
        }
    });

    // Testimonials Slider Two
	$('.nurses').owlCarousel({
		loop: true,
		margin: 30,
		nav: false,
		dots: true,
		smartSpeed: 1000,
		autoplay: false,
		autoplayTimeout: 4000,
        autoplayHoverPause: true,
        responsive:{
            0:{
                items: 1,
            },
            600:{
                items: 2,
            },
            1000:{
                items: 3,
            }
        }
    });

    // Loader
	jQuery(window).on('load',function(){
		jQuery('.loader').fadeOut(500);
    });
    
    // Go Top
	$(function(){
		$(window).on('scroll', function(){
			var scrolled = $(window).scrollTop();
			if (scrolled > 500) $('.go-top').addClass('active');
			if (scrolled < 500) $('.go-top').removeClass('active');
		});  
		$('.go-top').on('click', function() {
			$('html, body').animate({ scrollTop: '0' },  500);
		});
	});

    // Subscribe Form
    $(".newsletter-form").validator().on("submit", function (event) {
        if (event.isDefaultPrevented()) {
            // Hande the invalid form...
            formErrorSub();
            submitMSGSub(false, "Please enter your email correctly.");
        } else {
            // Everything looks good!
            event.preventDefault();
        }
    });
    function callbackFunction (resp) {
        if (resp.result === "success") {
            formSuccessSub();
        }
        else {
            formErrorSub();
        }
    }
    function formSuccessSub(){
        $(".newsletter-form")[0].reset();
        submitMSGSub(true, "Thank you for subscribing!");
        setTimeout(function() {
            $("#validator-newsletter").addClass('hide');
        }, 4000)
    }
    function formErrorSub(){
        $(".newsletter-form").addClass("animated shake");
        setTimeout(function() {
            $(".newsletter-form").removeClass("animated shake");
        }, 1000)
    }
    function submitMSGSub(valid, msg){
        if(valid){
            var msgClasses = "validation-success";
        } else {
            var msgClasses = "validation-danger";
        }
        $("#validator-newsletter").removeClass().addClass(msgClasses).text(msg);
    }

    // AJAX Mail Chimp 
    $(".newsletter-form").ajaxChimp({
        url: "#", // Your url MailChimp
        callback: callbackFunction
    });
}(jQuery));