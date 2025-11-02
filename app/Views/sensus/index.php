<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Sensus Penduduk</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>
    body {
        background: linear-gradient(135deg, #007bff, #00bcd4);
        font-family: "Poppins", sans-serif;
        margin: 0;
        display: flex;
        min-height: 100vh;
        color: #333;
    }

    /* ===== SIDEBAR ===== */
    .sidebar {
        width: 250px;
        background: rgba(255,255,255,0.15);
        backdrop-filter: blur(12px);
        color: #fff;
        padding: 1.5rem 1rem;
        box-shadow: 4px 0 15px rgba(0,0,0,0.2);
        display: flex;
        flex-direction: column;
        transition: all 0.3s ease-in-out;
    }

    .sidebar h4 {
        font-weight: 600;
        margin-bottom: 2rem;
        text-align: center;
        color: #fff;
    }

    .sidebar a {
        color: #fff;
        text-decoration: none;
        padding: 0.7rem 1rem;
        border-radius: 10px;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: background 0.3s, transform 0.2s;
    }

    .sidebar a:hover, .sidebar a.active {
        background: rgba(255,255,255,0.25);
        transform: translateX(5px);
    }

    .sidebar hr {
        border-color: rgba(255,255,255,0.2);
        margin: 1.5rem 0;
    }

    /* ===== CONTENT AREA ===== */
    .content {
        flex: 1;
        padding: 2rem;
        color: #333;
    }

    .header-bar {
        background: linear-gradient(90deg, #0052cc, #007bff);
        color: #fff;
        padding: 1rem 1.5rem;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .header-bar h2 {
        font-size: 1.4rem;
        margin: 0;
    }

    .main-card {
        background: rgba(255,255,255,0.95);
        backdrop-filter: blur(8px);
        border-radius: 16px;
        padding: 2rem;
        margin-top: 2rem;
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        animation: fadeIn 0.7s ease;
    }

    @keyframes fadeIn {
        from {opacity: 0; transform: translateY(15px);}
        to {opacity: 1; transform: translateY(0);}
    }

    table thead {
        background: linear-gradient(90deg, #007bff, #00bcd4);
        color: white;
    }

    table tbody tr:hover {
        background-color: rgba(0,123,255,0.08);
        transition: 0.3s;
    }

    .btn-primary {
        background: linear-gradient(45deg, #007bff, #00bcd4);
        border: none;
        border-radius: 10px;
    }

    .btn-primary:hover {
        background: linear-gradient(45deg, #0056b3, #0097a7);
        transform: scale(1.05);
    }

    footer {
        text-align: center;
        font-size: 0.9rem;
        color: #444;
        margin-top: 2rem;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .sidebar {
            position: fixed;
            left: -260px;
            top: 0;
            height: 100%;
            z-index: 999;
        }

        .sidebar.active {
            left: 0;
        }

        #menuToggle {
            display: block;
        }

        .content {
            padding: 1rem;
        }
    }

    #menuToggle {
        display: none;
        background: none;
        border: none;
        color: white;
        font-size: 1.6rem;
        cursor: pointer;
    }
</style>
</head>

<body>

<!-- ===== SIDEBAR ===== -->
<div class="sidebar" id="sidebar">
    <h4><i class="bi bi-people-fill"></i> Sensus</h4>
    <a href="/dashboard" class="active"><i class="bi bi-speedometer2"></i> Dashboard</a>
    <a href="/sensus/create"><i class="bi bi-person-plus"></i> Tambah Penduduk</a>
    <a href="/sensus"><i class="bi bi-card-list"></i> Data Penduduk</a>
    <a href="/laporan"><i class="bi bi-bar-chart"></i> Laporan</a>
    <hr>
    <a href="/logout" class="text-danger"><i class="bi bi-box-arrow-right"></i> Logout</a>
</div>

<!-- ===== MAIN CONTENT ===== -->
<div class="content">
    <div class="header-bar">
        <div class="d-flex align-items-center gap-3">
            <button id="menuToggle" class="btn"><i class="bi bi-list"></i></button>
            <h2>📊 Dashboard Sensus Indonesia</h2>
        </div>
        <div>
            <span class="me-3">👤 <?= esc($username) ?></span>
        </div>
    </div>

    <div class="container-fluid py-4">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
        <?php elseif (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
        <?php endif; ?>

        <form method="get" action="/sensus" class="d-flex mb-4">
            <input type="text" name="keyword" class="form-control" placeholder="Cari nama, kota, provinsi..."
                   value="<?= esc($keyword ?? '') ?>">
            <button class="btn btn-outline-primary ms-2" type="submit">Cari</button>
            <a href="/sensus" class="btn btn-outline-danger ms-2">Reset</a>
        </form>

        <div class="main-card">
            <table class="table table-hover table-bordered text-center align-middle">
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
                        <tr><td colspan="8" class="text-muted">Belum ada data penduduk.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <footer>© <?= date('Y') ?> Sistem Sensus Indonesia — Powered By Sajiwa Group</footer>
</div>

<script>
    const sidebar = document.getElementById('sidebar');
    const toggle = document.getElementById('menuToggle');
    toggle.addEventListener('click', () => {
        sidebar.classList.toggle('active');
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
