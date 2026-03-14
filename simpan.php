<?php  
include "koneksi.php";
// $id_mhs = $_POST['id_mhs'];
$nama = $_POST['nama'];
$jekel = $_POST['jekel'];
$alamat = $_POST['alamat'];
$prodi = $_POST['prodi'];
$nohp = $_POST['no_hp'];

$sql1 = "INSERT INTO datamahasiswa (nama, jekel, alamat, prodi, nohp) 
    VALUES ( '$nama', '$jekel', '$alamat', '$prodi', '$nohp')
";
//id_mhs, '$id_mhs',
if($conn->query($sql1) === true) {
    echo "<script>
        alert('Data Berhasil Disimpan!');
        window.location.href = 'Index.php';
    </script>";
} else {
    echo "<script>
        alert('Error: Data Gagal Disimpan!');
        window.location.href = 'Index.php';
    </script>";
}
$conn->close();
?>
