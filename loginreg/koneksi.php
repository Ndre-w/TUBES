<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "contoh_db";

$koneksi = new mysqli($servername, $username, $password, $dbname);

if ($koneksi->connect_error) {
    die("Koneksi Gagal: " . $koneksi->connect_error);
}
?>
