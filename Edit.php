<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="edit.css">
</head>

<body>


    <?php
    include_once "credentials.php";
    include_once 'sessionCheck.php';
    ?>


    <?php
    if (!$_SESSION['UserLog']) { ?>
        <div>
           
            <a href="Login.php">
                <p style="color:aliceblue; text-align:center;font-size:20px;">Login page</p>
            </a>
        </div>
    <?php exit();
    }
    if (isset($_POST['Update'])) {
        if (strlen($_POST['Password']) > 6)
            $PasswordHashed = password_hash($_POST['Password'], PASSWORD_BCRYPT);
        print ' We are updating your details';
        $sqlUpdate = $connect->prepare('UPDATE ppl SET First_Name=?,Second_Name=?,Age=?,UserName=?,Password=?,Nationality=? WHERE PERSON_ID=?');
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
    } 
    // else {
    //     print '<p style="color:white">You must type  passoword</p>';
    // }

    ?>
    <!-- <h2>Update your information</h2> -->
    <?php
    $sqlSelect = $connect->prepare("SELECT * FROM ppl WHERE PERSON_ID=?");
    $sqlSelect->bind_param('i', $_SESSION['UserLog']);
    $sqlSelect->execute();
    $result = $sqlSelect->get_result();
    if ($result->num_rows != 1) { ?>
        <p> are not allowed here,You have to log in first.</p>
        <a href="Signup.php"></a>
    <?php
        die('Your account has been banned!');
    }
    $row = $result->fetch_assoc();

    ?>
    <form class="edit" action="Edit.php" method="POST">
        <img src="avatar.png" alt="">
        <h1>Update Information</h1>
        <input type="text" name=" FirstName" placeholder="First Name" value="<? $row['First_Name'];?>" required><br>
        <input type="text" name="LastName" placeholder="Last Name" value="<? $row['Second_Name'];?>" required><br>
        <input type="text" name="Age" placeholder="Age" value="<? $row['Age'];?>"><br>
        <input type="text" name="Username" placeholder="User Name" value="<? $row['UserName'];?>" required><br>
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

        <div class="back"><a href="Signup.php"><i class="fa fa-arrow-left" aria-hidden="true"></i>Back</a></div>
    </form>
</Body>

</html>