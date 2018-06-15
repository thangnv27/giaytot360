var viewport_width = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
var viewport_height = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
jQuery(document).ready(function ($) {
    $('#banner-fade').bjqs({
        height: 467,
        width: '100%',
        responsive: false
    });
    if ($(".more-views ul li").length > 0) {
        $(".more-views").easySlider({
            mainImg: ".media .product-image img",
            animate: true,
            loop: true,
            vertical: true,
            speed: 300,
            width: 100,
            width_img: 100,
            btnPrev: ".btn-control .prev",
            btnNext: ".btn-control .next"
        });
    }
    $("#mobile-menu").wrap('<div id="dl-menu" class="dl-menuwrapper wf-mobile-visible" />');

    var $mainNav = $("#main-nav");

    $(".act", $mainNav).parents("li").addClass("act");

    var $mobileNav = $mainNav.clone();
    var backCap = $("#mobile-menu > .menu-back").html();

    $mobileNav
            .attr("id", "")
            .attr("class", "dl-menu")
            .find(".sub-menu")
            .addClass("dl-submenu")
            .removeClass("sub-menu")
            .prepend('<li class="dl-back"><a href="#"><span>' + backCap + '</a></li>');

    $mobileNav.appendTo("#dl-menu").wrap('<div class="dl-container" />');

    if (!$("html").hasClass("old-ie"))
        $('#dl-menu').dlmenu();


    if ($mainNav.hasClass("fancy-rollovers") && $("html").hasClass("csstransforms3d")) {
        $("> li > a", $mainNav).each(function () {
            var $this = $(this).css("padding", 0),
                    tempHtml = $this.html();

            tempHtml = '<span>' + tempHtml + '<span>' + tempHtml + '</span></span>';
            $this.html(tempHtml);
        });
    }

    $(".sub-menu", $mainNav).parent().each(function () {
        var $this = $(this);

        $this.find("> a").on("click", function (e) {
            if (!$(this).hasClass("dt-clicked")) {
                e.preventDefault();
                $mainNav.find(".dt-clicked").removeClass("dt-clicked");
                $(this).addClass("dt-clicked");
            } else {
                e.stopPropagation();
            }

        });

        var menuTimeoutShow,
                menuTimeoutHide;

        $this.on("mouseenter tap", function (e) {
            if (e.type == "tap")
                e.stopPropagation();

            var $this = $(this);
            $this.addClass("dt-hovered");

            if ($("#page").width() - ($this.children('ul').offset().left - $("#page").offset().left) - 230 < 0) {
                $this.children('ul').addClass("right-overflow");
            }

            clearTimeout(menuTimeoutShow);
            clearTimeout(menuTimeoutHide);

            menuTimeoutShow = setTimeout(function () {
                if ($this.hasClass("dt-hovered")) {
                    $this.children('ul').stop().css("visibility", "visible").animate({
                        "opacity": 1
                    }, 200);
                }
            }, 350);
        });

        $this.on("mouseleave", function (e) {
            var $this = $(this);
            $this.removeClass("dt-hovered");

            clearTimeout(menuTimeoutShow);
            clearTimeout(menuTimeoutHide);

            menuTimeoutHide = setTimeout(function () {
                if (!$this.hasClass("dt-hovered")) {
                    $this.children('ul').stop().animate({
                        "opacity": 0
                    }, 150, function () {
                        $(this).css("visibility", "hidden");
                    });

                    setTimeout(function () {
                        if (!$this.hasClass("dt-hovered")) {
                            $this.children('ul').removeClass("right-overflow");
                        }
                    }, 400);
                }
            }, 200);

            $this.find("> a").removeClass("dt-clicked");
        });

    });

    /* Main navigation: end */
    $(window).load(function(){				
        $.mCustomScrollbar.defaults.scrollButtons.enable=true; //enable scrolling buttons by default
        $.mCustomScrollbar.defaults.axis="yx"; //enable 2 axis scrollbars by default
        $("#content-md, #content-size, #content-brand, #content-material, #content-type").mCustomScrollbar({
            setHeight:140,
            theme:"minimal-dark"
        });
    });
});

var $box = jQuery.noConflict();
function showbox(el) {
    if ($box('.toturial #box-' + el).hasClass('active')) {
        $box('.toturial #box-' + el).removeClass('active');
        $box('.toturial .content-' + el).slideUp();
    } else {
        $box('.toturial .toturial li').removeClass('active');
        $box('.toturial .content').slideUp();
        $box('.toturial #box-' + el).addClass('active');
        $box('.toturial .content-' + el).slideDown();
    }
}
//console.log(Modernizr)

