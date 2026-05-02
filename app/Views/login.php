<!DOCTYPE html>
<html lang="id">
<head>
    <title>Masuk - Kasir UMKM Pintar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f0f2f5; display: flex; align-items: center; justify-content: center; height: 100vh; margin: 0; }
        .login-card { border: none; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); padding: 40px; width: 100%; max-width: 400px; background: white; }
    </style>
</head>
<body>

<div class="login-card text-center">
    <h3 class="fw-bold text-primary mb-2">🔐 Kasir Pintar</h3>
    <p class="text-muted mb-4">Masuk ke Back-Office Warung</p>

    <!-- Menampilkan pesan error jika login gagal -->
    <?php if(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger py-2 fs-6"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <form action="/auth/proses" method="POST">
        <div class="mb-3 text-start">
            <label class="form-label fw-medium small">Username</label>
            <input type="text" name="username" class="form-control py-2" required placeholder="Masukkan username">
        </div>
        <div class="mb-4 text-start">
            <label class="form-label fw-medium small">Password</label>
            <input type="password" name="password" class="form-control py-2" required placeholder="Masukkan password">
        </div>
        <button type="submit" class="btn btn-primary w-100 py-2 fw-bold rounded-pill">Masuk</button>
    </form>
    
    <div class="mt-4">
        <a href="/" class="text-decoration-none small text-secondary">Kembali ke Layar Kasir</a>
    </div>
</div>

</body>
</html>