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
        session_unset();
        print ' You are logged out';
    } elseif ($_SESSION['UserLog']) {
        print ' You are alerady logged in, you can not signup twice';
        displayuser($connect);
    } else

    if (
        isset($_POST["FirstName"]) &&
        isset($_POST["LastName"]) &&
        isset($_POST["Username"]) &&
        isset($_POST["Password"])
    ) {
        print "You are about to register .... but not yet<BR>";
        $isUserThere = $connect->prepare("SELECT * FROM ppl WHERE UserName=?");
        $isUserThere->bind_param("s", $_POST["Username"]);
        $isUserThere->execute();

        $result = $isUserThere->get_result();
        if ($result->num_rows > 0) {
            print "Your username is already taken ! <BR>";
        } else {
            $PasswordHashed = password_hash($_POST['Password'], PASSWORD_BCRYPT);
            $stmt = $connect->prepare("INSERT INTO ppl(First_Name,Second_Name,Age,UserName,Password,Nationality) VALUES(?,?,?,?,?,?)");
            $stmt->bind_param("ssissi", $_POST["FirstName"], $_POST["LastName"], $_POST["Age"], $_POST["Username"], $PasswordHashed, $_POST["Country"]);
            $stmt->execute();
            print "You have registered. Check the database <BR>";
            $_SESSION['UserLog'] = true;
            $selectstatemnt = $connect->prepare('SELECT PERSON_ID  FROM ppl WHERE UserName=?');
            $selectstatemnt->bind_param('s', $_POST['Username']);
            $selectstatemnt->execute();
            $newUserId = $selectstatemnt->get_result();
            $rowUserId = $newUserId->fetch_assoc();
            $_SESSION['UserId'] = $rowUserId['PERSON_ID'];


            displayuser($connect);
        }
    } else {


    ?>
        <form action="Signup.php" method="POST">
            First name: <input type="text" name="FirstName" required><br>
            Last name: <input type="text" name="LastName" required><br>
            Age: <input type="text" name="Age"><br>
            UserName: <input type="text" name="Username" required><br>
            Password: <input type="text" name="Password" required><br>

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
            <input type="submit" name="Register" value="Register">
        </form>
    <?php } ?>

</body>

</html>