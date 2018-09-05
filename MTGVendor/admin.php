<!DOCTYPE html>
<html>
<head>

    <title>Administrator</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <link rel="stylesheet" href="cart.css" />
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <link rel="shortcut icon" href="favicon.ico" />
</head>
<body>

<?php
$connect = mysqli_connect('localhost', 'root', '', 'admin');
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
if(isset($_POST['login'])) {

    $user_name = mysqli_real_escape_string($connect,$_POST['user_name']);
    $password = mysqli_real_escape_string($connect,$_POST['password']);


if ($user_name == "admin" && $password == "administrator") {
?>
<?php
$result = mysqli_query($connect, "SELECT * FROM products");
echo "<table class='table table-striped table-bordered table-hover'>
<thead>
<h1 align='center'>Products</h1>
<tr>
<th>ID</th>     
<th>name</th>   
<th>price</th>   
<th>delete</th>     
</tr>
</thead>";
while ($row = mysqli_fetch_array($result)) {
    echo "<tbody data-link='row' class='rowlink'>";
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['price'] . "</td>";
    echo "<td><a href=\"delete.php?id=" . $row['id'] . "\">Delete</a></td>";
    echo "</tr>";
    echo "</tbody>";
}
echo "</table>";
?>
<?php
$con = mysqli_connect('localhost', 'root', '', 'admin');
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$res = mysqli_query($con, "SELECT * FROM users");
echo "<table class='table table-striped table-bordered table-hover'/>
<thead>
<h1 align='center'>Persons</h1>
<tr>
<th>id</th>  
<th>first_name</th>     
<th>last_name</th>   
<th>email</th>  
<th>datebirth</th> 
<th>country</th>
<th>recommendation</th> 
<th>total</th> 
<th>name</th> 
<th>quantity</th> 
<th>date</th> 
<th>delete</th>     
</tr>
</thead>";
while ($row = mysqli_fetch_array($res)) {
    echo "<tbody data-link='row' class='rowlink'>";
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['first_name'] . "</td>";
    echo "<td>" . $row['last_name'] . "</td>";
    echo "<td>" . $row['email'] . "</td>";
    echo "<td>" . $row['datebirth'] . "</td>";
    echo "<td>" . $row['country'] . "</td>";
    echo "<td>" . $row['recommendation'] . "</td>";
    echo "<td>" . $row['total'] . "</td>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['quantity'] . "</td>";
    echo "<td>" . $row['date'] . "</td>";
    echo "<td><a href=\"delete1.php?id=" . $row['id'] . "\">Delete</a></td>";
    echo "</tr>";
    echo "</tbody>";
}
echo "</table>";
?>
<form action='update.php' method='post'
      accept-charset='UTF-8' ">
<fieldset >
    <legend>Update database</legend>
    <input type='hidden' name='submitted' id='submitted' value='1' class="form-control"/>
    <label for='name' >Name: </label>
    <!--name--> <input type="text" name="name" id="Name" maxlength="50" class="form-control" placeholder="Enter the name of the product" required />
    <label for='image' >Image:</label>
    <input type="file" name="image" id="image">
    <label for='email' >Price:</label>
    <!--email--> <input type="text" name="price" id="price" maxlength="4" class="form-control" placeholder="Enter the price" required /> <br/>
</fieldset>
<!-- Show checkout button only if the shopping cart is not empty -->

<button type="submit" class="button" name="submit" >Update database</button>
<?php
} else {
    echo "You wont find any ~rare~ cards here!";
}
}?>

</body>
</html>