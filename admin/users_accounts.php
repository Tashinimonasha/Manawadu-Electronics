<?php

include '../components/connect.php';

session_start();


$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};


if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_users = $conn->prepare("DELETE FROM `users` WHERE id = ?");
   $delete_users->execute([$delete_id]);
   $delete_order = $conn->prepare("DELETE FROM `orders` WHERE user_id = ?");
   $delete_order->execute([$delete_id]);
   $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
   $delete_cart->execute([$delete_id]);
   header('location:users_accounts.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>users accounts</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/adminn_style.css">

</head>
<body style="background-color: #0C2D48;">

<?php include '../components/admin_header.php' ?>

<!-- user accounts section starts  -->

<section class="accounts">

<h1 class="heading" style="color: white;">User Accounts</h1>


   <div class="box-container">

   <?php
      $select_account = $conn->prepare("SELECT * FROM `users`");
      $select_account->execute();
      if($select_account->rowCount() > 0){
         while($fetch_accounts = $select_account->fetch(PDO::FETCH_ASSOC)){  
   ?>
  <div class="box" style="border: 2px solid #000; padding: 15px; border-radius: 10px; margin-bottom: 20px; background-color: #f4f4f4;">

<p style="margin-bottom: 10px; font-size: 16px;"> User ID: <span><?= $fetch_accounts['id']; ?></span> </p>
<p style="margin-bottom: 10px; font-size: 16px;"> Username: <span><?= $fetch_accounts['name']; ?></span> </p>

<div style="display: flex; gap: 10px;">
    <a href="users_accounts.php?delete=<?= $fetch_accounts['id']; ?>" class="delete-btn" onclick="return confirm('Delete this account?');" style="background-color: red; color: #fff; padding: 8px; border-radius: 5px; text-decoration: none;">Delete</a>
</div>
</div>

   <?php
      }
   }else{
      echo '<p class="empty">no accounts available</p>';
   }
   ?>

   </div>

</section>

<!-- user accounts section ends -->







<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>