<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir UMKM Pintar</title>
    <!-- Import Font Modern & Bootstrap -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        /* Gaya Visual Global */
        body { 
            background-color: #f0f2f5; 
            font-family: 'Poppins', sans-serif; 
            color: #2b2b2b;
        }
        
        /* Navigasi Atas */
        .navbar-custom {
            background-color: #ffffff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.03);
            margin-bottom: 30px;
        }

        /* Kartu Produk (Elegan & Interaktif) */
        .produk-card { 
            cursor: pointer; 
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1); 
            border: none; 
            border-radius: 20px; 
            background: #ffffff;
            box-shadow: 0 4px 15px rgba(0,0,0,0.04); 
            height: 100%;
        }
        .produk-card:hover { 
            transform: translateY(-5px); /* Efek melayang saat disentuh */
            box-shadow: 0 10px 20px rgba(0,0,0,0.08); 
            border: 2px solid #0d6efd; /* Highlight warna biru */
        }
        .ikon-produk { 
            width: 90px; 
            height: 90px; 
            object-fit: contain; 
            margin-bottom: 15px; 
            transition: 0.3s;
        }
        .produk-card:hover .ikon-produk {
            transform: scale(1.1); /* Ikon membesar sedikit saat di-hover */
        }
        .nama-produk { font-size: 0.95rem; font-weight: 600; line-height: 1.2; }
        .harga-produk { color: #0d6efd; font-size: 0.9rem; }

        /* Panel Struk (Sticky & Scrollable) */
        .panel-struk { 
            background: #ffffff; 
            border-radius: 20px; 
            padding: 25px; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.05); 
            position: sticky; /* Membuat panel menempel saat di-scroll */
            top: 20px;
        }
        .area-daftar-pesanan {
            max-height: 45vh; /* Batas tinggi maksimal keranjang */
            overflow-y: auto; /* Memunculkan scrollbar jika penuh */
            padding-right: 10px;
        }
        
        /* Kustomisasi Scrollbar agar rapi */
        .area-daftar-pesanan::-webkit-scrollbar { width: 6px; }
        .area-daftar-pesanan::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 10px; }
        .area-daftar-pesanan::-webkit-scrollbar-thumb { background: #c1c1c1; border-radius: 10px; }

        .list-group-item { border: none; border-bottom: 1px dashed #e0e0e0; padding: 12px 0; }
        .list-group-item:last-child { border-bottom: none; }
        .btn-checkout { border-radius: 15px; letter-spacing: 0.5px; }
    </style>
</head>
<body>

<!-- Header/Navbar Simple -->
<nav class="d-flex justify-content-between align-items-center mb-4 bg-white p-3 shadow-sm" style="border-radius: 15px;">
    
    <!-- SISI KIRI: Judul Aplikasi -->
    <div class="d-flex align-items-center">
        <h3 class="mb-0 fw-bold text-primary">🏧 Kasir UMKM Pintar</h3>
    </div>

    <!-- SISI KANAN: Menu Kontrol -->
    <div class="d-flex align-items-center gap-2">
        
        <a href="<?= base_url('home/dashboard') ?>" class="btn btn-outline-primary btn-sm">
            📊 Dasbor Laporan
        </a>
        
        <a href="<?= base_url('home/tambah_produk') ?>" class="btn btn-outline-success btn-sm">
            ➕ Tambah Produk
        </a>
        
        <a href="<?= base_url('logout') ?>" class="btn btn-outline-danger btn-sm">
            Keluar
        </a>

        <!-- Badge Warung ID -->
        <span class="badge rounded-pill bg-light border text-dark px-3 py-2 ms-2">
            Warung ID: 01
        </span>

    </div>

</nav>

<div class="container-fluid px-4 mb-5">
    <div class="row">
        <!-- Sisi Kiri: Etalase Produk Dinamis -->
        <div class="col-md-8 col-lg-8">
            <h5 class="mb-4 fw-bold text-secondary">Katalog Produk</h5>
            <div class="row g-4">
                
                <?php foreach($katalog_produk as $item): ?>
                <!-- Tambahkan class position-relative agar posisi tombol hapus bisa diatur akurat -->
                <div class="col-6 col-md-4 col-lg-3 position-relative">
                    
                    <!-- Tombol Hapus Mengambang di Pojok Kanan Atas -->
                    <a href="/home/hapus_produk/<?= $item->id; ?>" class="btn btn-sm btn-danger position-absolute shadow-sm" style="top: 5px; right: 20px; z-index: 10; border-radius: 50%; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; text-decoration: none;" onclick="return confirm('Yakin ingin menghapus <?= $item->nama_produk; ?> secara permanen?');">
                        🗑️
                    </a>

                    <div class="card produk-card text-center p-3" onclick="tambahKeKeranjang('<?= $item->nama_produk; ?>', <?= $item->harga; ?>)">
                        <img src="<?= $item->foto_url; ?>" class="ikon-produk mx-auto" alt="<?= $item->nama_produk; ?>">
                        <h6 class="mb-1 nama-produk"><?= $item->nama_produk; ?></h6>
                        <small class="fw-bold harga-produk">Rp <?= number_format($item->harga, 0, ',', '.'); ?></small>
                    </div>
                </div>
                <?php endforeach; ?>

            </div>
        </div>

        <!-- Sisi Kanan: Panel Struk -->
        <div class="col-md-4 col-lg-4 mt-4 mt-md-0">
            <div class="panel-struk">
                <h5 class="fw-bold mb-3">🧾 Detail Pesanan</h5>
                <hr class="text-muted">
                
                <div class="area-daftar-pesanan mb-3">
                    <ul class="list-group list-group-flush" id="daftar-pesanan">
                        <!-- Teks bantuan awal -->
                        <div class="text-center text-muted my-5" id="pesan-kosong">
                            <small>Belum ada produk dipilih.<br>Klik produk di sebelah kiri.</small>
                        </div>
                    </ul>
                </div>

                <div class="p-3 bg-light rounded-3 mb-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="fw-bold mb-0 text-secondary">Total Tagihan</h6>
                        <h4 class="fw-bold text-primary mb-0" id="total-harga">Rp 0</h4>
                    </div>
                </div>
                
                <button class="btn btn-primary btn-checkout w-100 py-3 fw-bold fs-6 shadow-sm" onclick="checkout()">
                    Konfirmasi Pesananan 🚀
                </button>
            </div>
        </div>

    </div>
</div>

<!-- ================= LOGIKA JAVASCRIPT ================= -->
<script>
    let keranjang = {};
    let totalBelanja = 0;

    // 1. Fungsi Tambah Barang
    function tambahKeKeranjang(namaProduk, harga) {
        const pesanKosong = document.getElementById('pesan-kosong');
        if(pesanKosong) pesanKosong.style.display = 'none';

        if (keranjang[namaProduk]) {
            keranjang[namaProduk].jumlah += 1;
        } else {
            keranjang[namaProduk] = { harga: harga, jumlah: 1 };
        }
        
        totalBelanja += harga;
        renderKeranjang();
    }

    // 2. Fungsi Kurangi/Hapus Barang (FITUR BARU)
    function kurangiDariKeranjang(namaProduk, harga) {
        if (keranjang[namaProduk]) {
            // Kurangi jumlah dan total belanja
            keranjang[namaProduk].jumlah -= 1;
            totalBelanja -= harga;

            // Jika jumlahnya jadi 0, hapus barang dari keranjang sepenuhnya
            if (keranjang[namaProduk].jumlah === 0) {
                delete keranjang[namaProduk];
            }

            // Jika keranjang benar-benar kosong, munculkan lagi tulisan "Belum ada produk"
            if (Object.keys(keranjang).length === 0) {
                document.getElementById('pesan-kosong').style.display = 'block';
            }

            renderKeranjang();
        }
    }

    // 3. Fungsi Cetak Tampilan
    function renderKeranjang() {
        const daftarPesanan = document.getElementById('daftar-pesanan');
        const elemenTotal = document.getElementById('total-harga');
        
        Array.from(daftarPesanan.children).forEach(child => {
            if (child.id !== 'pesan-kosong') child.remove();
        });

        for (const [nama, item] of Object.entries(keranjang)) {
            const subtotal = item.harga * item.jumlah;
            const li = document.createElement('li');
            li.className = 'list-group-item d-flex justify-content-between align-items-center py-3'; // padding diperbesar sedikit
            
            // Perhatikan tambahan tombol minus dan plus di bawah ini
            li.innerHTML = `
                <div>
                    <h6 class="my-0 fs-6 mb-1">${nama}</h6>
                    <div class="d-flex align-items-center">
                        <button class="btn btn-sm btn-outline-danger px-2 py-0 me-2" style="border-radius: 8px;" onclick="kurangiDariKeranjang('${nama}', ${item.harga})"><b>-</b></button>
                        <span class="text-muted small">x${item.jumlah}</span>
                        <button class="btn btn-sm btn-outline-primary px-2 py-0 ms-2" style="border-radius: 8px;" onclick="tambahKeKeranjang('${nama}', ${item.harga})"><b>+</b></button>
                    </div>
                </div>
                <span class="fw-bold text-dark">Rp ${subtotal.toLocaleString('id-ID')}</span>
            `;
            daftarPesanan.appendChild(li);
        }

        elemenTotal.innerText = `Rp ${totalBelanja.toLocaleString('id-ID')}`;
    }

    // 4. Fungsi Checkout AJAX
    function checkout() {
        if(totalBelanja === 0) {
            alert("Keranjang masih kosong!");
            return;
        }

        const btnCheckout = document.querySelector('.btn-checkout');
        btnCheckout.innerHTML = `<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Memproses...`;
        btnCheckout.disabled = true;

        const dataKirim = {
            keranjang: keranjang,
            totalBelanja: totalBelanja
        };

        fetch('/home/proses_checkout', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify(dataKirim)
        })
        .then(response => response.json())
        .then(data => {
            if(data.status === 'success') {
                alert("🛒 MANTAP! " + data.pesan);
                keranjang = {};
                totalBelanja = 0;
                
                document.getElementById('pesan-kosong').style.display = 'block';
                renderKeranjang();
            } else {
                alert("Waduh, gagal: " + (data.pesan || data.message || "Error tidak diketahui"));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert("Terjadi kesalahan sistem!");
        })
        .finally(() => {
            btnCheckout.innerHTML = "Kirim Tagihan ke WA 🚀";
            btnCheckout.disabled = false;
        });
    }
</script>

</body>
</html>