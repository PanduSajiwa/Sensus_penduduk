<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// =======================================
// 🔹 DEFAULT ROUTE
// =======================================
$routes->get('/', 'AuthController::index'); // Halaman login utama


// =======================================
// 🔹 AUTHENTICATION
// =======================================
$routes->group('', function ($routes) {
    $routes->get('login', 'AuthController::index');       // Form login
    $routes->post('login', 'AuthController::login');      // Proses login
    $routes->post('login/auth', 'AuthController::login'); // Alias untuk form lama
    $routes->get('logout', 'AuthController::logout');     // Logout user
});


// =======================================
// 🔹 DASHBOARD UTAMA
// =======================================
$routes->get('dashboard', 'DashboardController::index');


// =======================================
// 🔹 CRUD DATA SENSUS (Tanpa JWT agar bisa lewat web)
// =======================================
$routes->group('sensus', function ($routes) {
    $routes->get('/', 'SensusController::index');                   // Tabel data penduduk
    $routes->get('create', 'SensusController::create');              // Form tambah
    $routes->post('store', 'SensusController::store');               // Simpan data
    $routes->get('edit/(:num)', 'SensusController::edit/$1');        // Form edit
    $routes->post('update/(:num)', 'SensusController::update/$1');   // Simpan perubahan
    $routes->get('delete/(:num)', 'SensusController::delete/$1');    // Hapus data
});


// =======================================
// 🔹 MASTER DATA KOTA
// =======================================
$routes->group('kota', function ($routes) {
    $routes->get('/', 'KotaController::index');                      // List semua kota
    $routes->post('store', 'KotaController::store');                 // Tambah kota
    $routes->post('update/(:num)', 'KotaController::update/$1');     // Update kota
    $routes->get('delete/(:num)', 'KotaController::delete/$1');      // Hapus kota
});


// =======================================
// 🔹 MASTER DATA PROVINSI
// =======================================
$routes->group('provinsi', function ($routes) {
    $routes->get('/', 'ProvinsiController::index');                  // List semua provinsi
    $routes->post('store', 'ProvinsiController::store');             // Tambah provinsi
    $routes->post('update/(:num)', 'ProvinsiController::update/$1'); // Update provinsi
    $routes->get('delete/(:num)', 'ProvinsiController::delete/$1');  // Hapus provinsi
});


// =======================================
// 🔹 API (JWT Protected) — opsional untuk pengujian
// =======================================
$routes->group('api', ['filter' => 'jwt'], function ($routes) {
    $routes->post('login', 'AuthController::apiLogin');              // Login via JWT
    $routes->get('sensus', 'SensusController::apiIndex');            // API Data Sensus
    $routes->get('test', 'AuthController::test');                    // Endpoint test token
});

$routes->get('token/expired', 'AuthController::expiredToken');       // Handle token kadaluarsa

