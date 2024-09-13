jQuery(document).ready(function ($) {
  'use strict';

  var table      = $('#update-themes-table');
  var necromancers_table_update_screenshot = table.find("img[src*='wp-content/themes/necromancers/screenshot.png']");
  // remove td
  necromancers_table_update_screenshot.parent().parent().parent().remove();

  $(window).on('load', function() {
    var necromancers_theme_screenshot = $('.theme-browser').find("img[src*='wp-content/themes/necromancers/screenshot.png']");
    necromancers_theme_screenshot.parent().next('.notice').remove();

    var necromancers_theme_overlay_screenshot = $('.theme-overlay .theme-about').find("img[src*='wp-content/themes/necromancers/screenshot.png']");
    necromancers_theme_overlay_screenshot.parent().parent().next('.theme-info').find('.notice').remove();
  });
});
