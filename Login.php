<link rel="stylesheet" href="main.css">



<?php
include_once 'sessionCheck.php';
include_once 'credentials.php';
include_once 'displayuser.php';

if (isset($_POST['Logout'])) {
    session_destroy();
    session_unset();

?>
    <a class="login1" href="Login.php">
        <p style="color:aliceblue; text-align:center"> Login</p>

    </a>
    <a class="login1" href="Home.html">
        <p style="color:aliceblue; text-align:center">Home</p>
    </a>
<?php
    // print '  <p style="color: white;  text-align: center">You are logged out ';
} elseif ($_SESSION['UserLog']) {
    print ' <p style="color: white;  text-align: center"> You are already logged in 👋';
    displayuser($connect); ?>
    <a class="login1" href="Home.html">
        <p style="color:aliceblue; text-align:center">Home</p>
    </a>
    <?php
} elseif (isset($_POST['username']) && isset($_POST['password'])) {


    $user = $connect->prepare('SELECT * FROM ppl WHERE username=?');
    $user->bind_param('s', $_POST['username']);
    $user->execute();
    $MyResult = $user->get_result();

    if ($MyResult->num_rows === 1) {
        print '  <p style="color: white;  text-align: center">Your Information </br>';
        $row = $MyResult->fetch_assoc(); 

       
        
        //  '<a class="backlogin" href="product.php" style="color: red;  text-align: center">Product Page</a>';

        if (password_verify($_POST['password'], $row['Password'])) {

            $_SESSION['UserLog'] = true;


            $_SESSION['UserId'] = $row['PERSON_ID'];
            // new
            $_SESSION['Basket'] = [];
            displayuser($connect);?>
             <a class="login1" href="product.php">
            <p style="color:aliceblue; text-align:center">Product</p>
        </a>
            <?php
        } else {
            print ' <p style="color: white;  text-align: center"> Mismatch password';
        }
    } else {
        print '<p style="color: #f39c12; text-align: center;font-size:30px">You are not in our database.Please sign up first</p>';


        ?>
        <div class="after-login">
            <a href="Signup.php">
                <p style="color:aliceblue;text-align:center;font-size:20px">Sign up page</p>
            </a>
            <a href="Login.php">
                <p style="color:aliceblue; text-align:center;font-size:20px"> Login page</p>
            </a>
        </div>

    <?php
    }
} else {
    ?>

    <form class="login" action="Login.php" method="post">
        <img src="avatar.png" alt="">
        <h1>Login</h1>
        <i class="fa fa-user" aria-hidden="true"></i>
        <input type="text" name="username" placeholder="Username" required>
        <i class="fa fa-lock" aria-hidden="true"></i>
        <input type="password" name="password" placeholder="Password" required>

        <!-- <p>Forgot your password <input type="checkbox"></p> -->

        <input type="submit" name="login" value="Login">
        <div class="fa fa-arrow-left" aria-hidden="true"></div>
        <a class="backlogin" href="Home.html">Back</a>



    </form>
<?php
}
?>