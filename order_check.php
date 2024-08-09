<?php
require_once('connection.php');

if(isset($_POST['add'])){
    $name = mysqli_real_escape_string($con, $_POST['dname']);
    $price = mysqli_real_escape_string($con, $_POST['price']);
    $time = mysqli_real_escape_string($con, $_POST['time']);

    // Check if the dish exists in the `dishes` table
    $check_query = "SELECT * FROM `dishes` WHERE `Dish_name` = '$name' AND `Dish_price` = '$price'";
    $result = mysqli_query($con, $check_query);

    if(mysqli_num_rows($result) > 0) {
        // If dish exists, insert into `orders` table
        $query = "INSERT INTO `orders`(`Dish_name`, `Dish_price`, `Order_time`) VALUES('$name', '$price', '$time')";
        
        if(mysqli_query($con, $query)){
            header('location:restaurent.php');
        } else {
            $_SESSION['message'] = '<div class="alert alert-danger alert-dismissible" style="position:fixed;top:50px;left:420px">
                Order Placement Failed!
            </div>';
            header('location:order.php');
        }
    } else {
        // If dish does not exist, redirect with an error message
        $_SESSION['message'] = '<div class="alert alert-danger alert-dismissible" style="position:fixed;top:50px;left:420px">
            Dish not available!
        </div>';
        header('location:order.php');
    }
}
?>
