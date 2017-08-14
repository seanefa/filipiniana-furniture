$("document").ready(function(e) {
  setTimeout(function() {
    if( $('.sidebar').is(":hover") ){
      e.preventDefault();
  } 
  else{
     $(".hideMenu").trigger('click');
   }
  },2000);
});
$("document").ready(function() {
  setTimeout(function() {
     $(".sidebar").mouseenter(function () {
      $(".hideMenu").trigger('click');
    });

     $(".sidebar").mouseleave(function () {
      $(".hideMenu").trigger('click');
    });
  },2000);
});

/* $(window).on('load',function() {
    setTimeout(function() {
       $("#page-wrapper:not(.sidebar), .navbar-header").hover(function () {
        $( '.hideMenu' ).trigger('click', function() {
            return false;
        });
      });
    },1000);
});

  $("document").ready(function() {
    function menuHover() {
      //Hover
      $('#page-wrapper, .navbar-header').hover(function(){
         $(".hideMenu").trigger('click');
      }).mouseout(function(){

      });
    }
    menuHover();
}); */