<?php
include '../conn.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Periksa apakah parameter nama ada dalam URL
    if (isset($_GET["sensor"])) {
        $sensor = $_GET["sensor"];

        // Lakukan operasi INSERT ke dalam database sesuai kebutuhan
        // Disarankan menggunakan prepared statement untuk menghindari serangan SQL injection

        // Contoh:
        $query = "INSERT INTO sensor (`sensor1`, `created_At`, `updated_At`) VALUES ('$sensor', NOW(), NOW() )";
        $result = $conn->query($query);

        echo "Data berhasil ditambahkan: $sensor";
    } else {
        echo "Parameter sensor tidak ditemukan dalam URL.";
    }
} else {
    echo "Metode permintaan tidak valid.";
}

?>