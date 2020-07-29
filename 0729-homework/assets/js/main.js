

jQuery(document).ready(function () {

    
    jQuery(".play-1, .play-2").yu2fvl();
    jQuery('.circleContent').owlCarousel({
        responsiveClass:true,
        responsive:{
            0:{items:1},
            500:{items:3},
            767:{items:4},
            1299:{items:7}
            
        },
        loop:true,
        margin:1,
        center:true,
        autoplay:true,
        autoplayTimeout:1000,
       
    });
    jQuery(".owl-carousel2").owlCarousel(
        {
            loop: false,
            center: false,
            margin: 10,
            responsiveClass: true,
            nav: false,
            responsive: {
                0: {
                    items: 1,

                },
                600: {
                    items: 2,

                },
                1000: {
                    items: 3,
                    nav: false,
                    loop: false
                }
            }
        }
    );
    jQuery(".owl-carousel4").owlCarousel(
        {
            loop: true,
            center: true,
            margin: 20,
            responsiveClass: true,
            nav: true,
            responsive: {
                0: {
                    items: 2,

                },
                600: {
                    items: 3,

                },
                1000: {
                    items: 5,
                    nav: true,
                    loop: true
                }
            }
        }
    );

    jQuery(".owl-carousel5").owlCarousel(
        {
            loop: true,
            center: false,
            margin: 10,
            responsiveClass: true,
            nav: false,
            responsive: {
                0: {
                    items: 2,

                },
                600: {
                    items: 3,

                },
                1000: {
                    items: 6,
                    nav: false,
                    loop: true
                }
            }
        }
    );
    
    jQuery('#BackTop').click(function(){ 
        $('html,body').animate({scrollTop:0}, 333);
    });
    jQuery('#BackEnd').click(function(){ 
        $('html,body').animate({scrollTop:$(document).height()}, 333);
    });
    jQuery(window).scroll(function() {
    if ( $(this).scrollTop() > 300 ){
        $('#BackTop').fadeIn(222);
    } else {
        $('#BackTop').stop().fadeOut(222);
    }
    if ( $(this).scrollTop() > 300 ){
        $('#BackEnd').stop().fadeOut(222);
    } else {
        $('#BackEnd').fadeIn(222);
    }
    }).scroll();

    // jQuery('#BackEnd').click(function(){         
    //     $('html,body').animate({scrollTop:$("body").height()}, 333);
    // });
    // jQuery(window).scroll(function() {
    // if ( $(this).scrollTop() > 300 ){
    //     $('#BackEnd').stop().fadeOut(222);
    // } else {
    //     $('#BackEnd').fadeIn(222);
    // }
    // }).scroll();
});

function myFunction(x) {
    x.classList.toggle("change");
}


jQuery(".link-img").click(function () {
    var link = jQuery(this).attr("data-link");
    //alert(link);
    jQuery("#screen").attr("src", link)
});



var count = 0;
jQuery("#toggle-search").click(function () {
    count++;
    //even odd click detect 
    var isEven = function (someNumber) {
        return (someNumber % 2 === 0) ? true : false;
    };
    // on odd clicks do this
    if (isEven(count) === false) {
        //jQuery("#nav-search").css({"display":"block"});
        jQuery("#nav-search").slideDown();
        jQuery("#toggle-search").attr("src", "assets/images/close.png");

    }
    // on even clicks do this
    else if (isEven(count) === true) {
        //jQuery("#nav-search").css({"display":"none"});
        jQuery("#nav-search").slideUp();

        jQuery("#toggle-search").attr("src", "assets/images/search-icon.png");
    }
});
