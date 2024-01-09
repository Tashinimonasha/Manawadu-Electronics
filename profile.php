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
   <title>profile</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/stylee.css">

</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<section class="user-details" style="text-align: center; background-color: #f9f9f9; padding: 20px; border-radius: 10px; margin: 20px auto; width: 80%;">

   <div class="user" style="display: inline-block; text-align: left;">

      <?php
         // You can include additional PHP logic here
      ?>

      <img src="images/user-icon.png" alt="User Icon" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; margin-bottom: 20px;">
      <h3 style="color: #333; font-size: 24px; margin-bottom: 10px;"><?= $fetch_profile['name']; ?></h3>
      <p><i class="fas fa-phone" style="color: #3498db;"></i> <span><?= $fetch_profile['number']; ?></span></p>
      <p><i class="fas fa-envelope" style="color: #3498db;"></i> <span><?= $fetch_profile['email']; ?></span></p>
     <center> <a href="update_profile.php" class="btn" style="background-color: #3498db; color: #fff; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Update Info</a></center>

   </div>

</section>











<?php include 'components/footer.php'; ?>







<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>