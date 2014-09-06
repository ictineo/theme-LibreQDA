/**
 * @file
 * A JavaScript file for the theme.
 *
 * In order for this JavaScript to be loaded on pages, see the instructions in
 * the README.txt next to this file.
 */
(function ($, Drupal, window, document, undefined) {
Drupal.behaviors.my_custom_behavior = {
  attach: function(context, settings) {
    jQuery('body.front #lqda-pc > img').click(function () {
      jQuery('html, body').animate({
        scrollTop: jQuery("#lqda-pc").offset().top
      }, 400);
    });

    // Place your code here.

  }
};


})(jQuery, Drupal, this, this.document);
