<?php
// Front Controller / Router (index.php)
require_once __DIR__ . '/app/controllers/ProdukController.php';

$controller = new ProdukController();
$action = $_GET['action'] ?? 'index';

if ($action === 'tambah') {
    $controller->tambah();
} elseif ($action === 'edit') {
    $controller->edit();
} elseif ($action === 'hapus') {
    $controller->hapus();
} else {
    $controller->index();
}
