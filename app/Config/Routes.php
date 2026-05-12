<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('home', 'Home::index');
$routes->get('home/test_wa', 'Home::test_wa');
$routes->post('home/proses_checkout', 'Home::proses_checkout');
// Rute untuk halaman upload produk
$routes->get('home/tambah_produk', 'Home::tambah_produk');
$routes->post('home/simpan_produk', 'Home::simpan_produk');
// Rute untuk menghapus produk beserta gambarnya di S3 (menerima ID produk)
$routes->get('home/hapus_produk/(:num)', 'Home::hapus_produk/$1');
// Rute untuk melihat dasbor laporan keuangan
$routes->get('home/dashboard', 'Home::dashboard');
// Rute Autentikasi
$routes->get('login', 'Auth::index');
$routes->post('auth/proses', 'Auth::proses');
$routes->get('logout', 'Auth::logout');
// Rute untuk mencetak struk kasir berdasarkan ID Pesanan
$routes->get('home/cetak_nota/(:num)', 'Home::cetak_nota/$1');