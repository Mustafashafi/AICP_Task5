<?php
require_once("connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['approve'])) {
    // Make sure the restaurent_name key exists in the POST request
    if (isset($_POST['customer_name'])) {
        $restaurent_name = $_POST['customer_name'];

        // Prepare the SQL delete query
        $delete_query = "DELETE FROM customer WHERE customer_name = ?";
        
        if ($stmt = mysqli_prepare($con, $delete_query)) {
            mysqli_stmt_bind_param($stmt, "s", $restaurent_name);
            mysqli_stmt_execute($stmt);

            if (mysqli_stmt_affected_rows($stmt) > 0) {
                echo "Record deleted successfully.";
            } else {
                echo "Error: Could not delete the record.";
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "Error: Could not prepare the statement.";
        }
    } else {
        echo "Error: Restaurent name not provided.";
    }

    mysqli_close($con);

    // Redirect back to the main page
    header("Location: customer.php");
    exit();
}
?>
