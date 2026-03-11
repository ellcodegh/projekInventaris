<?php
include "koneksi.php";

$id         = $_POST['id_barang'];
$kode       = mysqli_real_escape_string($koneksi, $_POST['kode_barang']);
$nama       = mysqli_real_escape_string($koneksi, $_POST['nama_barang']);
$satuan     = $_POST['satuan'];
$hb         = $_POST['harga_beli'];
$hj         = $_POST['harga_jual'];
$jumlah     = $_POST['jumlah'];
$tanggal    = $_POST['tanggal_masuk'];
$ket        = $_POST['keterangan'];

if (preg_match('/[0-9]/', $satuan)) {
    echo "<script>alert('Satuan tidak boleh mengandung angka!'); window.history.back();</script>";
    exit;
}

if($_FILES['foto']['name'] != ''){
    $foto = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];
    $allowed = ['jpg','jpeg','png'];
        $ext = strtolower(pathinfo($foto, PATHINFO_EXTENSION));

        if(!in_array($ext, $allowed)){
        die("Format file tidak diizinkan!");
        }

        if($_FILES['foto']['size'] > 2000000){
        die("Ukuran file terlalu besar!");
        }
    move_uploaded_file($tmp, "upload/".$foto);

        $sql    = "UPDATE barang SET kode_barang=?, nama_barang=?, satuan=?, harga_beli=?,
        harga_jual=?, jumlah=?, tanggal_masuk=?, keterangan=?, foto=? WHERE id_barang=?";
        $stmt   = $koneksi->prepare($sql);
        $stmt->bind_param("ssssiisssi", $kode, $nama, $satuan, $hb, $hj, $jumlah, $tanggal, $ket, $nama_foto_baru, $id);

        } else {
            $sql    = "UPDATE barang SET kode_barang=?, nama_barang=?, satuan=?, harga_beli=?,
            harga_jual=?, jumlah=?, tanggal_masuk=?, keterangan=? WHERE id_barang=?";
            $stmt = $koneksi->prepare($sql);
            $stmt->bind_param("ssssiissi", $kode, $nama, $satuan, $hb, $hj, $jumlah, $tanggal, $ket, $id);
        }

    if($stmt->execute()){
        header("Location: index.php");
        } else {
            echo "Gagal update: " . $stmt->error;
        }

$stmt->close();
$koneksi->close();
header("Location: index.php");
?>