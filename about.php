<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/stylee.css">

</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<div style="background-color:#0C2D48;" class="heading">
   <h3>about us</h3>
   <p><a href="index.php">Home</a> <span> / about</span></p>
</div>

<!-- about section starts  -->

<section class="about">

   <div class="row">

      <div class="image">
      <img src="images/Me.gif" class="Box" alt="About GIF" style="width: 100%; max-width: 400px; border: 2px solid black; border-radius: 8px;">

      </div>

      <div class="content">
         <h3>why choose us?</h3>
         <p style="text-align: justify;">"Welcome to Manawadu Electronics, where your electronic dreams come to life! Whether you're on the lookout for state-of-the-art gadgets, premium home appliances, or the trendiest tech accessories, we've got the perfect solution for you. With a steadfast dedication to excellence and prompt delivery, we invite you to dive into a world of innovation that promises an unforgettable experience. Seize the opportunity now—explore our curated collection and let Manawadu Electronics redefine your electronic indulgences..."</p>

         <p> "Lets Buy High Quality Appliances"</p>
         <a href="shop.php" class="btn">our Products</a>
      </div>

   </div>

</section>

<!-- about section ends -->

<!-- steps section starts  -->



<!-- steps section ends -->






<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->=






<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".reviews-slider", {
   loop:true,
   grabCursor: true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
      slidesPerView: 1,
      },
      700: {
      slidesPerView: 2,
      },
      1024: {
      slidesPerView: 3,
      },
   },
});

</script>

</body>
</html>