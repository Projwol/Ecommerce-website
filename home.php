<?php

@include 'config.php';


if(isset($_POST['add_to_wishlist'])){

   $product_id = $_POST['product_id'];
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   
   $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_wishlist_numbers) > 0){
       $message[] = 'already added to wishlist';
   }elseif(mysqli_num_rows($check_cart_numbers) > 0){
       $message[] = 'already added to cart';
   }else{
       mysqli_query($conn, "INSERT INTO `wishlist`(user_id, pid, name, price, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_image')") or die('query failed');
       $message[] = 'product added to wishlist';
   }

}

if(isset($_POST['add_to_cart'])){

   $product_id = $_POST['product_id'];
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
       $message[] = 'already added to cart';
   }else{

       $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

       if(mysqli_num_rows($check_wishlist_numbers) > 0){
           mysqli_query($conn, "DELETE FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
       }

       mysqli_query($conn, "INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
       $message[] = 'product added to cart';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>

   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="style.css">

</head>
<body>
   
<?php @include 'header.php'; ?>

    <section id="home">
         <h3>Communicate your tomorrow</h3>
         <h1>A better way of being smarter</h1>
         <p><b>Get the phone according to your need <br>
             Get smarter from here.</b>
         </p>
         <button>Shop Now</button>
    </section>

    <section id="new">
        <h2>New Arrival</h2>
        <p>Lets upgrade your phone</p>
        <div class="pro-container">
            <div class="pro" onclick="window.location.href='sproduct.html'">
                <img src="image/samsung/samsung flip.jpg">
                <div class="Des">
                    <h5>SAMSUNG  galaxy Z flip 3</h5>
                    <h4>Rs.124,999</h4>  
                    <a href="#"><i class="fal fa-shopping-cart cart"></i></a> 
                </div>
            </div>
            <div class="pro">
                <img src="image/New arrival/newarrival1.jpg">
                <div class="Des">
                    <h5>Honor 20 lite</h5>
                    <h4>Rs.15,790</h4>  
                    <a href="#"><i class="fal fa-shopping-cart cart"></i></a> 
                </div>
            </div>
            <div class="pro">
                <img src="image/iphone xr blue.jpg">
                <div class="Des">
                    <h5>iphone xr</h5>
                    <h4>Rs.80,000</h4>  
                    <a href="#"><i class="fal fa-shopping-cart cart"></i></a> 
                </div>
            </div>
            <div class="pro">
                <img src="image/Moto G black.jpg">
                <div class="Des">
                    <h5>Moto G</h5>
                    <h4>Rs.25,790</h4>  
                    <a href="#"><i class="fal fa-shopping-cart cart"></i></a> 
                </div>
            </div>
        </div>
    </section>




<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>