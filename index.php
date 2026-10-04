<?php
/**
 * Front Controller / Router Utama Application
 * Aplikasi Katalog UMKM & Produk Lokal
 * 
 * Semua permintaan (request) masuk melalui file ini dan diteruskan 
 * ke Controller yang sesuai berdasarkan parameter 'action'.
 */

session_start();

// Load Controller
require_once __DIR__ . '/app/controllers/ProdukController.php';

// Inisialisasi Controller
$controller = new ProdukController();

// Ambil parameter action dari URL (default: 'index')
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// Routing sederhana berdasarkan action
switch ($action) {
    case 'tambah':
        $controller->tambah();
        break;

    case 'edit':
        $controller->edit();
        break;

    case 'hapus':
        $controller->hapus();
        break;

    case 'detail':
        $controller->detail();
        break;

    case 'index':
    default:
        $controller->index();
        break;
}
