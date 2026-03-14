<?php
include "koneksi.php";

/* ================= HAPUS MAHASISWA ================= */
if (isset($_GET['mhs'])) {
    $id = $_GET['mhs'];
    mysqli_query($conn,"DELETE FROM datamahasiswa WHERE id_mhs='$id'");
    header("Location: index.php?page=mahasiswa");
    exit;
}

/* ================= HAPUS DOSEN ================= */
if (isset($_GET['dsn'])) {
    $id = $_GET['dsn'];
    mysqli_query($conn,"DELETE FROM datadosen WHERE id_dosen='$id'");
    header("Location: index.php?page=dosen");
    exit;
}

/* ================= HAPUS MATA KULIAH ================= */
if (isset($_GET['mk'])) {
    $id = $_GET['mk'];
    mysqli_query($conn,"DELETE FROM datamatakuliah WHERE id_mk='$id'");
    header("Location: index.php?page=matakuliah");
    exit;
}

/* ================= HAPUS PERKULIAHAN ================= */
if (isset($_GET['per'])) {
    $id = $_GET['per'];
    mysqli_query($conn,"DELETE FROM dataperkuliahan WHERE id_mk_perkuliahan='$id'");
    header("Location: index.php?page=perkuliahan");
    exit;
}
