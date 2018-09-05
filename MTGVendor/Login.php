


<?php

include("db_config.php");

if(isset($_POST['login']))
{
    $user_email=$_POST['user_name'];
    $user_pass=$_POST['password'];

    $check_user="select * from admin WHERE user_email='$user_email'AND user_pass='$user_pass'";

    $run=mysqli_query($conn,$check_user);

    if(mysqli_num_rows($run))
    {
        echo "<script>window.open('admin.php','_self')</script>";

        $_SESSION['user_name']=$user_email;//here session is used and value of $user_email store in $_SESSION.

    }
    else
    {
        echo "<script>alert('Email or password is incorrect!')</script>";
    }
}
?>











<html>
<head>
    <title>Administrator Login</title>
    <link rel="stylesheet" href="Login.css" />
    <link rel="shortcut icon" href="favicon.ico" />
</head>
<body>
<div>
    <div style="display:block;margin:0px auto;">
        <?php if(empty($_SESSION["user_id"])) { ?>
            <form action="admin.php" method="post" id="frmLogin">
                <div class="error-message"><?php if(isset($message)) { echo $message; } ?></div>
                <div class="field-group">
                    <div><label for="login">Username</label></div>
                    <div><input name="user_name" type="text" class="input-field" ></div>
                </div>
                <div class="field-group">
                    <div><label for="password">Password</label></div>
                    <div><input name="password" type="password" class="input-field" > </div>
                </div>
                <div class="field-group">
                    <div><input type="submit" name="login" value="Login" class="form-submit-button"></span></div>
                </div>
            </form>

    </div>
</div>
<?php } ?>
</body></html>