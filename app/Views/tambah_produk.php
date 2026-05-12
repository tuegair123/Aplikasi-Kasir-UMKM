<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk - UMKM Pintar</title>
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
            --putih: #ffffff;
            --biru-muda: #dbeafe;
            --biru: #2563eb;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--abu-bg);
            min-height: 100vh;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            padding: 40px 20px;
        }

        .wrapper { width: 100%; max-width: 480px; }

        /* Header */
        .halaman-header {
            display: flex; align-items: center; gap: 14px;
            margin-bottom: 24px;
        }
        .header-ikon {
            width: 48px; height: 48px;
            background: var(--hijau);
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 22px;
        }
        .header-teks h1 { font-size: 1.2rem; font-weight: 800; color: var(--teks-gelap); }
        .header-teks p { font-size: 0.78rem; color: var(--teks-abu); margin-top: 2px; }

        /* Kartu Form */
        .kartu {
            background: var(--putih);
            border-radius: 20px;
            border: 1px solid var(--abu-garis);
            padding: 28px;
            box-shadow: 0 2px 16px rgba(0,0,0,0.05);
            margin-bottom: 16px;
        }

        .field { margin-bottom: 20px; }
        .field label {
            display: block;
            font-size: 0.8rem; font-weight: 700;
            color: var(--teks-gelap);
            margin-bottom: 7px;
        }
        .field-hint { font-size: 0.73rem; color: var(--teks-abu); font-weight: 400; margin-left: 4px; }
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

        /* Area Upload Foto */
        .area-upload {
            border: 2px dashed var(--abu-garis);
            border-radius: 12px;
            padding: 28px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
            background: var(--abu-bg);
            position: relative;
        }
        .area-upload:hover { border-color: var(--hijau); background: var(--hijau-muda); }
        .area-upload.ada-file { border-color: var(--hijau); background: var(--hijau-muda); }
        .area-upload input[type="file"] {
            position: absolute; inset: 0;
            opacity: 0; cursor: pointer;
            width: 100%; height: 100%;
        }
        .upload-ikon { font-size: 36px; margin-bottom: 8px; }
        .upload-teks { font-size: 0.85rem; font-weight: 600; color: var(--teks-abu); }
        .upload-teks span { color: var(--hijau); }
        .upload-kecil { font-size: 0.74rem; color: var(--teks-abu); margin-top: 4px; }
        .preview-gambar {
            display: none;
            max-height: 120px;
            max-width: 120px;
            border-radius: 10px;
            margin: 0 auto 10px;
            object-fit: contain;
        }

        /* Tombol */
        .baris-tombol { display: flex; gap: 10px; }
        .btn-simpan {
            flex: 1;
            padding: 13px;
            background: var(--hijau);
            color: white;
            border: none;
            border-radius: 12px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.9rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-simpan:hover {
            background: var(--hijau-hover);
            transform: translateY(-1px);
            box-shadow: 0 4px 14px rgba(22,163,74,0.3);
        }
        .btn-kembali {
            padding: 13px 20px;
            background: var(--abu-bg);
            color: var(--teks-abu);
            border: 1.5px solid var(--abu-garis);
            border-radius: 12px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex; align-items: center;
            transition: all 0.2s;
        }
        .btn-kembali:hover { background: var(--teks-gelap); color: white; border-color: var(--teks-gelap); }

        /* Info Box */
        .info-box {
            background: var(--biru-muda);
            border-radius: 12px;
            padding: 14px 16px;
            font-size: 0.78rem;
            color: var(--biru);
            font-weight: 600;
            display: flex; gap: 8px; align-items: flex-start;
        }
    </style>
</head>
<body>

<div class="wrapper">
    <div class="halaman-header">
        <div class="header-ikon">📦</div>
        <div class="header-teks">
            <h1>Tambah Produk Baru</h1>
            <p>Produk akan langsung muncul di katalog kasir</p>
        </div>
    </div>

    <div class="kartu">
        <form action="/home/simpan_produk" method="POST" enctype="multipart/form-data">

            <div class="field">
                <label for="nama_produk">🏷️ Nama Produk</label>
                <input type="text" id="nama_produk" name="nama_produk" placeholder="Contoh: Es Teh Manis, Nasi Goreng..." required>
            </div>

            <div class="field">
                <label for="harga">💰 Harga Jual <span class="field-hint">(dalam Rupiah)</span></label>
                <input type="number" id="harga" name="harga" placeholder="Contoh: 15000" min="0" required>
            </div>

            <div class="field">
                <label>🖼️ Foto Produk <span class="field-hint">(PNG, JPG, SVG)</span></label>
                <div class="area-upload" id="area-upload">
                    <input type="file" name="foto_produk" id="input-foto" accept="image/png, image/svg+xml, image/jpeg" required>
                    <img src="" class="preview-gambar" id="preview-gambar" alt="Preview">
                    <div class="upload-ikon" id="upload-ikon">📷</div>
                    <div class="upload-teks"><span>Klik untuk upload</span> atau seret ke sini</div>
                    <div class="upload-kecil">Resolusi tinggi, ukuran max 5MB</div>
                </div>
            </div>

            <div class="baris-tombol">
                <a href="<?= base_url() ?>" class="btn-kembali">← Kembali</a>
                <button type="submit" class="btn-simpan">✓ Simpan Produk</button>
            </div>

        </form>
    </div>

    <div class="info-box">
        <span>💡</span>
        <span>Gunakan foto dengan latar belakang transparan (PNG) agar tampil lebih rapi di katalog.</span>
    </div>
</div>

<script>
    document.getElementById('input-foto').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function(ev) {
            const preview = document.getElementById('preview-gambar');
            const ikon = document.getElementById('upload-ikon');
            const area = document.getElementById('area-upload');
            preview.src = ev.target.result;
            preview.style.display = 'block';
            ikon.style.display = 'none';
            area.classList.add('ada-file');
        };
        reader.readAsDataURL(file);
    });
</script>

</body>
</html>