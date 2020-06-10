<link rel="stylesheet" href="main.css">
<?php
function displayuser($connect)
{
    if (!isset($_SESSION['UserId'])) {
        print ' <p style="color: white;  text-align: center">You are trying to display  a user without logging in ';
    } else {
        $user = $connect->prepare('SELECT * FROM ppl WHERE PERSON_ID=?');
        $user->bind_param('i', $_SESSION['UserId']);
        $user->execute();
        $MyResult = $user->get_result();
        $row = $MyResult->fetch_assoc();

        print ' <p style="color: white;  text-align: center">First Name: ' . $row['First_Name'] . '</br>';
        print ' Last Name: ' . $row['Second_Name'] . '</br>';
        print ' Age: ' . $row['Age'] . '</br>';
        print ' User Name: ' . $row['UserName'] . '</br>';
        $country = $connect->prepare('SELECT * FROM COUNTRIES WHERE COUNTRY_ID=?');
        $country->bind_param('i', $row['Nationality']);
        $country->execute();
        $resultOfCountry = $country->get_result();
        $nationality = $resultOfCountry->fetch_assoc();
        print ' Nationality: ' . $nationality["COUNTRY_NAME"];
    }
?>
    <form class="logout" action="<?php print $_SERVER['PHP_SELF']; ?>" method="post">
        
        <input type="submit" name="Logout" value="Logout">
        
    </form>
<?php


}
?>