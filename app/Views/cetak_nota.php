<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk #<?= $nota->id ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        /* Tampilan di layar: kelihatan rapi sebelum print */
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f1f5f9;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            min-height: 100vh;
            padding: 30px 20px;
            margin: 0;
        }

        .wrapper-struk {
            width: 100%;
            max-width: 320px;
        }

        /* Tombol print (hanya tampil di layar) */
        .btn-print {
            width: 100%;
            padding: 12px;
            background: #16a34a;
            color: white;
            border: none;
            border-radius: 12px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.9rem;
            font-weight: 700;
            cursor: pointer;
            margin-bottom: 16px;
            transition: background 0.2s;
        }
        .btn-print:hover { background: #15803d; }

        /* Kotak Struk */
        .struk {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 24px rgba(0,0,0,0.10);
        }

        /* Header Struk */
        .struk-head {
            background: #16a34a;
            color: white;
            text-align: center;
            padding: 22px 20px 18px;
        }
        .struk-head .nama-toko {
            font-size: 1.1rem;
            font-weight: 800;
            letter-spacing: 0.04em;
        }
        .struk-head .alamat {
            font-size: 0.78rem;
            opacity: 0.85;
            margin-top: 4px;
        }
        .struk-head .telp {
            font-size: 0.78rem;
            opacity: 0.75;
        }

        /* Body Struk */
        .struk-body { padding: 20px; }

        /* Garis putus */
        .garis {
            border: none;
            border-top: 1.5px dashed #e2e8f0;
            margin: 14px 0;
        }

        .info-baris {
            display: flex;
            justify-content: space-between;
            font-size: 0.78rem;
            color: #64748b;
            margin-bottom: 5px;
        }
        .info-baris strong { color: #0f172a; font-weight: 600; }

        /* Judul seksi */
        .label-bagian {
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #94a3b8;
            margin-bottom: 10px;
        }

        /* Item pesanan */
        .item-baris {
            font-family: 'Space Mono', monospace;
            font-size: 0.8rem;
            color: #0f172a;
            margin-bottom: 6px;
            white-space: pre-line;
            line-height: 1.7;
        }

        /* Total */
        .kotak-total {
            background: #f8fafc;
            border-radius: 10px;
            padding: 14px 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 4px;
        }
        .total-label { font-size: 0.82rem; font-weight: 700; color: #64748b; }
        .total-angka { font-size: 1.3rem; font-weight: 800; color: #0f172a; }

        /* Footer */
        .struk-foot {
            text-align: center;
            padding: 16px 20px 20px;
            border-top: 1.5px dashed #e2e8f0;
        }
        .ucapan {
            font-size: 0.85rem;
            font-weight: 700;
            color: #16a34a;
            margin-bottom: 4px;
        }
        .catatan {
            font-size: 0.72rem;
            color: #94a3b8;
        }

        /* ===== MODE PRINT ===== */
        @media print {
            body {
                background: white;
                padding: 0;
                display: block;
            }
            .wrapper-struk { max-width: 58mm; margin: 0; }
            .btn-print { display: none; }
            .struk {
                border-radius: 0;
                box-shadow: none;
                font-size: 11px;
            }
            .struk-head { padding: 10px 8px; }
            .struk-head .nama-toko { font-size: 0.95rem; }
            .struk-body { padding: 10px 8px; }
            .kotak-total { padding: 8px; border-radius: 6px; }
            .total-angka { font-size: 1rem; }
            .struk-foot { padding: 10px 8px; }
            @page { margin: 2mm; size: 58mm auto; }
        }
    </style>
</head>
<body>

<div class="wrapper-struk">
    <button class="btn-print" onclick="window.print()">🖨️ Cetak Struk Sekarang</button>

    <div class="struk">
        <!-- HEAD -->
        <div class="struk-head">
            <div class="nama-toko">WARUNG UMKM PINTAR</div>
            <div class="alamat">Jl. Teknologi No. 1</div>
            <div class="telp">Telp: 0812-3456-7890</div>
        </div>

        <!-- BODY -->
        <div class="struk-body">
            <div class="info-baris">
                <span>No. Nota</span>
                <strong>#<?= $nota->id ?></strong>
            </div>
            <div class="info-baris">
                <span>Waktu</span>
                <strong><?= $nota->waktu_pesan ?? $nota->created_at ?? date('d/m/Y H:i') ?></strong>
            </div>
            <div class="info-baris">
                <span>Kasir</span>
                <strong>Admin</strong>
            </div>

            <hr class="garis">

            <div class="label-bagian">Detail Pesanan</div>
            <div class="item-baris">
                <?= str_replace(', ', "\n", $nota->detail_pesanan) ?>
            </div>

            <hr class="garis">

            <div class="kotak-total">
                <span class="total-label">TOTAL TAGIHAN</span>
                <span class="total-angka">Rp <?= number_format($nota->total_harga, 0, ',', '.') ?></span>
            </div>
        </div>

        <!-- FOOT -->
        <div class="struk-foot">
            <div class="ucapan">✨ Terima Kasih! ✨</div>
            <div class="catatan">Barang yang sudah dibeli tidak dapat ditukar/dikembalikan.</div>
        </div>
    </div>
</div>

<script>
    // Otomatis buka dialog print saat halaman siap
    window.onload = function() { window.print(); }
</script>
</body>
</html>