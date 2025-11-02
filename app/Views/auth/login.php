<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Login • Sistem Sensus Indonesia</title>

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

  <style>
    :root {
      --accent1: #06b6d4;
      --accent2: #2563eb;
      --text-light: rgba(255,255,255,0.9);
      --card-bg: rgba(255, 255, 255, 0.15);
      --border: rgba(255, 255, 255, 0.25);
    }

    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Poppins', sans-serif;
      color: #fff;
      background: linear-gradient(115deg, #1e3a8a 0%, #0f172a 40%, #0e7490 100%);
      overflow: hidden;
    }

    /* Background Blur Overlay */
    .overlay {
      position: fixed;
      inset: 0;
      background: url("<?= base_url('') ?>") center/cover no-repeat;
      filter: blur(10px) brightness(0.65);
      z-index: 0;
    }

    .login-container {
      position: relative;
      z-index: 2;
      width: 100%;
      max-width: 900px;
      display: grid;
      grid-template-columns: 1fr 380px;
      gap: 36px;
      padding: 24px;
    }

    /* Left Panel */
    .info-panel {
      display: flex;
      flex-direction: column;
      justify-content: center;
      padding: 32px;
      background: var(--card-bg);
      border: 1px solid var(--border);
      border-radius: 20px;
      backdrop-filter: blur(14px);
      box-shadow: 0 10px 40px rgba(0,0,0,0.3);
      animation: fadeIn 0.7s ease-out;
    }

    .logo {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 16px;
    }

    .logo-mark {
      width: 56px;
      height: 56px;
      background: linear-gradient(135deg, var(--accent1), var(--accent2));
      border-radius: 14px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 700;
      font-size: 20px;
      box-shadow: 0 4px 18px rgba(37,99,235,0.35);
    }

    .info-panel h2 {
      font-weight: 600;
      font-size: 20px;
      margin-bottom: 12px;
      color: var(--text-light);
    }

    .info-panel p {
      font-size: 14px;
      color: rgba(255,255,255,0.85);
      margin-bottom: 18px;
      line-height: 1.6;
    }

    .info-panel ul {
      margin: 0;
      padding-left: 18px;
      font-size: 13px;
      color: rgba(255,255,255,0.9);
    }

    .info-panel li {
      margin-bottom: 6px;
    }

    /* Login Card */
    .login-card {
      background: var(--card-bg);
      border: 1px solid var(--border);
      border-radius: 20px;
      padding: 30px;
      backdrop-filter: blur(20px);
      box-shadow: 0 10px 40px rgba(0,0,0,0.4);
      animation: slideIn 0.7s ease-out;
    }

    .login-card h3 {
      text-align: center;
      font-size: 20px;
      margin-bottom: 10px;
      color: var(--text-light);
    }

    .login-card .sub {
      text-align: center;
      font-size: 13px;
      color: rgba(255,255,255,0.75);
      margin-bottom: 22px;
    }

    .field {
      position: relative;
      margin-bottom: 16px;
    }

    .field input {
      width: 100%;
      padding: 12px 44px;
      border: none;
      border-radius: 12px;
      font-size: 14px;
      color: #111;
      background: rgba(255,255,255,0.92);
      outline: none;
      transition: 0.2s ease;
    }

    .field input:focus {
      box-shadow: 0 0 0 2px var(--accent2);
    }

    .field svg {
      position: absolute;
      top: 50%;
      left: 14px;
      transform: translateY(-50%);
      color: var(--accent2);
    }

    .control {
      position: absolute;
      right: 12px;
      top: 50%;
      transform: translateY(-50%);
      background: transparent;
      border: none;
      cursor: pointer;
    }

    .btn {
      width: 100%;
      padding: 12px;
      border: none;
      border-radius: 12px;
      font-weight: 600;
      font-size: 15px;
      color: #fff;
      cursor: pointer;
      background: linear-gradient(90deg, var(--accent1), var(--accent2));
      box-shadow: 0 8px 20px rgba(37,99,235,0.35);
      transition: 0.2s ease;
    }

    .btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 12px 30px rgba(37,99,235,0.45);
    }

    .row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-size: 13px;
      color: rgba(255,255,255,0.85);
      margin-top: 8px;
      margin-bottom: 10px;
    }

    .forgot a {
      color: rgba(255,255,255,0.9);
      text-decoration: none;
    }

    .forgot a:hover {
      text-decoration: underline;
    }

    .watermark {
      text-align: center;
      font-size: 12px;
      color: rgba(255,255,255,0.65);
      margin-top: 14px;
    }

    @media(max-width: 860px) {
      .login-container {
        grid-template-columns: 1fr;
      }
      .info-panel {
        display: none;
      }
    }

    @keyframes slideIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }
  </style>
</head>

<body>
  <div class="overlay"></div>

  <div class="login-container">
    <!-- Left Information Panel -->
    <div class="info-panel">
      <div class="logo">
        <div class="logo-mark">SG</div>
        <div>
          <strong>Sensus Indonesia - Sajiwa Group</strong><br>
          <span style="font-size:12px;color:rgba(255,255,255,0.8)">Sistem Sensus Indonesia</span>
        </div>
      </div>

      <h2>Portal Petugas & Administrator</h2>
      <p>Kelola data sensus dengan cepat dan efisien.</p>

      <ul>
        <li>Pagination & pencarian nama penduduk</li>
        <li>Master data provinsi & kota</li>
      </ul>

      <p style="margin-top:auto;font-size:13px;">Butuh bantuan? Hubungi tim IT.</p>
    </div>

    <!-- Login Card -->
    <div class="login-card">
      <h3>🔐 Login Sensus Indonesia</h3>
      <div class="sub">Masuk menggunakan akun</div>

      <?php if (session()->getFlashdata('msg')): ?>
        <div style="background:rgba(255,80,80,0.2);padding:10px;border-radius:8px;margin-bottom:12px;color:#fff;">
          <?= session()->getFlashdata('msg') ?>
        </div>
      <?php endif; ?>

      <form action="<?= base_url('login') ?>" method="post" onsubmit="return submitDisabled(this)">
        <div class="field">
          <svg width="20" height="20" fill="none" stroke="#2563eb" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
          <input id="username" name="username" type="text" placeholder="Nama pengguna" required />
        </div>

        <div class="field">
          <svg width="20" height="20" fill="none" stroke="#2563eb" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
          <input id="password" name="password" type="password" placeholder="Kata sandi" required />
          <button type="button" class="control" onclick="togglePass()">
            <svg id="eye" width="18" height="18" fill="none" stroke="#333" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s4-7 10-7 10 7 10 7-4 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/></svg>
          </button>
        </div>

        <div class="row">
          <label><input type="checkbox" style="margin-right:6px;"> Ingat saya</label>
          <div class="forgot"><a href="<?= base_url('#') ?>">Lupa kata sandi?</a></div>
        </div>

        <button class="btn" type="submit">Log In</button>
      </form>

      <div class="watermark">© <?= date('Y') ?> • Sistem Sensus Indonesia</div>
      <div class="watermark"> <?= date('') ?> Powered By Sajiwa Group</div>
    </div>
  </div>

  <script>
    function togglePass() {
      const input = document.getElementById('password');
      const eye = document.getElementById('eye');
      if (input.type === 'password') {
        input.type = 'text';
        eye.innerHTML = '<path d="M2 12s4-7 10-7 10 7 10 7-4 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/>';
      } else {
        input.type = 'password';
        eye.innerHTML = '<path d="M17.94 17.94A10.94 10.94 0 0 1 12 19c-6 0-10-7-10-7a21.44 21.44 0 0 1 5.06-4.94"/><path d="M1 1l22 22"/>';
      }
    }

    function submitDisabled(form) {
      const btn = form.querySelector('button[type="submit"]');
      if (btn) btn.disabled = true;
      return true;
    }
  </script>
</body>
</html>
