<?php
include "koneksi.php";

$kode = mysqli_real_escape_string($koneksi, $_POST['kode_barang']);
$nama = mysqli_real_escape_string($koneksi, $_POST['nama_barang']);
htmlspecialchars($row['nama_barang']);

$id = $_POST['id'];
$kode = $_POST['kode_barang'];
$nama = $_POST['nama_barang'];
$satuan = $_POST['satuan'];
$hb = $_POST['harga_beli'];
$hj = $_POST['harga_jual'];
$jumlah = $_POST['jumlah'];
$tanggal = $_POST['tanggal_masuk'];
$ket = $_POST['keterangan'];

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

    mysqli_query($koneksi, "UPDATE barang SET
        kode_barang='$kode',
        nama_barang='$nama',
        satuan='$satuan',
        harga_beli='$hb',
        harga_jual='$hj',
        jumlah='$jumlah',
        tanggal_masuk='$tanggal',
        keterangan='$ket',
        foto='$foto'
        WHERE id_barang='$id'
    ");
}else{
    mysqli_query($koneksi, "UPDATE barang SET
        kode_barang='$kode',
        nama_barang='$nama',
        satuan='$satuan',
        harga_beli='$hb',
        harga_jual='$hj',
        jumlah='$jumlah',
        tanggal_masuk='$tanggal',
        keterangan='$ket'
        WHERE id_barang='$id'
    ");
}

header("Location: index.php");
?>