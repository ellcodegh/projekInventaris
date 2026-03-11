<?php
include "koneksi.php";

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

$sql = "INSERT INTO barang (id_barang, kode_barang, nama_barang, satuan, harga_beli, harga_jual, jumlah, tanggal_masuk, keterangan, foto) 
        VALUES ('', ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $koneksi->prepare($sql);

$stmt->bind_param("ssssiisss", $kode, $nama, $satuan, $hb, $hj, $jumlah, $tanggal, $ket, $nama_foto_baru);

if($stmt->execute()){
    header("Location: index.php");
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$koneksi->close();

header("Location: index.php");
?>