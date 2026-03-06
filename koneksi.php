<?php
$koneksi = mysqli_connect("localhost", "root", "", "inventaris");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>