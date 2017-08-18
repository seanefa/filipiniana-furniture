<?php
include "titleHeader.php";
include "menu.php";
//session_start();
/*if(isset($GET['id'])){
$jsID = $_GET['id']; 
}
$jsID=$_GET['id'];
$_SESSION['varname'] = $jsID;*/
$existingOrder = 0;
if(isset($_GET['id'])){
  $existingOrder = $_GET['id']; 
}
?>
<!DOCTYPE html>  
<html lang="en">
<head>
  <script>


  $(document).ready(function(){ //wala lang
    $('#quant').on('keyup',function(){
      var quan = $("input[name='quan']").val();
      if(quan!=""){
        $("#addBtn").prop("disabled",false);
        $('#quant').css('border-color','grey');
      }
      if(isNaN(quan)){
        $("#addBtn").prop("disabled",true);
        $('#quant').css('border-color','red');
      }
      if(quan==""){
        $("#addBtn").prop("disabled",true);
        $('#quant').css('border-color','grey');
      }
    });

  });
  $(document).ready(function(){

var value = $("#selectCat").val(); // on load

$.ajax({
  type: 'post',
  url: 'display-furnitures.php',
  data: {
    id: value,
  },
  success: function (response) {
    $('#tblProd').html(response);
//$("#selectType").attr('disabled','disabled');  
}
});

$('#selectCat').on("change",function() {
  var value = $("#selectCat").val();
  if(isNaN(value)){
    $.ajax({
      type: 'post',
      url: 'display-furnitures.php',
      data: {
        id: value,
      },
      success: function (response) {
        $('#tblProd').html(response);
        $("#selectType").empty();  
        $("#selectType").attr('disabled','disabled');  
      }
    });
  }
  else{
    var drop = 1;
    $.ajax({
      type: 'post',
      url: 'display-furnitures.php',
      data: {
        id: value,
      },
      success: function (response) {
        $('#tblProd').html(response);
      }
    });

    $.ajax({
      type: 'post',
      url: 'load-drop-downs.php',
      data: {
        id: value, type : drop,
      },
      success: function (response) {
        $('#selectType').html(response);
        $("#selectType").removeAttr('disabled');
      }
    });
  }
});

$('#selectType').on("change",function() {
  var value = $("#selectType").val();
  $.ajax({
    type: 'post',
    url: 'display-furnitures.php',
    data: {
      id: value,
    },
    success: function (response) {
      $('#tblProd').html(response);
//$("#selectType").attr('disabled','disabled');  
}
});
});

});
</script>
</head>
<body class ="fix-header fix-sidebar">
  <!-- Preloader -->
<!--script>
$(document).ready(function(){
$('.search').on('keyup',function(){
var searchTerm = $(this).val().toLowerCase();
$('#tblProd #formProduct').each(function(){
var lineStr = $(this).text().toLowerCase();
if(lineStr.indexOf(searchTerm) === -1){
$(this).hide();
}else{
$(this).show();
}
});
});
});
</script-->
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-info">
          <!-- nav start -->
          <h3>
            <ul class="nav customtab2 nav-tabs" role="tablist">
            </ul>
          </h3>
          <!-- nav end -->

          <div class="sttabs tabs-style-flip" style="margin-top: -40px;">
            <nav>
              <ul>
                <li><h3><a href="#orders" class="ti-shopping-cart"><span>Shop</span></a></h3></li>
              </ul>
            </nav>
            <div class="content-wrap text-center" style="margin-top: -10px;">

              <!-- ORDER MANAGEMENT TAB -->
              <section id="orders">
                <div class="tab-content">
                  <!-- CATEGORY -->
                  <div role="tabpanel" class="tab-pane fade active in" id="type">
                    <div class="panel-wrapper collapse in" aria-expanded="true">
                      <div class="panel-body">
                        <form id="myForm" method="post">
                          <input type="hidden" name="updateOrder" id="updateOrder" value="<?php echo $existingOrder?>">
                          <div class="col-md-12">

                            <div class="tab-content">
                              <!-- brochure -->
                              <div role="tabpanel" class="tab-pane fade active in" id="allprod">
                                <div class="panel-wrapper collapse in" aria-expanded="true">
                                  <div class="panel-body">  
                                    <div class="row" style="margin: 0 auto; margin-top: -120px;">
                                      <div class="col-md-6" style="margin-top: 10px;">
                                        <div class="row">
                                          <button type="button" href="#myCart" data-toggle="modal" id="cart" class="fcbtn btn-lg btn-info btn-outline btn-1e wave effect"><i class="fa fa fa-shopping-cart"></i> MY CART <span class="badge" id="totalBadge"></span></button>

                                        </div>
                                      </div>
                                      <div class="col-md-6" style="margin-top: -20px;">
                                        <div class="row">
                                          <input type="text" id="my-input-field" class="form-control navbar-form pull-right" placeholder="&#128269; Search..." size="30" style="margin-top: 35px;">

                                        </div>
                                      </div>
                                    </div>

                                    <div class="row">

                                      <div class="categories">
                                        <ul class="nav customtab2 nav-tabs col-md-12" role="tablist" id="myTab" style="margin-bottom: 20px;">

                                          <div class="col-md-6" style="padding: 0px 20px;">
                                            <div class="row">
                                              <label class="control-label">CATEGORY</label>
                                              <select id="selectCat" style="height:40px;" class="form-control" data-placeholder="Choose Category" tabindex="1" name="selectCat">
                                                <option value="All">All Furnitures</option>
                                                <option value="On-Hand">All On-hand Furnitures</option>
                                              <option value="On-Promo">All On-Promo Furnitures</option>
                                                <option value="Packages">All Packages</option>
                                                <?php
                                                include "dbconnect.php";
                                                $delsql = "SELECT * FROM tblfurn_category ORDER BY categoryName ASC;";
                                                $delresult = mysqli_query($conn,$delsql);
                                                while($delrow = mysqli_fetch_assoc($delresult)){
                                                  if($delrow['categoryStatus']!="Archived"){
                                                    echo('<option value="'.$delrow['categoryID'].'">'.$delrow['categoryName'].'</option>');
                                                  }
                                                }
                                                ?>
                                              </select>
                                            </div>
                                          </div>
                                          <div class="col-md-6" style="padding: 0px 20px;">
                                            <div class="row">
                                              <label class="control-label">TYPE</label>
                                              <select id="selectType" style="height:40px;" class="form-control" data-placeholder="Choose Category" tabindex="1" name="selectType" disabled>

                                              </select>
                                            </div>
                                          </div>
                                        </ul>
                                      </div>
                                      <!-- categories -->
                                    </div>

                                    <div class="row" id="allprod">
                                      <div id="thisIsCart">
                                      </div>

                                      <div class="row formScroll" id="tblProd">

                                      </div>
                                    </div>

                                    <div id="myModal1" class="modal fade" role="dialog " aria-hidden="true" style="display: none;" tabindex="-1">
                                      <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                          <!-- Modal content -->
                                          <div class="modal-content">
                                            <div class="modal-body">
                                              <h2 style="text-align:center;"> Successfully added to cart!<br>
                                              </h2>
                                              <div class="orderconfirm">
                                                <div class="descriptions">
                                                </div>
                                              </div>
                                            </div>
                                            <div class="modal-footer">
                                              <button input="theCloseBtn" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>

                                    <div id="myPackages" class="modal fade" role="dialog " aria-hidden="true" style="display: none;" tabindex="-1">
                                      <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                          <div class="modal-content clearable-content">
                                            <div class="modal-body">

                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>

                                    <div id="myCart" class="modal fade" role="dialog " aria-hidden="true" style="display: none;" tabindex="-1">
                                      <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <div class="panel-heading"> My Cart </div>
                                          </div>
                                          <div class="orderconfirm">
                                            <div class="descriptions">
                                              <div class="form-body">
                                                <div class="row">
                                                  <div class="col-md-12">
                                                    <div class="panel-wrapper collapse in" aria-expanded="true">
                                                      <div class="panel-body">
                                                        <div class="table-responsive">
                                                          <table class="table product-overview" id="cartTbl">
                                                            <thead>
                                                              <tr>
                                                                <!--th>Image</th-->
                                                                <th style="text-align:center">Furniture Name</th>
                                                                <th style="text-align:center">Furniture Description</th>
                                                                <th style="text-align:center">Unit Price</th>
                                                                <th style="text-align:center">Quantity</th>
                                                                <th style="text-align:center">Total Price</th>
                                                                <th style="text-align:center">Action</th>
                                                              </tr>
                                                            </thead>
                                                            <tbody>
                                                              <tr>
                                                                <!--td width="150"><img src="../plugins/images/chair.jpg" alt="No Image Available" width="80"></td-->
                                                              </tr>
                                                            </tbody>
                                                            <tfoot>
                                                              <td colspan="3" style="text-align:right"> GRAND TOTAL </td>
                                                              <td id="totalQ" style="text-align:center">0</td>
                                                              <td id="totalPrice" style="text-align:center">0</td>
                                                              <td></td>
                                                            </tfoot>
                                                          </table>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                      <button input="theCloseBtn" type="button" class="fcbtn btn btn-warning btn-outline btn-1b wave effect" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Continue Shopping</button>
                                                      <button type="button" id="check-out" class="fcbtn btn btn-success btn-outline btn-1b wave effect" onclick="checkout()"><i class="fa fa fa-shopping-cart"></i> Proceed to Check-Out</button>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>

                                    <div id="myProduct" class="modal fade" role="dialog " aria-hidden="true" style="display: none;" tabindex="-1">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-content">
                                            <div class="modal-body">
                                            </div>
                                            <div class="modal-footer">
                                              <button input="theCloseBtn" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>

                                  </div> <!-- panel body -->
                                </div> <!-- panel wrapper -->
                              </div> <!-- tab panel -->
                            </div> <!-- tab-content -->
                          </div> <!-- col inside -->
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </section>

              <script type="text/javascript">
//global variables
var prv_id = 0;
var idArray = [];
var qCtr = 0;
var totalQuant = 0;
var tempPrice = 0;

function deleteRow(row){
  var qunatityy = parseInt($('#quants'+row.value).val());
  var x = totalQuant - parseInt($('#quants'+row.value).val());
  var y = tempPrice - parseInt($('#prices'+row.value).val());
  var result;

  result = parseInt(prompt('Remove how many products?'));
  if(result == null || isNaN(result) || result > qunatityy ||  result == 0 || result < 0) {
    if(result > qunatityy){
      alert('Input must be less than '+qunatityy);
    }
    else if(result == 0){
      alert('Input number');
    }
    else if(isNaN(result)){
      alert('Input number');
    }
    else if(result < 0){
      alert('Input positive number');
    }
    return;

  }
  else{
    if(qunatityy != 0){
      var remover = qunatityy;
      var a = parseInt($('#prices'+row.value).val());
      var b = parseInt($('#quants'+row.value).val());

      var totalP= $('#totalPrice').html();
totalP=totalP.replace(/\,/g,''); //deletes comma
totalP=parseInt(totalP,10);

var totalQ= $('#totalQ').html();
totalQ=totalQ.replace(/\,/g,''); //deletes comma
totalQ=parseInt(totalQ,10);

var realPrice =  a / b;
//quantity
$('#quants'+row.value).val(0);
remover = remover - result;
$('#quants'+row.value).val(qunatityy - result);
$('#qt'+row.value+'').html($('#quants'+row.value).val());
var newQuantt = $('#quants'+row.value).val();
//price
$('#prices'+row.value).val(0);
$('#prices'+row.value).val(realPrice * newQuantt);
$('#pr'+row.value+'').html($('#prices'+row.value).val());



//total
$('#ttp').val(totalP - (realPrice * result));
$('#ttq').val(totalQ - result);

$('#totalPrice').html(String(totalP - (realPrice * result) ));
$('#totalQ').html(String(totalQ - result));
$('#totalBadge').html(String(totalQ - result));


//if quantity is zero delete row
if(remover == 0){
  var t = idArray.indexOf(row.value);
  idArray.splice(t,1);


  $('#totalQ').html(String(x));
  $('#totalPrice').html(String(y));
  qCtr--;
  var i=row.parentNode.parentNode.rowIndex;
  $('#thisIsCart').append('<input type="hidden" name="removed[]" value="'+$('#id'+row.value).val()+'">');
  $('#thisIsCart').append('<input type="hidden" name="priceremoved[]" value="'+$('#prices'+row.value).val()+'">');
  $('#thisIsCart').append('<input type="hidden" name="quantremoved[]" value="'+$('#quants'+row.value).val()+'">');
  document.getElementById('cartTbl').deleteRow(i);

}

}
else if(qunatityy == 0){
  var t = idArray.indexOf(row.value);
  idArray.splice(t,1);


  $('#totalQ').html(String(x));
  $('#totalPrice').html(String(y));
  qCtr--;
  var i=row.parentNode.parentNode.rowIndex;

  $('#thisIsCart').append('<input type="hidden" name="removed[]" value="'+$('#id'+row.value).val()+'">');
  $('#thisIsCart').append('<input type="hidden" name="priceremoved[]" value="'+$('#prices'+row.value).val()+'">');
  $('#thisIsCart').append('<input type="hidden" name="quantremoved[]" value="'+$('#quants'+row.value).val()+'">');
  document.getElementById('cartTbl').deleteRow(i);
}
}
}

function addPackage(id){
                 tempPrice = parseInt($('#totalPrice').text().slice());
                 var quant =parseInt($('#P_quant'+id).val());

                 totalQuant = parseInt($('#totalQ').text());
                 var tP = $('#P_price'+id).val().toString();
                 var price =parseInt(tP.replace(',',''));
                 price = price * quant;
                 tempPrice = tempPrice+price;
                 totalQuant = totalQuant+quant;

                 if(isInArray(id,idArray)){

                  if(quant > 0){
                    $('#P_quant'+id).val(0);
                    $('#'+id).attr('data-toggle','modal');
                    $('#'+id).attr('href','#myModal1');

                    //price parser
                    var priced= $('#P_prices'+id+'').val();
                  priced=priced.replace(/\,/g,''); //deletes comma
                  priced=parseInt(priced,10);

                  var tPriced= tP;
                  tPriced=tPriced.replace(/\,/g,''); //deletes comma
                  tPriced=parseInt(tPriced,10);
                  
                  //quantity parser
                  var quantd= $('#P_quants'+id+'').val();
                  quantd=quantd.replace(/\,/g,''); //deletes comma
                  quantd=parseInt(quantd,10);

                  var q = parseInt(quant);

                  //total price parser

                  var totalP= $('#totalPrice').html();
                  totalP=totalP.replace(/\,/g,''); //deletes comma
                  totalP=parseInt(totalP,10);

                  var totalQ= $('#totalQ').html();
                  totalQ=totalQ.replace(/\,/g,''); //deletes comma
                  totalQ=parseInt(totalQ,10);

                  var newPrice = priced + tPriced;
                  var newQuant = quantd + q;

                  $('#P_quants'+id+'').val(newQuant);
                  $('#P_qt'+id+'').html(''+newQuant);

                  $('#P_prices'+id+'').val(newPrice);
                  $('#P_pr'+id+'').html(''+newPrice);

                  $('#ttq').val(0);
                  $('#ttp').val(0); 
                  $('#ttp').val(totalP + tPriced);
                  $('#ttq').val(totalQ + q);

                  $('#totalPrice').html(String(totalP + tPriced));
                  $('#totalQ').html(String(totalQ + q));

                }
                else{
                  alert('please input the quantity');
                  $('#'+id).attr('data-toggle','');
                  $('#'+id).attr('href','');
                }
                
              }
              else{

                if(quant > 0){
                 prv_id = id;
                 qCtr++;
                 var name = $('#P_product'+id).val();
                 var size =$('#P_size'+id).val();
                 $('#'+id).attr('data-toggle','modal');
                 $('#'+id).attr('href','#myModal1');
                 $('#P_quant'+id).val(0);
                  //push id to array
                  idArray.push(id);

                  $('#thisIsCart').append('<input type="hidden" name="P_priceremoved[]" value=""><input type="hidden" name="P_quantremoved[]" value=""><input type="hidden" name="P_removed[]" value=""><input type="hidden" id="P_id'+id+'" name="P_cart[]" value="'+id+'"/><input type="hidden" name="P_quant[]" id="P_quants'+id+'" value="'+quant+'"/><input type="hidden" name="P_price[]" id="P_prices'+id+'" value="'+price+'"/><input type="hidden" id="ttp" name="totalPrice" value="'+tempPrice+'"/> <input type="hidden" name="totalQuant" id="ttq" value="'+totalQuant+'" />');
                  $('#cartTbl').append(
                    '<tr><td><h5 class="font-500">'+name+'</h5></td><td>'+size+'</td><td></td><td width="70" id="P_qt'+id+'">'+quant+'</td><td id="P_pr'+id+'" style="text-align: center; width="150" align="center" class="font-500">'+price+'</td><td><button type="button" class="btn btn-success" onclick="P_addRow(this)" value="'+id+'">+</button></td><td><button type="button" class="btn btn-danger" onclick="P_deleteRow(this)" value="'+id+'">x</button></td></tr>');

                  $('#totalPrice').html(String(tempPrice));
                  $('#totalQ').html(String(totalQuant));
        $('#totalBadge').html(String(totalQuant));
                }
                else if(quant == 0){
                  alert('please input the quantity');
                  $('#'+id).attr('data-toggle','');
                  $('#'+id).attr('href','');
                }
              }


                }

                //package row edit

                function P_deleteRow(row){
                      var qunatityy = parseInt($('#P_quants'+row.value).val());
                      var x = totalQuant - parseInt($('#P_quants'+row.value).val());
                      var y = tempPrice - parseInt($('#P_prices'+row.value).val());
                      var result;

                      result = parseInt(prompt('Remove how many products?'));
                      if(result == null || isNaN(result) || result > qunatityy ||  result == 0 || result < 0) {
                        if(result > qunatityy){
                          alert('Input must be less than '+qunatityy);
                        }
                        else if(result == 0){
                          alert('Input number');
                        }
                        else if(isNaN(result)){
                          alert('Input number');
                        }
                        else if(result < 0){
                          alert('Input positive number');
                        }
                        return;

                      }
                      else{
                        if(qunatityy != 0){
                          var remover = qunatityy;
                          var a = parseInt($('#P_prices'+row.value).val());
                          var b = parseInt($('#P_quants'+row.value).val());

                          var totalP= $('#totalPrice').html();
                      totalP=totalP.replace(/\,/g,''); //deletes comma
                      totalP=parseInt(totalP,10);

                      var totalQ= $('#totalQ').html();
                      totalQ=totalQ.replace(/\,/g,''); //deletes comma
                      totalQ=parseInt(totalQ,10);
                      
                      var realPrice =  a / b;
                      //quantity
                      $('#P_quants'+row.value).val(0);
                      remover = remover - result;
                      $('#P_quants'+row.value).val(qunatityy - result);
                      $('#P_qt'+row.value+'').html($('#P_quants'+row.value).val());
                      var newQuantt = $('#P_quants'+row.value).val();
                      //price
                      $('#P_prices'+row.value).val(0);
                      $('#P_prices'+row.value).val(realPrice * newQuantt);
                      $('#P_pr'+row.value+'').html($('#P_prices'+row.value).val());



                      //total
                      $('#ttp').val(totalP - (realPrice * result));
                      $('#ttq').val(totalQ - result);

                      $('#totalPrice').html(String(totalP - (realPrice * result) ));
                      $('#totalQ').html(String(totalQ - result));
                      $('#totalBadge').html(String(totalQ - result));
                      

                      //if quantity is zero delete row
                      if(remover == 0){
                       var t = idArray.indexOf(row.value);
                       idArray.splice(t,1);


                       $('#totalQ').html(String(x));
                       $('#totalPrice').html(String(y));
                       qCtr--;
                       var i=row.parentNode.parentNode.rowIndex;
                       $('#thisIsCart').append('<input type="hidden" name="P_removed[]" value="'+$('#P_id'+row.value).val()+'">');
                       $('#thisIsCart').append('<input type="hidden" name="P_priceremoved[]" value="'+$('#P_prices'+row.value).val()+'">');
                       $('#thisIsCart').append('<input type="hidden" name="P_quantremoved[]" value="'+$('#P_quants'+row.value).val()+'">');
                       document.getElementById('cartTbl').deleteRow(i);

                     }

                   }
                   else if(qunatityy == 0){
                    var t = idArray.indexOf(row.value);
                    idArray.splice(t,1);
                    

                    $('#totalQ').html(String(x));
                    $('#totalPrice').html(String(y));
                    qCtr--;
                    var i=row.parentNode.parentNode.rowIndex;
                    
                    $('#thisIsCart').append('<input type="hidden" name="P_removed[]" value="'+$('#P_id'+row.value).val()+'">');
                    $('#thisIsCart').append('<input type="hidden" name="P_priceremoved[]" value="'+$('#P_prices'+row.value).val()+'">');
                    $('#thisIsCart').append('<input type="hidden" name="P_quantremoved[]" value="'+$('#P_quants'+row.value).val()+'">');
                    document.getElementById('cartTbl').deleteRow(i);
                  }
                }
              }
                 ////////             ADD OF PRODUCTS TO CART ///////////////
                 function P_addRow(row){
                  var qunatityy = parseInt($('#P_quants'+row.value).val());
                  var x = totalQuant - parseInt($('#P_quants'+row.value).val());
                  var y = tempPrice - parseInt($('#P_prices'+row.value).val());
                  var result;

                  result = parseInt(prompt('Add how many products?'));
                  if(result == null || isNaN(result) ||  result == 0 || result < 0) {

                    if(result == 0){
                      alert('Input a number');
                    }
                    else if(isNaN(result)){
                      alert('Input a number');
                    }
                    else if(result < 0 ){
                      alert('Input positive number');
                    }
                    return;

                  }
                  else{
                    if(qunatityy != 0){
                      var remover = qunatityy;
                      var a = parseInt($('#P_prices'+row.value).val());
                      var b = parseInt($('#P_quants'+row.value).val());

                      var totalP= $('#totalPrice').html();
                      totalP=totalP.replace(/\,/g,''); //deletes comma
                      totalP=parseInt(totalP,10);

                      var totalQ= $('#totalQ').html();
                      totalQ=totalQ.replace(/\,/g,''); //deletes comma
                      totalQ=parseInt(totalQ,10);
                      
                      var realPrice =  a / b;
                      //quantity
                      remover = remover + result;
                      $('#P_quants'+row.value).val(qunatityy + result);
                      $('#P_qt'+row.value+'').html($('#P_quants'+row.value).val());
                      var newQuantt = $('#P_quants'+row.value).val();
                      //price
                      $('#P_prices'+row.value).val(0);
                      $('#P_prices'+row.value).val(realPrice * newQuantt);
                      $('#P_pr'+row.value+'').html($('#P_prices'+row.value).val());



                      //total
                      $('#ttp').val(totalP + (realPrice * result));
                      $('#ttq').val(totalQ + result);

                      $('#totalPrice').html(String(totalP + (realPrice * result) ));
                      $('#totalQ').html(String(totalQ + result));
                      $('#totalBadge').html(String(totalQ + result));
                      
                      
                    }
                  }



                  
                }

                //


                //

////////             ADD OF PRODUCTS TO CART ///////////////
function addRow(row){
  var qunatityy = parseInt($('#quants'+row.value).val());
  var x = totalQuant - parseInt($('#quants'+row.value).val());
  var y = tempPrice - parseInt($('#prices'+row.value).val());
  var result;

  result = parseInt(prompt('Add how many products?'));
  if(result == null || isNaN(result) ||  result == 0 || result < 0) {

    if(result == 0){
      alert('Input a number');
    }
    else if(isNaN(result)){
      alert('Input a number');
    }
    else if(result < 0 ){
      alert('Input positive number');
    }
    return;

  }
  else{
    if(qunatityy != 0){
      var remover = qunatityy;
      var a = parseInt($('#prices'+row.value).val());
      var b = parseInt($('#quants'+row.value).val());

      var totalP= $('#totalPrice').html();
totalP=totalP.replace(/\,/g,''); //deletes comma
totalP=parseInt(totalP,10);

var totalQ= $('#totalQ').html();
totalQ=totalQ.replace(/\,/g,''); //deletes comma
totalQ=parseInt(totalQ,10);

var realPrice =  a / b;
//quantity
remover = remover + result;
$('#quants'+row.value).val(qunatityy + result);
$('#qt'+row.value+'').html($('#quants'+row.value).val());
var newQuantt = $('#quants'+row.value).val();
//price
$('#prices'+row.value).val(0);
$('#prices'+row.value).val(realPrice * newQuantt);
$('#pr'+row.value+'').html($('#prices'+row.value).val());



//total
$('#ttp').val(totalP + (realPrice * result));
$('#ttq').val(totalQ + result);

$('#totalPrice').html(String(totalP + (realPrice * result) ));
$('#totalQ').html(String(totalQ + result));
$('#totalBadge').html(String(totalQ + result));


}
}




}

function isInArray(value, array) {
  return array.indexOf(value) > -1;
}

function btnClick(id){
  tempPrice = parseFloat($('#totalPrice').text().slice());
  var quant =parseInt($('#quant'+id).val());

  totalQuant = parseInt($('#totalQ').text());
  var tP = $('#price'+id).val().toString();
  var price =parseFloat(tP.replace(',',''));
  price = price * quant;
  tempPrice = tempPrice+price;
  totalQuant = totalQuant+quant;

  if(isInArray(id,idArray)){

    if(quant > 0){
      $('#quant'+id).val(0);
      $('#'+id).attr('data-toggle','modal');
      $('#'+id).attr('href','#myModal1');

      //price parser
      var priced= $('#prices'+id+'').val();
      priced=priced.replace(/\,/g,''); //deletes comma
      priced=parseFloat(priced,10);

      var tPriced= tP;
      tPriced=tPriced.replace(/\,/g,''); //deletes comma
      tPriced=parseInt(tPriced,10);

      //quantity parser
      var quantd= $('#quants'+id+'').val();
      quantd=quantd.replace(/\,/g,''); //deletes comma
      quantd=parseInt(quantd,10);

      var q = parseInt(quant);

      //total price parser
      var totalP= $('#totalPrice').html();
      totalP=totalP.replace(/\,/g,''); //deletes comma
      totalP=parseFloat(totalP,10);

      var totalQ= $('#totalQ').html();
      totalQ=totalQ.replace(/\,/g,''); //deletes comma
      totalQ=parseInt(totalQ,10);

      var newPrice = priced + tPriced;
      var newQuant = quantd + q;

      $('#quants'+id+'').val(newQuant);
      $('#qt'+id+'').html(''+newQuant);

      $('#prices'+id+'').val(newPrice);
      $('#pr'+id+'').html(''+newPrice);

      $('#ttq').val(0);
      $('#ttp').val(0); 
      $('#ttp').val(totalP + tPriced);
      $('#ttq').val(totalQ + q);

      $('#totalPrice').html(String(totalP + tPriced));
      $('#totalQ').html(String(totalQ + q));

      }
      else{
      alert('Please input the quantity');
      $('#'+id).attr('data-toggle','');
      $('#'+id).attr('href','');
      }

}
else{
    if(quant > 0){
    prv_id = id;
    qCtr++;
    var pack = $('#package'+id).val(); //packages
    if(pack!=0){
      var size =$('#size'+id).val();
      var name = $('#product'+id).val();
      var uprice =$('#uprice'+id).val();
      $('#'+id).attr('data-toggle','modal');
      $('#'+id).attr('href','#myModal1');
      $('#quant'+id).val(0);
        idArray.push(id);
        $('#thisIsCart').append('<input type="hidden" name="priceremoved[]" value=""><input type="hidden" name="quantremoved[]" value=""><input type="hidden" name="removed[]" value=""><input type="hidden" id="id'+id+'" name="cart[]" value="'+id+'"/><input type="hidden" name="quant[]" id="quants'+id+'" value="'+quant+'"/><input type="hidden" name="price[]" id="prices'+id+'" value="'+price+'"/><input type="hidden" id="ttp" name="totalPrice" value="'+tempPrice+'"/> <input type="hidden" name="totalQuant" id="ttq" value="'+totalQuant+'" />');
        $('#cartTbl').append(
          '<tr><td><h5 class="font-500">[Package]'+name+'</h5></td><td>'+size+'</td><td>'+uprice+'</td><td width="70" id="qt'+id+'">'+quant+'</td><td id="pr'+id+'" style="text-align: center; width="150" align="center" class="font-500">'+price+'</td><td><button type="button" class="btn btn-success" onclick="addRow(this)" value="'+id+'" style="margin:5px;">+</button><button type="button" class="btn btn-danger" onclick="deleteRow(this)" value="'+id+'">x</button></td></tr>');

        $('#totalPrice').html(String(tempPrice));
        $('#totalQ').html(String(totalQuant));
        $('#totalBadge').html(String(totalQuant));
        }

    else{
    var size =$('#size'+id).val();
    var name = $('#product'+id).val();
    var uprice =$('#uprice'+id).val();
    $('#'+id).attr('data-toggle','modal');
    $('#'+id).attr('href','#myModal1');
    $('#quant'+id).val(0);
    //push id to array
    idArray.push(id);
    $('#thisIsCart').append('<input type="hidden" name="priceremoved[]" value=""><input type="hidden" name="quantremoved[]" value=""><input type="hidden" name="removed[]" value=""><input type="hidden" id="id'+id+'" name="cart[]" value="'+id+'"/><input type="hidden" name="quant[]" id="quants'+id+'" value="'+quant+'"/><input type="hidden" name="price[]" id="prices'+id+'" value="'+price+'"/><input type="hidden" id="ttp" name="totalPrice" value="'+tempPrice+'"/> <input type="hidden" name="totalQuant" id="ttq" value="'+totalQuant+'" />');
    $('#cartTbl').append(
    '<tr><td><h5 class="font-500">'+name+'</h5></td><td>'+size+'</td><td>'+uprice+'</td><td width="70" id="qt'+id+'">'+quant+'</td><td id="pr'+id+'" style="text-align: center; width="150" align="center" class="font-500">'+price+'</td><td><button type="button" class="btn btn-success" onclick="addRow(this)" value="'+id+'" style="margin:5px;">+</button><button type="button" class="btn btn-danger" onclick="deleteRow(this)" value="'+id+'">x</button></td></tr>');

    $('#totalPrice').html(String(tempPrice));
    $('#totalQ').html(String(totalQuant));
    $('#totalBadge').html(String(totalQuant));
    }
}
else if(quant == 0){
  alert('Please input the quantity');
  $('#'+id).attr('data-toggle','');
  $('#'+id).attr('href','');
}
}
}
//CHECK OUT


function checkout(){

  if(qCtr== 0){
    alert("Cart is empty.");
  }
  else if(qCtr > 0){
    var result = confirm("This action cannot be undone. Do you want to proceed?");
    if(result){
      var value = $("#updateOrder").val();
      if(value!=0){
        $('#check-out').attr('type','submit');
        $('#myForm').attr('action','confirm-update.php');
      }
      else{
        $('#check-out').attr('type','submit');
        $('#myForm').attr('action','next.php');
      }
    }
    else{ 

    }
  }
}
</script>


</div><!-- /content -->
</div><!-- /tabs -->
</div> <!-- panel info -->

</div>
</div>
<!--footer class="footer text-center"> 2017 &copy; Filipiniana Furniture </footer-->
</div>
</div>

<script>
$(document).on('hidden.bs.modal', function (e) {
  var target = $(e.target);
  target.removeData('bs.modal')
  .find(".clearable-content").html('');
});
</script>

<script>
$(document).on('hidden.bs.modal', function (e) {
  var target = $(e.target);
  target.removeData('bs.modal')
  .find(".clearable-content").html('');
});
</script>

<!-- Editable -->
<script src="../plugins/bower_components/jquery-datatables-editable/jquery.dataTables.js"></script>
<script src="../plugins/bower_components/datatables/dataTables.bootstrap.js"></script>
<script src="../plugins/bower_components/tiny-editable/mindmup-editabletable.js"></script>
<script src="../plugins/bower_components/tiny-editable/numeric-input-example.js"></script>
<script>
$('#mainTable').editableTableWidget().numericInputExample().find('td:first').focus();
$('#editable-datatable').editableTableWidget().numericInputExample().find('td:first').focus();
$(document).ready(function(){
  $('#editable-datatable').DataTable();
});
</script>

<script>
$(document).ready(function () {
  $('.formScroll').slimScroll({
    height: '950px',
    size: '8px',
    wheelStep: 3,
    railVisible: true
  });
});
</script>

</body> 
</html>