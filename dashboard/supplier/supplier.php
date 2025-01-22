<?php
// Koneksi ke database
$mysqli = new mysqli("localhost", "root", "", "db_kasir");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Proses penambahan supplier jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $toko_id = $_POST['toko_id'];
    $nama_supplier = $_POST['nama_supplier'];
    $tlp_hp = $_POST['tlp_hp'];
    $alamat_supplier = $_POST['alamat_supplier'];

    // Query untuk menambah supplier (tanpa kolom created_at karena akan otomatis diatur oleh database)
    $query = "INSERT INTO supplier (toko_id, nama_supplier, tlp_hp, alamat_supplier) 
              VALUES ('$toko_id', '$nama_supplier', '$tlp_hp', '$alamat_supplier')";
    
    if ($mysqli->query($query) === TRUE) {
        echo "<div class='alert alert-success mt-3'>Supplier berhasil ditambahkan!</div>";
    } else {
        echo "<div class='alert alert-danger mt-3'>Error: " . $mysqli->error . "</div>";
    }
}

// Query untuk mengambil data supplier dari tabel 'supplier'
$query_supplier = "SELECT * FROM supplier";
$result_supplier = $mysqli->query($query_supplier);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Supplier</title>
 
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
        <li><a href="#" class="d-flex align-items-center"><i class="fas fa-store"></i> Toko</a></li>
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
    <div class="container mt-5">
        <h2>Tambah Supplier</h2>

        <!-- Form Tambah Supplier -->
        <form action="supplier.php" method="POST">
            <div class="mb-3">
                <label for="toko_id" class="form-label">ID Toko</label>
                <input type="number" class="form-control" id="toko_id" name="toko_id" required>
            </div>
            <div class="mb-3">
                <label for="nama_supplier" class="form-label">Nama Supplier</label>
                <input type="text" class="form-control" id="nama_supplier" name="nama_supplier" required>
            </div>
            <div class="mb-3">
                <label for="tlp_hp" class="form-label">Nomor Telepon</label>
                <input type="text" class="form-control" id="tlp_hp" name="tlp_hp" required>
            </div>
            <div class="mb-3">
                <label for="alamat_supplier" class="form-label">Alamat Supplier</label>
                <textarea class="form-control" id="alamat_supplier" name="alamat_supplier" rows="3" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Supplier</button>
        </form>

        <!-- Daftar Supplier -->
        <h3 class="mt-5">Daftar Supplier</h3>
        <table class="table table-bordered mt-3">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>ID Toko</th>
                    <th>Nama Supplier</th>
                    <th>Nomor Telepon</th>
                    <th>Alamat Supplier</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result_supplier->num_rows > 0) {
                    while ($row = $result_supplier->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row['id'] . "</td>
                                <td>" . $row['toko_id'] . "</td>
                                <td>" . $row['nama_supplier'] . "</td>
                                <td>" . $row['tlp_hp'] . "</td>
                                <td>" . $row['alamat_supplier'] . "</td>
                                <td>
                                    <a href='edit_supplier.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Edit</a>
                                    <a href='delete_supplier.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus supplier ini?\");'>Hapus</a>
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>Tidak ada supplier yang tersedia.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
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
