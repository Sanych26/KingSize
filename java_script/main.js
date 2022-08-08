$(function() {

/**
* Navicon
**/
  $(".navicon").on("click", function (){
    $(".sub-menu-cont").show();
  });
  $(".esc-nav").on("click", function (){
    $(".sub-menu-cont").hide();
  });


/**
* Scrolling
**/
  $(document).scroll(function() {

    var scrollFromTop = $(window).scrollTop();
    if (scrollFromTop >= 30) {
      $('#header').css({
        filter: 'drop-shadow(0px 1px 2.5px rgba(199, 199, 199, 0.65))'
      });
      $('#head').css({paddingTop: 0 + 'px',
        marginTop: -1 + 'px'});
        $('.header_mob').css({paddingTop: 0 + 'px',
            marginTop: -1 + 'px'});
    } else if(scrollFromTop === 0) {
      $('#header').css({
        filter: 'none'
      });
      $('#head').css({
      paddingTop: 30 + 'px'
    });
        $('.header_mob').css({
            paddingTop: 30 + 'px'
        });
    }
  });




/**
* Phone-mask
**/
$("#phone").mask("+38(999) 999-9999");


/**
* Add btn letter
**/
    $(".add-btn").on("click", function (){
        $(".add-cont-form").show();
        $(".add-cont").hide();
    });
    $(".add-cont-form .esc-nav").on("click", function (){
        $(".add-cont-form").hide();
        $(".add-cont").show();
    });


/**
* Slider
**/
    if ($("#models").length) {
      tns({
       container: '#models',
       items: 4,
       slideBy: "page",
       autoplay: true,
       nav: false,
       touch: true,
       controls: true,
       controlsText: ["", ""],
       autoplayTimeout: 7000,
       autoplayButtonOutput: false,
   });
  }
    if ($("#models-mob").length) {
      tns({
           container: '#models-mob',
           items: 1,
           slideBy: "page",
           autoplay: true,
           nav: true,
           navAsThumbnails: true,
           navContainer: "#models_mob_nav",
           touch: true,
           controls: true,
           controlsText: ["", ""],
           autoplayTimeout: 7000,
           autoplayButtonOutput: false,
   });
  }
    if ($("#testimonials").length) {
      tns({
          container: '#testimonials',
          items: 1,
          slideBy: "page",
          autoplay: true,
          nav: true,
          navAsThumbnails: true,
          navContainer: "#testimonialsNav",
          touch: true,
          controls: true,
          controlsText: ["", ""],
          autoplayTimeout: 8000,
          autoplayButtonOutput: false,
   });
  }
    if ($("#testimonials-mob").length) {
      tns({
           container: '#testimonials-mob',
           items: 1,
           slideBy: 1,
           autoplay: false,
           nav: true,
           navAsThumbnails: true,
           touch: true,
           controls: true,
           controlsText: ["", ""],
           autoplayButtonOutput: false,
   });
  }
    if ($("#pictures").length) {
      tns({
           container: '#pictures',
           items: 1,
           slideBy: "page",
           autoplay: false,
           nav: false,
           touch: true,
           controls: true,
           controlsText: ["", ""],
           autoplayButtonOutput: false,
   });
  }
    if ($("#pictures-mob").length) {
      tns({
           container: '#pictures-mob',
           items: 1,
           slideBy: 1,
           autoplay: false,
           nav: true,
           navContainer: "#navTestimonialMob",
           navAsThumbnails: true,
           touch: true,
           controls: true,
           controlsText: ["", ""],
           autoplayButtonOutput: false,
   });
  }


/**
* Search clear
**/
    function clearSearch() {
        var val = $('#search-input').val();
        if ($.trim(val)) {
            $('#clear-search').css("display" , "inline-block");
        } else {
            $('#clear-search').css("display" , "none");
        }
    }

    $("#search-input").keyup(clearSearch);
    clearSearch();

    var clearBtn = document.getElementById("clear-search") ?? '';
    var clearInpt = document.getElementById("search-input") ?? '';
        clearBtn.onclick = function (e) {
            e.preventDefault();
            clearInpt.value = "";
            clearBtn.style.display = "none";
        };




/**
* Submit forms in cart
**/
    $(".buy-btn").on("click", function (){
        $("#buyForm").submit();
    });

});
