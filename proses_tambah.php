<?php
include "koneksi.php";

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

$nama_foto = uniqid() . '.' . $ext;

move_uploaded_file($tmp, "upload/original/" . $nama_foto);

$source = "upload/original/" . $nama_foto;
$thumb  = "upload/thumb/" . $nama_foto;

$thumb_width = 150;
$thumb_height = 150;

if ($ext == 'jpg' || $ext == 'jpeg') {
    $img = imagecreatefromjpeg($source);
} elseif ($ext == 'png') {
    $img = imagecreatefrompng($source);
}

$width  = imagesx($img);
$height = imagesy($img);

$tmp_img = imagecreatetruecolor($thumb_width, $thumb_height);

imagecopyresampled(
    $tmp_img,
    $img,
    0, 0, 0, 0,
    $thumb_width,
    $thumb_height,
    $width,
    $height
);

if ($ext == 'jpg' || $ext == 'jpeg') {
    imagejpeg($tmp_img, $thumb);
} elseif ($ext == 'png') {
    imagepng($tmp_img, $thumb);
}

imagedestroy($img);
imagedestroy($tmp_img);

$sql = "INSERT INTO barang 
(kode_barang, nama_barang, satuan, harga_beli, harga_jual, jumlah, tanggal_masuk, keterangan, foto) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

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
    $nama_foto
]);

header("Location: index.php");
exit();
?>