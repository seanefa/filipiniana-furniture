<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="image/favicon.ico" rel="icon" />
<title>Home - Filipiniana Furniture Shop</title>
<meta name="description" content="Furniture shop">
<?php include"css.php";?>
<!-- CSS Part End-->
</head>
<body>
<?php include"main.php";?>
<?php include"scripts.php";?>

<script type="text/javascript">
	

		
//global variables
var num_of_package = 0;
var num_of_product = 0;


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
      num_of_product =  num_of_product + qunatityy;

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
totalQuant = totalQuant - result;


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
  alert(totalQuant);
if(totalQuant==0){
    totalQuant = 0;
    totalPrice = 0;
    $('#totalQ').html(String(0));
  $('#totalPrice').html(String(0));
  }



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

                  num_of_package =  num_of_package + quant;
                  //alert(num_of_package);

                 totalQuant = parseInt($('#totalQ').text());
                 var tP = $('#P_price'+id).val().toString();
                 var price =parseInt(tP.replace(',',''));
                 price = price * quant;
                 tempPrice = tempPrice+price;
                 totalQuant = totalQuant+quant;

                 if(isInArray(id,idArray)){

                  if(quant > 0){
                    //$('#P_quant'+id).val(0);
                   // $('#'+id).attr('data-toggle','modal');
                    //$('#'+id).attr('href','#myModal1');

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
                 // $('#'+id).attr('data-toggle','');
                 // $('#'+id).attr('href','');
                }
                
              }
              else{

                if(quant > 0){
                 prv_id = id;
                 qCtr++;
                 var name = $('#P_product'+id).val();
                 var size =$('#P_size'+id).val();
                // $('#'+id).attr('data-toggle','modal');
                 //$('#'+id).attr('href','#myModal1');
                 //$('#P_quant'+id).val(0);
                  //push id to array
                  idArray.push(id);

                  $('#thisIsCart').append('<input type="hidden" name="P_priceremoved[]" value=""><input type="hidden" name="P_quantremoved[]" value=""><input type="hidden" name="P_removed[]" value=""><input type="hidden" id="P_id'+id+'" name="P_cart[]" value="'+id+'"/><input type="hidden" name="P_quant[]" id="P_quants'+id+'" value="'+quant+'"/><input type="hidden" name="P_price[]" id="P_prices'+id+'" value="'+price+'"/><input type="hidden" id="ttp" name="totalPrice" value="'+tempPrice+'"/> <input type="hidden" name="totalQuant" id="ttq" value="'+totalQuant+'" />');
                  $('#cartTbl').append(
                    '<tr><td><a href=""><img class="img-thumbnail" title="Product" alt="Product" style="height:75px;width:50px;" src="../admin/plugins/images/28282-NX18M6.jpg"><h5 class="font-500">[Package]'+name+'</h5></td><td>'+size+'</td><td></td><td width="70" id="P_qt'+id+'">'+quant+'</td><td id="P_pr'+id+'" style="text-align: center; width="150" align="center" class="font-500">'+price+'</td><td><button type="button" class="btn btn-success" onclick="P_addRow(this)" value="'+id+'">+</button></td><td><button type="button" class="btn btn-danger" onclick="P_deleteRow(this)" value="'+id+'">x</button></td></tr>');

                  $('#totalPrice').html(String(tempPrice));
                  $('#totalQ').html(String(totalQuant));
        $('#totalBadge').html(String(totalQuant));
                }
                else if(quant == 0){
                  alert('please input the quantity');
                 // $('#'+id).attr('data-toggle','');
                  //$('#'+id).attr('href','');
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

                          num_of_package =  num_of_package - qunatityy;

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

                      totalQuant = totalQuant - result;

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
                       if(totalQuant==0){
                        totalQuant = 0;
                        totalPrice = 0;
                        $('#totalQ').html(String(0));
                      $('#totalPrice').html(String(0));
                      }

                       
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

                      num_of_package =  num_of_package + qunatityy;
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
      num_of_product =  num_of_product + qunatityy;
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
  var pic = $('#pic'+id+'').val();


  totalQuant = parseInt($('#totalQ').text());
  var tP = $('#price'+id).val().toString();
  var price =parseFloat(tP.replace(',',''));
  price = price * quant;
  tempPrice = tempPrice+price;
  totalQuant = totalQuant+quant;

  if(isInArray(id,idArray)){

    if(quant > 0){

      
      //$('#quant'+id).val(0);
      //$('#f'+id).attr('data-toggle','modal');
     // $('#f'+id).attr('href','#myModal1');

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

      }

}
else{
    if(quant > 0){
      num_of_product =  num_of_product + quant;
    prv_id = id;
    qCtr++;
    var pack = $('#package'+id).val(); //packages
    if(pack!=0){
      var size =$('#size'+id).val();
      var name = $('#product'+id).val();
      var uprice =$('#uprice'+id).val();
     // $('#'+id).attr('data-toggle','modal');
     // $('#'+id).attr('href','#myModal1');
      //$('#quant'+id).val(0);
        idArray.push(id);
        $('#thisIsCart').append('<input type="hidden" name="priceremoved[]" value=""><input type="hidden" name="quantremoved[]" value=""><input type="hidden" name="removed[]" value=""><input type="hidden" id="id'+id+'" name="cart[]" value="'+id+'"/><input type="hidden" name="quant[]" id="quants'+id+'" value="'+quant+'"/><input type="hidden" name="price[]" id="prices'+id+'" value="'+price+'"/><input type="hidden" id="ttp" name="totalPrice" value="'+tempPrice+'"/> <input type="hidden" name="totalQuant" id="ttq" value="'+totalQuant+'" />');
        $('#cartTbl').append(
          '<tr><td><a href="">																			<img class="img-thumbnail" title="Product" alt="Product" style="height:75px;width:50px;" src="../admin/plugins/images/'+pic+'"></a></td><td><h5 class="font-500">'+name+'</h5></td><td>'+size+'</td><td>'+uprice+'</td><td width="70" id="qt'+id+'">'+quant+'</td><td id="pr'+id+'" style="text-align: center; width="150" align="center" class="font-500">'+price+'</td><td><button type="button" class="btn btn-success" onclick="addRow(this)" value="'+id+'" style="margin:5px;">+</button><button type="button" class="btn btn-danger" onclick="deleteRow(this)" value="'+id+'">x</button></td></tr>');

        $('#totalPrice').html(String(tempPrice));
        $('#totalQ').html(String(totalQuant));
        $('#totalBadge').html(String(totalQuant));
        }

    else{
    var size =$('#size'+id).val();
    var name = $('#product'+id).val();
    var uprice =$('#uprice'+id).val();
   //$('#f'+id).attr('data-toggle','modal');
    //$('#f'+id).attr('href','#myModal1');
    //$('#quant'+id).val(0);
    //push id to array
    idArray.push(id);
    $('#thisIsCart').append('<input type="hidden" name="priceremoved[]" value=""><input type="hidden" name="quantremoved[]" value=""><input type="hidden" name="removed[]" value=""><input type="hidden" id="id'+id+'" name="cart[]" value="'+id+'"/><input type="hidden" name="quant[]" id="quants'+id+'" value="'+quant+'"/><input type="hidden" name="price[]" id="prices'+id+'" value="'+price+'"/><input type="hidden" id="ttp" name="totalPrice" value="'+tempPrice+'"/> <input type="hidden" name="totalQuant" id="ttq" value="'+totalQuant+'" />');
    $('#cartTbl').append(
    '<tr><td><img class="img-thumbnail" title="Product" alt="Product" style="height:75px;width:50px;" src="../admin/plugins/images/'+pic+'"></td><td><h5 class="font-500">'+name+'</h5></td><td>'+size+'</td><td style="text-align:right">'+uprice+'</td><td width="70" id="qt'+id+'" style="text-align:right">'+quant+'</td><td id="pr'+id+'" style="text-align: right; width="150" align="center" class="font-500">'+price+'</td><td style="text-align:center"><button type="button" class="btn btn-success" onclick="addRow(this)" value="'+id+'" style="margin:5px;">+</button><button type="button" class="btn btn-danger" onclick="deleteRow(this)" value="'+id+'">x</button></td></tr>');

    $('#totalPrice').html(String(tempPrice));
    $('#totalQ').html(String(totalQuant));
    $('#totalBadge').html(String(totalQuant));
    }
}
else if(quant == 0){
  alert('Please input the quantity');
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

        if(num_of_product == 0){
          $('#thisIsCart').append('<input type="hidden" name="priceremoved[]" value=""><input type="hidden" name="quantremoved[]" value=""><input type="hidden" name="removed[]" value=""><input type="hidden" id="id'+0+'" name="cart[]" value="0"/><input type="hidden" name="quant[]" id="quants'+0+'" value="'+0+'"/><input type="hidden" name="price[]" id="prices'+0+'" value="'+0+'"/>');
        }
        if(num_of_package == 0){
          $('#thisIsCart').append('<input type="hidden" name="P_priceremoved[]" value=""><input type="hidden" name="P_quantremoved[]" value=""><input type="hidden" name="P_removed[]" value=""><input type="hidden" id="P_id'+0+'" name="P_cart[]" value="'+0+'"/><input type="hidden" name="P_quant[]" id="P_quants'+0+'" value="'+0+'"/><input type="hidden" name="P_price[]" id="P_prices'+0+'" value="'+0+'"/>');
        }
        $('#check-out').attr('type','submit');
        $('#myForm').attr('action','checkout.php');
      
    }
    else{ 

    }
  }
}



</script>


</body>
</html>