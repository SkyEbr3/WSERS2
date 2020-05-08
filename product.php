<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>Document</title>
</head>

<body>
    <h1>Welcome to our product page</h1>
    <?php
    $database = 'testExample';
    $username = 'root';
    $password = '';
    $connection = mysqli_connect('localhost', $username, $password, $database);
    $select = $connection->prepare(' SELECT * FROM Products');
    $select->execute();
    $result = $select->get_result();
    while ($row = $result->fetch_assoc()) { ?>




        <div class="product">
            <img src="photo/<?php print $row['Picture'] ?>">
            <h3>Name: <?php print $row['Name'] ?></h3>
            <h4>Description <?php print $row['Description'] ?> </h4>
            <h5>Pirce <?php print $row['Price'] ?> &euro;</h5>
        </div>
    <?php }
    ?>
</body>

</html>