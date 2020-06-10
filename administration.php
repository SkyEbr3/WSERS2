<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration</title>
    <link rel="stylesheet" href="about.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>


    <?php
    include_once "sessionCheck.php";
    include_once "credentials.php";
    if (!$_SESSION["UserLog"]) {
        die("You are not logged in <div class='nav-bar'><a href='Home.html'>Back</a></div>");
    }
    $userselect = $connection->prepare("SELECT User_role FROM ppl WHERE PERSON_ID=?");
    $userselect->bind_param("i", $_SESSION["CurrentUser"]);
    $userselect->execute();
    $resultuser = $userselect->get_result();
    $rowuser = $resultuser->fetch_assoc();
    if ($rowuser["User_role"] !== 1) {
        die("you are not an adminstrator");
    }

    if (isset($_POST["Username"])) {
        $deleteThisStatement = $connection->prepare("DELETE FROM ppl where UserName=?");
        $deleteThisStatement->bind_param("s", $_POST["Username"]);
        $deleteThisStatement->execute();
    }

    $users = $connection->prepare("SELECT UserName FROM ppl WHERE PERSON_ID<>?");
    $users->bind_param("i", $_SESSION["CurrentUser"]);
    $users->execute();
    $resultuser = $users->get_result();
    while ($rowusers = $resultuser->fetch_assoc()) {
        print $rowusers['UserName']; ?>
        <form action="adminstration.php" method="post">
            <input type="hidden" name="Username" value="<?php print $rowusers['UserName']; ?>">
            <input type="submit" name="Delete" value="Delete"><BR>
        </form>
    <?php
    }
    ?>

    Add a new product to the database:<BR>
    <form action="adminstration.php" method="post">
        Name: <input type="text" name="ProductName" required><br>
        Description: <input type="text" name="ProductDescription"><br>
        Price: <input type="text" name="ProductPrice"><br>
        PictureName: <input type="text" name="ProductPicture" required><br>
        <input type="submit" name="Add" value="Add">
        <!-- <div class="back"><a href="Home.html"><i class="fa fa-arrow-left" aria-hidden="true"></i>Back</a></div> -->
    </form>



</body>

</html>