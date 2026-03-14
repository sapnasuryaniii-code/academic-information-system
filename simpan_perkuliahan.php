<?php
include "koneksi.php";

$mk_id   = $_POST['id_mk'];
$dosen_id= $_POST['id_dosen'];
$mhs_id  = $_POST['id_mhs'];
$ruang   = $_POST['ruang'];
$jadwal  = $_POST['jadwal'];

/* Ambil nama MK */
$qmk = mysqli_fetch_assoc(mysqli_query($conn,
    "SELECT nama_mk FROM datamatakuliah WHERE id_mk='$mk_id'"
));

/* Ambil nama dosen */
$qdsn = mysqli_fetch_assoc(mysqli_query($conn,
    "SELECT nama_dosen FROM datadosen WHERE id_dosen='$dosen_id'"
));

/* Ambil nama mahasiswa */
$qmhs = mysqli_fetch_assoc(mysqli_query($conn,
    "SELECT nama FROM datamahasiswa WHERE id_mhs='$mhs_id'"
));

mysqli_query($conn,"
INSERT INTO dataperkuliahan
(nama_mk, nama_dosen, nama_mahasiswa, ruang, jadwal, dosen_id, mk_id, mhs_id)
VALUES
(
 '{$qmk['nama_mk']}',
 '{$qdsn['nama_dosen']}',
 '{$qmhs['nama']}',
 '$ruang',
 '$jadwal',
 '$dosen_id',
 '$mk_id',
 '$mhs_id'
)
");

header("Location: index.php?page=perkuliahan");
exit;
