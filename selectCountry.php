
<form action="selectCountry.php" method="POST">

    <select id="country">
    
       
            <?php
            $database = 'localhost';
            $username = 'root';
            $password = '';
            $database = 'mohsen';
            $connection = mysqli_connect('localhost', $username, $password, $database);
            if (!$connection) {
                die('Connection has failed') . mysqli_connect_error();
            }

            $select = $connection->prepare(' SELECT * FROM countries');
            if (!$connection) {
                die('You are connected');
            }
            $select->execute();
            $result = $select->get_result();
            while ($row = $result->fetch_assoc()){?>

            

               
                <?php}
            ?>
             print $row['COUNTRY_NAME'] . '<br>';

            <option value="1"><?php print $row['COUNTRY_NAME']?></option>
            <input type="submit" name="Go" value="Go">
    </select>
            <?php}?>
</form>

