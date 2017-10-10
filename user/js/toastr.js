$(document).ready(function() {
  $(".tst1").click(function(){
   $.toast({
    heading: '<h5 style="color:white;">Your order has been successfully processed!</h5>',
    position: 'top-right',
    loaderBg:'#C7CBD1',
    icon: 'success',
    hideAfter: 3000, 
    stack: 6
  });

 });

  $(".tst2").click(function(){
   $.toast({
    heading: '<h5 style="color:white;">Your order has been successfully updated!</h5>',
    position: 'top-right',
    loaderBg:'#C7CBD1',
    icon: 'success',
    hideAfter: 3000, 
    stack: 6
  });

 });

  $(".tst3").click(function(){
   $.toast({
    heading: '<h5 style="color:white;">Your order has been successfully cancelled!</h5>',
    position: 'top-right',
    loaderBg:'#C7CBD1',
    icon: 'warning',
    hideAfter: 3000, 
    stack: 6
  });

 });

  $(".tst5").click(function(){
   $.toast({
    heading: '<h5 style="color:white;">Action failed</h5>',
    position: 'top-right',
    loaderBg:'#C7CBD1',
    icon: 'error',
    hideAfter: 3000, 
    stack: 6
  });
 });
});