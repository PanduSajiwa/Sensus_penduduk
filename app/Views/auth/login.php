<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Masuk — Sistem Sensus</title>

  <!-- Google font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

  <style>
    :root{
      --card-bg: rgba(255,255,255,0.12);
      --card-border: rgba(255,255,255,0.18);
      --accent-1: #06b6d4; /* teal */
      --accent-2: #2563eb; /* indigo */
      --muted: rgba(255,255,255,0.85);
    }
    *{box-sizing:border-box}
    html,body{height:100%;margin:0;font-family:"Inter",system-ui,-apple-system,"Segoe UI",Roboto,"Helvetica Neue",Arial;}
    body{
      background: url("<?= base_url('assets/img/bg-login.jpg') ?>") center/cover no-repeat fixed;
      display:flex;align-items:center;justify-content:center;
      -webkit-font-smoothing:antialiased;
      -moz-osx-font-smoothing:grayscale;
      color: #fff;
    }

    /* subtle dark overlay for legibility */
    .bg-overlay{
      position:fixed;inset:0;background:linear-gradient(180deg, rgba(2,6,23,0.35), rgba(2,6,23,0.30));
      z-index:0;
    }

    /* container */
    .wrap{
      position:relative;z-index:2;
      width:92%;max-width:920px;
      display:grid;
      grid-template-columns: 1fr 420px;
      gap:28px;
      align-items:center;
      padding:32px;
    }

    /* left promotional panel */
    .promo{
      display:flex;flex-direction:column;gap:18px;padding:28px;border-radius:14px;
      background: linear-gradient(180deg, rgba(255,255,255,0.06), rgba(255,255,255,0.03));
      border:1px solid rgba(255,255,255,0.04);
      box-shadow: 0 8px 30px rgba(2,6,23,0.45);
      min-height:360px;
      backdrop-filter: blur(6px);
    }
    .promo .logo{
      display:flex;align-items:center;gap:12px;
    }
    .logo .mark{
      width:64px;height:64px;border-radius:12px;background:linear-gradient(135deg,var(--accent-1),var(--accent-2));
      display:flex;align-items:center;justify-content:center;font-weight:700;color:#fff;
      box-shadow:0 6px 18px rgba(37,99,235,0.22);
    }
    .promo h3{margin:0;font-size:20px;color:var(--muted);font-weight:700}
    .promo p{margin:0;color:rgba(255,255,255,0.85);line-height:1.45}
    .promo ul{margin:14px 0 0 18px;color:rgba(255,255,255,0.88);}
    .promo li{margin:8px 0; font-size:14px;}

    /* login card */
    .card{
      margin-left:auto;
      width:100%;
      background: var(--card-bg);
      border-radius: 16px;
      border: 1px solid var(--card-border);
      padding:28px;
      box-shadow: 0 10px 40px rgba(2,6,23,0.45);
      backdrop-filter: blur(10px);
      transform-origin:center;
      animation: popIn .45s cubic-bezier(.2,.9,.2,1);
    }

    @keyframes popIn{
      from{opacity:0; transform: translateY(18px) scale(.995)}
      to{opacity:1; transform: translateY(0) scale(1)}
    }

    .card h2{margin:0 0 18px 0;font-size:20px;color:var(--muted);text-align:center}
    .sub{font-size:13px;color:rgba(255,255,255,0.75);text-align:center;margin-bottom:18px}

    /* form fields */
    .field{
      position:relative;margin-bottom:14px;
    }
    .field input{
      width:100%;padding:12px 44px 12px 44px;border-radius:12px;border:none;background:rgba(255,255,255,0.92);color:#111;font-size:14px;
      outline:none;transition:box-shadow .18s,transform .18s;
    }
    .field input:focus{box-shadow:0 6px 18px rgba(37,99,235,0.12);transform:translateY(-1px)}

    /* left icon inside field */
    .field .icon{
      position:absolute;left:12px;top:50%;transform:translateY(-50%);width:20px;height:20px;opacity:.95;
      display:flex;align-items:center;justify-content:center;color:#2563eb;
    }
    /* right control (toggle) */
    .field .control{
      position:absolute;right:10px;top:50%;transform:translateY(-50%);background:transparent;border:none;color:#333;padding:6px;border-radius:8px;cursor:pointer;
    }

    .row{
      display:flex;gap:12px;align-items:center;justify-content:space-between;margin-top:6px;margin-bottom:6px;
    }
    .checkbox{
      display:flex;gap:8px;align-items:center;color:rgba(255,255,255,0.9);font-size:13px;
    }
    .checkbox input{width:16px;height:16px;accent-color:var(--accent-2)}

    .forgot a{color:rgba(255,255,255,0.85);text-decoration:none;font-size:13px}
    .forgot a:hover{text-decoration:underline}

    /* primary button */
    .btn{
      width:100%;padding:12px;border-radius:12px;border:none;color:#fff;font-weight:600;font-size:15px;background:linear-gradient(90deg,var(--accent-1),var(--accent-2));
      box-shadow:0 10px 30px rgba(37,99,235,0.14);cursor:pointer;transition:transform .12s ease,box-shadow .12s ease;
    }
    .btn:active{transform:translateY(1px)}
    .btn:hover{box-shadow:0 14px 40px rgba(37,99,235,0.20);transform:translateY(-2px)}

    /* footer watermark */
    .watermark{text-align:center;margin-top:12px;font-size:12px;color:rgba(255,255,255,0.65)}

    /* responsiveness */
    @media (max-width:880px){
      .wrap{grid-template-columns:1fr; padding:18px}
      .promo{order:2}
      .card{order:1}
    }
  </style>
</head>
<body>
  <div class="bg-overlay"></div>

  <div class="wrap">
    <!-- left promo / branding -->
    <div class="promo" aria-hidden="true">
      <div class="logo">
        <div class="mark">SP</div>
        <div>
          <div style="font-size:14px;color:rgba(255,255,255,0.9);font-weight:700">SensusID</div>
          <div style="font-size:12px;color:rgba(255,255,255,0.75)">Sistem Pendataan Terintegrasi</div>
        </div>
      </div>

      <h3 style="color:rgba(255,255,255,0.95);margin-top:12px">Portal Petugas & Administrator</h3>
      <p>Kelola data sensus: input, edit, hapus, dan analisis sederhana. Akses menggunakan akun terdaftar.</p>

      <ul>
        <li>API terproteksi JWT (token 5 hari)</li>
        <li>Pagination & pencarian nama penduduk</li>
        <li>Master data provinsi & kota</li>
      </ul>

      <div style="margin-top:auto;font-size:13px;color:rgba(255,255,255,0.8)">Butuh bantuan? Hubungi tim IT.</div>
    </div>

    <!-- login card -->
    <div class="card" role="region" aria-label="Login form">
      <h2>🔒 Login Sistem Sensus Penduduk</h2>
      <div class="sub">Masuk menggunakan akun petugas atau administrator</div>

      <!-- flash message -->
      <?php if (session()->getFlashdata('msg')): ?>
        <div style="background:rgba(255,80,80,0.12);padding:10px;border-radius:8px;margin-bottom:12px;color:#fff">
          <?= session()->getFlashdata('msg') ?>
        </div>
      <?php endif; ?>

      <form action="<?= base_url('login') ?>" method="post" autocomplete="on" onsubmit="return submitDisabled(this)">
        <!-- username -->
        <div class="field">
          <div class="icon" aria-hidden="true">
            <!-- user icon -->
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
          </div>
          <input id="username" name="username" type="text" placeholder="Nama pengguna" required />
        </div>

        <!-- password -->
        <div class="field">
          <div class="icon" aria-hidden="true">
            <!-- lock icon -->
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
          </div>
          <input id="password" name="password" type="password" placeholder="Kata sandi" required />
          <button type="button" class="control" title="Toggle show password" onclick="togglePass()" aria-label="Tampilkan kata sandi">
            <svg id="eye" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#333" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s4-7 10-7 10 7 10 7-4 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/></svg>
          </button>
        </div>

        <div class="row">
          <label class="checkbox"><input type="checkbox" name="remember" /> Ingat saya</label>
          <div class="forgot"><a href="<?= base_url('#') ?>">Lupa kata sandi?</a></div>
        </div>

        <div style="margin-top:18px">
          <button class="btn" type="submit">Masuk ke Dashboard</button>
        </div>
      </form>

      <div class="watermark">© <?= date('Y') ?> • Sistem Sensus Indonesia</div>
    </div>
  </div>

  <script>
    function togglePass(){
      const p = document.getElementById('password');
      const eye = document.getElementById('eye');
      if (p.type === 'password'){
        p.type = 'text';
        eye.innerHTML = '<path d="M2 12s4-7 10-7 10 7 10 7-4 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/>';
      } else {
        p.type = 'password';
        eye.innerHTML = '<path d="M17.94 17.94A10.94 10.94 0 0 1 12 19c-6 0-10-7-10-7a21.44 21.44 0 0 1 5.06-4.94"/><path d="M1 1l22 22"/>';
      }
    }

    /* prevent double submit */
    function submitDisabled(form){
      const btn = form.querySelector('button[type="submit"]');
      if (btn) btn.disabled = true;
      return true;
    }
  </script>
</body>
</html>
