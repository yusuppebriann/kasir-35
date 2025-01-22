<?php
// Koneksi ke database
$mysqli = new mysqli("localhost", "root", "", "db_kasir");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Memeriksa apakah ada ID yang diterima
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mengambil data supplier berdasarkan ID
    $query = "SELECT * FROM supplier WHERE id = '$id'";
    $result = $mysqli->query($query);

    if ($result->num_rows > 0) {
        $supplier = $result->fetch_assoc();
    } else {
        echo "Supplier tidak ditemukan!";
        exit;
    }
}

// Proses pembaruan data supplier jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $toko_id = $_POST['toko_id'];
    $nama_supplier = $_POST['nama_supplier'];
    $tlp_hp = $_POST['tlp_hp'];
    $alamat_supplier = $_POST['alamat_supplier'];

    // Query untuk memperbarui data supplier
    $query_update = "UPDATE supplier SET toko_id = '$toko_id', nama_supplier = '$nama_supplier', tlp_hp = '$tlp_hp', alamat_supplier = '$alamat_supplier' WHERE id = '$id'";

    if ($mysqli->query($query_update) === TRUE) {
        echo "<div class='alert alert-success mt-3'>Supplier berhasil diperbarui!</div>";
    } else {
        echo "<div class='alert alert-danger mt-3'>Error: " . $mysqli->error . "</div>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Supplier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Edit Supplier</h2>

    <!-- Form Edit Supplier -->
    <form action="edit_supplier.php?id=<?php echo $id; ?>" method="POST">
        <div class="mb-3">
            <label for="toko_id" class="form-label">ID Toko</label>
            <input type="number" class="form-control" id="toko_id" name="toko_id" value="<?php echo $supplier['toko_id']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="nama_supplier" class="form-label">Nama Supplier</label>
            <input type="text" class="form-control" id="nama_supplier" name="nama_supplier" value="<?php echo $supplier['nama_supplier']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="tlp_hp" class="form-label">Nomor Telepon</label>
            <input type="text" class="form-control" id="tlp_hp" name="tlp_hp" value="<?php echo $supplier['tlp_hp']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="alamat_supplier" class="form-label">Alamat Supplier</label>
            <textarea class="form-control" id="alamat_supplier" name="alamat_supplier" rows="3" required><?php echo $supplier['alamat_supplier']; ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.0/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>

<?php
// Menutup koneksi ke database
$mysqli->close();
?>
