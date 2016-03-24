(function($, window) {
    "use strict";
    $.jgetbrowser = function() {
        var e = navigator.appName,
            t = navigator.userAgent,
            n;
        var r = t.match(/(opera|chrome|safari|firefox|msie)\/?\s*(\.?\d+(\.\d+)*)/i);
        if (r && (n = t.match(/version\/([\.\d]+)/i)) !== null) {
            r[2] = n[1];
        }
        r = r ? [r[1], r[2]] : [e, navigator.appVersion, "-?"];
        return r[0];
    };
})(jQuery, window);
(function($) {
    "use strict";
    var ismobile = '';
    if ($(".movingbg").length && !ismobile) {
        $(".movingbg").each(function() {
            var ele = $(this);
            var curbgpos = $(ele).css('backgroundPosition').split(" ");
            var direction = $(ele).data('direction');
            var bgpos = 0;
            var bgpos2 = 0;
            var bgimage = $(this).css('background-image');
            bgimage = /^url\((['"]?)(.*)\1\)$/.exec(bgimage);
            bgimage = bgimage ? bgimage[2] : "";
            var newimg = new Image();
            newimg.src = bgimage;
            var browser = $.jgetbrowser().toLowerCase();
            $(newimg).load(function() {
                var maxwidth = newimg.width;
                var maxheight = newimg.height;
                var bsmove = function() {
                    if (direction === 'horizontal') {
                        if (bgpos > maxwidth) {
                            bgpos = 0;
                        }
                        if (browser === 'netscape' || browser === 'msie') {
                            $(ele).css('background-position-x', bgpos+++"px");
                        } else {
                            $(ele).css('background-position', bgpos+++"px " + curbgpos[1]);
                        }
                    } else if (direction === 'vertical') {
                        if (bgpos > maxheight) {
                            bgpos = 0;
                        }
                        if (browser === 'netscape' || browser === 'msie') {
                            $(ele).css('background-position-y', bgpos+++"px");
                        } else {
                            $(ele).css('background-position', curbgpos[0] + bgpos+++"px ");
                        }
                    } else if (direction === 'diagonal') {
                        if (bgpos > maxwidth) {
                            bgpos = 0;
                        }
                        if (bgpos2 > maxheight) {
                            bgpos2 = 0;
                        }
                        if (browser === 'netscape' || browser === 'msie') {
                            $(ele).css('background-position-x', bgpos+++"px");
                            $(ele).css('background-position-y', bgpos2+++"px");
                        } else {
                            $(ele).css('background-position', bgpos+++"px " + bgpos2+++"px ");
                        }
                    }
                    requestAnimationFrame(bsmove);
                };
                requestAnimationFrame(bsmove);
            });
        });
    }
})(jQuery);