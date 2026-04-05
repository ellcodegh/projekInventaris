<?php
session_start();

if (!isset($_SESSION['login']) && isset($_COOKIE['username'])) {
    $_SESSION['login'] = true;
    $_SESSION['username'] = $_COOKIE['username'];
}

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}
?>