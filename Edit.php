<?php
include_once "credentials.php";
include_once 'sessionCheck.php';
?>

<Body class="Edit">
    <?php
    if (!$_SESSION['UserLog']) { ?>
        You are not allowed here,log in first
        <a href="Login.php"><br>Login</a>
    <?php exit();
    }
    if (isset($_POST['Update'])) {
        if(strlen($_POST['Password'])> 6)
        $PasswordHashed = password_hash($_POST['Password'], PASSWORD_BCRYPT);
        print ' We are updating your details';
        $sqlUpdate = $connect->prepare('UPDATE ppl SET First_Name=?,Second_Name=?,Age=?,Password=?,UserName=? WHERE PERSON_ID=? ');
        $sqlUpdate->bind_param(
            'ssissii',
            $_POST['FirstName'],
            $_POST['LastName'],
            $_POST['Age'],
            $PasswordHashed,
            $_POST['Username'],
            $_POST['Country'],
            $_SESSION['CurrentUser']
        );
        $sqlUpdate->execute();
        print  'Updated information';
    }else{
        print 'You must type  passoword';
    }


    ?>
    <h2>Update your information</h2>
    <?php
    $sqlSelecct = $connect->prepare('SELECT * FROM ppl WHERE PERSON_ID=?');
    $sqlSelecct->bind_param('i', $_SESSION['CurrentUser']);
    $sqlSelecct->execute();
    $result = $sqlSelecct->get_result();
    if ($result->num_rows != 1) { ?>
        You are not allowed here,You have to log in first.
        <a href="Login.php"></a>
    <?php
        die('Your account has been banned!');
    }
    $row = $result->fetch_assoc();

    ?>
    <form class="sig" action="Edit.php" method="POST">
        <img src="avatar.png" alt="">
        <h1>Sign in</h1>
        <input type="text" name=" FirstName" placeholder="First Name" value="<? $row['First_Name'];?>"required><br>
        <input type="text" name="LastName" placeholder="Last Name" value="<? $row['Last_Name'];?>"required><br>
        <input type="text" name="Age" placeholder="Age" value="<? $row['Age'];?>"required><br>
        <input type="text" name="Username" placeholder="User Name" value="<? $row['Username'];?>"required><br>
        <input type="password" name="Password" placeholder="Password" value="<? $row['Password'];?>" required><br>


        <select name="Country">
            <?php
            $stmt = $connect->prepare("SELECT * FROM countries");
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    // <!-- // echo '<option value="' . $row["COUNTRY_ID"] . '">' . $row["COUNTRY_NAME"] . '</option>'; -->
                    // <!-- <option value="1">AFG</option>
                    // <option value="2">LUX</option> -->
                    $optionValue = '<option value=';
                    $optionValue = $optionValue . $row['COUNTRY_NAME'] . " ;";
                    if ($row['COUNTRY_ID'] == $row['Nationality']) {
                        $optionValue = $optionValue . 'selected';
                    }
                    $optionValue = $optionValue . ">" . $row['COUNTRY_NAME'];
                    $optionValue = $optionValue . '</option>';
                    print $optionValue;
                }
            } else {
                echo "0 results";
            }
            $connect->close();
            ?>
        </select>
        <br>
        <input type="submit" name="Update" value="Update"><br>

        <!-- <div class="back"><a href="Home.html"><i class="fa fa-arrow-left" aria-hidden="true"></i>Back</a></div> -->
    </form>


</Body>