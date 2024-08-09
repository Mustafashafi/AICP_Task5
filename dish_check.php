<?php
require_once('connection.php');

if(isset($_POST['add'])){
    // Sanitize and escape input data to prevent SQL injection
    $name = mysqli_real_escape_string($con, $_POST['dname']);
    $price = mysqli_real_escape_string($con, $_POST['price']);
    
    $pic = ''; // Initialize with default if no file uploaded
    if(isset($_FILES['pic']) && $_FILES['pic']['error'] === UPLOAD_ERR_OK) {
        $pic = basename($_FILES['pic']['name']); // Use basename to get the file name
        $targetDirectory = 'images/';
        $targetFile = $targetDirectory . $pic;

        // Ensure the target directory exists
        if (!file_exists($targetDirectory)) {
            mkdir($targetDirectory, 0777, true);
        }

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES['pic']['tmp_name'], $targetFile)) {
            // File upload successful
            $pic = mysqli_real_escape_string($con, $pic);
        } else {
            // Handle the error if file move fails
            $_SESSION['message'] = '<div class="alert alert-danger alert-dismissible" style="position:fixed;top:50px;left:420px">
                File Upload Failed!
            </div>';
            header('location: admin.php');
            exit;
        }
    } else {
        // Handle the case where no file is uploaded
        $_SESSION['message'] = '<div class="alert alert-danger alert-dismissible" style="position:fixed;top:50px;left:420px">
            No file was uploaded or an error occurred.
        </div>';
        header('location: admin.php');
        exit;
    }
    
    $message = mysqli_real_escape_string($con, $_POST['message']);
    
    // Insert into database with column names specified
    $query = "INSERT INTO `dishes`(`Dish_name`, `Dish_price`, `Dish_pic`, `Dish_detail`) VALUES ('$name', '$price', '$pic', '$message')";
        
    if(mysqli_query($con, $query)){
        // Redirect on success
        header('location: Add_dish.php');
        exit;
    } else {
        // Redirect with error message on failure
        $_SESSION['message'] = '<div class="alert alert-danger alert-dismissible" style="position:fixed;top:50px;left:420px">
            Task Record Uploading Failed!
        </div>';
        header('location: admin.php');
        exit;
    }
}
?>
