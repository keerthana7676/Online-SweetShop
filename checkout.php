<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['order_btn'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $number = $_POST['number'];
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $method = mysqli_real_escape_string($conn, $_POST['method']);
   $address = mysqli_real_escape_string($conn, 'flat no. '. $_POST['flat'].', '. $_POST['street'].', '. $_POST['city'].', '. $_POST['country'].' - '. $_POST['pincode']);
   $placed_on = date('d-M-Y');

   $cart_total = 0;
   $cart_products[] = '';

   $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
   if(mysqli_num_rows($cart_query) > 0){
      while($cart_item = mysqli_fetch_assoc($cart_query)){
         $cart_products[] = $cart_item['name'].' ('.$cart_item['quantity'].') ';
         $sub_total = ($cart_item['price'] * $cart_item['quantity']);
         $cart_total += $sub_total;
      }
   }

   $total_products = implode(', ',$cart_products);

   $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE name = '$name' AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total'") or die('query failed');

   if($cart_total == 0){
      $message[] = 'your cart is empty';
   }else{
      if(mysqli_num_rows($order_query) > 0){
         $message[] = 'Order already placed!'; 
      }else{
         mysqli_query($conn, "INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$cart_total', '$placed_on')") or die('query failed');
         $message[] = 'Order placed successfully!';
         mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
      }
   }
   
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>checkout</h3>
   <p> <a href="home.php">Home</a> / Checkout </p>
</div>

<section class="display-order">

   <?php  
      $grand_total = 0;
      $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select_cart) > 0){
         while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total += $total_price;
   ?>
   <p> <?php echo $fetch_cart['name']; ?> <span>(<?php echo '₹'.$fetch_cart['price'].'/-'.' x '. $fetch_cart['quantity']; ?>)</span> </p>
   <?php
      }
   }else{
      echo '<p class="empty">Your cart is empty</p>';
   }
   ?>
   <div class="grand-total"> Grand Total : <span>₹<?php echo $grand_total; ?>/-</span> </div>

</section>

<section class="checkout">
   
   <form action="" method="POST">
      <h3>Place your order</h3>
      <div class="flex">
         <div class="inputBox">
            <span>Your Name :</span>
            <input type="text" name="name" required placeholder="Enter your name" pattern="^[A-Za-z\s]+$">
         </div>
         <div class="inputBox">
            <span>Contact Number :</span>
            <input type="tel" name="number" pattern="[0-9]{10}" required placeholder="Enter your number">
         </div>
         <div class="inputBox">
            <span>Email :</span>
            <input type="email" name="email" required placeholder="Enter your email">
         </div>
         <div class="inputBox">
            <span>Payment Method :</span>
            <select name="method">
               <option value="cash on delivery">Cash on Delivery</option>
               <option value="credit card">Credit Card</option>
               <option value="paypal">Paypal</option>
               <option value="paytm">Paytm</option>
            </select>
         </div>
         <div class="inputBox">
            <span>Address Line 01 :</span>
            <input type="number" min="0" name="flat" required placeholder="e.g. flat no.">
         </div>
         <div class="inputBox">
            <span>Address Line 02 :</span>
            <input type="text" name="street" required placeholder="e.g. street name">
         </div>
         <div class="inputBox">
            <span>City :</span>
         <select name="city">
               <option value="Bangaluru">Bengaluru</option>
               <option value="Mumbai">Mumbai</option>
               <option value="Delhi">Delhi</option>
               <option value="Patna">Patna</option>
               <option value="Gorakhpur">Gorakhpur</option>
               <option value="Panipath">Panipath</option>
               <option value="Chennai">Chennai</option>
               <option value="Bhagalpur">Bhagalpur</option>
               <option value="Lucknow">Lucknow</option>
               <option value="Pragraj">Pragraj</option>
               <option value="Pune">Pune</option>
               <option value="Gurugram">Gurugram</option>
               <option value="Raxual">Raxual</option>
               <option value="Kolkata">Kolkata</option>
            </select>
         </div>
         <div class="inputBox">
            <span>State :</span>
            <select name="state">
               <option value="Karnataka">Karnataka</option>
               <option value="Maharastra">Maharastra</option>
               <option value="Delhi">Delhi</option>
               <option value="Bihar">Bihar</option>
               <option value="Uttar pardesh">Uttar pardesh</option>
               <option value="Haryana">Haryana</option>
               <option value="Tamilnadu">Tamil Nadu</option>
               <option value="West Bengal">West Bengal</option>
            </select>
         </div>
         <div class="inputBox">
            <span>Country :</span>
            <select name="country">
               <option value="India">India</option>
            </select>
         </div>
         <div class="inputBox">
            <span>Pincode :</span>
            <span><input type="tel" name="pincode" pattern="[0-9]{6}" required placeholder="e.g. 123456"></span>
         </div>
         
      </div>
      
      <input type="submit" value="order now" class="btn" name="order_btn">
   </form>

</section>









<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>