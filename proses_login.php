<?php
session_start();
include "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    try {
        $sql  = "SELECT * FROM admin WHERE username = :user";
        $stmt = $koneksi->prepare($sql);
        
        // 2. Bind parameter dan eksekusi
        $stmt->execute(['user' => $username]);
        $user = $stmt->fetch();

        if ($user) {
            if ($password == $user['password']) {
                $_SESSION['login'] = true;
                $_SESSION['username'] = $user['username'];

                header("Location: index.php");
                exit();
            } else {
                echo "<script>alert('Password salah!'); window.history.back();</script>";
            }
        } else {
            echo "<script>alert('Username tidak ditemukan!'); window.history.back();</script>";
        }

    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}
?>