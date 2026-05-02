<!DOCTYPE html>
<html lang="id">
<head>
    <title>Dashboard Laporan Kasir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style> 
        body { font-family: 'Poppins', sans-serif; background-color: #f0f2f5; }
        .card-stat { border: none; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.04); transition: 0.3s; }
        .card-stat:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.08); }
        .tabel-riwayat { background: white; border-radius: 20px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.04); }
    </style>
</head>
<body>

<nav class="navbar bg-white shadow-sm py-3 mb-4">
    <div class="container-fluid px-4 d-flex justify-content-between align-items-center">
        <h4 class="mb-0 fw-bold text-primary">📊 Dasbor Laporan Penjualan</h4>
        
        <!-- Kelompokkan tombol di sini -->
        <div class="d-flex gap-2">
            <a href="<?= base_url() ?>" class="btn btn-outline-primary">Kembali ke Kasir</a>
        </div>
        
    </div>
</nav>

<div class="container-fluid px-4">
    <div class="row mb-4">
        <!-- Kartu Total Pendapatan -->
        <div class="col-md-6 mb-3">
            <div class="card card-stat bg-primary text-white h-100 p-4">
                <h5 class="opacity-75">Total Pendapatan</h5>
                <h1 class="fw-bold display-5">Rp <?= number_format($total_pendapatan, 0, ',', '.'); ?></h1>
            </div>
        </div>
        <!-- Kartu Total Transaksi -->
        <div class="col-md-6 mb-3">
            <div class="card card-stat bg-white h-100 p-4">
                <h5 class="text-secondary">Jumlah Transaksi Selesai</h5>
                <h1 class="fw-bold text-dark display-5"><?= $jumlah_transaksi; ?> <span class="fs-4 text-muted fw-normal">Pesanan</span></h1>
            </div>
        </div>
    </div>

    <!-- Tabel Riwayat Transaksi -->
    <h5 class="fw-bold mb-3 text-secondary">Riwayat Transaksi Terbaru</h5>
    <div class="tabel-riwayat p-4 mb-5">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Waktu Pesan</th>
                        <th>Pembeli</th>
                        <th>Detail Pesanan</th>
                        <th class="text-end">Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($riwayat)): ?>
                        <tr><td colspan="4" class="text-center py-4 text-muted">Belum ada transaksi hari ini.</td></tr>
                    <?php endif; ?>

                    <?php foreach($riwayat as $trx): ?>
                    <tr>
                        <!-- Kita gunakan ?? agar jika kolomnya tidak ada, teksnya tidak error dan diganti jadi 'Hari Ini' -->
                        <td class="text-muted"><small><?= $trx->waktu_pesan ?? $trx->created_at ?? 'Hari Ini'; ?></small></td>
                        <td class="fw-bold"><?= $trx->nama_pembeli; ?></td>
                        <td><?= $trx->detail_pesanan; ?></td>
                        <td class="text-end">
                        <div class="fw-bold text-success mb-1">Rp <?= number_format($trx->total_harga, 0, ',', '.'); ?></div>
                        <a href="/home/cetak_nota/<?= $trx->id; ?>" target="_blank" class="btn btn-sm btn-outline-secondary" style="font-size: 0.75rem; border-radius: 8px;">🖨️ Cetak Struk</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>