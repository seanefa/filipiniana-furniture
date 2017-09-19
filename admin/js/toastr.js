$(document).ready(function() {
  $(".tst1").click(function(){
   $.toast({
    heading: '<h4 style="color:white;">Successfully Saved!</h4>',
    position: 'top-right',
    loaderBg:'transparent',
    icon: 'success',
    hideAfter: 1500,
  });

 });

  $(".tst2").click(function(){
   $.toast({
    heading: '<h4 style="color:white;">Successfully Updated!</h4>',
    position: 'top-right',
    loaderBg:'transparent',
    icon: 'success',
    hideAfter: 1500

  });

 });

  $(".tst3").click(function(){
   $.toast({
    heading: '<h4 style="color:white;">Successfully Deactivated!</h4>',
    position: 'top-right',
    loaderBg:'transparent',
    icon: 'success',
    hideAfter: 1500

  });

 });

  $(".tst4").click(function(){
   $.toast({
    heading: '<h4 style="color:white;">Successfully Reactivated!</h4>',
    position: 'top-right',
    loaderBg:'transparent',
    icon: 'success',
    hideAfter: 1500

  });

 });

  $(".tst5").click(function(){
   $.toast({
    heading: '<h4 style="color:white;">Action failed</h4>',
    position: 'top-right',
    loaderBg:'transparent',
    icon: 'error',
    hideAfter: 1500

  });

 });


});

