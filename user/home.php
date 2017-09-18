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
      
      $(document).ready(function(){
  $('#addToCart').on('click', function(){
    alert('added to cart');
  $('#tblCart').append('<tr><td class="text-center"><a href="product.php"><img class="img-thumbnail" title="Product" alt="Product" src="image/product/sony_vaio_1-50x75.jpg"></a></td><td class="text-left"><a href="product.php">Product</a></td><td class="text-right">x 1</td><td class="text-right">&#8369 902.00</td><td class="text-center"><button class="btn btn-danger btn-xs remove" title="Remove" onClick="" type="button"><i class="fa fa-times"></i></button></td></tr>');
});
}); 


  </script>
</body>
</html>