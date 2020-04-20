<?php
session_start();
if(!isset($_SESSION['UserLog'])){
$_SESSION['UserLog'] = false;       
}
?>