$(function() {
$('img').Lazy();
});

// Slick image slider
 function handleBackFunctionality()
 {
    $('form select').prop('disabled',false);   
    $('form :input').prop('disabled',false); 

 }
    $(document).on('ready', function() {
        $(".items").slick({

            dots: true,
            arrows: false,
            infinite: true,
            speed: 2000,
            slidesToShow: 2,
            slidesToScroll: 2,
            autoplay: true,
            autoplaySpeed: 2000,
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        arrows: false,
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]

            //dots: true,
            //infinite: true,
            //slidesToShow: 3,
            //slidesToScroll: 3
        });
    });
    
    $(document).on('ready', function() {
        $(".testimonial").slick({

            dots: true,
            arrows: false,
            infinite: true,
            speed: 5000,
            slidesToShow: 2,
            slidesToScroll: 2,
            autoplay: true,
            autoplaySpeed: 6000,
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        arrows: false,
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]

            //dots: true,
            //infinite: true,
            //slidesToShow: 3,
            //slidesToScroll: 3
        });
    });
    
// Property Details Slick slider
    $('.slider-nav').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        asNavFor: '.slider-for',
        arrows: false,
        dots: false,
        centerMode: true,
        focusOnSelect: true
    });
    
//Property Details Click Zoom
        $(function () {
            $('#aniimated-thumbnials').lightGallery({
                 download: false,
                 share: false,
                 actualSize:false,
                 fullScreen:false,
                 autoplayControls:false
            });
            // Card's slider
            var $carousel = $('.slider-for');

            $carousel
              .slick({
                  slidesToShow: 1,
                  slidesToScroll: 1,
                  arrows: false,
                  fade: true,
                  adaptiveHeight: true,
                  asNavFor: '.slider-nav'
              });
        });