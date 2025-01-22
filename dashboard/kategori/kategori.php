<?php
// Koneksi ke database
$mysqli = new mysqli("localhost", "root", "", "db_kasir");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Proses penambahan kategori jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_kategori = $_POST['nama_kategori'];

    // Query untuk menambah kategori baru dengan menambahkan nilai created_at
    $query = "INSERT INTO produk_kategori (nama_kategori, created_at) VALUES ('$nama_kategori', NOW())";
    
    if ($mysqli->query($query) === TRUE) {
        echo "<div class='alert alert-success mt-3'>Kategori berhasil ditambahkan!</div>";
    } else {
        echo "<div class='alert alert-danger mt-3'>Error: " . $query . "<br>" . $mysqli->error . "</div>";
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
    <title>Kelola Kategori</title>
    <!-- Menambahkan Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Menambahkan Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
        }
        /* Custom CSS untuk menyesuaikan dengan desain */
        /* Sidebar */
        .sidebar {
            min-height: 100vh;
            background-color: #34495e; /* Warna sidebar sesuai dengan index.php */
            width: 250px; /* Lebar sidebar */
            position: fixed;
            left: 0;
            top: 0;
            padding-top: 20px;
            z-index: 100; /* Agar sidebar selalu di depan konten utama */
        }

        .sidebar .sidebar-header {
            padding: 20px;
            text-align: center;
        }

        .sidebar .sidebar-header h2 {
            color: #ecf0f1;
            font-size: 24px;
            font-weight: bold;
        }

        .sidebar-menu li a {
            color: #ecf0f1;
            text-decoration: none;
            font-size: 18px;
            padding: 12px 20px; /* Sesuaikan padding untuk tampilan yang konsisten */
            transition: background-color 0.3s ease;
            border-left: 3px solid transparent; /* Border efek hover */
        }

        .sidebar-menu li a:hover {
            background-color: #2980b9; /* Warna hover yang konsisten */
            border-left: 3px solid #ecf0f1;
        }

        /* Menghilangkan hover effect pada Dashboard */
        .sidebar-menu li a.active:hover {
            background-color: #2980b9;
            border-left: 3px solid #ecf0f1;
        }

        .sidebar-menu li a i {  
            color: white;
            font-weight: bold;
            margin-right: 10px;
            font-size: 18px;
        }

        /* Main Content */
        .main-content {
            margin-left: 250px; /* Memberikan ruang untuk sidebar */
            padding: 30px;
        }

        .card-header {
            font-size: 22px;
            font-weight: bold;
        }

        .card-body {
            font-size: 18px;
        }

        .card {
            border-radius: 8px;
        }

        /* Responsif untuk perangkat mobile */
        @media (max-width: 768px) {
            .sidebar {
                width: 200px; /* Mengurangi lebar sidebar pada layar kecil */
            }
            .main-content {
                margin-left: 0; /* Menghilangkan margin untuk tampilan mobile */
            }
        }

        /* Menghindari konten tertindih */
        @media (max-width: 992px) {
            .sidebar {
                position: relative;
                width: 100%;
            }
            .main-content {
                margin-left: 0; /* Pastikan margin kiri dihilangkan pada perangkat kecil */
            }
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar bg-dark text-white p-3">
    <div class="sidebar-header mb-4">
        <h2>WARUNG NGOBAR</h2>
    </div>
    <ul class="sidebar-menu list-unstyled">
        <li><a href="../index.php" class="d-flex align-items-center active"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
        <li><a href="#" class="d-flex align-items-center"><i class="fas fa-store"></i> Toko</a></li>
        <li><a href="../produk/produk.php" class="d-flex align-items-center"><i class="fas fa-cogs"></i> Produk</a></li>
        <li><a href="../kategori/kategori.php" class="d-flex align-items-center"><i class="fas fa-th-large"></i> Kategori</a></li>
        <li><a href="../supplier/supplier.php" class="d-flex align-items-center"><i class="fas fa-truck"></i> Supplier</a></li>
        <li><a href="#" class="d-flex align-items-center"><i class="fas fa-users"></i> Pelanggan</a></li>
        <li><a href="#" class="d-flex align-items-center"><i class="fas fa-credit-card"></i> Transaksi</a></li>
        <li><a href="#" class="d-flex align-items-center"><i class="fas fa-arrow-circle-down"></i> Data Pembelian</a></li>
        <li><a href="#" class="d-flex align-items-center"><i class="fas fa-arrow-circle-up"></i> Data Penjualan</a></li>
        <li><a href="#" class="d-flex align-items-center"><i class="fas fa-cogs"></i> Pengaturan</a></li>
    </ul>
</div>

<!-- Main Content -->
<div class="main-content">
    <div class="container mt-5">
        <h2>Tambah Kategori</h2>

        <!-- Form Tambah Kategori -->
        <form action="kategori.php" method="POST">
            <div class="mb-3">
                <label for="nama_kategori" class="form-label">Nama Kategori</label>
                <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Kategori</button>
        </form>

        <!-- Daftar Kategori -->
        <h3 class="mt-5">Daftar Kategori</h3>
        <table class="table table-bordered mt-3">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result_kategori->num_rows > 0) {
                    while ($row = $result_kategori->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row['id'] . "</td>
                                <td>" . $row['nama_kategori'] . "</td>
                                <td>
                                    <a href='edit_kategori.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Edit</a>
                                    <a href='delete_kategori.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus kategori ini?\");'>Hapus</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='3' class='text-center'>Tidak ada kategori yang tersedia.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
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
