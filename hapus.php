<?php
include "koneksi.php";

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$sql = "DELETE FROM barang WHERE id_barang = ?";
$stmt = $koneksi->prepare($sql);
$stmt->execute([$id]);

header("Location: index.php");
exit();
?>