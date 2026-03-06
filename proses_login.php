<?php
session_start();
include "koneksi.php";

$username = mysqli_real_escape_string($koneksi, $_POST['username']);
$password = md5($_POST['password']);

$query = mysqli_query($koneksi, "SELECT * FROM admin WHERE username='$username' AND password='$password'");
$data = mysqli_fetch_assoc($query);

if($data){
    $_SESSION['login'] = true;
    $_SESSION['username'] = $data['username'];
    header("Location: index.php");
}else{
    echo "<script>alert('Login gagal!'); window.location='login.php';</script>";
}
?>