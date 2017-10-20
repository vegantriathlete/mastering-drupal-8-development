/**
 * @file
 * A silly effect for the book page
 *
 * To learn more about how to use Javascript with Drupal 8
 * @see: https://www.drupal.org/docs/8/api/javascript-api/javascript-api-overview
 */

(function ($, Drupal) {
  Drupal.behaviors.mySillyEffect = {
    attach: function (context, settings) {
      $('.helloWorld', context).hide().fadeIn(1500).fadeOut(500).fadeIn(1500);
    }
  };
})(jQuery, Drupal);
