<!DOCTYPE html>
<html lang="id">
<head>
    <title>Tambah Produk Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style> body { font-family: 'Poppins', sans-serif; background-color: #f0f2f5; } </style>
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm" style="border-radius: 15px;">
                <div class="card-body p-4">
                    
                    <!-- Bagian Judul & Tombol Kembali -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="mb-0 fw-bold">📦 Tambah Produk Katalog</h4>
                        <a href="<?= base_url() ?>" class="btn btn-outline-secondary btn-sm">
                            Kembali
                        </a>
                    </div>
                    
                    <!-- Form dengan enctype multipart/form-data wajib untuk upload file -->
                    <form action="/home/simpan_produk" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label">Nama Produk</label>
                            <input type="text" name="nama_produk" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Harga (Rp)</label>
                            <input type="number" name="harga" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Foto Produk (Vektor/PNG Resolusi Tinggi)</label>
                            <input type="file" name="foto_produk" class="form-control" accept="image/png, image/svg+xml, image/jpeg" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 fw-bold">Upload ke S3 & Simpan</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>