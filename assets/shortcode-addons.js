jQuery(document).ready(function(){

    var container = jQuery('.collapsible-content-container');

    container.click(function(e) {
       e.preventDefault();
       var content = jQuery(this).find('.collapsible-content');
       var button = jQuery(this).find('.collapsible-button');
       content.slideToggle();
       button.toggleClass('open');
    });

});