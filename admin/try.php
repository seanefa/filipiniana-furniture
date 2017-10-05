<?php
echo '<script type="text/javascript">
        window.open("receipt.php?id='.$receiptID.'","_blank")
        </script>';

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
$conn = mysqli_connect($servername, $username, $password, $dbname);
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


$(document).ready(function() {
  $(".js-example-basic-single").select2();
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
      $( '#display' ).html(response);
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