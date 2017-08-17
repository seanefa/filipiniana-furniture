<!DOCTYPE html>
<?php
session_start();
if(!isset($_SESSION['userID']))
{
	header("Location: error.html");
}
?>
<html>
	<head>
		<title>Filipiniana Furnitures - Home</title>
		<!--meta tags-->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="x-ua-compatible" content="ie-edge">
		<!--bootstrap 4-->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
		<!--custom css-->
		<link rel="stylesheet" href="custom.css">
		<!--scripts-->
		<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
		<!--custom css-->
		<link rel="stylesheet" href="custom.css">
		<!--google icons-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<!--font awesome icons-->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<!--my css-->
		<link rel="stylesheet" href="myStyle.css">
		<!--javascript-->
		<script src="myScript.js"></script>
	</head>
	<body>
		<div class="jumbotron-fluid">
			<div class="row">
				<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
					<!--navbar-->
					<br>
					<br>
					<nav class="navbar navbar-toggleable-md fixed-top navbar-inverse bg-inverse">
					 	<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					  	</button>
						<?php
						include "userconnect.php";
						$sql="SELECT * from tblcompany_info";
						$result=$conn->query($sql);
						if($result->num_rows>0)
						{
							while($row=$result->fetch_assoc())
							{
						?>
						<a class="navbar-brand" href="access.php"><?php echo "" . $row['comp_name'];?></a>
						<?php
							}
						}
						$conn->close();
						?>
					  	<div class="collapse navbar-collapse" id="navbarSupportedContent">
							<ul class="navbar-nav mr-auto">
						  		<li class="nav-item">
									<a class="nav-link" href="access.php"><i class="fa fa-user-circle-o"></i>&nbsp;ACCOUNT <span class="sr-only">(current)</span></a>
						  		</li>
						  		<li class="nav-item active">
									<a class="nav-link" href="accessproducts.php"><i class="fa fa-bed"></i>&nbsp;PRODUCTS</a>
						  		</li>
						  		<li class="nav-item">
									<a class="nav-link" href="accesscustom.php"><i class="fa fa-hand-pointer-o"></i>&nbsp;CUSTOMIZE</a>
						  		</li>
						  		<li class="nav-item">
									<a class="nav-link" href="accessproduction.php"><i class="fa fa-cog fa-spin"></i>&nbsp;PRODUCTION</a>
						  		</li>
							</ul>
							<form class="form-inline my-2 my-lg-0">
						  		<input class="form-control mr-sm-2" type="text" placeholder="Search">
						  		<button class="btn btn-outline-primary my-2 my-sm-0" type=""><i class="fa fa-search"></i></button>
							</form>
							&nbsp;
		          			<ul class="nav navbar-nav navbar-right">
								<li class="nav-item">
									<button class="btn btn-outline-success" data-toggle="modal" data-target="#myCart" title="Cart"><i class="fa fa-shopping-cart"></i></button>
								</li>
		        			</ul>
					  </div>
					</nav>
				</div>
			</div>
		</div>
		<div class="jumbotron-fluid">
			<!--products-->
			<hr>
			<h1 class="text-center"><b>PRODUCTS</b></h1>
			<hr>
			<div class="container">
				<div class="row">
					<div class="form-group col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
						<label>Category</label>
						<select class="form-control">
							<option>All Furnitures</option>
							<option>All Packages</option>
							<option>All On-Hand Furnitures</option>
							<option>All Pre-Order Furnitures</option>
						</select>
					</div>
					<div class="form-group col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
						<label>Type</label>
						<select class="form-control" disabled>
							<option></option>
						</select>
					</div>
				</div>
				<br>
				<div class="row">
				<?php
				include "userconnect.php";
				$sql="SELECT * from tblproduct";
				$result=$conn->query($sql);
				if($result->num_rows>0)
				{
					while($row=$result->fetch_assoc())
					{
				?>
					<div class="col-6 col-sm-3 col-md-4 col-lg-3 col-xl-2">
						<div class="card text-center">
							<img type="image" class="card-img-top img-fluid img-thumbnail" src="/admin/plugins/images/<?php echo "" .$row['prodMainPic'];?>">
							<div class="card-block">
								<div class="card-text">
									<p class="text-danger">
										<b class="text-primary"><?php echo "" . $row['productName'];?></b><br>
										Php <?php echo "" . $row['productPrice'];?>
									</p>
								</div>
								<form class="form-group">
									<?php echo('
										<input type="hidden" id="product'.$row['productID'].'" value="'.$row['productName'].'"/>
										<input type="hidden" id="price'.$row['productID'].'" value="'.$row['productPrice'].'"/>
                                        <input type="hidden" id="size'.$row['productID'].'" value="'.$row['prodSizeSpecs'].'"/>
                                        <input value="0" id="quant'.$row['productID'].'" type="number" class="form-control" step="1" min="0" value="" name="quantity" style="margin: 0 auto; width:65px;" required/>
                                        <br>
                                        <button onclick="btnClick('.$row['productID'].')" id="'.$row['productID'].'"  type="button" class="btn btn-primary" value="'.$row['productID'].'" ><i class="fa fa-cart-plus"></i></button>
										<button class="btn btn-success" data-toggle="modal" data-target="#viewmodal"><i class="fa fa-search"></i></button>
                                   '); ?>
								</form>
							</div>
						</div>
					</div>
				<?php
					}
				}
				$conn->close();
				?>
				</div>
			</div>
			<br>
<!--
		<footer class="jumbotron-fluid footer">
			<div class="row">
				<?php
				include "userconnect.php";
				$sql="SELECT * from tblcompany_info";
				$result=$conn->query($sql);
				if($result->num_rows>0)
				{
					while($row=$result->fetch_assoc())
					{
				?>
				<div class="col-md-3 col-lg-3 col-xl-3">
					<h3><b>Navigation Links</b></h3>
					<hr>
					<ul>
						<li><a href="#" class="btn btn-web">Home</a></li>
						<li><a href="#" class="btn btn-web">Products</a></li>
						<li><a href="#" class="btn btn-web">User Manual</a></li>
					</ul>
				</div>
				<div class="col-md-5 col-lg-5 col-xl-5">
					<h3 class="text-center"><b>About</b></h3>
					<hr>
					<p class="text-justify"><?php echo "" . $row['comp_about'];?></p>
				</div>
				<div class="col-md-4 col-lg-4 col-xl-4">
					<h3 class="text-center"><b>Additional Infos</b></h3>
					<hr>
					<div class="row">
						<div class="col-md-12 col-lg-12 col-xl-12 text-center">
							<b>Visit Us</b>
							<br>
							<?php echo "" . $row['comp_address'];?><br>
						</div>
					</div>
					<hr>
					<div class="row text-center">
						<div class="col-md-6 col-lg-6 col-xl-6">
							<b>Contact</b>
							<br>
							<?php echo "" . $row['comp_num'];?><br>
						</div>
						<div class="col-md-6 col-lg-6 col-xl-6">
							<b>Email</b>
							<br>
							<?php echo "" . $row['comp_email'];?><br>
						</div>
					</div>
				</div>
				<?php
					}
				}
				$conn->close();
				?>
			</div>
		</footer>
			<div class="jumbotron-fluid">
				<div class="row">
					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center">
						<button onClick="footerToggle() "class="btn text-primary text-center"style="background-color:white;"><i class="fa fa-copyright"></i>&nbsp;Marie and Friends. All rights reserved</button>
					</div>
				</div>
			</div>
-->
	<form action="" method="post" id="myForm">
			<div class="modal fade" id="myCart">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Product Name</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="table-responsive">
								<table id="cartTbl" class="table table-hover">
									<thead class="bg-web">
										<tr>
											<th>Product Name</th>
											<th>Dimensions</th>
											<th>Quantity</th>
											<th>Price</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<div class="modal-footer">
						<button input="theCloseBtn" type="button" class="fcbtn btn btn-warning btn-outline btn-1b wave effect" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Continue Shopping</button>
                                                      <button type="button" id="check-out" class="fcbtn btn btn-success btn-outline btn-1b wave effect" onclick="checkout()"><i class="fa fa fa-shopping-cart"></i> Proceed to Check-Out</button>
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade" id="viewmodal">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title"></h5>
							
						</div>
						<div class="modal-body">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row" id="allprod">
                                        <div id="thisIsCart">
                                        </div>

                                        <div class="row" id="tblProd">

                                        </div>
                                      </div>
                                      </form>
	</body>
</html>
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
                      
                      
                    }
                  }



                  
                }

                function isInArray(value, array) {
                  return array.indexOf(value) > -1;
                }

                function btnClick(id){
                 tempPrice = parseInt($('#totalPrice').text().slice());
                 var quant =parseInt($('#quant'+id).val());

                 totalQuant = parseInt($('#totalQ').text());
                 var tP = $('#price'+id).val().toString();
                 var price =parseInt(tP.replace(',',''));
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
                  priced=parseInt(priced,10);

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
                  totalP=parseInt(totalP,10);

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
                  alert('please input the quantity');
                  $('#'+id).attr('data-toggle','');
                  $('#'+id).attr('href','');
                }
                
              }
              else{

                if(quant > 0){
                 prv_id = id;
                 qCtr++;
                 var name = $('#product'+id).val();
                 var size =$('#size'+id).val();
                 $('#'+id).attr('data-toggle','modal');
                 $('#'+id).attr('href','#myModal1');
                 $('#quant'+id).val(0);
                  //push id to array
                  idArray.push(id);
                  alert('added to cart')

                  $('#thisIsCart').append('<input type="hidden" name="priceremoved[]" value=""><input type="hidden" name="quantremoved[]" value=""><input type="hidden" name="removed[]" value=""><input type="hidden" id="id'+id+'" name="cart[]" value="'+id+'"/><input type="hidden" name="quant[]" id="quants'+id+'" value="'+quant+'"/><input type="hidden" name="price[]" id="prices'+id+'" value="'+price+'"/><input type="hidden" id="ttp" name="totalPrice" value="'+tempPrice+'"/> <input type="hidden" name="totalQuant" id="ttq" value="'+totalQuant+'" />');
                  $('#cartTbl').append(
                    '<tr><td width="550"><h5 class="font-500">'+name+'</h5></td><td>'+size+'</td><td width="70" id="qt'+id+'">'+quant+'</td><td id="pr'+id+'" style="text-align: center; width="150" align="center" class="font-500">'+price+'</td><td><button type="button" class="btn btn-success" onclick="addRow(this)" value="'+id+'">Add</button></td><td><button type="button" class="btn btn-danger" onclick="deleteRow(this)" value="'+id+'">Remove</button></td></tr>');

                  $('#totalPrice').html(String(tempPrice));
                  $('#totalQ').html(String(totalQuant));
                }
                else if(quant == 0){
                  alert('please input the quantity');
                  $('#'+id).attr('data-toggle','');
                  $('#'+id).attr('href','');
                }
              }
            }
                  //CHECK OUT


                  function checkout(){

                    if(qCtr== 0){
                      alert("Cart is Empty.");
                    }
                    else if(qCtr > 0){
                      var result = confirm("Are you sure? \n\n\n *this action cannot be undone*");
                      if(result){
                        $('#check-out').attr('type','submit');
                        $('#myForm').attr('action','accessorder.php');
                        $('#myForm').attr('action','accesscheckout.php');
                      }
                      else{

                      }
                    }
                  }


</script>