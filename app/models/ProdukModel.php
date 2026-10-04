<?php
/**
 * Model: ProdukModel
 * Bertanggung jawab melakukan query database (CRUD) untuk tabel produk_umkm
 */

require_once __DIR__ . '/../../config/database.php';

class ProdukModel {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    /**
     * Menampilkan semua data produk (dengan dukungan pencarian & filter kategori)
     */
    public function getAll($keyword = '', $kategori = '') {
        $sql = "SELECT * FROM produk_umkm WHERE 1=1";
        $params = [];

        if (!empty($keyword)) {
            $sql .= " AND (nama_produk LIKE :keyword OR nama_pemilik LIKE :keyword OR lokasi_umkm LIKE :keyword)";
            $params[':keyword'] = "%" . $keyword . "%";
        }

        if (!empty($kategori)) {
            $sql .= " AND kategori_produk = :kategori";
            $params[':kategori'] = $kategori;
        }

        $sql .= " ORDER BY id DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    /**
     * Mengambil 1 data produk berdasarkan ID
     */
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM produk_umkm WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    /**
     * Menambah data produk baru (Create)
     */
    public function create($data) {
        $sql = "INSERT INTO produk_umkm (nama_produk, nama_pemilik, kategori_produk, harga, nomor_whatsapp, lokasi_umkm, deskripsi, status_stok) 
                VALUES (:nama_produk, :nama_pemilik, :kategori_produk, :harga, :nomor_whatsapp, :lokasi_umkm, :deskripsi, :status_stok)";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':nama_produk'    => $data['nama_produk'],
            ':nama_pemilik'   => $data['nama_pemilik'],
            ':kategori_produk'=> $data['kategori_produk'],
            ':harga'          => $data['harga'],
            ':nomor_whatsapp' => $data['nomor_whatsapp'],
            ':lokasi_umkm'    => $data['lokasi_umkm'],
            ':deskripsi'      => $data['deskripsi'],
            ':status_stok'    => $data['status_stok']
        ]);
    }

    /**
     * Mengubah data produk yang sudah ada (Update)
     */
    public function update($id, $data) {
        $sql = "UPDATE produk_umkm SET 
                    nama_produk = :nama_produk,
                    nama_pemilik = :nama_pemilik,
                    kategori_produk = :kategori_produk,
                    harga = :harga,
                    nomor_whatsapp = :nomor_whatsapp,
                    lokasi_umkm = :lokasi_umkm,
                    deskripsi = :deskripsi,
                    status_stok = :status_stok
                WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':id'             => $id,
            ':nama_produk'    => $data['nama_produk'],
            ':nama_pemilik'   => $data['nama_pemilik'],
            ':kategori_produk'=> $data['kategori_produk'],
            ':harga'          => $data['harga'],
            ':nomor_whatsapp' => $data['nomor_whatsapp'],
            ':lokasi_umkm'    => $data['lokasi_umkm'],
            ':deskripsi'      => $data['deskripsi'],
            ':status_stok'    => $data['status_stok']
        ]);
    }

    /**
     * Menghapus data produk berdasarkan ID (Delete)
     */
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM produk_umkm WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    /**
     * Mengambil daftar kategori unik untuk opsi filter dropdown
     */
    public function getKategoriList() {
        $stmt = $this->db->query("SELECT DISTINCT kategori_produk FROM produk_umkm ORDER BY kategori_produk ASC");
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    /**
     * Mengambil statistik ringkas untuk ringkasan katalog
     */
    public function getStatistik() {
        $totalProduk = $this->db->query("SELECT COUNT(*) FROM produk_umkm")->fetchColumn();
        $totalUmkm = $this->db->query("SELECT COUNT(DISTINCT nama_pemilik) FROM produk_umkm")->fetchColumn();
        $rataHarga = $this->db->query("SELECT AVG(harga) FROM produk_umkm")->fetchColumn();

        return [
            'total_produk' => $totalProduk ?: 0,
            'total_umkm'   => $totalUmkm ?: 0,
            'rata_harga'   => $rataHarga ?: 0
        ];
    }
}
