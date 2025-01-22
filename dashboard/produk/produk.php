<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_kasir"; // Ganti dengan nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mengambil data produk
$sql = "SELECT p.id, p.nama_produk, p.harga_beli, p.harga_jual, t.nama_toko, pk.nama_kategori, s.nama_satuan 
        FROM produk p
        JOIN toko t ON p.toko_id = t.id
        JOIN produk_kategori pk ON p.kategori_id = pk.id
        JOIN satuan s ON p.satuan_id = s.id";

// Menjalankan query dan menyimpan hasilnya ke dalam variabel $result
$result = $conn->query($sql);

// Menutup koneksi
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>

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
    </style>
</head>
<body>

    <div class="d-flex">

        <!-- Sidebar -->
        <div class="sidebar bg-dark text-white p-3">
            <div class="sidebar-header mb-4">
                <h2>WARUNG NGOBAR</h2>
            </div>
            <ul class="sidebar-menu list-unstyled">
                <li><a href="../index.php" class="d-flex align-items-center active"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li> <!-- Active menu item -->
                <li><a href="" class="d-flex align-items-center"><i class="fas fa-store"></i> Toko</a></li>
                <li><a href="../produk/produk.php" class="d-flex align-items-center"><i class="fas fa-cogs"></i> Produk</a></li>
                <li><a href="../kategori/kategori.php" class="d-flex align-items-center"><i class="fas fa-th-large"></i> Kategori</a></li>
                <li><a href="../supplier/supplier.php" class="d-flex align-items-center"><i class="fas fa-truck"></i> Supplier</a></li>
                <li><a href="" class="d-flex align-items-center"><i class="fas fa-users"></i> Pelanggan</a></li>
                <li><a href="" class="d-flex align-items-center"><i class="fas fa-credit-card"></i> Transaksi</a></li>
                <li><a href="" class="d-flex align-items-center"><i class="fas fa-arrow-circle-down"></i> Data Pembelian</a></li>
                <li><a href="" class="d-flex align-items-center"><i class="fas fa-arrow-circle-up"></i> Data Penjualan</a></li>
                <li><a href="" class="d-flex align-items-center"><i class="fas fa-cogs"></i> Pengaturan</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="d-flex mb-4">
                <!-- Tombol Kembali ke Dashboard -->
                <a href="../index.php" class="btn btn-secondary">Kembali ke Dashboard</a>
                
                <!-- Tombol Tambah Produk -->
                <a href="tambah_produk.php" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Produk</a>
            </div>

            <h1 class="mb-4">Daftar Produk</h1>

            <!-- Tabel Produk -->
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Nama Produk</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th>Toko</th>
                        <th>Kategori</th>
                        <th>Satuan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['nama_produk']; ?></td>
                                <td><?php echo number_format($row['harga_beli'], 0, ',', '.'); ?></td>
                                <td><?php echo number_format($row['harga_jual'], 0, ',', '.'); ?></td>
                                <td><?php echo $row['nama_toko']; ?></td>
                                <td><?php echo $row['nama_kategori']; ?></td>
                                <td><?php echo $row['nama_satuan']; ?></td>
                                <td>
                                    <a href="edit_produk.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="delete_produk.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">Hapus</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center">Tidak ada produk tersedia.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Menambahkan Bootstrap JS dan dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.0/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>
