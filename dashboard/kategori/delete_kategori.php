<?php
// Koneksi ke database
$mysqli = new mysqli("localhost", "root", "", "db_kasir");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Mengecek apakah ada parameter ID dalam URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus kategori berdasarkan ID
    $query = "DELETE FROM produk_kategori WHERE id = $id";

    if ($mysqli->query($query) === TRUE) {
        header("Location: kategori.php"); // Redirect ke halaman kategori setelah penghapusan
        exit();
    } else {
        echo "Error: " . $mysqli->error;
    }
}

$mysqli->close();
?>
