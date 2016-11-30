(function($){
	"use strict";
    var WPO_Menufooter_effect = function(){
        "use strict";
        jQuery('.wpo-footer .menu a').each(function(){
            jQuery(this).contents().wrap("<span></span>");
            jQuery(this).find('span').attr('data-hover',jQuery(this).text());
        });
    }

    var WPO_CartFixed = function(){
        "use strict";
        var $header = jQuery('#wpo-header');
        var $headercontainer = jQuery('#wpo-header>.container');
        var offset = $headercontainer.offset();
        jQuery('.top-cart').css({
            left:offset.left + $headercontainer.outerWidth()+3
        });
    }

    var WPO_CartScroll = function(){
        "use strict";
        var $header = jQuery('#wpo-header');
        var $cart = jQuery('.top-cart');
        if(jQuery(window).scrollTop()>=$header.offset().top){
            $cart.addClass('fixed');
        }else{
            $cart.removeClass('fixed');
        }
    }


	jQuery(document).ready(function() {
        //WPO_CartFixed();
        WPO_CartScroll();
        WPO_Menufooter_effect();
        jQuery('.yith-wcwl-add-to-wishlist div[style="clear:both"]').remove();
	});

    jQuery(window).scroll(function(event){
        WPO_CartScroll();
    });

    jQuery(window).resize(function(event) {
        //WPO_CartFixed();
    });

})(jQuery);



