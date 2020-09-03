jQuery(window).load(function() {
   
   if( jQuery('body.home').length == 0 ){

        var item1 = jQuery( ".site-title" )[ 0 ];
        jQuery(('html, body')).scrollTop(jQuery(item1).offset().top - 30);
   }
});
