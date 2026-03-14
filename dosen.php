<?php
include "koneksi.php";

if (isset($_POST['simpan_dosen'])) {
    mysqli_query($conn, "
        INSERT INTO datadosen (nip, nama_dosen, bidang_keahlian, no_hp)
        VALUES (
            '$_POST[nip]',
            '$_POST[nama_dosen]',
            '$_POST[bidang_keahlian]',
            '$_POST[no_hp]'
        )
    ");
}

$q_dosen = mysqli_query($conn, "SELECT * FROM datadosen");
if(!$q_dosen){ die(mysqli_error($conn)); }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Dosen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand bg-white mb-4 shadow-sm">
    <div class="container d-flex align-items-center">
        <a class="navbar-brand text-pink" href="index.php">Sistem Akademik</a>
        <div class="ms-3">
            <a class="me-3" href="dosen.php">Data Dosen</a>
            <a class="me-3" href="mahasiswa.php">Data Mahasiswa</a>
            <a class="me-3" href="mata_kuliah.php">Data Mata Kuliah</a>
            <a class="me-3" href="perkuliahan.php">Data Perkuliahan</a>
        </div>
    </div>
</nav>

<div class="container my-4">
    <div class="card mb-5 card-pink">
        <div class="card-header">Data Dosen</div>
        <div class="card-body table-responsive">
            <div class="card mb-3">
                <div class="card-header">Tambah Data Dosen</div>
                <div class="card-body">
                    <form method="post">
                        <div class="mb-3">
                            <label class="form-label">NIP</label>
                            <input type="text" name="nip" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Dosen</label>
                            <input type="text" name="nama_dosen" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Bidang Keahlian</label>
                            <input type="text" name="bidang_keahlian" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">No HP</label>
                            <input type="text" name="no_hp" class="form-control">
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="submit" name="simpan_dosen" class="btn btn-pink">Simpan Dosen</button>
                            <a href="index.php" class="btn btn-pink">Dashboard</a>
                        </div>
                    </form>
                </div>
            </div>
            <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <th>NIP</th>
                    <th>Nama Dosen</th>
                    <th>Bidang Keahlian</th>
                    <th>No HP</th>
                </tr>
                <?php $no=1; while($d=mysqli_fetch_assoc($q_dosen)){ ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $d['nip'] ?></td>
                    <td><?= $d['nama_dosen'] ?></td>
                    <td><?= $d['bidang_keahlian'] ?></td>
                    <td><?= $d['no_hp'] ?></td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>
</body>
</html>
