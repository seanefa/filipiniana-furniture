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