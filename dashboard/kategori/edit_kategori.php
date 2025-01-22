<?php
// Koneksi ke database
$mysqli = new mysqli("localhost", "root", "", "db_kasir");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Cek jika ada ID yang diterima dari URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil data kategori berdasarkan ID
    $query = "SELECT * FROM produk_kategori WHERE id = '$id'";
    $result = $mysqli->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nama_kategori = $row['nama_kategori'];
    } else {
        echo "Kategori tidak ditemukan!";
        exit;
    }
}

// Proses update kategori jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_kategori = $_POST['nama_kategori'];

    // Query untuk update kategori
    $query_update = "UPDATE produk_kategori SET nama_kategori = '$nama_kategori' WHERE id = '$id'";

    if ($mysqli->query($query_update) === TRUE) {
        echo "<div class='alert alert-success mt-3'>Kategori berhasil diperbarui!</div>";
    } else {
        echo "<div class='alert alert-danger mt-3'>Error: " . $query_update . "<br>" . $mysqli->error . "</div>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Edit Kategori</h2>

    <!-- Form Edit Kategori -->
    <form action="edit_kategori.php?id=<?php echo $id; ?>" method="POST">
        <div class="mb-3">
            <label for="nama_kategori" class="form-label">Nama Kategori</label>
            <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" value="<?php echo $nama_kategori; ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Perbarui Kategori</button>
    </form>
</div>

<!-- Menambahkan Bootstrap JS dan dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.0/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>

<?php
// Menutup koneksi ke database
$mysqli->close();
?>
