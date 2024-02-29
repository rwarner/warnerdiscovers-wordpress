var NEGATIVE_SCROLL_OFFSET = 50; // pixels we want to start off scrolled above the Title
var TMP_CONTENT_HEIGHT = 4000; // pixels the content section should start out at temporarily

var $ = jQuery;
var $content = $('#site-content');

/**
 * Set the scroll position to just above the title for any page that isn't the home page. This removes the need to
 * scroll past the header image every time the visitor changes pages.
 */
var setScrollPosition = function () {
    // @todo someday we could save the last scroll position in localStorage or a URL param
    var $title = $('.site-title');
    $('html, body').scrollTop($title.offset().top - NEGATIVE_SCROLL_OFFSET);
};

/**
 * We need to make sure the window is tall enough to scroll down
 */
var expandContentSection = function () {
    $content.css('height', TMP_CONTENT_HEIGHT); // temporarily set this to be super high so we know our scroll position will be valid
};

/**
 * We can undo our temporary changes once everything has loaded.
 */
var restoreContentSection = function () {
    $content.css('height', '');
};

$(document).ready(function () {
    if ($('body').hasClass('home')) {
        return;
    }

    // As page is loading, set scroll position
    expandContentSection();
    setScrollPosition();

    // When page finishes loading, undo temporary changes
    $(window).on('load', restoreContentSectionn);
});

// Ignore all images on site to pin, except for the ones with the class .sharethisimg
// Allows control on what image to use for pin in the recipes page
jQuery(document).ready(function(jQuery) {
   jQuery("img").attr("data-pin-nopin", "true");  // blacklists all images
   jQuery(".sharethisimg").removeAttr("data-pin-nopin", "true");  // whitelists all images with "sharethisimg" class
});