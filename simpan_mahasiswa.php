<?php
include "koneksi.php";

$nama   = $_POST['nama'];
$jekel  = $_POST['jekel'];
$alamat = $_POST['alamat'];
$prodi  = $_POST['prodi'];
$nohp   = $_POST['nohp'];

mysqli_query($conn,"
    INSERT INTO datamahasiswa
    (nama, jekel, alamat, prodi, nohp)
    VALUES
    ('$nama','$jekel','$alamat','$prodi','$nohp')
");

header("Location: index.php?page=mahasiswa");
exit;
