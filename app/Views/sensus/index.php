<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Sensus Penduduk</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    /* ======= BACKGROUND & FONT ======= */
    body {
        background: 
            linear-gradient(rgba(240, 248, 255, 0.8), rgba(245, 248, 250, 0.9)),
            url('/assets/img/background.jpg') no-repeat center center fixed;
        background-size: cover;
        min-height: 100vh;
        font-family: "Poppins", sans-serif;
        margin: 0;
    }

    /* ======= HEADER ======= */
    .header-bar {
        background: rgba(13, 110, 253, 0.85);
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 0 0 12px 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        display: flex;
        justify-content: space-between;
        align-items: center;
        animation: slideDown .6s ease-out;
    }

    .header-bar h2 {
        margin: 0;
        font-size: 1.6rem;
        font-weight: 600;
    }

    @keyframes slideDown {
        0% {opacity: 0; transform: translateY(-20px);}
        100% {opacity: 1; transform: translateY(0);}
    }

    /* ======= CARD CONTAINER ======= */
    .main-card {
        background: rgba(255,255,255,0.9);
        backdrop-filter: blur(8px);
        border-radius: 16px;
        padding: 2rem;
        margin-top: 2rem;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        animation: fadeIn 1s ease-in;
    }

    @keyframes fadeIn {
        0% {opacity: 0; transform: translateY(15px);}
        100% {opacity: 1; transform: translateY(0);}
    }

    /* ======= SEARCH BAR ======= */
    .search-form input {
        border-radius: 10px 0 0 10px;
    }

    .search-form button,
    .search-form a {
        border-radius: 0 10px 10px 0;
    }

    /* ======= TABEL ======= */
    table thead {
        background: linear-gradient(90deg, #007bff, #00bcd4);
        color: white;
    }

    table tbody tr:hover {
        background-color: rgba(0,123,255,0.1);
        transition: background 0.3s;
    }

    .table td, .table th {
        vertical-align: middle;
    }

    /* ======= BUTTON STYLE ======= */
    .btn-primary {
        background: linear-gradient(45deg, #007bff, #00bcd4);
        border: none;
        border-radius: 10px;
        transition: transform 0.2s ease-in-out;
    }

    .btn-primary:hover {
        transform: scale(1.05);
        background: linear-gradient(45deg, #0056b3, #0097a7);
    }

    .btn-warning, .btn-danger {
        border: none;
        transition: transform 0.2s ease-in-out;
        border-radius: 8px;
    }

    .btn-warning:hover, .btn-danger:hover {
        transform: scale(1.05);
    }

    /* ======= FOOTER ======= */
    footer {
        text-align: center;
        color: #666;
        font-size: 0.9rem;
        padding: 1rem;
        margin-top: 2rem;
    }
</style>
</head>

<body>

<!-- ===== HEADER ===== -->
<div class="header-bar">
    <h2>📊 Dashboard Sensus Penduduk</h2>
    <div>
        <a href="/sensus/create" class="btn btn-light btn-sm fw-semibold me-2">+ Tambah Penduduk</a>
        <span class="me-3">👤 <?= esc($username) ?></span>
        <a href="/logout" class="btn btn-outline-light btn-sm">Logout</a>
    </div>
</div>

<div class="container py-4">
    <!-- Flash Message -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            <?= session()->getFlashdata('success'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php elseif (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            <?= session()->getFlashdata('error'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Search -->
    <form method="get" action="/sensus" class="search-form d-flex mb-4">
        <input type="text" name="keyword" class="form-control" placeholder="Cari nama, kota, provinsi..." 
               value="<?= esc($keyword ?? '') ?>">
        <button class="btn btn-outline-primary" type="submit">Cari</button>
        <a href="/sensus" class="btn btn-outline-danger ms-2">Reset</a>
    </form>

    <!-- Card Data -->
    <div class="main-card">
        <table class="table table-hover table-bordered align-middle text-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>NIK</th>
                    <th>Alamat</th>
                    <th>Kota</th>
                    <th>Provinsi</th>
                    <th>Jenis Kelamin</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($sensus)) : ?>
                    <?php foreach ($sensus as $i => $s) : ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= esc($s['nama_penduduk']) ?></td>
                        <td><?= esc($s['nik']) ?></td>
                        <td><?= esc($s['alamat']) ?></td>
                        <td><?= esc($s['nama_kota']) ?></td>
                        <td><?= esc($s['nama_provinsi']) ?></td>
                        <td><?= $s['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan' ?></td>
                        <td>
                            <a href="/sensus/edit/<?= $s['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="/sensus/delete/<?= $s['id'] ?>" class="btn btn-sm btn-danger"
                               onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr><td colspan="8" class="text-muted text-center">Belum ada data penduduk.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<footer>
    © <?= date('Y') ?> Sistem Sensus Indonesia — Dibuat oleh Kevin Saputra Rustian
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
