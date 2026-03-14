<?php
include "koneksi.php";
$page = $_GET['page'] ?? 'dashboard';

/* HITUNG TOTAL */
$total_mhs   = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) total FROM datamahasiswa"))['total'];
$total_dosen = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) total FROM datadosen"))['total'];
$total_mk    = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) total FROM datamatakuliah"))['total'];
$total_per   = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) total FROM dataperkuliahan"))['total'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Sistem Informasi Akademik</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
/* ===== BASE ===== */
:root {
    --bg-color: #fce4ec;
    --sidebar-bg: #ba68c8;
    --topbar-bg: #f8bbd9;
    --card-bg: #fce4ec;
    --text-color: #374151;
    --text-light: #64748b;
    --border-color: #e2e8f0;
}

body{
    background: var(--bg-color);
    font-family: Arial, sans-serif;
}

/* ===== CONTENT ===== */
.content{
    margin-left:0;
    padding:35px;
    min-height:100vh;
}

/* ===== TOPBAR ===== */
.topbar{
    background:var(--topbar-bg);
    padding:22px 30px;
    margin-bottom:30px;
}
.topbar h4{
    margin:0;
    font-weight:700;
    color: #374151;
}
.topbar small{
    color:var(--text-light);
    font-weight:500;
}
.top-menu{
    display:flex;
    gap:20px;
}
.top-menu a{
    color:#374151;
    text-decoration:none;
    font-weight:600;
    padding:8px 16px;
    border-radius:8px;
    transition:all .3s ease;
}
.top-menu a:hover{
    background:#ba68c8;
    color:white;
}
.top-menu a.active{
    background:#ba68c8;
    color:white;
}

/* ===== CARD ===== */
.card{
    background:var(--card-bg);
}

/* ===== DASHBOARD CARDS ===== */
.stat-card{
    padding:30px;
    color:white;
    background:#ba68c8;
}
.stat-card.bg-success{
    background:#f06292;
}
.stat-card.bg-warning{
    background:#ba68c8;
    color:#ffffff;
}
.stat-card.bg-info{
    background:#ab47bc;
}
.stat-card h2{
    font-size:2.5rem;
    margin:10px 0 0 0;
}

/* ===== TABLE ===== */
.table{
    overflow:hidden;
}
.table thead{
    background: #f0f0f0;
    color:#374151;
    font-weight:600;
}


/* ===== FORM ===== */
.form-control, select, textarea, .btn{
    border-radius:16px;
    border:2px solid #e2e8f0;
    transition:all .3s ease;
}
.form-control:focus, select:focus, textarea:focus{
    border-color:#3b82f6;
    box-shadow:0 0 0 .2rem rgba(59,130,246,.25);
    transform:scale(1.02);
}
.btn{
    font-weight:600;
    padding:12px 24px;
    transition:all .3s ease;
    position:relative;
    overflow:hidden;
}
.btn::before{
    content:'';
    position:absolute;
    top:0;
    left:-100%;
    width:100%;
    height:100%;
    background:linear-gradient(90deg,transparent,rgba(255,255,255,.3),transparent);
    transition:.5s;
}
.btn:hover::before{
    left:100%;
}
.btn:hover{
    transform:translateY(-2px);
    box-shadow:0 8px 25px rgba(0,0,0,.2);
}

/* ===== ANIMATIONS ===== */
.animate__animated{
    animation-duration:1s;
}
.fade-in{
    animation:fadeInUp .8s ease-out;
}
@keyframes fadeInUp{
    from{
        opacity:0;
        transform:translateY(30px);
    }
    to{
        opacity:1;
        transform:translateY(0);
    }
}

/* ===== RESPONSIVE ===== */
@media(max-width:768px){
    .content{
        margin-left:0;
        padding:20px;
    }
    .stat-card{
        margin-bottom:20px;
    }
    .top-menu{
        flex-wrap:wrap;
        gap:10px;
    }
    .top-menu a{
        padding:6px 12px;
        font-size:14px;
    }
}

/* ===== FOOTER ===== */
.created-by{
    position:fixed;
    bottom:0;
    left:0;
    right:0;
    background:var(--footer-bg);
    border-top:2px solid var(--border-color);
    text-align:center;
    padding:12px 0;
    font-size:14px;
    color:var(--text-light);
    backdrop-filter:blur(10px);
    box-shadow:0 -5px 20px rgba(0,0,0,.1);
    transition: background 0.3s ease, color 0.3s ease, border-color 0.3s ease;
}


</style>
</head>







<div class="content">

<!-- TOPBAR -->
<div class="topbar">
    <div class="d-flex justify-content-between align-items-center">
        <h4>Sistem Informasi Akademik</h4>
        <nav class="top-menu">
            <a href="index.php" class="<?= $page=='dashboard'?'active':'' ?>">Dashboard</a>
            <a href="?page=mahasiswa" class="<?= $page=='mahasiswa'?'active':'' ?>">Mahasiswa</a>
            <a href="?page=dosen" class="<?= $page=='dosen'?'active':'' ?>">Dosen</a>
            <a href="?page=matakuliah" class="<?= $page=='matakuliah'?'active':'' ?>">Mata Kuliah</a>
            <a href="?page=perkuliahan" class="<?= $page=='perkuliahan'?'active':'' ?>">Perkuliahan</a>
        </nav>
    </div>
</div>

<!-- ================= DASHBOARD ================= -->
<?php if($page=="dashboard"){ ?>
<div style="background: linear-gradient(135deg, #f8bbd9 0%, #fce4ec 100%); border-radius: 12px; padding: 50px 30px; text-align: center; margin-bottom: 40px; box-shadow: 0 4px 15px rgba(0,0,0,0.08);">
<h1 style="font-size: 2.5rem; color: white; font-weight: 700; margin: 0 0 15px 0; text-shadow: 1px 1px 2px rgba(0,0,0,0.1);">Dashboard</h1>
<p style="color: rgba(255,255,255,0.95); font-size: 1rem; margin: 0 0 25px 0; font-weight: 500;">Sistem pengelolaan data akademik oleh Sapna Suryani</p>
<div style="display: inline-block; background: white; color: #f06292; padding: 12px 24px; border-radius: 20px; font-weight: 600; font-size: 1rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">Total Data Keseluruhan: <?= $total_mhs + $total_dosen + $total_mk + $total_per ?></div>
</div>

<div class="row g-4">
<div class="col-md-3">
<div style="background: white; border-radius: 12px; padding: 25px; text-align: center; box-shadow: 0 4px 15px rgba(0,0,0,0.08); transition: all 0.3s ease;">
<h5 style="color: #f06292; font-weight: 700; margin-bottom: 15px;">Data Dosen</h5>
<h2 style="font-size: 2.5rem; color: #f06292; margin: 0; font-weight: 700;">
<i class="fas fa-chalkboard-user" style="margin-right: 10px;"></i><?= $total_dosen ?>
</h2>
<p style="color: #999; font-size: 0.9rem; margin-top: 10px;">Jumlah: <?= $total_dosen ?></p>
</div>
</div>
<div class="col-md-3">
<div style="background: white; border-radius: 12px; padding: 25px; text-align: center; box-shadow: 0 4px 15px rgba(0,0,0,0.08); transition: all 0.3s ease;">
<h5 style="color: #f06292; font-weight: 700; margin-bottom: 15px;">Data Mahasiswa</h5>
<h2 style="font-size: 2.5rem; color: #f06292; margin: 0; font-weight: 700;">
<i class="fas fa-graduation-cap" style="margin-right: 10px;"></i><?= $total_mhs ?>
</h2>
<p style="color: #999; font-size: 0.9rem; margin-top: 10px;">Jumlah: <?= $total_mhs ?></p>
</div>
</div>
<div class="col-md-3">
<div style="background: white; border-radius: 12px; padding: 25px; text-align: center; box-shadow: 0 4px 15px rgba(0,0,0,0.08); transition: all 0.3s ease;">
<h5 style="color: #f06292; font-weight: 700; margin-bottom: 15px;">Mata Kuliah</h5>
<h2 style="font-size: 2.5rem; color: #f06292; margin: 0; font-weight: 700;">
<i class="fas fa-book" style="margin-right: 10px;"></i><?= $total_mk ?>
</h2>
<p style="color: #999; font-size: 0.9rem; margin-top: 10px;">Jumlah: <?= $total_mk ?></p>
</div>
</div>
<div class="col-md-3">
<div style="background: white; border-radius: 12px; padding: 25px; text-align: center; box-shadow: 0 4px 15px rgba(0,0,0,0.08); transition: all 0.3s ease;">
<h5 style="color: #f06292; font-weight: 700; margin-bottom: 15px;">Perkuliahan</h5>
<h2 style="font-size: 2.5rem; color: #f06292; margin: 0; font-weight: 700;">
<i class="fas fa-calendar-alt" style="margin-right: 10px;"></i><?= $total_per ?>
</h2>
<p style="color: #999; font-size: 0.9rem; margin-top: 10px;">Jumlah: <?= $total_per ?></p>
</div>
</div>
</div>

<?php } ?>

<!-- ================= MAHASISWA ================= -->
<?php if($page=="mahasiswa"){
$data = mysqli_query($conn,"SELECT * FROM datamahasiswa ORDER BY id_mhs DESC");
?>
<div class="card mb-4">
<div style="background: #f06292; color: white; padding: 15px 20px; font-weight: 600; border-radius: 8px 8px 0 0;">Data Mahasiswa</div>
<div class="card-body" style="padding: 20px;">
<h6 style="background: #f06292; color: white; padding: 12px 15px; margin: 0 -20px 20px -20px; border-radius: 8px; font-weight: 600;">Tambah Data Mahasiswa</h6>
<form action="simpan_mahasiswa.php" method="post">
<div class="mb-3">
<label class="form-label">Nama</label>
<input name="nama" class="form-control" required>
</div>
<div class="mb-3">
<label class="form-label">Jenis Kelamin</label>
<select name="jekel" class="form-control" required>
<option value="">Pilih Jenis Kelamin</option>
<option>Laki-laki</option>
<option>Perempuan</option>
</select>
</div>
<div class="mb-3">
<label class="form-label">Alamat</label>
<textarea name="alamat" class="form-control" required></textarea>
</div>
<div class="mb-3">
<label class="form-label">Prodi</label>
<input name="prodi" class="form-control" required>
</div>
<div class="mb-3">
<label class="form-label">No HP</label>
<input name="nohp" class="form-control" required>
</div>
<div class="d-flex justify-content-between align-items-center">
<button type="submit" class="btn" style="background-color: #f06292; border-color: #f06292; color: white; font-weight: 600;">Simpan</button>
<a href="index.php" class="text-decoration-none" style="color: #f06292; font-weight: 600;">Dashboard</a>
</div>
</form>
</div>
</div>

<div class="card">
<div style="background: #f0f0f0; padding: 15px 20px; font-weight: 600; border-radius: 8px 8px 0 0;">Data Mahasiswa</div>
<div class="table-responsive">
<table class="table table-hover mb-0">
<tr><th>No</th><th>Nama</th><th>JK</th><th>Alamat</th><th>Prodi</th><th>No HP</th><th>Aksi</th></tr>
<?php $no=1; while($d=mysqli_fetch_assoc($data)){ ?>
<tr>
<td><?= $no++ ?></td>
<td><?= $d['nama'] ?></td>
<td><?= $d['jekel'] ?></td>
<td><?= $d['alamat'] ?></td>
<td><?= $d['prodi'] ?></td>
<td><?= $d['nohp'] ?></td>
<td>
<a href="hapus.php?mhs=<?= $d['id_mhs'] ?>" onclick="return confirm('Hapus data?')" class="btn btn-danger btn-sm">Hapus</a>
</td>
</tr>
<?php } ?>
</table>
</div>
</div>
<?php } ?>

<!-- ================= DOSEN ================= -->
<?php if($page=="dosen"){
$data = mysqli_query($conn,"SELECT * FROM datadosen ORDER BY id_dosen DESC");
?>
<div class="card mb-4">
<div style="background: #f06292; color: white; padding: 15px 20px; font-weight: 600; border-radius: 8px 8px 0 0;">Data Dosen</div>
<div class="card-body" style="padding: 20px;">
<h6 style="background: #f06292; color: white; padding: 12px 15px; margin: 0 -20px 20px -20px; border-radius: 8px; font-weight: 600;">Tambah Data Dosen</h6>
<form action="simpan_dosen.php" method="post">
<div class="mb-3">
<label class="form-label">NIP</label>
<input name="nip" class="form-control" required>
</div>
<div class="mb-3">
<label class="form-label">Nama Dosen</label>
<input name="nama_dosen" class="form-control" required>
</div>
<div class="mb-3">
<label class="form-label">Bidang Keahlian</label>
<input name="bidang_keahlian" class="form-control" required>
</div>
<div class="mb-3">
<label class="form-label">No HP</label>
<input name="no_hp" class="form-control" required>
</div>
<div class="d-flex justify-content-between align-items-center">
<button type="submit" class="btn" style="background-color: #f06292; border-color: #f06292; color: white; font-weight: 600;">Simpan</button>
<a href="index.php" class="text-decoration-none" style="color: #f06292; font-weight: 600;">Dashboard</a>
</div>
</form>
</div>
</div>

<div class="card">
<div style="background: #f0f0f0; padding: 15px 20px; font-weight: 600; border-radius: 8px 8px 0 0;">Data Dosen</div>
<div class="table-responsive">
<table class="table table-hover mb-0">
<tr><th>No</th><th>NIP</th><th>Nama Dosen</th><th>Bidang Keahlian</th><th>No HP</th><th>Aksi</th></tr>
<?php $no=1; while($d=mysqli_fetch_assoc($data)){ ?>
<tr>
<td><?= $no++ ?></td>
<td><?= $d['nip'] ?></td>
<td><?= $d['nama_dosen'] ?></td>
<td><?= $d['bidang_keahlian'] ?></td>
<td><?= $d['no_hp'] ?></td>
<td>
<a href="hapus.php?dsn=<?= $d['id_dosen'] ?>" onclick="return confirm('Hapus data?')" class="btn btn-danger btn-sm">Hapus</a>
</td>
</tr>
<?php } ?>
</table>
</div>
</div>
<?php } ?>

<!-- ================= MATA KULIAH ================= -->
<?php if($page=="matakuliah"){
$data = mysqli_query($conn,"SELECT * FROM datamatakuliah ORDER BY id_mk DESC");
?>
<div class="card mb-4">
<div style="background: #f06292; color: white; padding: 15px 20px; font-weight: 600; border-radius: 8px 8px 0 0;">Data Mata Kuliah</div>
<div class="card-body" style="padding: 20px;">
<h6 style="background: #f06292; color: white; padding: 12px 15px; margin: 0 -20px 20px -20px; border-radius: 8px; font-weight: 600;">Tambah Data Mata Kuliah</h6>
<form action="simpan_matakuliah.php" method="post">
<div class="mb-3">
<label class="form-label">Kode MK</label>
<input name="kode_mk" class="form-control" required>
</div>
<div class="mb-3">
<label class="form-label">Nama Mata Kuliah</label>
<input name="nama_mk" class="form-control" required>
</div>
<div class="mb-3">
<label class="form-label">SKS</label>
<input type="number" name="sks" class="form-control" required>
</div>
<div class="mb-3">
<label class="form-label">Semester</label>
<input type="number" name="semester" class="form-control" required>
</div>
<div class="d-flex justify-content-between align-items-center">
<button type="submit" class="btn" style="background-color: #f06292; border-color: #f06292; color: white; font-weight: 600;">Simpan</button>
<a href="index.php" class="text-decoration-none" style="color: #f06292; font-weight: 600;">Dashboard</a>
</div>
</form>
</div>
</div>

<div class="card">
<div style="background: #f0f0f0; padding: 15px 20px; font-weight: 600; border-radius: 8px 8px 0 0;">Data Mata Kuliah</div>
<div class="table-responsive">
<table class="table table-hover mb-0">
<tr><th>No</th><th>Kode MK</th><th>Nama MK</th><th>SKS</th><th>Semester</th><th>Aksi</th></tr>
<?php $no=1; while($d=mysqli_fetch_assoc($data)){ ?>
<tr>
<td><?= $no++ ?></td>
<td><?= $d['kode_mk'] ?></td>
<td><?= $d['nama_mk'] ?></td>
<td><?= $d['sks'] ?></td>
<td><?= $d['semester'] ?></td>
<td>
<a href="hapus.php?mk=<?= $d['id_mk'] ?>" onclick="return confirm('Hapus data?')" class="btn btn-danger btn-sm">Hapus</a>
</td>
</tr>
<?php } ?>
</table>
</div>
</div>
<?php } ?>

<!-- ================= PERKULIAHAN ================= -->
<?php if($page=="perkuliahan"){
$mk  = mysqli_query($conn,"SELECT * FROM datamatakuliah");
$dsn = mysqli_query($conn,"SELECT * FROM datadosen");
$mhs = mysqli_query($conn,"SELECT * FROM datamahasiswa");
$per = mysqli_query($conn,"SELECT * FROM dataperkuliahan ORDER BY id_mk_perkuliahan DESC");
?>
<div class="card mb-4">
<div style="background: #f06292; color: white; padding: 15px 20px; font-weight: 600; border-radius: 8px 8px 0 0;">Data Perkuliahan</div>
<div class="card-body" style="padding: 20px;">
<h6 style="background: #f06292; color: white; padding: 12px 15px; margin: 0 -20px 20px -20px; border-radius: 8px; font-weight: 600;">Tambah Data Perkuliahan</h6>
<form action="simpan_perkuliahan.php" method="post">
<div class="mb-3">
<label class="form-label">Mata Kuliah</label>
<select name="id_mk" class="form-control" required>
<option value="">Pilih Mata Kuliah</option>
<?php while($d=mysqli_fetch_assoc($mk)){ ?>
<option value="<?= $d['id_mk'] ?>"><?= $d['nama_mk'] ?></option>
<?php } ?>
</select>
</div>

<div class="mb-3">
<label class="form-label">Dosen</label>
<select name="id_dosen" class="form-control" required>
<option value="">Pilih Dosen</option>
<?php while($d=mysqli_fetch_assoc($dsn)){ ?>
<option value="<?= $d['id_dosen'] ?>"><?= $d['nama_dosen'] ?></option>
<?php } ?>
</select>
</div>

<div class="mb-3">
<label class="form-label">Mahasiswa</label>
<select name="id_mhs" class="form-control" required>
<option value="">Pilih Mahasiswa</option>
<?php while($d=mysqli_fetch_assoc($mhs)){ ?>
<option value="<?= $d['id_mhs'] ?>"><?= $d['nama'] ?></option>
<?php } ?>
</select>
</div>

<div class="mb-3">
<label class="form-label">Ruang</label>
<input name="ruang" class="form-control" required>
</div>

<div class="mb-3">
<label class="form-label">Jadwal</label>
<input name="jadwal" class="form-control" required>
</div>

<div class="d-flex justify-content-between align-items-center">
<button type="submit" class="btn" style="background-color: #f06292; border-color: #f06292; color: white; font-weight: 600;">Simpan</button>
<a href="index.php" class="text-decoration-none" style="color: #f06292; font-weight: 600;">Dashboard</a>
</div>
</form>
</div>
</div>

<div class="card">
<div style="background: #f0f0f0; padding: 15px 20px; font-weight: 600; border-radius: 8px 8px 0 0;">Data Perkuliahan</div>
<div class="table-responsive">
<table class="table table-hover mb-0">
<tr><th>No</th><th>Mata Kuliah</th><th>Dosen</th><th>Mahasiswa</th><th>Ruang</th><th>Jadwal</th><th>Aksi</th></tr>
<?php $no=1; while($d=mysqli_fetch_assoc($per)){ ?>
<tr>
<td><?= $no++ ?></td>
<td><?= $d['nama_mk'] ?></td>
<td><?= $d['nama_dosen'] ?></td>
<td><?= $d['nama_mahasiswa'] ?></td>
<td><?= $d['ruang'] ?></td>
<td><?= $d['jadwal'] ?></td>
<td>
<a href="hapus.php?per=<?= $d['id_mk_perkuliahan'] ?>" onclick="return confirm('Hapus data?')" class="btn btn-danger btn-sm">Hapus</a>
</td>
</tr>
<?php } ?>
</table>
</div>
</div>
<?php } ?>

</div>

<script>
<?php if($page=="dashboard"){ ?>
const ctx = document.getElementById('statsChart').getContext('2d');
const statsChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Mahasiswa', 'Dosen', 'Mata Kuliah', 'Perkuliahan'],
        datasets: [{
            label: 'Jumlah',
            data: [<?= $total_mhs ?>, <?= $total_dosen ?>, <?= $total_mk ?>, <?= $total_per ?>],
            backgroundColor: [
                'rgba(59, 130, 246, 0.8)',
                'rgba(16, 185, 129, 0.8)',
                'rgba(245, 158, 11, 0.8)',
                'rgba(6, 182, 212, 0.8)'
            ],
            borderColor: [
                'rgba(59, 130, 246, 1)',
                'rgba(16, 185, 129, 1)',
                'rgba(245, 158, 11, 1)',
                'rgba(6, 182, 212, 1)'
            ],
            borderWidth: 2,
            borderRadius: 8,
            borderSkipped: false,
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                titleColor: '#fff',
                bodyColor: '#fff',
                cornerRadius: 8,
                displayColors: false
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    color: 'rgba(0, 0, 0, 0.1)'
                },
                ticks: {
                    color: '#64748b',
                    font: {
                        weight: '600'
                    }
                }
            },
            x: {
                grid: {
                    display: false
                },
                ticks: {
                    color: '#64748b',
                    font: {
                        weight: '600'
                    }
                }
            }
        },
        animation: {
            duration: 2000,
            easing: 'easeOutBounce'
        }
    }
});
<?php } ?>
</script>


</body>
</html>
