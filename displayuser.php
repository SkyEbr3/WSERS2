<?php
function displayuser($connect)
{
    if (!isset($_SESSION['UserId'])) {
        print ' You are trying to display of a user without logging in ';
    } else {
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
    }
?>
    <form action="<?php print $_SERVER['PHP_SELF'];?>" method="post">

        <input type="submit" name="Logout" value="Logout">
    </form>
<?php


}
?>