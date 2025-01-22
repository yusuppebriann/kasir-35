<?php
// Koneksi ke database
$mysqli = new mysqli("localhost", "root", "", "db_kasir");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Menambahkan Satuan
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_satuan'])) {
    $nama_satuan = $_POST['nama_satuan'];

    // Query untuk menambah satuan
    $query = "INSERT INTO satuan (nama_satuan, created_at) 
              VALUES ('$nama_satuan', NOW())";  // NOW() untuk mendapatkan timestamp saat ini
    
    if ($mysqli->query($query) === TRUE) {
        echo "<div class='alert alert-success mt-3'>Satuan berhasil ditambahkan!</div>";
    } else {
        echo "<div class='alert alert-danger mt-3'>Error: " . $mysqli->error . "</div>";
    }
}

// Menghapus Satuan
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $query = "DELETE FROM satuan WHERE id = $id";
    
    if ($mysqli->query($query) === TRUE) {
        echo "<div class='alert alert-success mt-3'>Satuan berhasil dihapus!</div>";
    } else {
        echo "<div class='alert alert-danger mt-3'>Error: " . $mysqli->error . "</div>";
    }
}

// Mengambil Data Satuan
$query_satuan = "SELECT * FROM satuan";
$result_satuan = $mysqli->query($query_satuan);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Satuan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Tambah Satuan</h2>

    <!-- Form Tambah Satuan -->
    <form action="satuan.php" method="POST">
        <div class="mb-3">
            <label for="nama_satuan" class="form-label">Nama Satuan</label>
            <input type="text" class="form-control" id="nama_satuan" name="nama_satuan" required>
        </div>
        <button type="submit" name="add_satuan" class="btn btn-primary">Simpan Satuan</button>
    </form>

    <h3 class="mt-5">Daftar Satuan</h3>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Satuan</th>
                <th>Tanggal Dibuat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result_satuan->num_rows > 0) {
                while ($row = $result_satuan->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row['id'] . "</td>
                            <td>" . $row['nama_satuan'] . "</td>
                            <td>" . $row['created_at'] . "</td>
                            <td>
                                <a href='satuan.php?delete_id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus?\")'>Hapus</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='4' class='text-center'>Tidak ada satuan yang tersedia.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.0/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>

<?php
// Menutup koneksi ke database
$mysqli->close();
?>
