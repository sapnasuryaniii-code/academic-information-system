<?php
include "koneksi.php";

$kode     = $_POST['kode_mk'];
$nama     = $_POST['nama_mk'];
$sks      = $_POST['sks'];
$semester = $_POST['semester'];

mysqli_query($conn,"
    INSERT INTO datamatakuliah
    (kode_mk, nama_mk, sks, semester)
    VALUES
    ('$kode','$nama','$sks','$semester')
");

header("Location: index.php?page=matakuliah");
exit;
