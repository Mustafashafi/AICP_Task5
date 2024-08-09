<?php 
session_start();

$con = mysqli_connect("localhost","root","","task5");
if(mysqli_connect_error()){
    echo "connection failed";
}


?>