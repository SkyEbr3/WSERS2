<link rel="stylesheet" href="main.css">
<?php
include_once 'sessionCheck.php';

?>
<html>

<body>
    <?php
    include_once "credentials.php";
    include_once 'displayuser.php';
    if (isset($_POST['Logout'])) {
        session_destroy();
        session_unset(); ?>
        <a class="login1" href="Home.html">
            <p style="color:aliceblue; text-align:center">Home</p>
        </a>
    <?php

        print '  <p style="color: white;  text-align: center;font-size:20px;">Visit us again';
    } elseif ($_SESSION['UserLog']) {
        print ' <p style="color: white;  text-align: center;font-size:20px;">You are alerady logged in, you can not signup twice';
        displayuser($connect);
    ?>
        <a class="login1" href="product.php">
            <p style="color:aliceblue; text-align:center">Product</p>
        </a>
    <?php
    } else

    if (
        isset($_POST["FirstName"]) &&
        isset($_POST["LastName"]) &&
        isset($_POST["Username"]) &&
        isset($_POST["Password"])
    ) {
        print ' <p style="color: white;  text-align: center">You are registered <BR>';
        if (strlen($_POST['Password']) < 6) {
            print 'At least six characters, try again';
        } else {


            $isUserThere = $connect->prepare("SELECT * FROM ppl WHERE UserName=?");
            $isUserThere->bind_param("s", $_POST["Username"]);
            $isUserThere->execute();

            $result = $isUserThere->get_result();
            if ($result->num_rows > 0) {
                print ' <p style="color: white;  text-align: center">Your username is already taken ! <BR>';
            } else {
                $PasswordHashed = password_hash($_POST['Password'], PASSWORD_BCRYPT);
                $userType = 2;
                $stmt = $connect->prepare("INSERT INTO ppl(First_Name,Second_Name,Age,UserName,Password,Nationality,User_role) VALUES(?,?,?,?,?,?,?)");

                $stmt->bind_param(
                    "ssissii",
                    $_POST["FirstName"],
                    $_POST["LastName"],
                    $_POST["Age"],
                    $_POST["Username"],
                    $PasswordHashed,
                    $_POST["Country"],
                    $userType
                );
                $stmt->execute();
                print " You have been registered.  <BR>";

                $_SESSION['UserLog'] = true;
                $selectstatemnt = $connect->prepare('SELECT PERSON_ID  FROM ppl WHERE UserName=?');
                $selectstatemnt->bind_param('s', $_POST['Username']);
                $selectstatemnt->execute();
                $newUserId = $selectstatemnt->get_result();
                $rowUserId = $newUserId->fetch_assoc();
                $_SESSION['UserId'] = $rowUserId['PERSON_ID'];
                // print $rowUserId['PERSON_ID'];

                print ' Your details';
                displayuser($connect);
            }
        }
    } else {

    ?>

        <form class="sign" action="Signup.php" method="POST">
            <img src="avatar.png" alt="">
            <h1>Sign in</h1>
            <input type="text" name=" FirstName" placeholder="First Name" required><br>
            <input type="text" name="LastName" placeholder="Last Name" required><br>
            <input type="text" name="Age" placeholder="Age"><br>
            <input type="text" name="Username" placeholder="User Name" required><br>
            <input type="password" name="Password" placeholder="Password" required><br>


            <select name="Country">
                <?php
                $stmt = $connect->prepare("SELECT * FROM countries");
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row["COUNTRY_ID"] . '">' . $row["COUNTRY_NAME"] . '</option>';
                    }
                } else {
                    echo "0 results";
                }
                $connect->close();
                ?>
            </select>
            <br>
            <input type="submit" name="Register" value="Register"><br>

            <div class="back"><a href="Home.html"><i class="fa fa-arrow-left" aria-hidden="true"></i>Back</a></div>
        </form>
    <?php } ?>

</body>

</html>