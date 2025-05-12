<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>About Us</h3>
   <p> <a href="home.php">Home</a> / About </p>
</div>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="./new_img/kjj.jpg">
      </div>

      <div class="content">
         <h3>Why choose us?</h3>
         <p>Choose our online sweet shop for a delightful and convenient sweet shopping experience. We offer a wide selection of delicious treats that can be conveniently browsed and purchased from the comfort of your own home. </p>
         <p> Our commitment to freshness ensures that you receive high-quality sweets delivered right to your doorstep. With nationwide or global delivery options, you can enjoy our delectable offerings no matter where you are.</p>
         <p>Benefit from special offers and discounts, and explore customer reviews to make informed choices. Our user-friendly interface and excellent customer support guarantee a seamless and satisfying online shopping journey. Indulge in the sweetness of our online store and let us bring joy to your taste buds.</p>
         <a href="contact.php" class="btn">contact us</a>
      </div>

   </div>

</section>

<section class="reviews">

   <h1 class="title">client's reviews</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/pic-1.png" alt="">
         <p>SweetS is my go-to for all things sweet! Their delectable treats, user-friendly website, and exceptional service keep me coming back for more. Highly recommended for a delightful online shopping experience!</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Joydeep Roy</h3>
      </div>

      <div class="box">
         <img src="images/pic-2.png" alt="">
         <p>I'm hooked on SweetS! Their sweets are pure perfection, the ordering process is a breeze, and their attention to detail is outstanding. A must-try for any sweet tooth craving an exceptional online shopping experience!</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Emma Watson</h3>
      </div>

      <div class="box">
         <img src="images/pic-3.png" alt="">
         <p>I highly recommend SweetS! <br> Their sweets are absolutely delicious, the ordering process is seamless, and the customer service is top-notch. A fantastic online sweet shop experience!</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Ujjwal Karn</h3>
      </div>

   </div>

</section>



<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>