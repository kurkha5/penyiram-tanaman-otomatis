<?php
// Include file koneksi
require_once '../conn.php';

// Set header untuk JSON
header("Content-Type: application/json");

// Query untuk mengambil data dari database
$sql = "SELECT * FROM sensor ORDER BY id DESC LIMIT 12";
$result = $conn->query($sql);

if ($result === false) {
    // Jika query gagal
    echo json_encode(["error" => "Gagal menjalankan query."]);
} else {
    // Jika query berhasil
    $data = [];

    // Mengambil data dan menyimpannya dalam array
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    // Menampilkan data dalam format JSON
    echo json_encode($data);
}

// Menutup koneksi
$conn->close();
?>
