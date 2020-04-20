<?php
include_once 'sessionCheck.php';
include_once 'credentials.php';
function displayuser($connect)
{
    $user = $connect->prepare('SELECT * FROM ppl WHERE PERSON_ID=?');
    $user->bind_param('i', $_SESSION['UserId']);
    $user->execute();
    $MyResult = $user->get_result();
    $row = $MyResult->fetch_assoc();

    print ' First Name: ' . $row['First_Name'] . '</br>';
    print ' Last Name: ' . $row['Second_Name'] . '</br>';
    print ' Age: ' . $row['Age'] . '</br>';
    print ' User Name: ' . $row['UserName'] . '</br>';
    $country = $connect->prepare('SELECT * FROM COUNTRIES WHERE COUNTRY_ID=?');
    $country->bind_param('i', $row['Nationality']);
    $country->execute();
    $resultOfCountry = $country->get_result();
    $nationality = $resultOfCountry->fetch_assoc();
    print ' You are from: ' . $nationality["COUNTRY_NAME"];
?>
    <form action="Login.php" method="post">

        <input type="submit" name="Logout" value="Logout">
    </form>
    <?php

}
if (isset($_POST['Logout'])) {
    session_destroy();
    session_unset();
    print ' You are loggout';
} elseif ($_SESSION['UserLog']) {
    print ' You are already logged in';
    displayuser($connect);
} elseif (isset($_POST['username']) && isset($_POST['password'])) {


    $user = $connect->prepare('SELECT * FROM ppl WHERE username=?');
    $user->bind_param('s', $_POST['username']);
    $user->execute();
    $MyResult = $user->get_result();

    if ($MyResult->num_rows === 1) {
        print ' Checking password </br>';
        $row = $MyResult->fetch_assoc();

        if (password_verify($_POST['password'], $row['Password'])) {

            $_SESSION['UserLog'] = true;


            $_SESSION['UserId'] = $row['PERSON_ID'];
            displayuser($connect);
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
        Password: <input type="password" name="password" required>
        Login: <input type="submit" name="login" value="Login">
    </form>
<?php
}
?>