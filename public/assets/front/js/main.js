(function($) {
    "use strict";
    $(document).ready(function(){

        // menu top add class scroll
        $(window).scroll(function(){
            if ($(this).scrollTop() > 40) {
                $(".wrap-all-main-menu-top").addClass("wrap-all-main-menu-top-active");
                $(".main-logo-black").show();
                $(".main-logo-white").hide();
            } else { 
                $(".wrap-all-main-menu-top").removeClass("wrap-all-main-menu-top-active");
                $(".main-logo-black").hide();
                $(".main-logo-white").show();
            }
        });

        // show burger menu box
        $('.bt-burger-menu-cta').on("click",function(){
            $('.wrap-burger-menu-list-box').addClass('wrap-burger-menu-list-box-active');
            $('body').addClass('block-menu-burger-open');
        });

        // hide burger menu box
        $('.bt-close-burger-menu-section-c').on("click",function(){
            $('.wrap-burger-menu-list-box').removeClass('wrap-burger-menu-list-box-active');
            $('body').removeClass('block-menu-burger-open');
        });

        $("html, body").animate({scrollTop: ($(window).scrollTop() + 1)});

        // sub menu burger
        $('.main-menu-burger-content ul li.menu-item-has-children > a').on("click", function(e) {
            e.preventDefault();
            $(this).parent().find(">ul").slideToggle(300);
            this.classList.toggle("icon-change");
        });

        $('.owl-carousel2').owlCarousel({
            loop:true,
            margin:10,
            nav:true,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:3
                },
                1000:{
                    items:5
                }
            }
        })

        // slider logo partners
        $('.slider-logo-partners').owlCarousel({
            loop: false,
            autoplayTimeout: 5000,
            autoplay: true,
            touchDrag: true,
            mouseDrag: false,
            margin: 20,
            autoplayHoverPause: false,
            autoHeight: false,
            nav: false,
            dots: true,
            smartSpeed: 700,
            center: false,
            responsive : {
                // breakpoint from 0 up
                0 : {
                    items: 3
                },
                // breakpoint from 768 up
                768 : {
                    items: 3
                },
                // breakpoint from 768 up
                991 : {
                    items: 7
                }
            }
        });

        // slider logo partners
        $('.slider-tab-below-the-line').owlCarousel({
            loop: false,
            autoplayTimeout: 5000,
            autoplay: true,
            touchDrag: false,
            mouseDrag: false,
            margin: 20,
            autoplayHoverPause: false,
            autoHeight: false,
            nav: false,
            dots: true,
            smartSpeed: 700,
            center: false,
            responsive : {
                // breakpoint from 0 up
                0 : {
                    items: 3
                },
                // breakpoint from 768 up
                768 : {
                    items: 3
                },
                // breakpoint from 768 up
                991 : {
                    items: 5
                }
            }
        });

        // slider logo partners
        $('.slider-some-section-2-video').owlCarousel({
            loop: false,
            autoplayTimeout: 5000,
            autoplay: false,
            touchDrag: false,
            mouseDrag: false,
            margin: 20,
            autoplayHoverPause: false,
            autoHeight: false,
            nav: false,
            dots: false,
            smartSpeed: 700,
            items: 1,
            center: false
        });

        // slider our team our people
        $('.slider-our-team1').owlCarousel({
            loop: false,
            autoplayTimeout: 5000,
            autoplay: false,
            touchDrag: true,
            mouseDrag: false,
            autoplayHoverPause: false,
            autoHeight: false,
            nav: false,
            dots: true,
            smartSpeed: 700,
            center: false,
            responsive : {
                // breakpoint from 0 up
                0 : {
                    items: 1,
                    margin: 20
                },
                // breakpoint from 768 up
                768 : {
                    items: 3,
                    margin: 20
                },
                // breakpoint from 768 up
                991 : {
                    items: 3,
                    margin: 60
                }
            }
        });

        // slider our team our people
        $('.slider-our-team2').owlCarousel({
            loop: false,
            autoplayTimeout: 5000,
            autoplay: false,
            touchDrag: true,
            mouseDrag: false,
            autoplayHoverPause: false,
            autoHeight: false,
            nav: false,
            dots: true,
            smartSpeed: 700,
            center: false,
            responsive : {
                // breakpoint from 0 up
                0 : {
                    items: 1,
                    margin: 20
                },
                // breakpoint from 768 up
                768 : {
                    items: 3,
                    margin: 20
                },
                // breakpoint from 768 up
                991 : {
                    items: 4,
                    margin: 40
                }
            }
        });

        $(".nav-slider-video-home-prev").on("click", function() {
            $(".slider-some-section-2-video").trigger('prev.owl.carousel');
            var videos = document.querySelectorAll('video#videosec');
            for(var i = 0; i < videos.length; i++) {
                videos[i].pause();
            }
        });

        $(".nav-slider-video-home-next").on("click", function() {
            $(".slider-some-section-2-video").trigger('next.owl.carousel');
            var videos = document.querySelectorAll('video#videosec');
            for(var i = 0; i < videos.length; i++) {
                videos[i].pause();
            }
        });

        //pause video when close modal
        $('.bt-close-modal-popup-video').on("click", function() {
            var videos = document.querySelectorAll('video#videosec');
            for(var i = 0; i < videos.length; i++) {
                videos[i].pause();
            }
            // $('.iframe')[0].contentWindow.postMessage('{"event":"command","func":"' + 'stopVideo' + '","args":""}', '*');
        });

        // Video Responsive
        $(".video-full").fitVids();

        // Wow Js Animate
        new WOW().init();

    });
})(jQuery);
