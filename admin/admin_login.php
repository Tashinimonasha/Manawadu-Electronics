<?php

include '../components/connect.php';

session_start();

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_admin = $conn->prepare("SELECT * FROM `admin` WHERE name = ? AND password = ?");
   $select_admin->execute([$name, $pass]);
   
   if($select_admin->rowCount() > 0){
      $fetch_admin_id = $select_admin->fetch(PDO::FETCH_ASSOC);
      $_SESSION['admin_id'] = $fetch_admin_id['id'];
      header('location:dashboard.php');
   }else{
      $message[] = 'incorrect username or password!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/adminn_style.css">

</head>
<body>

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

<!-- admin login form section starts  -->

<section class="form-container">

<form action="" method="POST" style="text-align: center;margin: 0 auto; padding: 20px; background-color: #f4f4f4; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">

<h3 style="font-size: 24px; color: #333; margin-bottom: 20px;">Login</h3>
   
<input type="text" name="name" maxlength="20" required placeholder="Enter UserName" class="box" style="width: 100%; padding: 10px; box-sizing: border-box; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 5px;" oninput="this.value = this.value.replace(/\s/g, '')">

<input type="password" name="pass" maxlength="20" required placeholder="Enter Password" class="box" style="width: 100%; padding: 10px; box-sizing: border-box; margin-bottom: 20px; border: 1px solid #ccc; border-radius: 5px;" oninput="this.value = this.value.replace(/\s/g, '')">

<input type="submit" value="Login" name="submit" class="btn" style="background-color: #3498db; color: #fff; padding: 10px; border: none; border-radius: 5px; cursor: pointer;">

</form>


</section>

<!-- admin login form section ends -->











</body>
</html>