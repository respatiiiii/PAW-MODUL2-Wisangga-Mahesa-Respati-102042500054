<?php
require 'functions.php';
require 'connect.php';

// TODO 1 (RINGKASAN)
// Hitung jumlah baris di tabel mata_kuliah, materi, dan tugas,
// lalu hitung juga tugas yang statusnya 'Aktif'.
// Simpan hasilnya ke empat variabel di bawah ini (gunakan COUNT, bukan mengambil semua baris).
$res_mk = $conn->query('SELECT COUNT(*) AS total FROM mata_kuliah');
$jumlah_mata_kuliah = $res_mk->fetch_assoc()['total'];

$res_materi = $conn->query('SELECT COUNT(*) AS total FROM materi');
$jumlah_materi = $res_materi->fetch_assoc()['total'];

$res_tugas = $conn->query('SELECT COUNT(*) AS total FROM tugas');
$jumlah_tugas = $res_tugas->fetch_assoc()['total'];

$res_tugas_aktif = $conn->query("SELECT COUNT(*) AS total FROM tugas WHERE status = 'Aktif'");
$jumlah_tugas_aktif = $res_tugas_aktif->fetch_assoc()['total'];

$pilihan_mk = pilihan_mata_kuliah($conn);

$judul = 'Beranda';
require 'header.php';
?>
<p class="eyebrow">Learning Management System</p>
<h1 class="hero">Kelola perkuliahan dalam satu tempat.</h1>
<p class="muted">Pengelolaan mata kuliah, materi pembelajaran, dan tugas.</p>

<div class="stats">
    <a class="card stat" href="mata_kuliah.php">
        <b><?= (int) $jumlah_mata_kuliah ?></b>
        <span>Mata kuliah</span>
    </a>
    <a class="card stat" href="materi.php">
        <b><?= (int) $jumlah_materi ?></b>
        <span>Materi</span>
    </a>
    <a class="card stat" href="tugas.php">
        <b><?= (int) $jumlah_tugas ?></b>
        <span>Tugas</span>
    </a>
    <a class="card stat" href="tugas.php?status=Aktif">
        <b><?= (int) $jumlah_tugas_aktif ?></b>
        <span>Tugas aktif</span>
    </a>
</div>

<h2>Mata kuliah tersedia</h2>
<?php if (count($pilihan_mk) === 0): ?>
    <p class="empty">Belum ada mata kuliah.</p>
<?php else: ?>
    <div class="card list">
        <?php foreach ($pilihan_mk as $id => $nama): ?>
            <a class="list-item" href="mata_kuliah.php?aksi=detail&id=<?= (int) $id ?>"><?= h($nama) ?></a>
        <?php endforeach ?>
    </div>
<?php endif ?>
<?php require 'footer.php'; ?>
