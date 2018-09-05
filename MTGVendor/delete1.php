<?php
include 'db_config.php';
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$query = mysqli_query($connect,"SELECT * FROM users");
$id=$_GET['id'];
$id = (int)$_GET['id'];

mysqli_query($connect,"DELETE FROM users WHERE id='".$id."'");
echo $id;
echo ". ";
echo "je izbrisan";

?>

<br/>
<a href="Login.php">Click here to go back </a>
