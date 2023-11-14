<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'idn';

$koneksi = new mysqli($host, $username, $password, $database);

if ($koneksi->connect_error) {
    die("Koneksi Gagal: " . $koneksi->connect_error);
} else {
    // echo "Koneksi Berhasil";
}
?>