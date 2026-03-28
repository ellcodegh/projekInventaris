<?php
$host   = "localhost";
$user   = "root";
$pass   = "";
$db     = "inventaris";
$charset= "utf8mb4";

// DSN (Data Source Name) - Alamat lengkap database
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// Opsi tambahan untuk keamanan dan kemudahan
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Menampilkan error sebagai pengecualian
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Hasil query otomatis jadi array
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Menggunakan prepared statement asli
];

try {
    // Membuat koneksi baru
    $koneksi = new PDO($dsn, $user, $pass, $options);
    
    // Jika ingin cek koneksi berhasil, bisa uncomment baris di bawah:
    // echo "Koneksi PDO Berhasil!"; 
} catch (PDOException $e) {
    // Menangkap error jika koneksi gagal
    die("Koneksi gagal: " . $e->getMessage());
}
?>