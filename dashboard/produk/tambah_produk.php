<?php
// Koneksi ke database
$mysqli = new mysqli("localhost", "root", "", "db_kasir");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Proses penambahan produk jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $toko_id = $_POST['toko_id'];
    $kategori_id = $_POST['kategori_id'];
    $satuan_id = $_POST['satuan_id'];
    $nama_produk = $_POST['nama_produk'];
    $harga_beli = $_POST['harga_beli'];
    $harga_jual = $_POST['harga_jual'];

    // Query untuk menambah produk baru
    $query = "INSERT INTO produk (toko_id, kategori_id, satuan_id, nama_produk, harga_beli, harga_jual, created_at)
              VALUES ('$toko_id', '$kategori_id', '$id', '$nama_produk', '$harga_beli', '$harga_jual', NOW())";
    
    if ($mysqli->query($query) === TRUE) {
        echo "Produk berhasil ditambahkan!";
    } else {
        echo "Error: " . $query . "<br>" . $mysqli->error;
    }
}

// Query untuk mengambil data kategori dari tabel 'produk_kategori'
$query_kategori = "SELECT * FROM produk_kategori";
$result_kategori = $mysqli->query($query_kategori);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
    <!-- Menambahkan Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Tambah Produk</h2>

    <!-- Form Tambah Produk -->
    <form action="tambah_produk.php" method="POST">
        <div class="mb-3">
            <label for="toko_id" class="form-label">ID Toko</label>
            <input type="number" class="form-control" id="toko_id" name="toko_id" required>
        </div>

        <div class="mb-3">
            <label for="kategori_id" class="form-label">Kategori</label>
            <select class="form-select" id="kategori_id" name="kategori_id" required>
                <option value="">Pilih Kategori</option>
                <?php
                // Menampilkan kategori yang diambil dari tabel 'produk_kategori'
                if ($result_kategori->num_rows > 0) {
                    while ($row = $result_kategori->fetch_assoc()) {
                        echo "<option value='" . $row['id'] . "'>" . $row['nama_kategori'] . "</option>";
                    }
                } else {
                    echo "<option value=''>Tidak ada kategori</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="satuan_id" class="form-label">ID Satuan</label>
            <input type="number" class="form-control" id="satuan_id" name="satuan_id" required>
        </div>

        <div class="mb-3">
            <label for="nama_produk" class="form-label">Nama Produk</label>
            <input type="text" class="form-control" id="nama_produk" name="nama_produk" required>
        </div>

        <div class="mb-3">
            <label for="harga_beli" class="form-label">Harga Beli</label>
            <input type="number" class="form-control" id="harga_beli" name="harga_beli" required>
        </div>

        <div class="mb-3">
            <label for="harga_jual" class="form-label">Harga Jual</label>
            <input type="number" class="form-control" id="harga_jual" name="harga_jual" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Produk</button>
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
