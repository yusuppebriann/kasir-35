<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

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
                <li><a href="../dashboard/index.php" class="d-flex align-items-center active"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li> <!-- Active menu item -->
                <li><a href="../dashboard/toko/toko.php" class="d-flex align-items-center"><i class="fas fa-store"></i> Toko</a></li>
                <li><a href="../dashboard/produk/produk.php" class="d-flex align-items-center"><i class="fas fa-cogs"></i> Produk</a></li>
                <li><a href="../dashboard/kategori/kategori.php" class="d-flex align-items-center"><i class="fas fa-th-large"></i> Kategori</a></li>
                <li><a href="../dashboard/supplier/supplier.php" class="d-flex align-items-center"><i class="fas fa-truck"></i> Supplier</a></li>
                <li><a href="" class="d-flex align-items-center"><i class="fas fa-users"></i> Pelanggan</a></li>
                <li><a href="" class="d-flex align-items-center"><i class="fas fa-credit-card"></i> Transaksi</a></li>
                <li><a href="" class="d-flex align-items-center"><i class="fas fa-arrow-circle-down"></i> Data Pembelian</a></li>
                <li><a href="" class="d-flex align-items-center"><i class="fas fa-arrow-circle-up"></i> Data Penjualan</a></li>
                <li><a href="../dashboard/satuan/satuan.php" class="d-flex align-items-center"><i class="fas fa-arrow-circle-up"></i> Satuan</a></li>
                <li><a href="" class="d-flex align-items-center"><i class="fas fa-cogs"></i> Pengaturan</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content flex-fill">
            <div class="container-fluid">
                <header class="mb-4">
                    <div class="alert alert-info" role="alert">
                        <h1 class="h3">Welcome to the Admin Dashboard</h1>
                    </div>
                </header>

                <!-- Dashboard Overview Section -->
                <section>
                    <h2 class="mb-4">Dashboard Overview</h2>
                    <p>Welcome back, Admin! This is your dashboard overview.</p>

                    <div class="row g-4">
                        <!-- Card 1: Produk -->
                        <div class="col-md-3">
                            <div class="card shadow-sm">
                                <div class="card-header bg-primary text-white">
                                    Produk
                                </div>
                                <div class="card-body">
                                <h5 class="card-title"><?php echo $total_produk; ?></h5>
                                </div>
                            </div>
                        </div>

                        <!-- Card 2: Kategori -->
                        <div class="col-md-3">
                            <div class="card shadow-sm">
                                <div class="card-header bg-success text-white">
                                    Kategori
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $total_kategori; ?></h5>
                                </div>
                            </div>
                        </div>

                        <!-- Card 3: supplier -->
                        <div class="col-md-3">
                            <div class="card shadow-sm">
                                <div class="card-header bg-warning text-white">
                                    Supplier
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $total_supplier; ?></h5>
                                </div>
                            </div>
                        </div>

                        <!-- Card 4: Pelanggan -->
                        <div class="col-md-3">
                            <div class="card shadow-sm">
                                <div class="card-header bg-danger text-white">
                                    Pelanggan
                                </div>
                                <div class="card-body">
                                <h5 class="card-title"><?php echo $total_pelanggan; ?></h5>
                                </div>
                            </div>
                        </div>

                    </div>
                </section>

                
                    </table>
                </section>
            </div>
        </div>
    </div>

    <!-- Menambahkan Bootstrap JS dan dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.0/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>
