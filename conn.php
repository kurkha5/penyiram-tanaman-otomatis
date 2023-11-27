<?php
// Informasi koneksi database
$servername = "localhost";  // Ganti dengan nama server database Anda
$username = "root";     // Ganti dengan nama pengguna database Anda
$password = "";     // Ganti dengan kata sandi database Anda
$database = "websensor"; // Ganti dengan nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $database);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
