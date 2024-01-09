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
   <title>quick view</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/stylee.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="quick-view">

    <h1 style="color: #333; text-align: center; font-size: 40px; margin-bottom: 20px;">QUICK VIEW</h1>
   <?php
      $pid = $_GET['pid'];
      $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
      $select_products->execute([$pid]);
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
  <form action="" method="post" class="box" style="border: 2px solid #000; padding: 20px; text-align: center; margin: 0 auto; width: 500px; border-radius: 10px; box-sizing: border-box; background-color: #fff;">

<input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
<input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
<input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
<input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
<input type="hidden" name="details" value="<?= $fetch_products['details']; ?>">

<img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="" style="width: 100%; height: 150px; object-fit: cover; border-radius: 5px;">
<a href="category.php?category=<?= $fetch_products['category']; ?>" class="cat" style="text-decoration: none; color: #3498db; display: block; margin-top: 10px; font-size: 14px;"><?= $fetch_products['category']; ?></a>
<div class="name" style="margin-top: 10px; font-size: 18px;"><?= $fetch_products['name']; ?></div>
<div class="price" style="color: #27ae60; font-weight: bold; margin-top: 5px; font-size: 16px;"><?= $fetch_products['price']; ?></div>
<div class="details" style="margin-top: 5px; font-size: 14px;"><?= $fetch_products['details']; ?></div>
<div class="flex" style="display: flex; justify-content: space-between; margin-top: 20px;">
<button type="submit" name="add_to_cart" class="cart-btn" style="background-color: #3498db; color: #fff; padding: 10px; border: none; border-radius: 5px; cursor: pointer;">Add to Cart</button>
   <div style="display: flex; align-items: center;">
      <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2" style="width: 50px; text-align: center; padding: 5px; box-sizing: border-box; font-size: 16px;">
      <span style="margin-left: 10px; font-size: 16px;"></span>
   </div>
</div>

</form>
   <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
   ?>

</section>
















<?php include 'components/footer.php'; ?>


<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>


</body>
</html>