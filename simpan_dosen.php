<?php
include "koneksi.php";

$nip    = $_POST['nip'];
$nama   = $_POST['nama_dosen'];
$bidang = $_POST['bidang_keahlian'];
$nohp   = $_POST['no_hp'];

mysqli_query($conn,"
    INSERT INTO datadosen
    (nip, nama_dosen, bidang_keahlian, no_hp)
    VALUES
    ('$nip','$nama','$bidang','$nohp')
");

header("Location: index.php?page=dosen");
exit;
