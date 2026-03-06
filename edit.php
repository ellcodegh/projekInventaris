<?php
include "session.php";
include "koneksi.php";

$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM barang WHERE id_barang='$id'");
$row = mysqli_fetch_assoc($data);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow">
        
        <div class="card-header bg-warning">
            <h4 class="mb-0">Edit Data Barang</h4>
        </div>

        <div class="card-body">

            <form method="POST" action="proses_edit.php" enctype="multipart/form-data">

            <input type="hidden" name="id" value="<?= $row['id_barang']; ?>">

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="form-label">Kode Barang</label>
                    <input type="text" name="kode_barang" class="form-control"
                    value="<?= htmlspecialchars($row['kode_barang']); ?>" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Barang</label>
                    <input type="text" name="nama_barang" class="form-control"
                    value="<?= htmlspecialchars($row['nama_barang']); ?>" required>
                </div>

            </div>


            <div class="row">

                <div class="col-md-4 mb-3">
                    <label class="form-label">Satuan</label>
                    <input type="text" name="satuan" class="form-control"
                    value="<?= htmlspecialchars($row['satuan']); ?>">
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Harga Beli</label>
                    <input type="number" name="harga_beli" class="form-control"
                    value="<?= $row['harga_beli']; ?>">
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Harga Jual</label>
                    <input type="number" name="harga_jual" class="form-control"
                    value="<?= $row['harga_jual']; ?>">
                </div>

            </div>


            <div class="row">

                <div class="col-md-4 mb-3">
                    <label class="form-label">Jumlah</label>
                    <input type="number" name="jumlah" class="form-control"
                    value="<?= $row['jumlah']; ?>">
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Tanggal Masuk</label>
                    <input type="date" name="tanggal_masuk" class="form-control"
                    value="<?= $row['tanggal_masuk']; ?>">
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Foto Baru</label>
                    <input type="file" name="foto" class="form-control">
                </div>

            </div>


            <div class="mb-3">
                <label class="form-label">Keterangan</label>
                <textarea name="keterangan" class="form-control" rows="3"><?= htmlspecialchars($row['keterangan']); ?></textarea>
            </div>


            <div class="mb-3">
                <label class="form-label">Foto Saat Ini</label><br>
                <img src="upload/<?= $row['foto']; ?>" width="120" class="img-thumbnail">
            </div>


            <div class="d-flex justify-content-between">
                <a href="index.php" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-success">Update Data</button>
            </div>

            </form>

        </div>
    </div>
</div>

</body>
</html>