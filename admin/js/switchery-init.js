$(document).ready(function () {
  var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
  $('.js-switch').each(function() {
      new Switchery($(this)[0], $(this).data());
  }); 
});s