(function ($) {
    'use strict';

    // Sticky Menu
    $(window).scroll(function () {
        if ($('header').offset().top > 10) {
            $('.top-header').addClass('hide');
            $('.navigation').addClass('nav-bg');
        } else {
            $('.top-header').removeClass('hide');
            $('.navigation').removeClass('nav-bg');
        }
    });


    //Hero Slider
    $('.hero-slider').slick({
        autoplay: true,
        autoplaySpeed: 7500,
        pauseOnFocus: false,
        pauseOnHover: false,
        infinite: true,
        arrows: true,
        fade: true,
        prevArrow: '<button type=\'button\' class=\'prevArrow\'><i class=\'ti-angle-left\'></i></button>',
        nextArrow: '<button type=\'button\' class=\'nextArrow\'><i class=\'ti-angle-right\'></i></button>',
        dots: true
    });
    $('.hero-slider').slickAnimation();

})(jQuery);



function randomValues() {

    anime({
      targets: '.anime-section  div.obj-anime:nth-child('+anime.random(1,6)+')',
      translateX: function() {
        return anime.random(0, window.outerWidth);
      },
      translateY: function() {
        return anime.random(0, document.querySelector(".anime-section").clientHeight);
      },
      rotate:function(){
        return anime.random(0, 360);
      },
      scale:function(){
        return anime.random(-5, 5);
      },
      easing: 'easeOutExpo',
      duration: 5000,
      complete: randomValues,
      
    });
  }

  randomValues();