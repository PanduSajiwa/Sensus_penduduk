<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Penduduk</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<style>
body {
    background: linear-gradient(135deg, #007bff, #00bcd4);
    font-family: "Poppins", sans-serif;
    margin: 0;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* ===== CARD ===== */
.card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(8px);
    border-radius: 18px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    width: 100%;
    max-width: 550px;
    animation: fadeIn 0.8s ease-in-out;
    overflow: hidden;
}

.card-header {
    background: linear-gradient(90deg, #007bff, #00bcd4);
    color: white;
    text-align: center;
    padding: 1.2rem;
    font-weight: 600;
    font-size: 1.2rem;
    letter-spacing: 0.5px;
}

/* ===== FORM ELEMENTS ===== */
label.form-label {
    font-weight: 500;
    color: #333;
}

input.form-control, textarea.form-control, select.form-select {
    border-radius: 10px;
    transition: all 0.3s;
    border: 1px solid #ddd;
}

input.form-control:focus, textarea.form-control:focus, select.form-select:focus {
    box-shadow: 0 0 10px rgba(0,123,255,0.4);
    border-color: #007bff;
}

/* ===== BUTTONS ===== */
.btn-secondary, .btn-warning {
    border: none;
    border-radius: 10px;
    padding: 0.6rem 1.2rem;
    font-weight: 500;
    transition: transform 0.2s ease-in-out;
}

.btn-warning {
    background: linear-gradient(45deg, #ffca28, #ff9800);
    color: white;
}

.btn-secondary {
    background: linear-gradient(45deg, #90a4ae, #607d8b);
    color: white;
}

.btn-warning:hover, .btn-secondary:hover {
    transform: scale(1.05);
}

/* ===== ANIMASI ===== */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

/* ===== RESPONSIVE ===== */
@media (max-width: 576px) {
    .card {
        margin: 1rem;
    }
}
</style>
</head>

<body>
<div class="container py-5">
    <div class="card">
        <div class="card-header">
            <i class="bi bi-pencil-square"></i> Edit Data Penduduk
        </div>
        <div class="card-body p-4">
            <form action="/sensus/update/<?= $sensus['id'] ?>" method="post">
                
                <div class="mb-3">
                    <label class="form-label">Nama Penduduk</label>
                    <input type="text" name="nama_penduduk" class="form-control" 
                           value="<?= $sensus['nama_penduduk'] ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">NIK</label>
                    <input type="text" name="nik" class="form-control"
                           value="<?= $sensus['nik'] ?>" required maxlength="16" 
                           pattern="\d{16}" title="NIK harus 16 digit angka saja"
                           oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                           placeholder="16 digit angka">
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="2" required><?= $sensus['alamat'] ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kota</label>
                    <select name="id_kota" class="form-select" required>
                        <?php foreach ($kota as $k): ?>
                            <option value="<?= $k['id'] ?>" <?= $k['id'] == $sensus['id_kota'] ? 'selected' : '' ?>>
                                <?= $k['nama_kota'] ?> (<?= $k['nama_provinsi'] ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control" 
                               value="<?= $sensus['tanggal_lahir'] ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-select" required>
                            <option value="L" <?= $sensus['jenis_kelamin'] == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                            <option value="P" <?= $sensus['jenis_kelamin'] == 'P' ? 'selected' : '' ?>>Perempuan</option>
                        </select>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="/sensus" class="btn btn-secondary">
                        <i class="bi bi-arrow-left-circle"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-save2-fill"></i> Perbarui
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
