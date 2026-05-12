<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan - UMKM Pintar</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --hijau: #16a34a;
            --hijau-muda: #dcfce7;
            --biru: #2563eb;
            --biru-muda: #dbeafe;
            --abu-bg: #f8fafc;
            --abu-garis: #e2e8f0;
            --teks-gelap: #0f172a;
            --teks-abu: #64748b;
            --putih: #ffffff;
            --radius: 16px;
            --shadow: 0 1px 3px rgba(0,0,0,0.06), 0 4px 16px rgba(0,0,0,0.04);
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: var(--abu-bg); color: var(--teks-gelap); }

        /* HEADER */
        .header {
            background: var(--putih);
            border-bottom: 1px solid var(--abu-garis);
            padding: 16px 28px;
            display: flex; align-items: center; justify-content: space-between;
            position: sticky; top: 0; z-index: 100;
        }
        .header-kiri { display: flex; align-items: center; gap: 12px; }
        .logo-icon { width: 38px; height: 38px; background: var(--hijau); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px; }
        .header-kiri h4 { font-size: 1.05rem; font-weight: 800; }
        .header-kiri span { font-size: 0.75rem; color: var(--teks-abu); display: block; }
        .btn-kembali {
            display: flex; align-items: center; gap: 6px;
            padding: 8px 16px;
            background: var(--biru-muda);
            color: var(--biru);
            border: none; border-radius: 10px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.82rem; font-weight: 600;
            cursor: pointer; text-decoration: none;
            transition: all 0.2s;
        }
        .btn-kembali:hover { background: var(--biru); color: white; }

        /* KONTEN */
        .konten { padding: 28px; max-width: 1200px; margin: 0 auto; }

        /* KARTU STATISTIK */
        .grid-stat { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 32px; }

        .kartu-stat {
            background: var(--putih);
            border-radius: var(--radius);
            padding: 28px;
            box-shadow: var(--shadow);
            border: 1px solid var(--abu-garis);
        }
        .kartu-stat.aksen-hijau { background: var(--hijau); border-color: var(--hijau); }

        .kartu-label {
            font-size: 0.78rem; font-weight: 700;
            color: var(--teks-abu); letter-spacing: 0.06em;
            text-transform: uppercase; margin-bottom: 12px;
            display: flex; align-items: center; gap: 6px;
        }
        .kartu-label.putih { color: rgba(255,255,255,0.75); }

        .kartu-angka {
            font-size: 2rem; font-weight: 800;
            color: var(--teks-gelap); line-height: 1;
        }
        .kartu-angka.putih { color: white; font-size: 2.2rem; }
        .kartu-angka small { font-size: 0.9rem; font-weight: 500; color: var(--teks-abu); }
        .kartu-angka.putih small { color: rgba(255,255,255,0.7); }

        .kartu-kecil {
            font-size: 0.78rem; color: var(--teks-abu); margin-top: 6px;
        }

        /* TABEL TRANSAKSI */
        .bagian-tabel h5 {
            font-size: 0.78rem; font-weight: 700;
            color: var(--teks-abu); letter-spacing: 0.06em;
            text-transform: uppercase; margin-bottom: 14px;
        }
        .kotak-tabel {
            background: var(--putih);
            border-radius: var(--radius);
            border: 1px solid var(--abu-garis);
            overflow: hidden;
            box-shadow: var(--shadow);
        }
        table { width: 100%; border-collapse: collapse; }
        thead tr { background: var(--abu-bg); border-bottom: 2px solid var(--abu-garis); }
        thead th {
            padding: 14px 20px;
            font-size: 0.76rem; font-weight: 700;
            color: var(--teks-abu); letter-spacing: 0.04em;
            text-transform: uppercase;
            text-align: left;
        }
        thead th.kanan { text-align: right; }
        tbody tr {
            border-bottom: 1px solid var(--abu-garis);
            transition: background 0.15s;
        }
        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: var(--abu-bg); }
        tbody td { padding: 16px 20px; font-size: 0.875rem; vertical-align: middle; }

        .waktu-badge {
            font-size: 0.75rem; color: var(--teks-abu); font-weight: 500;
        }
        .nama-pembeli { font-weight: 700; color: var(--teks-gelap); }
        .detail-pesanan { color: var(--teks-abu); font-size: 0.82rem; max-width: 260px; }
        
        .kolom-harga { text-align: right; }
        .harga-angka { font-weight: 800; color: var(--hijau); font-size: 0.95rem; }
        .btn-cetak {
            display: inline-flex; align-items: center; gap: 4px;
            padding: 5px 10px;
            background: var(--abu-bg);
            color: var(--teks-abu);
            border: 1px solid var(--abu-garis);
            border-radius: 8px;
            font-size: 0.74rem; font-weight: 600;
            text-decoration: none;
            transition: all 0.2s;
            margin-top: 5px;
        }
        .btn-cetak:hover { background: var(--teks-gelap); color: white; border-color: var(--teks-gelap); }

        .kosong-row td {
            text-align: center; padding: 60px 20px;
            color: var(--teks-abu); font-size: 0.875rem;
        }
        .kosong-ikon { font-size: 40px; margin-bottom: 10px; opacity: 0.4; }

        .grup-tombol { display: flex; gap: 10px; align-items: center; }

.btn-aksi {
    display: flex; align-items: center; gap: 6px;
    padding: 8px 16px;
    border: none; border-radius: 10px;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 0.82rem; font-weight: 600;
    cursor: pointer; text-decoration: none;
    transition: all 0.2s;
}

.btn-simpan { background: var(--hijau-muda); color: var(--hijau); }
.btn-simpan:hover { background: var(--hijau); color: white; }

.btn-reset { background: #fee2e2; color: #dc2626; }
.btn-reset:hover { background: #dc2626; color: white; }
    </style>
</head>
<body>

<header class="header">
    <div class="header-kiri">
        <div class="logo-icon">📊</div>
        <div>
            <h4>Laporan Penjualan</h4>
            <span>UMKM Pintar · Hari ini</span>
        </div>
    </div>
    
    <!-- Ini bagian yang baru -->
    <div class="grup-tombol">
        <a href="<?= base_url('home/simpan_csv') ?>" class="btn-aksi btn-simpan">💾 Simpan Data (CSV)</a>
        <a href="<?= base_url('home/reset_data') ?>" class="btn-aksi btn-reset" onclick="return confirm('PERINGATAN: Yakin ingin mereset/menghapus SEMUA data transaksi hari ini? Data tidak bisa dikembalikan!');">🔄 Mulai Ulang</a>
        <a href="<?= base_url() ?>" class="btn-aksi btn-kembali">← Kembali ke Kasir</a>
    </div>
</header>

<div class="konten">

    <!-- STATISTIK ATAS -->
    <div class="grid-stat">
        <div class="kartu-stat aksen-hijau">
            <div class="kartu-label putih">💰 Total Pendapatan Hari Ini</div>
            <div class="kartu-angka putih">Rp <?= number_format($total_pendapatan, 0, ',', '.') ?></div>
            <div style="font-size:0.78rem; color:rgba(255,255,255,0.65); margin-top:8px;">Akumulasi semua transaksi selesai</div>
        </div>
        <div class="kartu-stat">
            <div class="kartu-label">🧾 Jumlah Transaksi</div>
            <div class="kartu-angka"><?= $jumlah_transaksi ?> <small>pesanan</small></div>
            <div class="kartu-kecil">Transaksi berhasil dikonfirmasi</div>
        </div>
    </div>

    <!-- TABEL RIWAYAT -->
    <div class="bagian-tabel">
        <h5>📋 Riwayat Transaksi Terbaru</h5>
        <div class="kotak-tabel">
            <table>
                <thead>
                    <tr>
                        <th>Waktu</th>
                        <th>Pembeli</th>
                        <th>Detail Pesanan</th>
                        <th class="kanan">Total & Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($riwayat)): ?>
                    <tr class="kosong-row">
                        <td colspan="4">
                            <div class="kosong-ikon">📭</div>
                            <div>Belum ada transaksi hari ini.</div>
                        </td>
                    </tr>
                    <?php endif; ?>
                    <?php foreach($riwayat as $trx): ?>
                    <tr>
                        <td><span class="waktu-badge"><?= $trx->waktu_pesan ?? $trx->created_at ?? 'Hari Ini' ?></span></td>
                        <td><span class="nama-pembeli"><?= $trx->nama_pembeli ?></span></td>
                        <td><span class="detail-pesanan"><?= $trx->detail_pesanan ?></span></td>
                        <td class="kolom-harga">
                            <div class="harga-angka">Rp <?= number_format($trx->total_harga, 0, ',', '.') ?></div>
                            <a href="/home/cetak_nota/<?= $trx->id ?>" target="_blank" class="btn-cetak">🖨️ Cetak Struk</a>
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