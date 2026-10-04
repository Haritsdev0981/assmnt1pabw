<?php
/**
 * Controller: ProdukController
 * Menghubungkan Model (ProdukModel) dan View (Tampilan aplikasi)
 * Mengolah masukan dari form, validasi, serta alur pengalihan halaman (redirect).
 */

require_once __DIR__ . '/../models/ProdukModel.php';

class ProdukController {
    private $model;

    public function __construct() {
        $this->model = new ProdukModel();
    }

    /**
     * Halaman Utama Katalog & Tabel Kelola Produk (Read Data)
     */
    public function index() {
        $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
        $kategori = isset($_GET['kategori']) ? trim($_GET['kategori']) : '';
        $viewMode = isset($_GET['view']) && $_GET['view'] === 'table' ? 'table' : 'grid';

        $daftarProduk = $this->model->getAll($keyword, $kategori);
        $kategoriList = $this->model->getKategoriList();
        $statistik = $this->model->getStatistik();

        // Format nomor WhatsApp untuk setiap produk menjadi link otomatis
        foreach ($daftarProduk as &$produk) {
            $produk['link_wa'] = $this->formatWaLink($produk['nomor_whatsapp'], $produk['nama_produk']);
        }

        // Render tampilan index
        require_once __DIR__ . '/../views/produk/index.php';
    }

    /**
     * Halaman Detail Produk
     */
    public function detail() {
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $produk = $this->model->getById($id);

        if (!$produk) {
            $_SESSION['flash_error'] = "Data produk tidak ditemukan!";
            header("Location: index.php");
            exit;
        }

        $produk['link_wa'] = $this->formatWaLink($produk['nomor_whatsapp'], $produk['nama_produk']);

        require_once __DIR__ . '/../views/produk/detail.php';
    }

    /**
     * Tambah Produk Baru (Create Data)
     */
    public function tambah() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Tangkap dan bersihkan input user
            $namaProduk   = trim($_POST['nama_produk'] ?? '');
            $namaPemilik  = trim($_POST['nama_pemilik'] ?? '');
            $kategori     = trim($_POST['kategori_produk'] ?? '');
            $harga        = floatval($_POST['harga'] ?? 0);
            $whatsapp     = $this->sanitasiNomorWa($_POST['nomor_whatsapp'] ?? '');
            $lokasi       = trim($_POST['lokasi_umkm'] ?? 'Tidak Ditentukan');
            $deskripsi    = trim($_POST['deskripsi'] ?? '');
            $statusStok   = trim($_POST['status_stok'] ?? 'Tersedia');

            // Validasi Sederhana
            if (empty($namaProduk) || empty($namaPemilik) || empty($kategori) || $harga <= 0 || empty($whatsapp)) {
                $error = "Harap isi semua kolom wajib dengan data yang valid!";
                require_once __DIR__ . '/../views/produk/tambah.php';
                return;
            }

            $data = [
                'nama_produk'    => $namaProduk,
                'nama_pemilik'   => $namaPemilik,
                'kategori_produk'=> $kategori,
                'harga'          => $harga,
                'nomor_whatsapp' => $whatsapp,
                'lokasi_umkm'    => $lokasi,
                'deskripsi'      => $deskripsi,
                'status_stok'    => $statusStok
            ];

            if ($this->model->create($data)) {
                $_SESSION['flash_success'] = "Produk UMKM berhasil ditambahkan ke katalog!";
                header("Location: index.php");
                exit;
            } else {
                $error = "Gagal menyimpan data produk ke database.";
                require_once __DIR__ . '/../views/produk/tambah.php';
            }
        } else {
            // Tampilkan form tambah
            require_once __DIR__ . '/../views/produk/tambah.php';
        }
    }

    /**
     * Ubah Data Produk (Update Data)
     */
    public function edit() {
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $produk = $this->model->getById($id);

        if (!$produk) {
            $_SESSION['flash_error'] = "Data produk tidak ditemukan!";
            header("Location: index.php");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $namaProduk   = trim($_POST['nama_produk'] ?? '');
            $namaPemilik  = trim($_POST['nama_pemilik'] ?? '');
            $kategori     = trim($_POST['kategori_produk'] ?? '');
            $harga        = floatval($_POST['harga'] ?? 0);
            $whatsapp     = $this->sanitasiNomorWa($_POST['nomor_whatsapp'] ?? '');
            $lokasi       = trim($_POST['lokasi_umkm'] ?? 'Tidak Ditentukan');
            $deskripsi    = trim($_POST['deskripsi'] ?? '');
            $statusStok   = trim($_POST['status_stok'] ?? 'Tersedia');

            if (empty($namaProduk) || empty($namaPemilik) || empty($kategori) || $harga <= 0 || empty($whatsapp)) {
                $error = "Harap isi semua kolom wajib dengan data yang valid!";
                require_once __DIR__ . '/../views/produk/edit.php';
                return;
            }

            $data = [
                'nama_produk'    => $namaProduk,
                'nama_pemilik'   => $namaPemilik,
                'kategori_produk'=> $kategori,
                'harga'          => $harga,
                'nomor_whatsapp' => $whatsapp,
                'lokasi_umkm'    => $lokasi,
                'deskripsi'      => $deskripsi,
                'status_stok'    => $statusStok
            ];

            if ($this->model->update($id, $data)) {
                $_SESSION['flash_success'] = "Data produk berhasil diperbarui!";
                header("Location: index.php");
                exit;
            } else {
                $error = "Gagal memperbarui data produk.";
                require_once __DIR__ . '/../views/produk/edit.php';
            }
        } else {
            // Tampilkan form edit pre-filled
            require_once __DIR__ . '/../views/produk/edit.php';
        }
    }

    /**
     * Hapus Data Produk (Delete Data)
     */
    public function hapus() {
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        
        if ($id > 0) {
            if ($this->model->delete($id)) {
                $_SESSION['flash_success'] = "Produk berhasil dihapus dari katalog.";
            } else {
                $_SESSION['flash_error'] = "Gagal menghapus produk.";
            }
        }
        
        header("Location: index.php");
        exit;
    }

    /**
     * Helper: Membersihkan & memformat nomor WA ke standar internasional (628xxxx)
     */
    private function sanitasiNomorWa($nomor) {
        // Hapus karakter selain angka
        $nomor = preg_replace('/[^0-9]/', '', $nomor);

        // Ubah awalan 08xxx menjadi 628xxx
        if (substr($nomor, 0, 1) === '0') {
            $nomor = '62' . substr($nomor, 1);
        } elseif (substr($nomor, 0, 2) !== '62') {
            $nomor = '62' . $nomor;
        }

        return $nomor;
    }

    /**
     * Helper: Membuat URL Direct Chat WhatsApp dengan template pesan otomatis
     */
    private function formatWaLink($nomor, $namaProduk) {
        $pesan = "Halo kak, saya tertarik dengan produk *" . $namaProduk . "* yang ada di Katalog UMKM. Apakah masih tersedia?";
        return "https://api.whatsapp.com/send?phone=" . $nomor . "&text=" . urlencode($pesan);
    }
}
