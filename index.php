<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/add_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Home</title>
   <link rel="icon" type="image/x-icon" href="https://example.com/path/to/your/new-icon.png" />

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/stylee.css">

</head>
<body>

<?php include 'components/user_header.php'; ?>



<section class="hero">

  <div class="swiper hero-slider">

      <div class="swiper-wrapper">

         <div class="swiper-slide slide">
            <div class="content">
               <span>Order Online</span>
               <h3 style="font-size: 40px;">Home & Kitchen Appliances </h3>
               <a href="shop.php" class="btn">View</a>
            </div>
            <div class="image">
               <img src="images/HomeandKitchen.jpg" alt="">
            </div>
         </div>

         <div class="swiper-slide slide">
            <div class="content">
               <span>Order Online</span>
               <h3 style="font-size:40px;">Tv & Home Audio Video Appliances</h3>
               <a href="shop.php" class="btn">View</a>
            </div>
            <div class="image">
               <img src="images/tv.jpg" alt="">
            </div>
         </div>

         <div class="swiper-slide slide">
            <div class="content">
               <span>Order Online</span>
               <h3 style="font-size:40px">Fitness equipments</h3>
               <a href="shop.php" class="btn">View</a>
            </div>
            <div class="image">
               <img src="images/gym.jpg" alt="">
            </div>
         </div>

      <div class="swiper-pagination"></div>

   </div>

</section>

<section class="category" style="padding: 20px; text-align: center;">

    <h1 style="color: #333; text-align: center; font-size: 40px; margin-bottom: 20px;">CATEGORY</h1>


   <div class="box-container" style="display: flex; justify-content: space-around;">

    <a href="category.php?category=Home and Kitchen" class="box" style="text-decoration: none; color: #333; border: 1px solid #ddd; padding: 20px; width: 450px; box-sizing: border-box; border-width: 2px; border-color:black;  border-width: 3px;">
   <img src="images/13.jpg" alt="" style="width: 100%; height: 200px; object-fit: cover; border-radius: 5px;">
   <h3 style="margin-top: 10px;">Home & Kitchen Appliances</h3>
</a>

<a href="category.php?category=Tv and Home Audio/Video" class="box" style="text-decoration: none; color: #333; border: 1px solid #ddd; padding: 20px; width: 450px; box-sizing: border-box; border-width: 2px; border-color: black; border-width: 3px;">
   <img src="images/14.jpg" alt="" style="width: 100%; height: 200px; object-fit: cover; border-radius: 5px;">
   <h3 style="margin-top: 10px;">Tv & Home Audio Video Appliances</h3>
</a>

<a href="category.php?category=Fitness Equipment" class="box" style="text-decoration: none; color: #333; border: 1px solid #ddd; padding: 20px; width: 450px; box-sizing: border-box; border-width: 2px; border-color: black;  border-width: 3px;">
   <img src="images/5.jpg" alt="" style="width: 100%; height: 200px; object-fit: cover; border-radius: 5px;">
   <h3 style="margin-top: 10px;">Fitness equipments</h3>
</a>


   </div>

</section>

<section class="products">

    <h1 style="color: #333; text-align: center; font-size: 40px; margin-bottom: 20px;">LATEST PRODUCTS</h1>

   <div class="box-container" style="display: flex; justify-content: space-around; flex-wrap: wrap;">

      <?php
      $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6");
      $select_products->execute();
      if ($select_products->rowCount() > 0) {
         while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
      ?>
            <form action="" method="post" class="box" style="border: 1px solid #ddd; padding: 10px; text-align: center; margin: 10px; width: 300px; border-radius: 5px; border-color: black; border-width: 2px;">

               <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
               <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
               <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
               <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">

               <a href="quick_view.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye" style="text-decoration: none; color: #333; margin-right: 5px;"></a>
               <button type="submit" class="fas fa-shopping-cart" name="add_to_cart" style="border: none; background: none; cursor: pointer; color: #333;"></button>
               <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="" style="width: 100%; height: 150px; object-fit: cover; margin-top: 10px; border-radius: 5px;">
               <a href="category.php?category=<?= $fetch_products['category']; ?>" class="cat" style="text-decoration: none; color: #3498db; display: block; margin-top: 5px;"><?= $fetch_products['category']; ?></a>
               <div class="name" style=" margin-top: 5px;"><?= $fetch_products['name']; ?></div>
               <div class="flex" style="display: flex; justify-content: space-between; margin-top: 5px;">
                  <div class="price" style="color: #0C2D48; font-weight: bold;"><?= $fetch_products['price']; ?></div>
                  <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2" style="width: 50px; text-align: center; padding: 5px; box-sizing: border-box;">
               </div>
            </form>
      <?php
         }
      } else {
         echo '<p class="empty" style="text-align: center; color: #777; margin-top: 20px;">No products added yet!</p>';
      }
      ?>

   </div>

   <div class="more-btn" style="text-align: center; margin-top: 20px;">
      <a href="shop.php" class="btn" style="padding: 10px 20px; background-color: #3498db; color: #fff; text-decoration: none; border-radius: 15px;">View All</a>
   </div>
</section>

<?php include 'components/footer.php'; ?>


<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".hero-slider", {
   loop:true,
   grabCursor: true,
   effect: "flip",
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
});

</script>

</body>
</html>