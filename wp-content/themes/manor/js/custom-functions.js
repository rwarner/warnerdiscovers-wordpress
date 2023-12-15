jQuery(window).load(function() {
   
   if( jQuery('body.home').length == 0 ){

        var item1 = jQuery( ".site-title" )[ 0 ];
        jQuery(('html, body')).scrollTop(jQuery(item1).offset().top - 30);
   }
});

// Ignore all images on site to pin, except for the ones with the class .sharethisimg
// Allows control on what image to use for pin in the recipes page
jQuery(document).ready(function(jQuery) {
   jQuery("img").attr("data-pin-nopin", "true");  // blacklists all images
   jQuery(".sharethisimg").removeAttr("data-pin-nopin", "true");  // whitelists all images with "sharethisimg" class
});