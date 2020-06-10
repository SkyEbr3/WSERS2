<?php
session_start();
if(!isset($_SESSION['UserLog'])){
$_SESSION['UserLog'] = false;   
    
}
if(!isset($_SESSION['Basket'])){
    $_SESSION['Basket'] = [];
}

?>