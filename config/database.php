<?php
/**
 * Konfigurasi Koneksi Database MySQL menggunakan PDO
 * Aplikasi Katalog UMKM & Produk Lokal
 */

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', ''); // Default XAMPP password biasanya kosong ''
define('DB_NAME', 'db_katalog_umkm');

class Database {
    private static $koneksi = null;

    /**
     * Mengambil instance koneksi PDO (Singleton Pattern Sederhana)
     */
    public static function connect() {
        if (self::$koneksi === null) {
            try {
                $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
                self::$koneksi = new PDO($dsn, DB_USER, DB_PASS, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]);
            } catch (PDOException $e) {
                // Tampilkan pesan error sederhana jika koneksi gagal
                die("<div style='font-family: sans-serif; padding: 20px; background: #fee2e2; color: #991b1b; border-radius: 8px; margin: 20px;'>
                        <h3>❌ Gagal Terhubung ke Database MySQL!</h3>
                        <p>Pastikan MySQL di XAMPP sudah dinyalakan dan database <b>" . DB_NAME . "</b> sudah di-import.</p>
                        <p><small>Detail Error: " . htmlspecialchars($e->getMessage()) . "</small></p>
                     </div>");
            }
        }
        return self::$koneksi;
    }
}
