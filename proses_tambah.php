<?php
include "koneksi.php";

$kode = mysqli_real_escape_string($koneksi, $_POST['kode_barang']);
$nama = mysqli_real_escape_string($koneksi, $_POST['nama_barang']);
htmlspecialchars($_POST['nama_barang']);

$kode = $_POST['kode_barang'];
$nama = $_POST['nama_barang'];
$satuan = $_POST['satuan'];
$hb = $_POST['harga_beli'];
$hj = $_POST['harga_jual'];
$jumlah = $_POST['jumlah'];
$tanggal = $_POST['tanggal_masuk'];
$ket = $_POST['keterangan'];

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

mysqli_query($koneksi, "INSERT INTO barang VALUES(
'', '$kode','$nama','$satuan','$hb','$hj','$jumlah','$tanggal','$ket','$foto'
)");

header("Location: index.php");
?>