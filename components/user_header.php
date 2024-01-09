<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header" style="background-color: #0C2D48;">

<section class="flex">
   <div style="background-color: white; padding-left: 20px; padding-right: 20px; margin-left: 320px; border: 2px solid White; border-radius: 5px; width: 600px">
      <marquee behavior="scroll" direction="left" scrollamount="5">
          <a href="index.php" class="logo" style="text-decoration: none; color: orange; font-weight: bold; text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;">MANAWADU ELECTRONICS</a>

      </marquee>
   </div>
</section>


</header>
<header class="header" style="background-color: black;">

   <section class="flex">
   
      <nav class="navbar" style="margin-left:350px;text-decoration:none;">
         <a href="index.php">Home</a>
         <a href="shop.php">Shop</a>
         <a href="orders.php">Orders</a>
         <a href="about.php">About</a>
         <a href="contact.php">Find Us</a>
      </nav>

      <div class="icons">
         <?php
            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $total_cart_items = $count_cart_items->rowCount();
         ?>
         <a href="search.php"><i class="fas fa-search"></i></a>
         <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?= $total_cart_items; ?>)</span></a>
         <div id="user-btn" class="fas fa-user"></div>
         <div id="menu-btn" class="fas fa-bars"></div>
      </div>

      <div class="profile" style="padding: 10px; border: 2px solid black; border-radius: 10px;">

<?php
$select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
$select_profile->execute([$user_id]);

if ($select_profile->rowCount() > 0) {
    $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
?>

    <p class="name" style="font-size: 18px; color: #333;">Hi <?= $fetch_profile['name']; ?></p>

    <div class="flex">
        <a href="profile.php" class="btn" style="background-color: black; color: white; border-radius: 5px;">Profile</a>
        <a href="components/user_logout.php" onclick="return confirm('Logout from this website?');" class="delete-btn" style="background-color: red; color: white; border-radius: 5px;">Logout</a>
    </div>

    <p class="account" style="margin-top: 10px; font-size: 14px; color: #666;">
        <a href="login.php">Login</a> or
        <a href="register.php">Register</a>
    </p>

<?php
} else {
?>

    <p class="name" style="font-size: 18px; color: #333;">Please login first!</p>
    <a href="login.php" class="btn" style="background-color: blue; color: white; border-radius: 5px;">Login</a>

<?php
}
?>

</div>


   </section>

</header>

