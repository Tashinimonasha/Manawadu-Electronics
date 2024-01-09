<?php

include '../components/connect.php';

session_start();


$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>dashboard</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/adminn_style.css">

</head>
<body style="background-color: #0C2D48;">

<?php include '../components/admin_header.php' ?>

<!-- admin dashboard section starts  -->

<section class="dashboard" style="padding: 20px;">

   <h1 class="heading" style="text-align: center; color: whitesmoke;">DASHBOARD</h1>

   <div class="box-container" style="display: flex; justify-content: space-around; flex-wrap: wrap;">

      <div class="box" style="text-align: center; background-color: #f8d7da; padding: 20px; border-radius: 10px; margin: 10px; width: 200px; height: 250px;">
         <h3 style="font-size: 18px;">Welcome!</h3>
         <p style="font-size: 16px;"><?= $fetch_profile['name']; ?></p>
         <a href="update_profile.php" class="btn" style="text-decoration: none; color: #fff; background-color: #28a745; padding: 5px 10px; border-radius: 5px; font-size: 14px;">Update Profile</a>
      </div>

      <div class="box" style="text-align: center; background-color: #d4edda; padding: 20px; border-radius: 10px; margin: 10px; width: 200px; height: 250px;">
         <?php
         $select_orders = $conn->prepare("SELECT * FROM `orders`");
         $select_orders->execute();
         $numbers_of_orders = $select_orders->rowCount();
         ?>
         <h3 style="font-size: 18px;"><?= $numbers_of_orders; ?></h3>
         <p style="font-size: 16px;">Total Orders</p>
         <a href="placed_orders.php" class="btn" style="text-decoration: none; color: #fff; background-color: #007bff; padding: 5px 10px; border-radius: 5px; font-size: 14px;">See Orders</a>
      </div>

      <div class="box" style="text-align: center; background-color: #cce5ff; padding: 20px; border-radius: 10px; margin: 10px; width: 200px; height: 250px;">
         <?php
         $select_products = $conn->prepare("SELECT * FROM `products`");
         $select_products->execute();
         $numbers_of_products = $select_products->rowCount();
         ?>
         <h3 style="font-size: 18px;"><?= $numbers_of_products; ?></h3>
         <p style="font-size: 16px;">Products Added</p>
         <a href="products.php" class="btn" style="text-decoration: none; color: #fff; background-color: #007bff; padding: 5px 10px; border-radius: 5px; font-size: 14px;">See Products</a>
      </div>

      <div class="box" style="text-align: center; background-color: #d1ecf1; padding: 20px; border-radius: 10px; margin: 10px; width: 200px; height: 250px;">
         <?php
         $select_users = $conn->prepare("SELECT * FROM `users`");
         $select_users->execute();
         $numbers_of_users = $select_users->rowCount();
         ?>
         <h3 style="font-size: 18px;"><?= $numbers_of_users; ?></h3>
         <p style="font-size: 16px;">Users Accounts</p>
         <a href="users_accounts.php" class="btn" style="text-decoration: none; color: #fff; background-color: #007bff; padding: 5px 10px; border-radius: 5px; font-size: 14px;">See Users</a>
      </div>

      <div class="box" style="text-align: center; background-color: #f1f1f1; padding: 20px; border-radius: 10px; margin: 10px; width: 200px; height: 250px;">
         <?php
         $select_admins = $conn->prepare("SELECT * FROM `admin`");
         $select_admins->execute();
         $numbers_of_admins = $select_admins->rowCount();
         ?>
         <h3 style="font-size: 18px;"><?= $numbers_of_admins; ?></h3>
         <p style="font-size: 16px;">Admins</p>
         <a href="admin_accounts.php" class="btn" style="text-decoration: none; color: #fff; background-color: #007bff; padding: 5px 10px; border-radius: 5px; font-size: 14px;">See Admins</a>
      </div>

   </div>

</section>


<!-- admin dashboard section ends -->

<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>