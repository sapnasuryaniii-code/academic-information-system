<?php
$host = "localhost"; // Ganti dengan host database anda
$username = "root"; // Ganti dengan username database anda
$password = ""; // Ganti dengan password database anda
$database = "db_kampussapna"; // Ganti dengan nama database anda

// Membuat koneksi
$conn = new mysqli($host, $username, $password, $database);

// memeriksa koneksi
if ($conn ->connect_error) {
    die("Koneksi Gagal: " . $conn->connect_error);
}
// Set karakter encoding ke UTF-8
$conn->set_charset("utf8");
?>

 
