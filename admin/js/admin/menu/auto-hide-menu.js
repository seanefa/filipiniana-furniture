$(window).load(function() {
  // When the page has loaded
  $("#showMenu").fadeIn(500);
});
$("document").ready(function(e) {
  setTimeout(function() {
    if( $('.sidebar').is(":hover") ){
      e.preventDefault();
  } 
  else{
     $(".hideMenu").trigger('click');
   }

  $(".sidebar").mouseenter(function () {
      $(".hideMenu").trigger('click');
    });

     $(".sidebar").mouseleave(function () {
      $(".hideMenu").trigger('click');
    });

  },4000);
});