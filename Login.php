<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>
<p>Welcome to login page</p>
    <form action="Login.php" method="post">
    Username: <input type="text" name="username" required>
    Password: <input type="text" name="password" required>
    Login: <input type="submit" name="login" value="Login">
    </form>

</body>
</html>
<?php
if(isset($_POST['username'])&& isset($_POST['password']))   {
    include_once('credentials.php');
    $connect = mysqli_connect($servername,$username,$password,$database);

    if($connect!==$connect){
        die(' Unsuccessful connection' . mysqli_connect_errno());
    }


}
?>