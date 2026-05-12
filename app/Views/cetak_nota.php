<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Kasir #<?= $nota->id; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* Desain khusus kertas Thermal 58mm */
        body {
            font-family: 'Space Mono', monospace; /* Font mirip mesin kasir asli */
            font-size: 12px;
            color: #000;
            width: 58mm;
            margin: 0 auto;
            padding: 10px;
        }
        h2, h3, h4, p { margin: 0; padding: 0; }
        .text-center { text-align: center; }
        .garis { border-bottom: 1px dashed #000; margin: 10px 0; }
        .mb-1 { margin-bottom: 5px; }
        
        /* Mematikan elemen yang tidak perlu saat di-print beneran */
        @media print {
            body { width: 58mm; margin: 0; padding: 0; }
            @page { margin: 0; }
        }
    </style>
</head>
<body>

    <div class="text-center mb-1">
        <h3 style="font-weight: bold;">WARUNG UMKM PINTAR</h3>
        <p>Jl. Teknologi No. 1</p>
        <p>Telp: 0812-3456-7890</p>
    </div>
    
    <div class="garis"></div>
    
    <p>No. Nota: #<?= $nota->id; ?></p>
    <!-- Handle error jika kolom waktu_pesan atau created_at tidak seragam -->
    <p>Waktu   : <?= $nota->waktu_pesan ?? $nota->created_at ?? date('Y-m-d H:i:s'); ?></p>
    <p>Kasir   : Admin</p>
    
    <div class="garis"></div>
    
    <p style="white-space: pre-line; line-height: 1.5; font-size: 11px;">
        <?= str_replace(', ', "\n", $nota->detail_pesanan); ?>
    </p>

    <div class="garis"></div>

    <div style="display: flex; justify-content: space-between; font-weight: bold; font-size: 14px;">
        <span>TOTAL:</span>
        <span>Rp <?= number_format($nota->total_harga, 0, ',', '.'); ?></span>
    </div>

    <div class="garis"></div>

    <div class="text-center">
        <p>Terima Kasih</p>
        <p>Barang yang sudah dibeli tidak dapat ditukar/dikembalikan.</p>
    </div>

    <!-- Script ajaib untuk otomatis memicu dialog Print -->
    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>