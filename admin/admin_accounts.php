<?php

include '../components/connect.php';

session_start();


$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};


if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_admin = $conn->prepare("DELETE FROM `admin` WHERE id = ?");
   $delete_admin->execute([$delete_id]);
   header('location:admin_accounts.php');
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admins accounts</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/adminn_style.css">

</head>
<body style="background-color: #0C2D48;">

<?php include '../components/admin_header.php' ?>

<!-- admins accounts section starts  -->

<section class="accounts">
    <h1 class="heading" style="color: white;">Admin Accounts</h1>

    <div class="box-container">

        <div class="box" style="border: 2px solid #000; padding: 15px; border-radius: 10px; margin-bottom: 20px; background-color: #f4f4f4; text-align: center;">
            <p style="font-size: 18px; color: #333; margin-bottom: 10px;">Add New Admin</p>
            <a href="register_admin.php" class="option-btn" style="background-color: #3498db; color: #fff; padding: 8px; border-radius: 5px; text-decoration: none;">Add</a>
        </div>

        <?php
        $select_account = $conn->prepare("SELECT * FROM `admin`");
        $select_account->execute();
        if ($select_account->rowCount() > 0) {
            while ($fetch_accounts = $select_account->fetch(PDO::FETCH_ASSOC)) {
        ?>
                <div class="box" style="border: 2px solid #000; padding: 15px; border-radius: 10px; margin-bottom: 20px; background-color: #f4f4f4;">
                    <p style="margin-bottom: 10px;"> Admin ID: <span><?= $fetch_accounts['id']; ?></span> </p>
                    <p style="margin-bottom: 10px;"> UserName: <span><?= $fetch_accounts['name']; ?></span> </p>

                    <div class="flex-btn" style="display: flex; gap: 10px;">
                        <a href="admin_accounts.php?delete=<?= $fetch_accounts['id']; ?>" class="delete-btn" onclick="return confirm('Delete this account?');" style="background-color: red; color: #fff; padding: 8px; border-radius: 5px; text-decoration: none;">Delete</a>
                        <?php
                        if ($fetch_accounts['id'] == $admin_id) {
                            echo '<a href="update_profile.php" class="option-btn" style="background-color: #3498db; color: #fff; padding: 8px; border-radius: 5px; text-decoration: none;">Update</a>';
                        }
                        ?>
                    </div>
                </div>
        <?php
            }
        } else {
            echo '<p class="empty">No accounts available</p>';
        }
        ?>
    </div>
</section>

<!-- admins accounts section ends -->




















<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>