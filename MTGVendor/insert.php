<?php


if(isset($_POST['submit'])) {

    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST['email'];
    $datebirth= $_POST['datebirth'];
    $country=$_POST['country'];
    $recommendation=$_POST['recommendation'];
    include "shop.php";
    $name=$product['name'];
    $quantity=$product['quantity'];
    $date=$date_clicked;


// Escape user inputs for security
    /* $first_name = mysqli_real_escape_string($link, $_REQUEST['first_name']);

    $last_name = mysqli_real_escape_string($link, $_REQUEST['last_name']);

    $email = mysqli_real_escape_string($link, $_REQUEST['email']); */


   include 'db_config.php';

// attempt insert query execution

    $sql = "INSERT INTO `users` (`first_name`, `last_name`, `email`, `datebirth`,`country`,`recommendation`,`total`,`name`,`quantity`,`date`) VALUES ('$first_name','$last_name', '$email','$datebirth','$country','$recommendation','$total','$name','$quantity','$date')";
    $result = mysqli_query($link, $sql);
    mysqli_close($link);



}

?>

