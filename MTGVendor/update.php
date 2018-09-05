<?php
require 'Login.php';
if(isset($_POST['submit'])) {

    $name = $_POST["name"];
    $image=$_POST["image"];
    $price= $_POST['price'];



// Escape user inputs for security
//     $first_name = mysqli_real_escape_string($link, $_REQUEST['first_name']);
//
//    $last_name = mysqli_real_escape_string($link, $_REQUEST['last_name']);
//
//    $email = mysqli_real_escape_string($link, $_REQUEST['email']);


    $link = mysqli_connect("localhost", "root", "", "admin");

// attempt insert query execution

    $sql = "INSERT INTO `products` (`name`,`image`, `price`) VALUES ('$name','$image','$price')";
    $result = mysqli_query($link, $sql);
    mysqli_close($link);



}







?>