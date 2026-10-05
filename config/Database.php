<?php
// Database.php - Koneksi PDO Sederhana
class Database {
    public static function connect() {
        return new PDO("mysql:host=localhost;dbname=db_katalog_umkm", "root", "");
    }
}