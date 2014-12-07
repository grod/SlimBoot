$(document).ready(function(){

  // Set active class for parent <li> for links
  $('.nav li').each(function() {
    $(this).removeClass('active');
    var href = $(this).find('a').attr('href');
    if (href === window.location.pathname) {
      $(this).addClass('active');
    }
  });

});
