<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="product.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>product</title>
</head>
<?php
include_once 'sessionCheck.php';
include_once 'credentials.php';
?>

<body class="product-body">
    <div class="nav-bar">
        <ul>
            <!-- <li> Welcome to our product page</li> -->
            <li>
                <a href="Home.html"> <i class="fa fa-home" aria-hidden="true"></i>Home</a>
            </li>
            <li class="active"><a href=""><i class="fa fa-shopping-cart" aria-hidden="true"></i></i>Product</a> </li>
            <li><a href="Signup.php"><i class="fa fa-sign-in" aria-hidden="true"></i>Sign up</a> </li>
            <li><a href="Login.php"><i class="fa fa-unlock-alt" aria-hidden="true"></i>Login in</a> </li>
            <!-- <a href="finishOrder.php"></a> -->

            <li><?= sizeof($_SESSION['Basket']) ?>
            <a href="finishOrder.php"><i class="fa fa-shopping-basket" aria-hidden="true"></i>Basket
            </a> 
            
            </li>
           
           

        </ul>
    </div>

    <?php



    if (isset($_POST['ItemToBuy'])) {
        // print "Some itmes to buy";
        array_push($_SESSION['Basket'],$_POST['ItemToBuy']);
    ?>
        <!-- do have problems -->
        <!-- <h2>Our Products</h2> -->


    <?php
        // $sqlBuy = $connection->prepare('DELETE FROM product WHERE ID=?');
        // $sqlBuy->bind_param('i', $_POST['ItemToBuy']);
        // $sqlBuy->execute();
    }
    // $sqlInsert = $connection->prepare("INSERT INTO orders(PRODUCT_ID) VALUE(?)");
    // $sqlInsert->bind_param('i', $_POST['ItemToBuy']);
    // $sqlInsert->execute();

    // $database = 'addProduct';
    // $username = 'root';
    // $password = '';
    // $connection = mysqli_connect('localhost', $username, $password, $database);
    $ProductPage = $connect->prepare("SELECT * FROM products");
    $ProductPage->execute();
    $result = $ProductPage->get_result();
    while ($row = $result->fetch_assoc()) { ?>

        <div class="product">

            <img src="photo/<?= $row['Picture'] ?>">
            <h3>Name: <?= $row['Name'] ?></h3>
            <h4>Tips: <?= $row['Description'] ?> </h4>
            <h5>Price: <?= $row['Price'] ?> &euro;</h5>
            <form action="product.php" method="post">
                <input type="hidden" name="ItemToBuy" value="<?= $row['ID'] ?>">

                <div class="buy">
                    <input type="submit" value="Buy">
                </div>
            </form>
        </div>
    <?php }
    ?>
</body>

</html>