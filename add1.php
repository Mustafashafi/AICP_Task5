<?php
require_once('connection.php');

if(isset($_POST['add'])){
    $id = $_POST['cid'];
    $name = $_POST['cname'];
   

  
    $check_query = "SELECT * FROM `restaurent`";
    $result = mysqli_query($con, $check_query);
    $query = "INSERT INTO `customer`VALUES('$name', '$id')";
        
        if(mysqli_query($con, $query)){
            header('location:index1.php');
        } else {
            $_SESSION['message'] = '<div class="alert alert-danger alert-dismissible" style="position:fixed;top:50px;left:420px">
                Task Record Uploading Failed!
            </div>';
            header('location:customer-signup.php');
        }
    }

?>
