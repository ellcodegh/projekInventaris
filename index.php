<?php
include "session.php";
include "koneksi.php";
$data = mysqli_query($koneksi, "SELECT * FROM barang ORDER BY id_barang DESC");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Data Inventaris</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-4">
        <h3>Data Inventaris Barang</h3>
        <p>Login sebagai: <b>
                <?= $_SESSION['username']; ?>
            </b> |
            <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
        </p>

        <a href="tambah.php" class="btn btn-primary mb-3">+ Tambah Data</a>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Jumlah</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; while($row=mysqli_fetch_assoc($data)){ ?>
                <tr>
                    <td>
                        <?= $no++; ?>
                    </td>
                    <td>
                        <?= htmlspecialchars($row['kode_barang']); ?>
                    </td>
                    <td>
                        <?= htmlspecialchars($row['nama_barang']); ?>
                    </td>
                    <td>
                        <?= $row['jumlah']; ?>
                    </td>
                    <td><img src="upload/<?= $row['foto']; ?>" width="70"></td>
                    <td>
                        <a href="edit.php?id=<?= $row['id_barang']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="hapus.php?id=<?= $row['id_barang']; ?>" class="btn btn-danger btn-sm"
                            onclick="return confirm('Yakin hapus?')">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>

</html>