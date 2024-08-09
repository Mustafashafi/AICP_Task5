<?php
require_once('connection.php');

if(isset($_POST['add'])){
    $name = $_POST['name'];
    $number = $_POST['number'];
   

  
    $check_query = "SELECT * FROM `restaurent`";
    $result = mysqli_query($con, $check_query);
    $query = "INSERT INTO `restaurent`VALUES('$name', '$number')";
        
        if(mysqli_query($con, $query)){
            header('location:index.php');
        } else {
            $_SESSION['message'] = '<div class="alert alert-danger alert-dismissible" style="position:fixed;top:50px;left:420px">
                Task Record Uploading Failed!
            </div>';
            header('location:restaurent-signup.php');
        }
    }

?>
