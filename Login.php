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

    if (!$connect) {
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
            print ' Successfully Registered</br>';
            print ' First Name: ' . $row['First_Name'] . '</br>';
            print ' Last Name: ' . $row['Second_Name'] . '</br>';
            print ' Age: ' . $row['Age'] . '</br>';
            print ' User Name: ' . $row['UserName'] . '</br>';
            $country = $connect->prepare('SELECT * FROM COUNTRIES WHERE COUNTRY_ID=?');
            $country->bind_param('i', $row['Nationality']);
            $country->execute();
            $resultOfCountry = $country->get_result();
            $nationality = $resultOfCountry->fetch_assoc();
            print ' You are from: '.$nationality["COUNTRY_NAME"];
        } else {
            print ' Mismatch password';
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