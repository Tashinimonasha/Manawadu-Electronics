<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
};

if (isset($_POST['update_status'])) {
    $order_id = $_POST['order_id'];

    // Check if order_status is set in the POST data
    $order_status = isset($_POST['order_status']) ? $_POST['order_status'] : '';

    // Perform the update only if order_status is not empty
    if (!empty($order_status)) {
        $update_status = $conn->prepare("UPDATE `orders` SET order_status = ? WHERE id = ?");
        $update_status->execute([$order_status, $order_id]);
        $message[] = 'order status updated!';
    }
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_order = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
    $delete_order->execute([$delete_id]);
    header('location:placed_orders.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Placed Orders</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="../css/adminn_style.css">

</head>

<body style="background-color: #0C2D48;">

    <?php include '../components/admin_header.php' ?>

    <!-- placed orders section starts  -->

    <section class="placed-orders">

        <h1 class="heading" style="color: white;">Placed Orders</h1>

        <div class="box-container">

            <?php
            $select_orders = $conn->prepare("SELECT * FROM `orders`");
            $select_orders->execute();
            if ($select_orders->rowCount() > 0) {
                while ($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)) {
            ?>
                    <div class="box" style="border: 2px solid #000; padding: 15px; border-radius: 10px; margin-bottom: 20px; background-color: #f4f4f4;">

                        <p style="margin-bottom: 10px;"> User Id: <span><?= $fetch_orders['user_id']; ?></span> </p>
                        <p style="margin-bottom: 10px;"> Placed On: <span><?= $fetch_orders['placed_on']; ?></span> </p>
                        <p style="margin-bottom: 10px;"> Name: <span><?= $fetch_orders['name']; ?></span> </p>
                        <p style="margin-bottom: 10px;"> Email: <span><?= $fetch_orders['email']; ?></span> </p>
                        <p style="margin-bottom: 10px;"> Number: <span><?= $fetch_orders['number']; ?></span> </p>
                        <p style="margin-bottom: 10px;"> Total Products: <span><?= $fetch_orders['total_products']; ?></span> </p>
                        <p style="margin-bottom: 10px;"> Total Price: <span><?= $fetch_orders['total_price']; ?>/-</span> </p>
                        <p style="margin-bottom: 10px;"> Payment Method: <span><?= $fetch_orders['method']; ?></span> </p>

                        <form action="" method="POST" style="margin-top: 10px;">
                            <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
                            <select name="order_status" class="drop-down" style="padding: 8px; border-radius: 5px; margin-right: 10px;">
                                <option value="" selected disabled><?= $fetch_orders['order_status']; ?></option>
                                <option value="pending">Pending</option>
                                <option value="completed">Completed</option>
                            </select>

                            <div class="flex-btn">
                                <input type="submit" value="Update" class="btn" name="update_status" style="background-color: #3498db; color: #fff; border: none; border-radius: 5px; cursor: pointer; padding: 8px;">
                                <a href="placed_orders.php?delete=<?= $fetch_orders['id']; ?>" class="delete-btn" onclick="return confirm('Delete this order?');" style="background-color: red; color: #fff; padding: 8px; border-radius: 5px; text-decoration: none; margin-left: 10px;">Delete</a>
                            </div>
                        </form>

                    </div>

            <?php
                }
            } else {
                echo '<p class="empty">No Orders Placed Yet!</p>';
            }
            ?>

        </div>

    </section>

    <!-- placed orders section ends -->

    <!-- custom js file link  -->
    <script src="../js/admin_script.js"></script>

</body>

</html>
