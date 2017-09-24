$(document).ready(function() {
  $(".tst1").click(function(){
   $.toast({
    heading: '<h4 style="color:white;">Record Successfully Created!</h4>',
    position: 'top-right',
    loaderBg:'#C7CBD1',
    icon: 'success',
    hideAfter: 3000, 
    stack: 6
  });

 });

  $(".tst2").click(function(){
   $.toast({
    heading: '<h4 style="color:white;">Record Successfully Updated!</h4>',
    position: 'top-right',
    loaderBg:'#C7CBD1',
    icon: 'success',
    hideAfter: 3000, 
    stack: 6
  });

 });

  $(".tst3").click(function(){
   $.toast({
    heading: '<h4 style="color:white;">Record Successfully Deactivated!</h4>',
    position: 'top-right',
    loaderBg:'#C7CBD1',
    icon: 'warning',
    hideAfter: 3000, 
    stack: 6
  });

 });

  $(".tst4").click(function(){
   $.toast({
    heading: '<h4 style="color:white;">Record Successfully Reactivated!</h4>',
    position: 'top-right',
    loaderBg:'#C7CBD1',
    icon: 'warning',
    hideAfter: 3000, 
    stack: 6
  });

 });

  $(".tst5").click(function(){
   $.toast({
    heading: '<h4 style="color:white;">Action failed</h4>',
    position: 'top-right',
    loaderBg:'#C7CBD1',
    icon: 'error',
    hideAfter: 3000, 
    stack: 6
  });
 });

    $(".tst6").click(function(){
   $.toast({
    heading: '<h4 style="color:white;">Successfully Saved Record!</h4>',
    position: 'top-right',
    loaderBg:'#C7CBD1',
    icon: 'success',
    hideAfter: 3000, 
    stack: 6
  });
 });
});