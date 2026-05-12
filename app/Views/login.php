<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Kasir UMKM Pintar</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --hijau: #16a34a;
            --hijau-hover: #15803d;
            --hijau-muda: #dcfce7;
            --abu-bg: #f8fafc;
            --abu-garis: #e2e8f0;
            --teks-gelap: #0f172a;
            --teks-abu: #64748b;
            --merah: #dc2626;
            --merah-muda: #fef2f2;
            --putih: #ffffff;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--abu-bg);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        /* Background dekoratif */
        body::before {
            content: '';
            position: fixed; inset: 0;
            background:
                radial-gradient(ellipse 60% 50% at 20% 20%, rgba(22,163,74,0.07) 0%, transparent 60%),
                radial-gradient(ellipse 50% 40% at 80% 80%, rgba(37,99,235,0.05) 0%, transparent 60%);
            pointer-events: none;
        }

        .wrapper {
            width: 100%;
            max-width: 400px;
            position: relative;
        }

        /* Logo di atas card */
        .logo-area {
            text-align: center;
            margin-bottom: 24px;
        }
        .logo-bulat {
            width: 64px; height: 64px;
            background: var(--hijau);
            border-radius: 20px;
            display: flex; align-items: center; justify-content: center;
            font-size: 30px;
            margin: 0 auto 14px;
            box-shadow: 0 8px 24px rgba(22,163,74,0.25);
        }
        .logo-area h2 { font-size: 1.4rem; font-weight: 800; color: var(--teks-gelap); }
        .logo-area p { font-size: 0.85rem; color: var(--teks-abu); margin-top: 4px; }

        /* Kartu Form */
        .kartu-login {
            background: var(--putih);
            border-radius: 20px;
            border: 1px solid var(--abu-garis);
            padding: 32px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.06);
        }

        /* Pesan Error */
        .alert-error {
            background: var(--merah-muda);
            border: 1px solid #fecaca;
            color: var(--merah);
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 0.82rem;
            font-weight: 600;
            margin-bottom: 20px;
            display: flex; align-items: center; gap: 8px;
        }

        /* Field Input */
        .field { margin-bottom: 16px; }
        .field label {
            display: block;
            font-size: 0.8rem; font-weight: 700;
            color: var(--teks-gelap);
            margin-bottom: 6px;
        }
        .field input {
            width: 100%;
            padding: 11px 14px;
            border: 1.5px solid var(--abu-garis);
            border-radius: 10px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.9rem;
            color: var(--teks-gelap);
            background: var(--putih);
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
        }
        .field input:focus {
            border-color: var(--hijau);
            box-shadow: 0 0 0 3px rgba(22,163,74,0.12);
        }
        .field input::placeholder { color: #cbd5e1; }

        /* Tombol Masuk */
        .btn-masuk {
            width: 100%;
            padding: 13px;
            background: var(--hijau);
            color: white;
            border: none;
            border-radius: 12px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.95rem;
            font-weight: 700;
            cursor: pointer;
            margin-top: 8px;
            transition: all 0.2s;
            letter-spacing: 0.02em;
        }
        .btn-masuk:hover {
            background: var(--hijau-hover);
            transform: translateY(-1px);
            box-shadow: 0 4px 14px rgba(22,163,74,0.3);
        }
        .btn-masuk:active { transform: scale(0.98); }

        /* Link bawah */
        .link-bawah {
            text-align: center;
            margin-top: 20px;
            font-size: 0.8rem;
            color: var(--teks-abu);
        }
        .link-bawah a { color: var(--hijau); text-decoration: none; font-weight: 600; }
        .link-bawah a:hover { text-decoration: underline; }

        /* Divider teks bantuan */
        .info-bantuan {
            text-align: center;
            margin-top: 28px;
            padding: 12px 16px;
            background: var(--hijau-muda);
            border-radius: 10px;
            font-size: 0.78rem;
            color: var(--hijau);
            font-weight: 600;
        }
    </style>
</head>
<body>

<div class="wrapper">
    <div class="logo-area">
        <div class="logo-bulat">🏪</div>
        <h2>Kasir UMKM Pintar</h2>
        <p>Masukkan akun untuk melanjutkan</p>
    </div>

    <div class="kartu-login">
        <?php if(session()->getFlashdata('error')): ?>
        <div class="alert-error">
            ⚠️ <?= session()->getFlashdata('error') ?>
        </div>
        <?php endif; ?>

        <form action="/auth/proses" method="POST">
            <div class="field">
                <label for="username">👤 Username</label>
                <input type="text" id="username" name="username" placeholder="Masukkan username" required autocomplete="username">
            </div>
            <div class="field">
                <label for="password">🔒 Password</label>
                <input type="password" id="password" name="password" placeholder="Masukkan password" required autocomplete="current-password">
            </div>
            <button type="submit" class="btn-masuk">Masuk ke Kasir →</button>
        </form>
        <div class="link-bawah">
            Belum punya akun? 
            <a href="https://wa.me/6281325907908?text=Halo%20Admin,%20saya%20ingin%20mendaftar%20akun%20Kasir%20UMKM%20Pintar." target="_blank">
                Hubungi admin untuk mendaftar
            </a> 
        </div>
</div>

</body>
</html>