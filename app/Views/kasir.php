<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir UMKM Pintar</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --hijau: #16a34a;
            --hijau-muda: #dcfce7;
            --hijau-hover: #15803d;
            --biru: #2563eb;
            --biru-muda: #dbeafe;
            --merah: #dc2626;
            --merah-muda: #fee2e2;
            --abu-bg: #f8fafc;
            --abu-garis: #e2e8f0;
            --teks-gelap: #0f172a;
            --teks-abu: #64748b;
            --putih: #ffffff;
            --radius: 16px;
            --radius-kecil: 10px;
            --shadow: 0 1px 3px rgba(0,0,0,0.06), 0 4px 16px rgba(0,0,0,0.04);
            --shadow-kuat: 0 4px 24px rgba(0,0,0,0.10);
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: var(--abu-bg); 
            color: var(--teks-gelap);
            height: 100vh;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        /* ===== HEADER ===== */
        .header {
            background: var(--putih);
            border-bottom: 1px solid var(--abu-garis);
            padding: 14px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-shrink: 0;
        }
        .header-logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .logo-icon {
            width: 40px; height: 40px;
            background: var(--hijau);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 20px;
        }
        .logo-teks h1 { font-size: 1.1rem; font-weight: 800; color: var(--teks-gelap); line-height: 1; }
        .logo-teks span { font-size: 0.72rem; color: var(--teks-abu); font-weight: 500; }

        .header-nav { display: flex; align-items: center; gap: 8px; }
        .btn-nav {
            display: flex; align-items: center; gap: 6px;
            padding: 8px 14px;
            border-radius: var(--radius-kecil);
            font-size: 0.82rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            border: 1.5px solid transparent;
            transition: all 0.2s;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .btn-nav-hijau { background: var(--hijau-muda); color: var(--hijau); border-color: var(--hijau-muda); }
        .btn-nav-hijau:hover { background: var(--hijau); color: white; }
        .btn-nav-biru { background: var(--biru-muda); color: var(--biru); border-color: var(--biru-muda); }
        .btn-nav-biru:hover { background: var(--biru); color: white; }
        .btn-nav-merah { background: var(--merah-muda); color: var(--merah); border-color: var(--merah-muda); }
        .btn-nav-merah:hover { background: var(--merah); color: white; }
        .badge-warung {
            background: var(--abu-bg);
            border: 1.5px solid var(--abu-garis);
            color: var(--teks-abu);
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        /* ===== KONTEN UTAMA ===== */
        .konten-utama {
            display: flex;
            flex: 1;
            overflow: hidden;
        }

        /* ===== PANEL KIRI: KATALOG ===== */
        .panel-katalog {
            flex: 1;
            padding: 20px 24px;
            overflow-y: auto;
        }
        .panel-katalog::-webkit-scrollbar { width: 6px; }
        .panel-katalog::-webkit-scrollbar-track { background: transparent; }
        .panel-katalog::-webkit-scrollbar-thumb { background: var(--abu-garis); border-radius: 99px; }

        .label-bagian {
            font-size: 0.78rem;
            font-weight: 700;
            color: var(--teks-abu);
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-bottom: 14px;
        }

        /* ===== KARTU PRODUK ===== */
        .grid-produk {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
            gap: 14px;
        }
        .kartu-produk {
            background: var(--putih);
            border-radius: var(--radius);
            border: 2px solid transparent;
            padding: 18px 12px 14px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s cubic-bezier(0.34, 1.56, 0.64, 1);
            box-shadow: var(--shadow);
            position: relative;
            user-select: none;
        }
        .kartu-produk:hover {
            border-color: var(--hijau);
            transform: translateY(-3px);
            box-shadow: var(--shadow-kuat);
        }
        .kartu-produk:active { transform: scale(0.96); }
        .kartu-produk.aktif { border-color: var(--hijau); background: var(--hijau-muda); }

        .ikon-produk {
            width: 70px; height: 70px;
            object-fit: contain;
            margin-bottom: 10px;
            transition: transform 0.2s;
        }
        .kartu-produk:hover .ikon-produk { transform: scale(1.08); }

        .nama-produk {
            font-size: 0.82rem;
            font-weight: 700;
            color: var(--teks-gelap);
            margin-bottom: 4px;
            line-height: 1.3;
        }
        .harga-produk {
            font-size: 0.8rem;
            font-weight: 700;
            color: var(--hijau);
        }

        .btn-hapus-produk {
            position: absolute;
            top: 8px; right: 8px;
            width: 26px; height: 26px;
            background: var(--merah-muda);
            color: var(--merah);
            border: none;
            border-radius: 8px;
            font-size: 13px;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer;
            opacity: 0;
            transition: opacity 0.2s;
            text-decoration: none;
        }
        .kartu-produk:hover .btn-hapus-produk { opacity: 1; }

        /* ===== PANEL KANAN: STRUK ===== */
        .panel-struk {
            width: 360px;
            flex-shrink: 0;
            background: var(--putih);
            border-left: 1px solid var(--abu-garis);
            display: flex;
            flex-direction: column;
        }

        .struk-header {
            padding: 20px 20px 16px;
            border-bottom: 1px solid var(--abu-garis);
        }
        .struk-header h5 {
            font-size: 1rem;
            font-weight: 800;
            color: var(--teks-gelap);
            margin-bottom: 2px;
        }
        .struk-header p { font-size: 0.75rem; color: var(--teks-abu); }

        .struk-isi {
            flex: 1;
            overflow-y: auto;
            padding: 16px 20px;
        }
        .struk-isi::-webkit-scrollbar { width: 4px; }
        .struk-isi::-webkit-scrollbar-thumb { background: var(--abu-garis); border-radius: 99px; }

        .pesan-kosong {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            gap: 10px;
            color: var(--teks-abu);
            text-align: center;
            padding: 40px 20px;
        }
        .pesan-kosong .ikon-besar { font-size: 48px; opacity: 0.3; }
        .pesan-kosong p { font-size: 0.82rem; }

        .item-keranjang {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid var(--abu-garis);
            animation: masuk 0.2s ease;
        }
        @keyframes masuk { from { opacity: 0; transform: translateX(8px); } to { opacity: 1; transform: none; } }
        .item-keranjang:last-child { border-bottom: none; }

        .item-nama { 
            flex: 1; 
            font-size: 0.85rem; 
            font-weight: 600; 
            color: var(--teks-gelap); 
        }
        .item-subtotal { 
            font-size: 0.85rem; 
            font-weight: 700; 
            color: var(--teks-gelap); 
            text-align: right;
            min-width: 80px;
        }

        .kontrol-qty {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-top: 4px;
        }
        .btn-qty {
            width: 24px; height: 24px;
            border-radius: 7px;
            border: 1.5px solid var(--abu-garis);
            background: var(--abu-bg);
            color: var(--teks-gelap);
            font-size: 14px;
            font-weight: 700;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer;
            transition: all 0.15s;
        }
        .btn-qty:hover { background: var(--teks-gelap); color: white; border-color: var(--teks-gelap); }
        .qty-angka { font-size: 0.82rem; font-weight: 700; color: var(--teks-abu); min-width: 20px; text-align: center; }

        /* ===== FOOTER STRUK ===== */
        .struk-footer { padding: 16px 20px 20px; border-top: 1px solid var(--abu-garis); }

        .baris-total {
            display: flex; justify-content: space-between; align-items: center;
            margin-bottom: 16px;
        }
        .label-total { font-size: 0.82rem; font-weight: 600; color: var(--teks-abu); }
        .angka-total { font-size: 1.5rem; font-weight: 800; color: var(--teks-gelap); }

        .btn-checkout {
            width: 100%;
            padding: 14px;
            background: var(--hijau);
            color: white;
            border: none;
            border-radius: var(--radius);
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.95rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
            display: flex; align-items: center; justify-content: center; gap: 8px;
        }
        .btn-checkout:hover { background: var(--hijau-hover); transform: translateY(-1px); box-shadow: 0 4px 12px rgba(22,163,74,0.3); }
        .btn-checkout:active { transform: scale(0.98); }
        .btn-checkout:disabled { background: var(--abu-garis); color: var(--teks-abu); cursor: not-allowed; transform: none; box-shadow: none; }

        .jumlah-item-badge {
            background: var(--hijau);
            color: white;
            font-size: 0.7rem;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 99px;
            margin-left: 6px;
        }

        /* ===== TOAST NOTIFIKASI ===== */
        .toast-notif {
            position: fixed;
            bottom: 24px; left: 50%;
            transform: translateX(-50%) translateY(80px);
            background: var(--teks-gelap);
            color: white;
            padding: 12px 20px;
            border-radius: var(--radius-kecil);
            font-size: 0.85rem;
            font-weight: 600;
            z-index: 9999;
            transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            white-space: nowrap;
        }
        .toast-notif.tampil { transform: translateX(-50%) translateY(0); }
    </style>
</head>
<body>

<!-- ===== HEADER ===== -->
<header class="header">
    <div class="header-logo">
        <div class="logo-icon">🏪</div>
        <div class="logo-teks">
            <h1>UMKM Pintar</h1>
            <span>Sistem Kasir Digital</span>
        </div>
    </div>
    <nav class="header-nav">
        <a href="<?= base_url('home/dashboard') ?>" class="btn-nav btn-nav-biru">
            📊 Laporan
        </a>
        <a href="<?= base_url('home/tambah_produk') ?>" class="btn-nav btn-nav-hijau">
            ➕ Produk Baru
        </a>
        <span class="badge-warung">Warung #01</span>
        <a href="<?= base_url('logout') ?>" class="btn-nav btn-nav-merah">
            Keluar
        </a>
    </nav>
</header>

<!-- ===== KONTEN UTAMA ===== -->
<div class="konten-utama">

    <!-- PANEL KIRI: KATALOG PRODUK -->
    <div class="panel-katalog">
        <div class="label-bagian">Katalog Produk (<?= count($katalog_produk) ?> item)</div>
        <div class="grid-produk">
            <?php foreach($katalog_produk as $item): ?>
            <div class="kartu-produk" onclick="tambahKeKeranjang('<?= $item->nama_produk ?>', <?= $item->harga ?>)">
                <a href="/home/hapus_produk/<?= $item->id ?>" class="btn-hapus-produk" 
                   onclick="event.stopPropagation(); return confirm('Hapus <?= $item->nama_produk ?>?');" title="Hapus produk">✕</a>
                <img src="<?= $item->foto_url ?>" class="ikon-produk" alt="<?= $item->nama_produk ?>">
                <div class="nama-produk"><?= $item->nama_produk ?></div>
                <div class="harga-produk">Rp <?= number_format($item->harga, 0, ',', '.') ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- PANEL KANAN: STRUK PESANAN -->
    <aside class="panel-struk">
        <div class="struk-header">
            <h5>🧾 Pesanan <span class="jumlah-item-badge" id="badge-jumlah" style="display:none">0</span></h5>
            <p>Klik produk di katalog untuk menambahkan</p>
        </div>

        <div class="struk-isi" id="area-struk">
            <div class="pesan-kosong" id="pesan-kosong">
                <div class="ikon-besar">🛒</div>
                <p>Keranjang masih kosong.<br>Silakan pilih produk di sebelah kiri.</p>
            </div>
        </div>

        <div class="struk-footer">
            <div class="baris-total">
                <span class="label-total">Total Tagihan</span>
                <span class="angka-total" id="total-harga">Rp 0</span>
            </div>
            <button class="btn-checkout" onclick="checkout()" id="btn-checkout" disabled>
                <span>Konfirmasi Pesanan</span>
                <span>✓</span>
            </button>
        </div>
    </aside>

</div>

<!-- Toast Notifikasi -->
<div class="toast-notif" id="toast"></div>

<script>
    let keranjang = {};
    let totalBelanja = 0;

    function tampilkanToast(pesan) {
        const t = document.getElementById('toast');
        t.textContent = pesan;
        t.classList.add('tampil');
        setTimeout(() => t.classList.remove('tampil'), 2000);
    }

    function tambahKeKeranjang(namaProduk, harga) {
        if (keranjang[namaProduk]) {
            keranjang[namaProduk].jumlah += 1;
        } else {
            keranjang[namaProduk] = { harga: harga, jumlah: 1 };
        }
        totalBelanja += harga;
        renderKeranjang();
        tampilkanToast('✅ ' + namaProduk + ' ditambahkan');
    }

    function kurangiDariKeranjang(namaProduk, harga) {
        if (!keranjang[namaProduk]) return;
        keranjang[namaProduk].jumlah -= 1;
        totalBelanja -= harga;
        if (keranjang[namaProduk].jumlah === 0) delete keranjang[namaProduk];
        renderKeranjang();
    }

    function renderKeranjang() {
        const area = document.getElementById('area-struk');
        const pesanKosong = document.getElementById('pesan-kosong');
        const badgeJumlah = document.getElementById('badge-jumlah');
        const btnCheckout = document.getElementById('btn-checkout');
        const totalEl = document.getElementById('total-harga');

        // Hapus semua item lama (kecuali pesan kosong)
        const items = area.querySelectorAll('.item-keranjang');
        items.forEach(el => el.remove());

        const produkList = Object.keys(keranjang);

        if (produkList.length === 0) {
            pesanKosong.style.display = 'flex';
            badgeJumlah.style.display = 'none';
            btnCheckout.disabled = true;
        } else {
            pesanKosong.style.display = 'none';
            badgeJumlah.style.display = 'inline';
            badgeJumlah.textContent = produkList.length;
            btnCheckout.disabled = false;

            produkList.forEach(nama => {
                const item = keranjang[nama];
                const subtotal = item.harga * item.jumlah;

                const div = document.createElement('div');
                div.className = 'item-keranjang';
                div.innerHTML = `
                    <div style="flex:1;">
                        <div class="item-nama">${nama}</div>
                        <div class="kontrol-qty">
                            <button class="btn-qty" onclick="kurangiDariKeranjang('${nama}', ${item.harga})">−</button>
                            <span class="qty-angka">${item.jumlah}</span>
                            <button class="btn-qty" onclick="tambahKeKeranjang('${nama}', ${item.harga})">+</button>
                        </div>
                    </div>
                    <div class="item-subtotal">Rp ${subtotal.toLocaleString('id-ID')}</div>
                `;
                area.appendChild(div);
            });
        }

        totalEl.textContent = 'Rp ' + totalBelanja.toLocaleString('id-ID');
    }

    function checkout() {
        if (totalBelanja === 0) return;
        const btn = document.getElementById('btn-checkout');
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Memproses...';
        btn.disabled = true;

        fetch('/home/proses_checkout', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
            body: JSON.stringify({ keranjang, totalBelanja })
        })
        .then(r => r.json())
        .then(data => {
            if (data.status === 'success') {
                tampilkanToast('🎉 Transaksi berhasil! Mengalihkan ke laporan...');
                keranjang = {};
                totalBelanja = 0;
                renderKeranjang();
                
                // --- KODE BARU: Alihkan ke dashboard setelah jeda 1.5 detik ---
                setTimeout(() => {
                    window.location.href = '<?= base_url("home/dashboard") ?>';
                }, 1500);
                
            } else {
                alert('Gagal: ' + (data.pesan || 'Error tidak diketahui'));
            }
        })
        .catch(() => alert('Terjadi kesalahan sistem!'))
        .finally(() => {
            // Bagian ini mungkin tidak akan sempat terlihat karena keburu pindah halaman,
            // tapi tetap aman dibiarkan sebagai fallback kalau fetch gagal.
            btn.innerHTML = '<span>Konfirmasi Pesanan</span><span>✓</span>';
            btn.disabled = Object.keys(keranjang).length === 0;
        });
    }
</script>
</body>
</html>