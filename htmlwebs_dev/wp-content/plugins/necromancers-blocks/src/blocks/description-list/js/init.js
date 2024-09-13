(function($){
  $(function(){
    $(".js-info-box__content:contains('@') > a").html(function(_, html) {
      return html.replace(/(@)/g, '<span class="color-primary">$1</span>');
   });
  });
})(jQuery);

