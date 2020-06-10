<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>finishOrder</title>
    <link rel="stylesheet" href="product.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body class="finish-order">
    <div class="nav-bar">
        <ul>
            <!-- <li> Welcome to our product page</li> -->
            <li>
                <a href="Home.html"> <i class="fa fa-home" aria-hidden="true"></i>Home</a>
            </li>
            <li><a href="product.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i></i>Product</a> </li>
            <li><a href="Signup.php"><i class="fa fa-sign-in" aria-hidden="true"></i>Sign up</a> </li>
            <li><a href="Login.php"><i class="fa fa-unlock-alt" aria-hidden="true"></i>Login in</a> </li>

            <li class="active"><a href="finishOrder.php"><i class="fa fa-shopping-basket" aria-hidden="true"></i>Basket</a> </li>
        </ul>
    </div>
    <?php
    include_once 'sessionCheck.php';
    include_once 'credentials.php';
    if (!$_SESSION['UserLog']) {
        die('You can not finish your order, you must log in first');
    }
    if (isset($_POST['Delete'])) {
        array_splice($_SESSION['Basket'], (int) $_POST['Delete'], 1);
    }
    // have problems
    if (sizeof($_SESSION['Basket']) === 0) {
        print " You have nothing in your basket" .   "<br>";
        // $row = $result->fetch_assoc();
    } else {
        $total = 0;

        for ($i = 0; $i < sizeof($_SESSION['Basket']); $i++) {
            // print $_SESSION['Basket'][$i] . '<br>';
            $ProductPage = $connect->prepare("SELECT * FROM products WHERE ID=?");
            $ProductPage->bind_param('i', $_SESSION['Basket'][$i]);
            $ProductPage->execute();
            $result = $ProductPage->get_result();
            if ($row = $result->fetch_assoc()) {
                print $row['Name'] . $row['Picutre'] . ': ' . $row['Price'] . '&euro;' . '<br>';
                $total += $row['Price'];
            }
    ?>
            <form action="finishOrder.php" method="post">
                <input type="hidden" name="Delete" value="<?= $i; ?> ">
                <input type="submit" name="Remove" value='Remove'>
            </form>
            <br>


    <?php

        }
        print '<hr> Total: ' . $total . '&euro;';
    }

    ?>

    <input type="button" value="Buy" name="confirmToBuy">

</body>

</html>