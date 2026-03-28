<?php
include "koneksi.php";

$id      = $_POST['id_barang'];
$kode    = $_POST['kode_barang'];
$nama    = $_POST['nama_barang'];
$satuan  = $_POST['satuan'];
$hb      = $_POST['harga_beli'];
$hj      = $_POST['harga_jual'];
$jumlah  = $_POST['jumlah'];
$tanggal = $_POST['tanggal_masuk'];
$ket     = $_POST['keterangan'];

if (preg_match('/[0-9]/', $satuan)) {
    echo "<script>alert('Satuan tidak boleh mengandung angka!'); window.history.back();</script>";
    exit;
}

// CEK apakah upload foto baru
if ($_FILES['foto']['name'] != '') {

    $foto = $_FILES['foto']['name'];
    $tmp  = $_FILES['foto']['tmp_name'];

    $allowed = ['jpg','jpeg','png'];
    $ext = strtolower(pathinfo($foto, PATHINFO_EXTENSION));

    if (!in_array($ext, $allowed)) {
        die("Format file tidak diizinkan!");
    }

    if ($_FILES['foto']['size'] > 2000000) {
        die("Ukuran file terlalu besar!");
    }

    // bikin nama unik
    $nama_foto_baru = uniqid() . '.' . $ext;

    move_uploaded_file($tmp, "upload/" . $nama_foto_baru);

    $sql = "UPDATE barang SET 
        kode_barang=?, nama_barang=?, satuan=?, harga_beli=?,
        harga_jual=?, jumlah=?, tanggal_masuk=?, keterangan=?, foto=?
        WHERE id_barang=?";

    $stmt = $koneksi->prepare($sql);

    $stmt->execute([
        $kode,
        $nama,
        $satuan,
        $hb,
        $hj,
        $jumlah,
        $tanggal,
        $ket,
        $nama_foto_baru,
        $id
    ]);

} else {

    $sql = "UPDATE barang SET 
        kode_barang=?, nama_barang=?, satuan=?, harga_beli=?,
        harga_jual=?, jumlah=?, tanggal_masuk=?, keterangan=?
        WHERE id_barang=?";

    $stmt = $koneksi->prepare($sql);

    $stmt->execute([
        $kode,
        $nama,
        $satuan,
        $hb,
        $hj,
        $jumlah,
        $tanggal,
        $ket,
        $id
    ]);
}

header("Location: index.php");
exit();
?>