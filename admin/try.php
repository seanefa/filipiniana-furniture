<?php
// echo '<script type="text/javascript">
//         window.open("receipt.php?id='.$receiptID.'","_blank")
//         </script>';

include "titleHeader.php";
include "menu.php";
include "dbconnect.php";
//session_start();
/*if(isset($GET['id'])){
$jsID = $_GET['id']; 
}
$jsID=$_GET['id'];
$_SESSION['varname'] = $jsID;*/
include 'dbconnect.php';
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['newSuccess']))
{
  echo  '<script>';
  echo '$(document).ready(function () {';
    echo 'document.getElementById("toastNewSuccess").click();';
    echo '});';
echo '</script>';
}
else if (isset($_GET['updateSuccess']))
{
  echo  '<script>';
  echo '$(document).ready(function () {';
    echo 'document.getElementById("toastUpdateSuccess").click();';
    echo '});';
echo '</script>';
}
else if (isset($_GET['deactivateSuccess']))
{
  echo  '<script>';
  echo '$(document).ready(function () {';
    echo 'document.getElementById("toastDeactivateSuccess").click();';
    echo '});';
echo '</script>';
}

?>
<!DOCTYPE html>  
<html lang="en">
<head>
  <script>

  $(document).ready(function(){

    $('body').on('keyup','#username',function(){
      var user = $(this).val();
      var flag = true;
      $.post('frame-mat-check.php',{username : user}, function(data){


        if(data != "Already Exist!"){
          flag = false;
          $('#message').html("");

        }
        else if(data == "Already Exist!"){
          $('#message').html(data);
          flag = true;
        }
        if(flag){
          $('#addFab').prop('disabled',true);

          $('#username').css('border-color','red');
        }
        else if(!flag){
          $('#addFab').prop('disabled', false);

          $('#username').css('border-color','limegreen');
        }
      });



    });
    

  });
  $(document).ready(function(){
    var temprem;
    var tempname;
    var error = 0;
    $('body').on('keyup','#editname',function(){
      var user = $(this).val();

      tempname = $('#editname').val();
      temprem = $('#rem').val();
      $.post('frame-mat-Ucheck.php',{username : user}, function(data){


        if(data != "Already Exist!" && data !="unchanged"){
          flag = false;
          error =0;
          $('#message').html("");
          $('#updateBtn').prop('disabled', false);
          $('#editname').css('border-color','limegreen');

        }
        if(data == "unchanged"){
          error = 0;
          $('#message').html("");
          $('#updateBtn').prop('disabled', true);
          $('#editname').css('border-color','black')
        }
        else if(data == "Already Exist!"){
          flag = true;
          error++;
          $('#message').html(data);
          $('#updateBtn').prop('disabled',true);

          $('#editname').css('border-color','red');
        }

      });



    });
    $('body').on('change','#rem',function(){
      if(error == 0){
        $('#updateBtn').prop('disabled',false);
      }

    });
    $('body').on('keyup','#remText',function(){
      var tem = $(this).val();
      if(error == 0){
        flag = false;
        if(!flag){
          $('#updateBtn').prop('disabled',false);
        }
      }
    });

  });
/*  $(document).ready(function(){
    $("#archiveTable").hide();
    $("#backArch").hide();
  $("#showArch").click(function(){
      $("#tblFrameworkMaterial").hide();
      $("#archiveTable").show();
      $("#temptitle").text("");
      $("#temptitle").text("Archived");
      $("#tempbtn").hide();
      $("#showArch").hide();
      $("#backArch").show();
  });
  $("#backArch").click(function(){
    $("#tblFrameworkMaterial").show();
      $("#archiveTable").hide();
      $("#temptitle").text("");
      $("#temptitle").text("Frame Material");
      $("#tempbtn").show();
      $("#showArch").show();
      $("#backArch").hide();
  });
}); */


$(document).ready(function(){
 $('#myModal').on('shown.bs.modal',function(){

   $('#purpose').on('change', function() {
    if ( this.value == '1')
    //.....................^.......
  {
    $("#business").show();
  }
  else
  {
    $("#business").hide();
  }
});

 });
});


$(document).ready(function(){
 $('#myModal').on('shown.bs.modal',function(){

  $('#material').on('change', function() {
    var value = this.value;
    alert(value);

    $.ajax({
      type: 'post',
      url: 'load-form.php',
      data: {
        id: value,
      },
      success: function (response) {
      // We get the element having id of display_info and put the response inside it
      $( '#display_info' ).html(response);
  }


});
});
});
});

 $( function() {
    $( "#dialog-message" ).dialog({
      modal: true,
      buttons: {
        Ok: function() {
          $( this ).dialog( "close" );
        }
      }
    });
  } );

$(document).ready(function() {
  $(".js-example-basic-single").select2();
});

$(document).ready(function() {
  $("#dialog" ).dialog();
});

$(document).ready(function()
{
    $('table thead th').each(function(i)
    {
        calculateColumn(i);
    });
});

function calculateColumn(index)
{
    var total = 0;
    $('table tr').each(function()
    {
        var value = parseInt($('td', this).eq(index).text());
        if (!isNaN(value))
        {
            total += value;
        }
    });

    $('table tfoot td').eq(index).text('Total: ' + total);
}​

$(document).ready(function(){
    $("button").click(function(){
        $.ajax({url: "load-form.php", success: function(result){
            $("#div1").html(result);
        }});
    });
});


$(document).ready(function(){
 $('#myModal').on('shown.bs.modal',function(){

  $('#material').on('change', function() {
    var value = this.value;
    alert(value);

    $.ajax({
      type: 'post',
      url: 'load-form.php',
      data: {
        id: value,
      },
      success: function (response) {
      // We get the element having id of display_info and put the response inside it
      $( '#display' ).dialog(response);
  }


});
});
});
});

$(function(){ // DOM ready

  // ::: TAGS BOX

  $("#tags input").on({
    focusout : function() {
      var txt = this.value.replace(/[^a-z0-9\+\-\.\#]/ig,''); // allowed characters
      if(txt) $("<span/>", {text:txt.toLowerCase(), insertBefore:this});
      this.value = "";
    },
    keyup : function(ev) {
      // if: comma|enter (delimit more keyCodes with | pipe)
      if(/(188|13)/.test(ev.which)) $(this).focusout(); 
    }
  });
  $('#tags').on('click', 'span', function() {
    if(confirm("Remove "+ $(this).text() +"?")) $(this).remove(); 
  });

});

      $(document).ready(function() {
        var country = ["Australia", "Bangladesh", "Denmark", "Hong Kong", "Indonesia", "Netherlands", "New Zealand", "South Africa"];
        $("#country").select2({
          data: country
        });
      });

      window.onload = function() {
  document.write(
    '<body><div id="message"><p>STOP! This website is hot-linking resources and that\'s a naughty, naughty thing to do.</p><p style="text-align: center;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="150" height="150"><style>.a{fill:#fff;stroke-linejoin:round;stroke-width:20;}.b{fill:#212121;stroke-linejoin:round;stroke-width:5;}.c{fill:#ffb928;stroke-linejoin:round;stroke-width:5;}.d{fill:#fff;stroke-linejoin:round;stroke-width:10;stroke:#212121;}.e{fill:#212121;stroke-linejoin:round;stroke-width:20;}</style><defs><style type="text/css"/><style type="text/css"/><linearGradient><stop offset="0" stop-color="#6f0102"/><stop offset="1" style="stop-color:#6f0102;stop-opacity:0"/></linearGradient><linearGradient><stop offset="0" stop-color="#e33a4b"/><stop offset="1" style="stop-color:#d22436;stop-opacity:0.5"/></linearGradient><linearGradient gradientUnits="userSpaceOnUse" y2="870.6" x2="-192.6" y1="973.9" x1="-163.1" xlink:href="#linearGradient4161" gradientTransform="matrix(0.83330116,-0.4193308,0.37102762,0.85590167,24.29834,-452.9853)"/><linearGradient gradientUnits="userSpaceOnUse" y2="810.6" x2="119.2" y1="974.6" x1="284.7" xlink:href="#linearGradient4171" gradientTransform="matrix(0.93286074,0,0,0.93286074,29.062288,-482.75998)"/></defs><circle transform="scale(-1 1)" cy="256" cx="-256" r="256" style="fill:#212121;stroke-width:0.4"/><path d="M253.6 397.9A272.1 213.6 0 0 0 93.1 439.8 256 256 0 0 0 256 498.5 256 256 0 0 0 416.7 441.5 272.1 213.6 0 0 0 253.6 397.9Z" class="a"/><path d="m132.4 289.2c23.1 122.7 92.4 192.8 218.8 173.6-38.5-70.1-0.7-104.6 24-150.1L303.9 203.3c-39 42.6-67.6 87.4-171.5 85.9z" class="b"/><path d="m139.9 287.9c25.5 112.9 81.3 182.7 198.1 165.8-36.2-65.8 6.5-101 29.7-143.7l-58.6-29.4c-36.6 40-71.8 8.8-169.2 7.3z" class="c"/><path d="m155.7 294.5c31.7 108.3 64.2 159.6 167.8 152.6-36.2-65.8 10.5-102.3 33.7-145.1L299.7 290.5c-36.6 40-46.5 5.4-144 4z" class="b"/><path d="m163.2 295.9c33.9 105.7 54.3 147.7 152.8 146.5-36.2-65.8 11.9-100 35.1-142.7l-47.4-13.1c-36.6 40-43 10.8-140.5 9.3z" style="fill:url(#linearGradient4177);stroke-linejoin:round;stroke-width:5"/><path d="m189.8 362.8c-0.9 0-1.7 0-2.6 0.1 19.2 44.1 41.5 68.2 85.2 76.3 1.9-9.3-0.7-21.4-11.2-36.5-15.3-22-52.6-39.4-71.4-39.9z" style="fill:url(#linearGradient4167);stroke-linejoin:round;stroke-width:20"/><path d="m337 320.8c13-12.5 25.2-10.7 38.1 1.6 12.9 12.3 13.8 59.7 6.4 68.3-7.4 8.6-35.8 9.2-44.5 0-8.7-9.2-13-57.4 0-69.9z" class="d"/><path d="m337 320.8c13-12.5 25.2-10.7 38.1 1.6 12.9 12.3 13.8 59.7 6.4 68.3-7.4 8.6-35.8 9.2-44.5 0-8.7-9.2-13-57.4 0-69.9z" class="a"/><path d="m305.3 320.7c-11-10.6-21.4-9-32.3 1.3-10.9 10.4-12.7 38.4-4.9 50 7.9 11.6 30.9 20 38.2 12.2 7.4-7.8 10-52.9-1.1-63.5z" class="d"/><path d="m305.3 320.7c-11-10.6-21.4-9-32.3 1.3-10.9 10.4-12.7 38.4-4.9 50 7.9 11.6 30.9 20 38.2 12.2 7.4-7.8 10-52.9-1.1-63.5z" class="a"/><path d="m128.6 289.2c109.6 66.9 220.3 69 327.8 50.4C271.5 210.7 226.9 271.9 128.6 289.2Z" class="b"/><path d="m139.9 287.9c103.2 59.8 208.5 59.9 314.2 48.4C276.8 212.6 234.1 271.3 139.9 287.9Z" class="c"/><path d="m345.1 75.7a96.1 111 0 0 0-96.1 111 96.1 111 0 0 0 13 55.6l166.2 0A96.1 111 0 0 0 441.2 186.7 96.1 111 0 0 0 345.1 75.7Z" class="e"/><path d="m335.8 77.6a96.1 111 0 0 0-96.1 111 96.1 111 0 0 0 12.1 53.7l168.1 0a96.1 111 0 0 0 12-53.7 96.1 111 0 0 0-96.1-111z" class="a"/><path d="M184.2 75.7A96.1 111 0 0 0 88.1 186.7 96.1 111 0 0 0 101.1 242.3l166.2 0A96.1 111 0 0 0 280.4 186.7 96.1 111 0 0 0 184.2 75.7Z" class="e"/><path d="M174.9 77.6A96.1 111 0 0 0 78.8 188.6 96.1 111 0 0 0 90.9 242.3l168.1 0A96.1 111 0 0 0 271 188.6 96.1 111 0 0 0 174.9 77.6Z" class="a"/><circle cx="341.6" cy="181.6" r="36.9" class="e"/><circle r="36.9" cy="181.6" cx="180.7" class="e"/></svg></p><p>Somebody tell the person that manages this website to fix it ASAP.</p></div></body>' +
    '<style>body { background: #FF4136; color: black; font-family: sans-serif; max-width: 45rem; margin: 4rem auto; } #message { font-size: 2rem; border: solid 2rem #800; background: #FFDC00; padding: 4rem; animation: pulse 1s infinite; } @keyframes pulse { from { transform: scale3d(1, 1, 1) rotate(-5deg); } 50% { transform: scale3d(1.05, 1.05, 1.05) rotate(-5deg); } to { transform: scale3d(1, 1, 1) rotate(-5deg); } }</style>'
  );
};

</script>

<style>
#tags{
  float:left;
  border:1px solid #ccc;
  padding:5px;
  font-family:Arial;
}
#tags > span{
  cursor:pointer;
  display:block;
  float:left;
  color:#fff;
  background:#789;
  padding:5px;
  padding-right:25px;
  margin:4px;
}
#tags > span:hover{
  opacity:0.7;
}
#tags > span:after{
 position:absolute;
 content:"×";
 border:1px solid;
 padding:2px 5px;
 margin-left:3px;
 font-size:11px;
}
#tags > input{
  background:#eee;
  border:0;
  margin:4px;
  padding:7px;
  width:auto;
}
</style>
</head>
<body>
  <!-- Preloader -->
  <div class="preloader">
    <div class="cssload-speeding-wheel"></div>
  </div>
  <!-- Toast Notification -->
  <button class="tst1" id="toastNewSuccess" style="display: none;"></button>
  <button class="tst2" id="toastUpdateSuccess" style="display: none;"></button>
  <button class="tst3" id="toastDeactivateSuccess" style="display: none;"></button>
  <div id="page-wrapper">
    <div class="container-fluid">

      <table id="sum_table" width="300" border="1">
    <thead>                
        <tr>
            <th>Apple</th>
            <th>Orange</th>
            <th>Watermelon</th>
        </tr>
    </thead>
    <tr>
        <td>1</td>
        <td>2</td>
        <td>3</td>
    </tr>
    <tr>
        <td>1</td>
        <td>2</td>
        <td>3</td>
    </tr>
    <tr>
        <td>1</td>
        <td>2</td>
        <td>3</td>
    </tr>
    <tfoot>
        <tr>
            <td>Total:</td>
            <td>Total:</td>
            <td>Total:</td>
        </tr>
    </tfoot>
</table>​​​​​​​​​​​​​​​

<div id="dialog-message" title="Download complete">
  <p>
    <span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>
    Your files have downloaded successfully into the My Downloads folder.
  </p>
  <p>
    Currently using <b>36% of your storage space</b>.
  </p>
</div>

<p>Sed vel diam id libero <a href="http://example.com">rutrum convallis</a>. Donec aliquet leo vel magna. Phasellus rhoncus faucibus ante. Etiam bibendum, enim faucibus aliquet rhoncus, arcu felis ultricies neque, sit amet auctor elit eros a lectus.</p>
 


      <!--<option> LOL<option>
        <option>lEE<option>
          <option>hOng<option>-->

      <h1>DropDown with Search using jQuery</h1>
    <div>
      <select id="country" style="width:300px;">
      <!-- Dropdown List Option -->
      </select>
    </div>


  <div id="tags">
  <input type="text" value="" placeholder="Add a tag" />
  <span>php</span>
  <span>c++</span>
  <span>jquery</span>
</div>
      
      <div id="dialog" title="Basic dialog">
  <p>This is the default dialog which is useful for displaying information. The dialog window can be moved, resized and closed with the 'x' icon.</p>
</div>
 


    </div>
    <div id="myModal" class="modal fade" role="dialog " aria-hidden="true" style="display: none;" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Modal content-->
          <div class="modal-content clearable-content">
            <div class="modal-body">

            </div>
          </div>
        </div>
      </div>
    </div>

    <script>
    $(document).on('hidden.bs.modal', function (e) {
      var target = $(e.target);
      target.removeData('bs.modal')
      .find(".clearable-content").html('');
    });
    </script>
  </body>
  </html>


  <!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Dialog - Modal message</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#dialog-message" ).dialog({
      modal: true,
      buttons: {
        Ok: function() {
          $( this ).dialog( "close" );
        }
      }
    });
  } );
  </script>
</head>
<body>
 
<div id="dialog-message" title="Download complete">
  <p>
    <span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>
    Your files have downloaded successfully into the My Downloads folder.
  </p>
  <p>
    Currently using <b>36% of your storage space</b>.
  </p>
</div>
 
<p>Sed vel diam id libero <a href="http://example.com">rutrum convallis</a>. Donec aliquet leo vel magna. Phasellus rhoncus faucibus ante. Etiam bibendum, enim faucibus aliquet rhoncus, arcu felis ultricies neque, sit amet auctor elit eros a lectus.</p>
 
 
</body>
</html>