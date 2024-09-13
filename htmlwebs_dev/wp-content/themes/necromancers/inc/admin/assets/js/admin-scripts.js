/**
  * @package Necromancers WordPress theme
  * @version 1.0.0
  * Admin Scripts
  * Created by Dan Fisher
*/

(function ($){
  'use strict';

  $(function () {
    // Event
    var layoutEventItem = $('label[for="sportspress_event_show_content"]');
    layoutEventItem.parent().parent().hide();

    // Event Venue
    var eventVenueSection = $('.sp-settings-section-venue_options');
    eventVenueSection.hide();

    // Event Countdown
    var eventCountdownSection = $('.sp-settings-section-countdown_options');
    eventCountdownSection.hide();

    // Player
    var layoutPlayerProfileItem = $('label[for="sportspress_player_show_content"]');
    layoutPlayerProfileItem.parent().parent().hide();

    // Team
    var layoutTeamProfileItem = $('label[for="sportspress_team_show_content"]');
    layoutTeamProfileItem.parent().parent().hide();
  });

})(jQuery);
