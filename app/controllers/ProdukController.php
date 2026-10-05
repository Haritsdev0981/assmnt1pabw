<?php
// Controller: ProdukController.php (Logika Aplikasi)
require_once __DIR__ . '/../models/ProdukModel.php';

class ProdukController {
    private $model;

    public function __construct() {
        $this->model = new ProdukModel();
    }

    // Tampilkan Katalog Produk
    public function index() {
        $keyword = $_GET['keyword'] ?? '';
        $produk = $this->model->getAll($keyword);
        require_once __DIR__ . '/../views/produk/index.php';
    }

    // Tambah Produk Baru
    public function tambah() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->create($_POST);
            header("Location: index.php");
            exit;
        }
        require_once __DIR__ . '/../views/produk/tambah.php';
    }

    // Edit Data Produk
    public function edit() {
        $id = $_GET['id'] ?? 0;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->update($id, $_POST);
            header("Location: index.php");
            exit;
        }
        $produk = $this->model->getById($id);
        require_once __DIR__ . '/../views/produk/edit.php';
    }

    // Hapus Produk
    public function hapus() {
        $id = $_GET['id'] ?? 0;
        $this->model->delete($id);
        header("Location: index.php");
        exit;
    }
}
