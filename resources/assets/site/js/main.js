jQuery(function ($) {
    'use strict';

        // Header Sticky
		$(window).on('scroll',function() {
            if ($(this).scrollTop() > 120){
                $('.navbar-area').addClass("is-sticky");
            }
            else{
                $('.navbar-area').removeClass("is-sticky");
            }
		});

		// Mean Menu
		jQuery('.mean-menu').meanmenu({
			meanScreenWidth: "1199"
        });

		// Others Option For Responsive JS
		$(".others-option-for-responsive .dot-menu").on("click", function(){
			$(".others-option-for-responsive .container .container").toggleClass("active");
		});

        // Video Slides
		$('.video-slides').owlCarousel({
			loop: true,
			nav: true,
			dots: false,
			autoplayHoverPause: true,
			autoplay: true,
            margin: 30,
            navText: [
                "<i class='bx bx-chevron-left'></i>",
                "<i class='bx bx-chevron-right'></i>"
            ],
            responsive: {
                0: {
                    items: 1,
                },
                576: {
                    items: 1,
                },
                768: {
                    items: 2,
                },
                1200: {
                    items: 2,
				}
            }
        });

        // Popup Video
		$('.popup-youtube').magnificPopup({
			disableOn: 320,
			type: 'iframe',
			mainClass: 'mfp-fade',
			removalDelay: 160,
			preloader: false,
			fixedContentPos: false
		});

        // Business News Slides
		$('.business-news-slides').owlCarousel({
			loop: true,
			nav: true,
			dots: false,
			autoplayHoverPause: true,
			autoplay: true,
            margin: 30,
            navText: [
                "<i class='bx bx-chevron-left'></i>",
                "<i class='bx bx-chevron-right'></i>"
            ],
            responsive: {
                0: {
                    items: 1,
                },
                576: {
                    items: 1,
                },
                768: {
                    items: 2,
                },
                1200: {
                    items: 2,
				}
            }
        });

        // Health News Slides
		$('.health-news-slides').owlCarousel({
			loop: true,
			nav: true,
			dots: false,
			autoplayHoverPause: true,
			autoplay: true,
            margin: 30,
            navText: [
                "<i class='bx bx-chevron-left'></i>",
                "<i class='bx bx-chevron-right'></i>"
            ],
            responsive: {
                0: {
                    items: 1,
                },
                576: {
                    items: 1,
                },
                768: {
                    items: 2,
                },
                1200: {
                    items: 2,
				}
            }
        });

        // Subscribe form
		$(".newsletter-form").validator().on("submit", function (event) {
			if (event.isDefaultPrevented()) {
			// handle the invalid form...
				formErrorSub();
				submitMSGSub(false, "Please enter your email correctly.");
			} else {
				// everything looks good!
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
		// AJAX MailChimp
		$(".newsletter-form").ajaxChimp({
			url: "https://envytheme.us20.list-manage.com/subscribe/post?u=60e1ffe2e8a68ce1204cd39a5&amp;id=42d6d188d9", // Your url MailChimp
			callback: callbackFunction
		});

		// Go to Top
		$(function(){
			// Scroll Event
			$(window).on('scroll', function(){
				var scrolled = $(window).scrollTop();
				if (scrolled > 600) $('.go-top').addClass('active');
				if (scrolled < 600) $('.go-top').removeClass('active');
			});
			// Click Event
			$('.go-top').on('click', function() {
				$("html, body").animate({ scrollTop: "0" },  500);
			});
		});

		// Sports Slides
		$('.sports-slider').owlCarousel({
			loop: true,
			nav: true,
			dots: false,
			autoplayHoverPause: true,
			autoplay: true,
            items: 1,
            margin: 30,
            navText: [
                "<i class='bx bx-chevron-left'></i>",
                "<i class='bx bx-chevron-right'></i>"
			],

			responsive: {
                0: {
                    items: 1,
                },
                576: {
                    items: 2,
				},
				768: {
                    items: 1,
                },
                1200: {
                    items: 1,
				}
            }
		});

		// Tech Slides
		$('.tech-slider').owlCarousel({
			loop: true,
			nav: true,
			dots: false,
			autoplayHoverPause: true,
			autoplay: true,
            items: 1,
            margin: 30,
            navText: [
                "<i class='bx bx-chevron-left'></i>",
                "<i class='bx bx-chevron-right'></i>"
			],

			responsive: {
                0: {
                    items: 1,
                },
                576: {
                    items: 2,
				},
				768: {
                    items: 1,
                },
                1200: {
                    items: 1,
				}
            }
        });

		// Breaking News Slides
		$('.breaking-news-slides').owlCarousel({
			loop: true,
			nav: false,
			dots: false,
			autoplayHoverPause: true,
			autoplay: true,
			animateOut:"slideOutDown",
			animateIn:"flipInX",
            items: 1,
            margin: 30,
            navText: [
                "<i class='bx bx-chevron-left'></i>",
                "<i class='bx bx-chevron-right'></i>"
            ],
		});

		// Main News Slides
		$('.main-news-slides').owlCarousel({
			loop: true,
			nav: true,
			dots: false,
			autoplayHoverPause: true,
			autoplay: true,
            margin: 30,
            navText: [
                "<i class='bx bx-chevron-left'></i>",
                "<i class='bx bx-chevron-right'></i>"
            ],
            responsive: {
                0: {
                    items: 1,
                },
                576: {
                    items: 1,
                },
                768: {
                    items: 2,
                },
                1200: {
                    items: 3,
				}
            }
		});

		// FAQ Accordion
        $(function() {
            $('.accordion').find('.accordion-title').on('click', function(){
                // Adds Active Class
                $(this).toggleClass('active');
                // Expand or Collapse This Panel
                $(this).next().slideToggle('fast');
                // Hide The Other Panels
                $('.accordion-content').not($(this).next()).slideUp('fast');
                // Removes Active Class From Other Titles
                $('.accordion-title').not($(this)).removeClass('active');
            });
		});

		// Nice Select JS
		$('select').niceSelect();

		// Count Time
		function makeTimer() {
			var endTime = new Date("September 20, 3000 17:00:00 PDT");
			var endTime = (Date.parse(endTime)) / 1000;
			var now = new Date();
			var now = (Date.parse(now) / 1000);
			var timeLeft = endTime - now;
			var days = Math.floor(timeLeft / 86400);
			var hours = Math.floor((timeLeft - (days * 86400)) / 3600);
			var minutes = Math.floor((timeLeft - (days * 86400) - (hours * 3600 )) / 60);
			var seconds = Math.floor((timeLeft - (days * 86400) - (hours * 3600) - (minutes * 60)));
			if (hours < "10") { hours = "0" + hours; }
			if (minutes < "10") { minutes = "0" + minutes; }
			if (seconds < "10") { seconds = "0" + seconds; }
			$("#days").html(days + "<span>Days</span>");
			$("#hours").html(hours + "<span>Hours</span>");
			$("#minutes").html(minutes + "<span>Minutes</span>");
			$("#seconds").html(seconds + "<span>Seconds</span>");
		}
		setInterval(function() { makeTimer(); }, 0);

        // Preloader
        // $(window).on('load', function() {
        //     $('.preloader').fadeOut();
        //     $('.preloader-area').addClass('preloader-deactivate');
        // });

        // Preloader

    // -------------------------------------------------------------
    //  Preloader
    // -------------------------------------------------------------

    // $(window).on("load", function(){
    //     $('#preloader').fadeOut('slow',function(){$(this).remove();});
    // });

    // -------------------------------------------------------------
    //  Toggle Menu for Mobile
    // -------------------------------------------------------------

    mobileDropdown ();
    function mobileDropdown () {
      if($('.navbar-nav').length) {
        $('.navbar-nav .sg-dropdown').append(function () {
          return '<i class="fa fa-angle-down icon" aria-hidden="true"></i>';
        });
        $('.navbar-nav .sg-dropdown .icon').on('click', function () {
          $(this).parent('li, .sg-dropdown').children('ul, .sg-dropdown-menu').slideToggle();
        });
      }
    }

    /*==============================================================*/
    // TheiaStickySidebar
    /*==============================================================*/

    $('.sg-sticky').theiaStickySidebar({
            additionalMarginTop: 100
    });

    // -------------------------------------------------------------
    //  MagnificPopup
    // -------------------------------------------------------------

    $('.sg-popup').magnificPopup({type:'iframe'});

    // -------------------------------------------------------------
    //  Slick Slider
    // -------------------------------------------------------------

    $(".post-slider").slick({
        infinite: true,
        dots: false,
        arrows: true,
        slidesToShow: 1,
        autoplay:true,
        autoplaySpeed:10000,
        slidesToScroll: 1,
        nextArrow: '<i class="fa fa-angle-left" aria-hidden="true"></i>',
        prevArrow: '<i class="fa fa-angle-right" aria-hidden="true"></i>',
    });

    $(".news-ticker").slick({
        infinite: true,
        dots: false,
        arrows: true,
        slidesToShow: 1,
        autoplay:true,
        autoplaySpeed: 10000,
        fade:true,
        pauseOnHover:true,
        slidesToScroll: 1,
        nextArrow: '<i class="fa fa-angle-left" aria-hidden="true"></i>',
        prevArrow: '<i class="fa fa-angle-right" aria-hidden="true"></i>',
    });





    $('.home-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        dots: false,
        speed: 1500,
        autoplay:true,
        nextArrow: '<i class="fa fa-angle-left" aria-hidden="true"></i>',
        prevArrow: '<i class="fa fa-angle-right" aria-hidden="true"></i>',
        asNavFor: '.home-slider-nav'
    });

    $('.home-slider-nav').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        asNavFor: '.home-slider',
        dots: false,
        speed: 1500,
        arrows: false,
        focusOnSelect: true,
        responsive: [
        {
          breakpoint: 1200,
          settings: {
            slidesToShow:4,
          }
        },
        {
          breakpoint: 992,
          settings: {
            slidesToShow: 3,
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 2,
          }
        },
        {
          breakpoint: 481,
          settings: {
            slidesToShow: 1,
          }
        }
        ]
    });

    $(".breaking-news-slider").slick({
        infinite: true,
        dots: false,
        arrows: true,
        slidesToShow: 3,
        autoplay:true,
        slidesToScroll: 1,
        swipe: false,
        vertical: true,
        verticalScrolling: true,
        nextArrow: '<i class="fa fa-angle-left" aria-hidden="true"></i>',
        prevArrow: '<i class="fa fa-angle-right" aria-hidden="true"></i>',
    });

    // -------------------------------------------------------------
    //  Carousel Animation
    // -------------------------------------------------------------
    //
    function doAnimations( elems ) {
        var animEndEv = 'webkitAnimationEnd animationend';

        elems.each(function () {
            var $this = $(this),
                $animationType = $this.data('animation');
            $this.addClass($animationType).one(animEndEv, function () {
                $this.removeClass($animationType);
            });
        });
    }
    var $myCarousel = $('#home-carousel'),
        $firstAnimatingElems = $myCarousel.find('.item:first').find("[data-animation ^= 'animated']");
    $myCarousel.carousel();

    doAnimations($firstAnimatingElems);
    $myCarousel.carousel('pause');

    $myCarousel.on('slide.bs.carousel', function (e) {
        var $animatingElems = $(e.relatedTarget).find("[data-animation ^= 'animated']");
        doAnimations($animatingElems);
    });

    /*==============================================================*/
    // Select
    /*==============================================================*/

    $('.sg-language select').each(function(){
        var $this = $(this), numberOfOptions = $(this).children('option').length;

        $this.addClass('select-hidden');
        $this.wrap('<div class="select"></div>');
        $this.after('<div class="select-styled"></div>');

        var $styledSelect = $this.next('div.select-styled');
        $styledSelect.text($("#languges-changer").find(":selected").text());

        var $list = $('<ul />', {
            'class': 'select-options'
        }).insertAfter($styledSelect);

        for (var i = 0; i < numberOfOptions; i++) {
            $('<li />', {
                text: $this.children('option').eq(i).text(),
                rel: $this.children('option').eq(i).val()
            }).appendTo($list);
        }

        var $listItems = $list.children('li');

        $styledSelect.on('click', function(e) {
            e.stopPropagation();
            $('div.select-styled.active').not(this).each(function(){
                $(this).removeClass('active').next('ul.select-options').hide();
            });
            $(this).toggleClass('active').next('ul.select-options').toggle();
        });

        $listItems.on('click', function(e) {
            e.stopPropagation();
            $styledSelect.text($(this).text()).removeClass('active');
            $this.val($(this).attr('rel'));
            $list.hide();
        });

        $(document).on('click', function(e) {
            $styledSelect.removeClass('active');
            $list.hide();
        });

    });

}(jQuery));
