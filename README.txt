Tugas Aplikasi Kasir Omnichannel (Event-Driven Architecture)

Cara Menjalankan Proyek:
1. Nyalakan Docker Desktop.
2. Buka terminal di folder ini, jalankan: docker-compose up -d
3. Buat database baru bernama 'db_omnichannel' di MySQL, lalu import file 'db_omnichannel.sql' ke dalamnya.
4. Buka terminal baru, masuk ke folder aplikasi-kasir, jalankan server: php spark serve
5. Buka terminal satu lagi, masuk ke folder aplikasi-kasir, jalankan robot SQS: php spark sqs:work
6. Buka browser dan akses: http://localhost:8080/

Catatan:
- Halaman Kasir (Frontend): http://localhost:8080/
- Halaman Dasbor (Admin): http://localhost:8080/home/dashboard
- Login Admin -> Username: admin | Password: rahasia123