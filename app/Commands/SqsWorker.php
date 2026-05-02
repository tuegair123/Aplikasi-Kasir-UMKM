<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use Aws\Sqs\SqsClient;
use Aws\Exception\AwsException;

class SqsWorker extends BaseCommand
{
    // Nama perintah yang nanti kita ketik di terminal
    protected $group       = 'AWS';
    protected $name        = 'sqs:work';
    protected $description = 'Menjalankan robot worker untuk memproses antrean SQS WA Gateway.';

    public function run(array $params)
    {
        CLI::write('🤖 Mengaktifkan Robot SQS Worker...', 'green');

        // 1. Hubungkan Robot ke LocalStack AWS
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
            $queue = $sqsClient->getQueueUrl(['QueueName' => 'antrean-wa-umkm']);
            $queueUrl = $queue->get('QueueUrl');
            
            CLI::write('✅ Terhubung ke antrean. Menunggu pesanan masuk...', 'yellow');

            // 2. INFINITE LOOP (Jantung Robot yang berdetak terus menerus)
            while (true) {
                // Robot menengok ke dalam antrean SQS
                $result = $sqsClient->receiveMessage([
                    'QueueUrl'            => $queueUrl,
                    'MaxNumberOfMessages' => 1,
                    'WaitTimeSeconds'     => 5 // Long polling: Jika kosong, tunggu 5 detik di depan pintu
                ]);

                // 3. Jika ada pesan yang ditangkap...
                if ($result->hasKey('Messages')) {
                    $message = $result->get('Messages')[0];
                    $body = json_decode($message['Body'], true);
                    
                    CLI::write("\n" . '------------------------------------------------', 'cyan');
                    CLI::write('🔔 PESANAN BARU DITERIMA!', 'green');
                    
                    // Gunakan ?? untuk mencegah error jika format data lama/salah
                    CLI::write('ID Pesanan : ' . ($body['id_pesanan'] ?? 'N/A (Data Lama)'));
                    CLI::write('Pembeli    : ' . ($body['nama_pembeli'] ?? 'Tidak diketahui'));
                    CLI::write('Detail     : ' . ($body['detail_pesanan'] ?? $body['pesanan'] ?? 'Tidak ada detail'));
                    CLI::write('Total      : Rp ' . number_format($body['total_harga'] ?? 0, 0, ',', '.'));
                    
                    CLI::write('⚙️  Mensimulasikan pengiriman struk ke WhatsApp...', 'yellow');
                    sleep(2);
                    
                    // 4. Hapus pesan dari antrean
                    $sqsClient->deleteMessage([
                        'QueueUrl'      => $queueUrl,
                        'ReceiptHandle' => $message['ReceiptHandle']
                    ]);

                    CLI::write('✅ Struk berhasil dicetak! Pesan dihapus dari SQS.', 'green');
                    CLI::write('------------------------------------------------' . "\n", 'cyan');
                }
            }

        } catch (AwsException $e) {
            CLI::error('Robot Gagal: ' . $e->getMessage());
        }
    }
}