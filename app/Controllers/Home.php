<?php

namespace App\Controllers;

use Aws\S3\S3Client;
use Aws\Sqs\SqsClient;
use Aws\Exception\AwsException;

class Home extends BaseController
{   
    public function proses_checkout()
    {
        // 1. Tangkap data JSON yang dikirim oleh JavaScript
        $json = $this->request->getJSON();
        
        if (!$json) {
            return $this->response->setJSON(['status' => 'error', 'pesan' => 'Data kosong']);
        }

        // 2. Hubungkan ke Database MySQL
        $db = \Config\Database::connect();
        
        // Rangkai detail pesanan jadi teks (misal: "Beras 1Kg (x2), Minyak (x1)")
        $detail_pesanan = "";
        foreach($json->keranjang as $nama => $item) {
            $detail_pesanan .= $nama . " (x" . $item->jumlah . "), ";
        }

        // Siapkan data untuk dimasukkan ke tabel 'pesanan'
        $dataPesanan = [
            'warung_id' => 1, // Anggap ini akun warung ID 1
            'nama_pembeli' => 'Pelanggan Langsung', // Karena lewat kasir offline
            'detail_pesanan' => rtrim($detail_pesanan, ", "), // Hapus koma terakhir
            'total_harga' => $json->totalBelanja,
        ];
        
        // Simpan ke database!
        $db->table('pesanan')->insert($dataPesanan);
        $pesanan_id = $db->insertID(); // Ambil ID transaksi yang baru saja dibuat

        // 3. Lempar ke Antrean SQS (AWS LocalStack)
        $sqsClient = new \Aws\Sqs\SqsClient([
            'version'     => 'latest',
            'region'      => getenv('AWS_REGION'),
            'endpoint'    => getenv('AWS_ENDPOINT'),
            'credentials' => [
                'key'    => getenv('AWS_ACCESS_KEY_ID'),
                'secret' => getenv('AWS_SECRET_ACCESS_KEY'),
            ],
        ]);

        try {
            $queue = $sqsClient->getQueueUrl(['QueueName' => 'antrean-wa-umkm']);
            $dataPesanan['id_pesanan'] = $pesanan_id; // Sisipkan ID pesanan untuk dikirim ke WA
            
            $sqsClient->sendMessage([
                'QueueUrl'    => $queue->get('QueueUrl'),
                'MessageBody' => json_encode($dataPesanan)
            ]);

            // Kirim balasan sukses ke JavaScript
            return $this->response->setJSON(['status' => 'success', 'pesan' => 'Transaksi Berhasil !!']);
        } catch (\Aws\Exception\AwsException $e) {
            return $this->response->setJSON(['status' => 'error', 'pesan' => $e->getMessage()]);
        }
    }

    public function index()
    {
        // Cek apakah user sudah punya session login
        if (!session()->get('is_logged_in')) {
        // Jika belum login, arahkan paksa ke halaman login
        return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu!');
        }

        // Jika sudah login, barulah ambil data produk dan tampilkan halaman kasir
        $db = \Config\Database::connect();
        $data_produk = $db->table('produk')->get()->getResult(); 

        $data = [
            'katalog_produk' => $data_produk
        ];

        return view('kasir', $data);
    }

    // Fungsi baru untuk menguji antrean WA Gateway
    public function test_wa()
    {
        // 1. Inisialisasi Klien SQS
        $sqsClient = new SqsClient([
            'version'     => 'latest',
            'region'      => getenv('AWS_REGION'),
            'endpoint'    => getenv('AWS_ENDPOINT'),
            'credentials' => [
                'key'    => getenv('AWS_ACCESS_KEY_ID'),
                'secret' => getenv('AWS_SECRET_ACCESS_KEY'),
            ],
        ]);

        try {
            // 2. Dapatkan alamat URL dari antrean yang kita buat di terminal sebelumnya
            $queue = $sqsClient->getQueueUrl([
                'QueueName' => 'antrean-wa-umkm'
            ]);
            $queueUrl = $queue->get('QueueUrl');

            // 3. Siapkan data simulasi pesanan (nantinya ini diambil dari form pembeli)
            $pesan = [
                'warung_id' => 1,
                'nama_pembeli' => 'Budi Santoso',
                'pesanan' => '2kg Beras, 1L Minyak Goreng',
                'total_harga' => 45000,
                'waktu_pesan' => date('Y-m-d H:i:s')
            ];

            // 4. Lempar data tersebut ke dalam antrean SQS
            $result = $sqsClient->sendMessage([
                'QueueUrl'    => $queueUrl,
                'MessageBody' => json_encode($pesan)
            ]);

            echo "<h2>Simulasi Checkout Berhasil! 🛒</h2>";
            echo "<p>Pesan telah dilempar ke antrean SQS dan siap dikirim ke WA pedagang.</p>";
            echo "<b>Message ID dari AWS:</b> " . $result->get('MessageId') . "<br><br>";
            echo "<b>Data yang mengantre:</b><br>";
            echo "<pre>" . json_encode($pesan, JSON_PRETTY_PRINT) . "</pre>";

        } catch (AwsException $e) {
            echo "<h3>Gagal terhubung ke SQS:</h3>";
            echo $e->getMessage();
        }
    }

    public function tambah_produk()
    {
        // CEK TIKET LOGIN
        if (!session()->get('is_logged_in')) return redirect()->to('/login');
        
        return view('tambah_produk');
    }

    // Memproses data yang dikirim dari form
    public function simpan_produk()
    {
        $nama_produk = $this->request->getPost('nama_produk');
        $harga = $this->request->getPost('harga');
        $file = $this->request->getFile('foto_produk');

        if ($file->isValid() && ! $file->hasMoved()) {
            
            // 1. Hubungkan ke AWS S3 LocalStack
            $s3Client = new \Aws\S3\S3Client([
                'version'     => 'latest',
                'region'      => getenv('AWS_REGION'),
                'endpoint'    => getenv('AWS_ENDPOINT'),
                'use_path_style_endpoint' => true,
                'credentials' => [
                    'key'    => getenv('AWS_ACCESS_KEY_ID'),
                    'secret' => getenv('AWS_SECRET_ACCESS_KEY'),
                ],
            ]);

            // 2. Buat nama file unik agar tidak bentrok
            $namaFileBaru = $file->getRandomName();

            try {
                // 3. Upload file fisik ke Bucket S3 'katalog-umkm'
                $s3Client->putObject([
                    'Bucket'     => 'katalog-umkm',
                    'Key'        => $namaFileBaru,
                    'SourceFile' => $file->getTempName(),
                    'ContentType'=> $file->getMimeType()
                ]);

                // 4. Rakit URL gambar dari S3
                $foto_url = getenv('AWS_ENDPOINT') . '/katalog-umkm/' . $namaFileBaru;

                // 5. Simpan data lengkap ke Database MySQL
                $db = \Config\Database::connect();
                $db->table('produk')->insert([
                    'warung_id'   => 1,
                    'nama_produk' => $nama_produk,
                    'harga'       => $harga,
                    'stok'        => 99,
                    'foto_url'    => $foto_url // Menyimpan link dari S3!
                ]);

                // Kembali ke halaman kasir dengan sukses
                echo "<script>alert('Produk berhasil diunggah!'); window.location.href='/';</script>";

            } catch (\Aws\Exception\AwsException $e) {
                echo "Gagal upload ke S3: " . $e->getMessage();
            }
        } else {
            echo "File tidak valid atau error saat upload.";
        }
    }

    public function hapus_produk($id)
{
    // ... (kode hapus database dan S3 milikmu) ...

    // JANGAN gunakan redirect()->to('/') karena bisa terjebak di index.php
    // GUNAKAN redirect()->to(base_url()) agar dia selalu mengikuti port yang sedang jalan (8081)
    return redirect()->to(base_url())->with('success', 'Produk berhasil dihapus!');
}
    
    public function dashboard()
    {
        // CEK TIKET LOGIN: Jika tidak ada, tendang ke halaman login
        if (!session()->get('is_logged_in')) return redirect()->to('/login');

        $db = \Config\Database::connect();
        // ... (kode dashboard yang sudah ada di bawahnya biarkan saja)
        
        // 1. Hitung total semua uang yang masuk (SUM)
        $query_uang = $db->query("SELECT SUM(total_harga) as total_pendapatan FROM pesanan WHERE warung_id = 1");
        $uang = $query_uang->getRow()->total_pendapatan;

        // 2. Hitung berapa kali transaksi terjadi (COUNT)
        $jumlah_transaksi = $db->table('pesanan')->where('warung_id', 1)->countAllResults();

        // 3. Ambil daftar riwayat pesanan terbaru untuk ditampilkan di tabel
        // Kita ganti 'waktu_pesan' menjadi 'id'
        $riwayat_pesanan = $db->table('pesanan')->where('warung_id', 1)->orderBy('id', 'DESC')->get()->getResult();

        // Bungkus datanya untuk dikirim ke tampilan
        $data = [
            'total_pendapatan' => $uang ? $uang : 0, // Jika belum ada transaksi, jadikan 0
            'jumlah_transaksi' => $jumlah_transaksi,
            'riwayat'          => $riwayat_pesanan
        ];

        return view('dashboard', $data);
    }

    public function cetak_nota($id)
    {
        // Tetap lindungi rute ini agar hanya penjual yang bisa mencetak
        if (!session()->get('is_logged_in')) return redirect()->to('/login');

        $db = \Config\Database::connect();
        
        // Ambil data pesanan berdasarkan ID
        $pesanan = $db->table('pesanan')->where('id', $id)->get()->getRow();

        // Jika pesanannya tidak ditemukan, kembalikan ke dashboard
        if (!$pesanan) {
            return redirect()->to('/home/dashboard');
        }

        $data = [
            'nota' => $pesanan
        ];

        return view('cetak_nota', $data);
    }
    
}