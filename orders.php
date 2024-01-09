<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:index.php');
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>orders</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/stylee.css">

</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<div class="heading" style="background-color:#0C2D48;">
   <h3>orders</h3>
   <p><a href="index.php">Home</a> <span> / Orders</span></p>
</div>

<section class="orders" style="margin: 20px auto; text-align: center; background-color: #f9f9f9; padding: 20px; width: 80%;">

   <h1 class="title" style="color: #333; font-size: 24px; margin-bottom: 20px;">Your Orders</h1>

   <div class="box-container" style="display: flex; flex-wrap: wrap; gap: 20px; justify-content: center;">

   <?php
      if($user_id == ''){
         echo '<p class="empty" style="color: red; font-size: 18px;">Please login to see your orders</p>';
      } else {
         $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
         $select_orders->execute([$user_id]);
         if($select_orders->rowCount() > 0) {
            while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)) {
   ?>
   <div class="box" style="border: 1px solid #ddd; border-radius: 10px; padding: 20px; background-color: white; text-align: left; width: 400px; margin: 10px;">

     <center> <h3 style="color: #333; font-size: 20px; margin-bottom: 10px;">Order Details</h3></center>

      <p><strong>Placed On:</strong> <span><?= $fetch_orders['placed_on']; ?></span></p>
      <p><strong>Name:</strong> <span><?= $fetch_orders['name']; ?></span></p>
      <p><strong>Email:</strong> <span><?= $fetch_orders['email']; ?></span></p>
      <p><strong>Number:</strong> <span><?= $fetch_orders['number']; ?></span></p>
      <p><strong>Payment Method:</strong> <span><?= $fetch_orders['method']; ?></span></p>
      <p><strong>Your Orders:</strong> <span><?= $fetch_orders['total_products']; ?></span></p>
      <p><strong>Total Price:</strong> <span><?= $fetch_orders['total_price']; ?>/-</span></p>
      <p><strong>Order Status:</strong> <span style="color:<?php if($fetch_orders['order_status'] == 'pending'){ echo 'red'; } else { echo 'green'; }; ?>"><?= $fetch_orders['order_status']; ?></span></p>
   </div>
   <?php
      }
      } else {
         echo '<p class="empty" style="color: red; font-size: 18px;">No orders placed yet!</p>';
      }
      }
   ?>

   </div>

</section>












<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->






<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>