'use strict';

/* 
SCRIPT - GLOBAL
This script manage all the third-party scripts and plugins and must be inserted after all the other scripts and plugins, on footer.
*/

var device_screen_size;
var wh = jQuery(window).width();
if (wh < 993) device_screen_size = "device-xs";
if (wh > 992 && wh < 1200) device_screen_size = "device-m";
if (wh > 1200) device_screen_size = "device-l";

/* 
MAGNIFIC POUP
Third-party script name: jquery.magnific-popup.min.js
*/
(function ($) {

    $.fn.showPopupBanner = function () {
        var t = this;
        var a = $(t).attr("data-popup-anima");
        if (!isEmpty(a)) {
            $(t).css("opacity", 0);
            $(t).showAnima(a);
        }
        $(t).css("display", "block");

    };
    $.fn.initMagnificPopup = function () {
        var obj = this;
        var optionsString = $(obj).attr("data-options");
        var trigger = $(obj).attr("data-trigger");
        if (isEmpty(trigger)) trigger = "";
        var a = $(obj).attr("data-lightbox-anima");
        var href = $(obj).attr("href");
        if (isEmpty(href)) href = ""
        var optionsArr;
        var options = {
            type: 'iframe'
        }

        if (!isEmpty(optionsString)) {
            optionsArr = optionsString.split(",");
            options = getOptionsString(optionsString, options);
        }
        if (isEmpty(options['mainClass'])) options['mainClass'] = "";
        if (trigger == "load" || trigger == "scroll") {
            var l = $(obj).attr("data-link");
            var c = $(obj).attr("data-click");
            if (isEmpty(l)) { href = "#" + $(this).attr("id"); options['mainClass'] += ' custom-lightbox'; }
            else href = l;

            if (!isEmpty(c)) {
                $("body").on("click", ".lightbox-on-load", function () {
                    if ($(obj).attr("data-click-target") == "_blank") window.open(c);
                    else document.location = c;
                });
            }
        }

        if ($(obj).hasClass("grid-box") || $(obj).hasClass("maso-box")) {
            options["type"] = "image";
            options["delegate"] = "a.img-box,.advs-box a:not(.img-box)";
            options["gallery"] = { enabled: 1 };
        }
        if ((href.indexOf(".jpg") != -1) || (href.indexOf(".png") != -1)) options['type'] = 'image';
        if (href.indexOf("#") == 0) {
            options['type'] = 'inline';
            options['mainClass'] += ' box-inline';
            options['closeBtnInside'] = 0;
        }
        options["callbacks"] = {
            "open": function () {
                var mfp_cnt = $('.mfp-content');
                if (!isEmpty(a)) {
                    $(mfp_cnt).showAnima(a);
                    $(mfp_cnt).css("opacity", 0);
                } else {
                    if ((!isEmpty(optionsString)) && optionsString.indexOf("anima:") != -1) {
                        $(mfp_cnt).showAnima(options['anima']);
                        $(mfp_cnt).css("opacity", 0);
                    }
                }
                if (href.indexOf("#") == 0) {
                    $(href).css("display", "block");
                }
                if ($.isFunction($.fn.initFlexSlider)) {
                    var i = 0;
                    $(mfp_cnt).find(".flexslider").each(function () {
                        $(this).initFlexSlider();
                        i++;
                    });
                    if (i) $(window).trigger('resize').trigger('scroll');
                }
                if ($.isFunction($.fn.googleMap)) $(mfp_cnt).find(".google-map").googleMap();
            },
            change: function (item) {
                var h = this.content;
                $('.mfp-container').removeClass("active");
                setTimeout(function () { $('.mfp-container').addClass("active"); }, 500);
                if ($.isFunction($.fn.initFlexSlider)) {
                    setTimeout(function () {
                        var i = 0;
                        $(h).find(".flexslider").each(function () {
                            $(this).initFlexSlider();
                            i++;
                        });
                        if (i) $(window).trigger('resize').trigger('scroll');
                    }, 100);
                }
                if ($.isFunction($.fn.googleMap)) setTimeout(function () { $(h).find(".google-map").googleMap(); }, 200);
            }
        };
        if (trigger != "load" && trigger != "scroll") $(obj).magnificPopup(options);
        else {
            if (href.indexOf("#") == 0) $(href).css("display", "block");
            options['items'] = { 'src': href }
            options['mainClass'] += ' lightbox-on-load';
            $.magnificPopup.open(options);
        }
    };
    $(document).ready(function () {
        $('.grid-list.gallery .grid-box,.maso-list.gallery .maso-box, .lightbox').each(function () {
            $(this).initMagnificPopup();
        });
        $('*[data-trigger="load"].box-lightbox').each(function () {
            var e = $(this).attr("data-expire");
            if (!isEmpty(e) && e > 0) {
                var id = $(this).attr("id");
                if (isEmpty(Cookies.get(id))) {
                    $(this).initMagnificPopup();
                    Cookies.set(id, 'expiration-cookie', { expire: e });
                }
            } else $(this).initMagnificPopup();
        });
        $('*[data-trigger="load"].popup-banner').each(function () {
            var e = $(this).attr("data-expire");
            if (!isEmpty(e) && e > 0) {
                var id = $(this).attr("id");
                if (isEmpty(Cookies.get(id))) {
                    $(this).showPopupBanner();
                    Cookies.set(id, 'expiration-cookie', { expire: e });
                }
            } else $(this).showPopupBanner();
        });
        $('.popup-trigger').each(function () {
            $(this).click(function () {
                $($(this).attr("href")).showPopupBanner();
            });
        });
        $('.popup-banner [data-click]').each(function () {
            var t = this;
            var c = $(t).attr("data-click");
            if (!isEmpty(c)) {
                $("body").on("click", $(t).attr("data-click-trigger"), function () {
                    if ($(t).attr("data-click-target") == "_blank") window.open(c);
                    else document.location = c;
                });
            }
        });
    });
    $('.popup-close').click(function () {
        $(this).closest(".popup-banner").hide();
    });

    $(window).scroll(function (event) {
        $('*[data-trigger="scroll"].popup-trigger').each(function () {
            if (isScrollView(this)) {
                var t = $(this).attr("href");
                var a = $(t).attr("data-popup-anima");
                if (!isEmpty(a)) {
                    $(t).css("opacity", 0);
                    $(t).showAnima(a);
                }
                $(t).css("display", "block");
                $(this).removeClass("popup-trigger");
            }
        });
        $('*[data-trigger="scroll"].lightbox-trigger').each(function () {
            if (isScrollView(this)) {
                $($(this).attr("href")).initMagnificPopup();
                $(this).attr("data-trigger", "null");
            }
        });
    });
}(jQuery));

/* 
BOOTSTRAP POPOVER
Third-party script name: bootstrap.popover.min.js
*/
(function ($) {
    $('[data-toggle="tooltip"]').tooltip();
    $('[data-toggle="popover"]').popover();
}(jQuery));

/* 
DATE PICKER
Third-party script name: datepicker.min.js
*/
jQuery(document).ready(function () {
    jQuery('[data-toggle="datepicker"]').datepicker();
});

/* 
SLIM SCROLL
Third-party script name: jquery.slimscroll.min.js
*/
(function ($) {
    var device_screen_size;
    var wh = $(window).width();
    if (wh < 993) device_screen_size = "device-xs";
    if (wh > 992 && wh < 1200) device_screen_size = "device-m";
    if (wh > 1200) device_screen_size = "device-l";

    $.fn.initSlimScroll = function () {
        if (!$(this).hasClass("scroll-mobile-disabled") || device_screen_size != "device-xs") {
            var optionsString = $(this).attr("data-options");
            var optionsArr;
            var options = {
                height: 0,
                size: '4px'
            }
            if (!isEmpty(optionsString)) {
                optionsArr = optionsString.split(",");
                options = getOptionsString(optionsString, options);
            }
            if (device_screen_size == "device-xs") options['alwaysVisible'] = true;

            var wh = $(window).height();
            var vh = getHeightFullscreen(this, wh);
            var lh = $(this).attr("data-height-remove");
            if (isEmpty(lh)) lh = 0;
            vh += "";

            if ((vh.indexOf("#") != -1) || (vh.indexOf(".") != -1)) vh = "" + ($(this).closest(vh).height() - lh);

            options['height'] = vh + "px";
            $(this).slimScroll(options);

            if ($.isFunction($.fn.googleMap)) {
                $(this).find(".google-map").each(function (index) {
                    $(this).googleMap();
                });
            }
            if (!options['alwaysVisible']) $(".slimScrollBar").hide();
        }
    }
    function getHeightFullscreen(t, wh) {
        var vh = $(t).attr("data-height");
        var lh = $(t).attr("data-height-remove");
        if (isEmpty(vh) || vh == "auto") {
            var h = wh - $(t)[0].getBoundingClientRect().top - $("footer").outerHeight(), ch = $(t).outerHeight();
            if (!isEmpty(lh)) h = wh - lh;
            vh = (ch < h) ? ch + 30 : h - 30;
        }
        if (vh == "fullscreen") {
            var h = wh;
            if (!isEmpty(lh) && ((wh - lh) > 150)) h = wh - lh;
            else h = wh - 100;
            vh = h;
        }
        return vh;
    }
    $(document).ready(function () {
        $(".scroll-content").each(function () {
            $(this).initSlimScroll();
            if (device_screen_size == "device-xs") $(".slimScrollBar").css("height", "50px");
        });
        $(".scroll-content").bind("mousewheel DOMMouseScroll", function (n) { n.preventDefault() });
    });
}(jQuery));

/* 
PRETTIFY
Third-party script name: bootstrap.popover.min.js
*/
!function ($) {
    $(function () {
        window.prettyPrint && prettyPrint()
    })
}(window.jQuery);

/* 
TWBS PAGINATION
Third-party script name: jquery.twbsPagination.min.js
*/
(function ($) {
    var isRLI;
    $.fn.initTwbsPagination = function () {
        var opt = $(this).attr("data-options");
        var a = $(this).attr("data-pagination-anima");
        var p = parseInt($(this).attr("data-page-items"));
        var c = $(this).closest(".grid-list");
        var t = $(c).find(".grid-box .grid-item");
        var n = $(t).length;
        var type = "pagination";
        if ($(this).hasClass('load-more-grid')) type = 'load-more';

        $(t).css("display", "none");
        for (var i = 0; i < p; i++) {
            $($(t)[i]).css("display", "block");
        }

        if (type == 'pagination') {
            var optionsArr;
            var options = {
                totalPages: Math.ceil(n / p),
                visiblePages: 7,
                first: "<i class='fa fa-angle-double-left'></i> <span>First</span>",
                last: "<span>Last</span> <i class='fa fa-angle-double-right'></i>",
                next: "<span>Next</span> <i class='fa fa-angle-right'></i>",
                prev: " <i class='fa fa-angle-left'></i> <span>Previous</span>",
                onPageClick: function (event, page) {
                    $(t).css("display", "none");
                    for (var i = (p * (page - 1)) ; i < (p * (page)) ; i++) {
                        var o = $($(t)[i]);
                        if (!isEmpty(a)) {
                            $(o).css("opacity", "0");
                            $(o).showAnima(a);
                        }
                        $(o).css("display", "block");
                        if (isRLI) $(o).renderLoadedImgs();
                    }
                    if (!isEmpty(opt) && opt.indexOf("scrollTop:true") != -1) $(c).scrollTo();
                }
            }
            if (!isEmpty(opt)) {
                optionsArr = opt.split(",");
                options = getOptionsString(opt, options);
            }
            $(this).twbsPagination(options);
        }
        if (type == 'load-more') {
            if (!isEmpty(opt) && opt.indexOf("lazyLoad:true") != -1) {
                var ths = this;
                $(window).scroll(function () {
                    if ($(window).scrollTop() + $(window).height() == $(document).height()) {
                        loadMoreGrid(ths);
                    }
                });
            }
            $(this).click(function () {
                loadMoreGrid(this);
            });
        }
        function loadMoreGrid(obj) {
            var page = $(obj).attr("data-current-page");
            if (isEmpty(page)) page = 1;
            page++;
            $(obj).attr("data-current-page", page);
            var s = p * (page - 1);
            var e = p * (page);

            for (var i = s ; i < (p * (page)) ; i++) {
                var o = $($(t)[i]);
                if (!isEmpty(a)) {
                    $(o).css("opacity", "0");
                    $(o).showAnima(a);
                }
                $(o).css("display", "block");
            }
            if (e >= n) $(obj).hide(300);
        }
    }
    $(document).ready(function () {
        isRLI = $.fn.renderLoadedImgs;
        $(".pagination-grid,.load-more-grid").each(function () {
            $(this).initTwbsPagination();
        });

        //ALBUM
        var alb = ".cont-album-box";
        $(".album-item").hide();
        $(".album-box").click(function () {
            var t = $(this).closest(".album-main");
            var a = $(t).attr("data-album-anima");
            var ida = $("#" + $(this).attr("data-album-id"));
            if (isEmpty(ida)) {
                ida = $(t).find(alb + " .album-item:eq(" + $(this).index() + ")");
            }
            $(alb + " .album-item").hide();
            $(t).find(".album-list").hide();
            $(t).find(alb + " .album-title span").html($(this).find(".album-name").html().replace("<br>", " ").replace("<br />", " "));
            $(t).find(alb + " .album-title").show();
            if (!isEmpty(a)) {
                $(ida).css("opacity", 0);
                $(ida).showAnima(a);
            }
            $(ida).css("display", "block");
            if ($.isFunction($.fn.initIsotope)) $(ida).find(".maso-list").initIsotope();
            if (isRLI) $(t).find(ida).renderLoadedImgs();

            $(ida).find(".load-more-maso").attr("data-current-page", "1").css("display", "inline-block");
        });
        $(alb + " .album-title").click(function () {
            var t = $(this).closest(".album-main");
            var a = $(t).attr("data-album-anima");
            var b = $(t).find(".album-list");
            $(alb + " .album-item").hide();
            $(alb + " .album-title").hide();
            if (!isEmpty(a)) {
                $(b).css("opacity", 0);
                $(b).showAnima(a);
            }
            $(b).css("display", "block");
        });
    });

}(jQuery));
