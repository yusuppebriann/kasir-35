<?php
// Koneksi ke database
$mysqli = new mysqli("localhost", "root", "", "db_kasir");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Memeriksa apakah ada ID yang diterima
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus supplier berdasarkan ID
    $query = "DELETE FROM supplier WHERE id = '$id'";

    if ($mysqli->query($query) === TRUE) {
        echo "<div class='alert alert-success mt-3'>Supplier berhasil dihapus!</div>";
    } else {
        echo "<div class='alert alert-danger mt-3'>Error: " . $mysqli->error . "</div>";
    }
}

// Mengarahkan kembali ke halaman utama setelah operasi hapus
header("Location: supplier.php");
exit;

$mysqli->close();
?>
