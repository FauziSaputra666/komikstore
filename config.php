<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "komik_store"; // Nama database yang sudah dibuat sebelumnya

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
