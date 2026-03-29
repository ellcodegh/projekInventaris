<?php
include "koneksi.php";

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$stmt = $koneksi->prepare("SELECT foto FROM barang WHERE id_barang = ?");
$stmt->execute([$id]);
$data = $stmt->fetch();

if ($data) {
    if (file_exists("upload/" . $data['foto'])) {
        unlink("upload/" . $data['foto']);
    }

    $stmt = $koneksi->prepare("DELETE FROM barang WHERE id_barang = ?");
    $stmt->execute([$id]);
}

header("Location: index.php");
exit();
?>