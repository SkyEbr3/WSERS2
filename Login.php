<?php
include_once 'sessionCheck.php';
include_once 'credentials.php';
include_once 'displayuser.php';

if (isset($_POST['Logout'])) {
    session_destroy();
    session_unset();
    print ' You are logged out ';
} elseif ($_SESSION['UserLog']) {
    print ' You are already logged in 👋';
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