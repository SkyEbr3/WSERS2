<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>

<body>
    <p>Welcome to login page</p>


</body>

</html>
<?php
if (isset($_POST['username']) && isset($_POST['password'])) {
    include_once('credentials.php');
    $connect = mysqli_connect($servername, $username, $password, $database);

    if (!$connect ) {
        die(' Unsuccessful connection' . mysqli_connect_errno());
    }
    $user = $connect->prepare('SELECT * FROM ppl WHERE username=?');
    $user->bind_param('s', $_POST['username']);
    $user->execute();
    $MyResult = $user->get_result();

    if ($MyResult->num_rows === 1) {
        print ' Checking password </br>';
        $row = $MyResult->fetch_assoc();

        if (password_verify($_POST['password'], $row['Password'])) {
            print ' Successfully Registered';
        } else {
            ' Mismatch password';
        }
    } else {
        print ' You are not in our database. Please register first';
?>
        <a href="Singup.php">Singup page</a>
        <a href="Login.php">Login page</a>
    <?php
    }
} else {
    ?>
    <form action="Login.php" method="post">
        Username: <input type="text" name="username" required>
        Password: <input type="text" name="password" required>
        Login: <input type="submit" name="login" value="Login">
    </form>
<?php
}
?>