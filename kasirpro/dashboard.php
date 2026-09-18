<?php
include 'includes/cek_session.php';

$nama = $_SESSION['nama_lengkap'];
$role = $_SESSION['role'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - KasirPro</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            background: #f1f5f9;
            color: #1e293b;
        }

        /* SIDEBAR */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 260px;
            height: 100vh;
            background: linear-gradient(180deg, #1e3a8a, #172554);
            color: white;
            padding: 25px 18px;
            box-shadow: 3px 0 15px rgba(0, 0, 0, 0.15);
        }

        /* LOGO */
        .logo {
            text-align: center;
            padding-bottom: 25px;
            border-bottom: 1px solid rgba(255,255,255,0.15);
            margin-bottom: 25px;
        }

        .logo h2 {
            font-size: 25px;
            margin-bottom: 5px;
        }

        .logo p {
            font-size: 12px;
            color: #bfdbfe;
        }

        /* PROFILE */
        .profile {
            background: rgba(255,255,255,0.1);
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 25px;
        }

        .profile-name {
            font-size: 15px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .role {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
        }

        /* WARNA ROLE */
        .role-admin {
            background: #dc2626;
            color: white;
        }

        .role-gudang {
            background: #f59e0b;
            color: white;
        }

        .role-kasir {
            background: #16a34a;
            color: white;
        }

        /* MENU */
        .menu-title {
            font-size: 11px;
            color: #93c5fd;
            text-transform: uppercase;
            margin: 0 10px 10px;
            letter-spacing: 1px;
        }

        .menu {
            list-style: none;
        }

        .menu li {
            margin-bottom: 8px;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 13px 15px;
            text-decoration: none;
            color: #dbeafe;
            border-radius: 9px;
            font-size: 14px;
            transition: 0.3s;
        }

        .menu a:hover {
            background: rgba(255,255,255,0.12);
            color: white;
            transform: translateX(4px);
        }

        .menu .icon {
            width: 25px;
            text-align: center;
            font-size: 17px;
        }

        /* LOGOUT */
        .logout {
            position: absolute;
            left: 18px;
            right: 18px;
            bottom: 25px;
        }

        .logout a {
            display: block;
            text-align: center;
            background: #dc2626;
            color: white;
            padding: 12px;
            border-radius: 9px;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
            transition: 0.3s;
        }

        .logout a:hover {
            background: #b91c1c;
        }

        /* CONTENT */
        .content {
            margin-left: 260px;
            padding: 35px;
            min-height: 100vh;
        }

        /* HEADER */
        .header {
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 28px;
            color: #0f172a;
            margin-bottom: 7px;
        }

        .header p {
            color: #64748b;
            font-size: 14px;
        }

        /* WELCOME */
        .welcome {
            background: linear-gradient(135deg, #2563eb, #1e3a8a);
            color: white;
            padding: 30px;
            border-radius: 16px;
            margin-bottom: 30px;
            box-shadow: 0 8px 25px rgba(37,99,235,0.2);
        }

        .welcome h2 {
            font-size: 24px;
            margin-bottom: 8px;
        }

        .welcome p {
            color: #dbeafe;
            font-size: 14px;
        }

        /* CARD MENU */
        .card-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.07);
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }

        .card-icon {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #dbeafe;
            color: #2563eb;
            border-radius: 12px;
            font-size: 23px;
            margin-bottom: 15px;
        }

        .card h3 {
            font-size: 17px;
            margin-bottom: 8px;
            color: #0f172a;
        }

        .card p {
            font-size: 13px;
            color: #64748b;
            line-height: 1.5;
            margin-bottom: 18px;
        }

        .card a {
            display: inline-block;
            background: #2563eb;
            color: white;
            text-decoration: none;
            padding: 9px 15px;
            border-radius: 7px;
            font-size: 13px;
            font-weight: bold;
        }

        .card a:hover {
            background: #1d4ed8;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .sidebar {
                width: 220px;
            }

            .content {
                margin-left: 220px;
                padding: 20px;
            }

            .card-container {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 600px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }

            .logout {
                position: static;
                margin-top: 20px;
            }

            .content {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar">

        <div class="logo">
            <h2>💼 KasirPro</h2>
            <p>Cashier Management System</p>
        </div>

        <div class="profile">
            <div class="profile-name">
                👤 <?php echo htmlspecialchars($nama); ?>
            </div>

            <?php if ($role == 'admin') { ?>

                <span class="role role-admin">Admin</span>

            <?php } elseif ($role == 'gudang') { ?>

                <span class="role role-gudang">Gudang</span>

            <?php } elseif ($role == 'kasir') { ?>

                <span class="role role-kasir">Kasir</span>

            <?php } ?>
        </div>

        <div class="menu-title">
            Menu Utama
        </div>

        <ul class="menu">

            <!-- ADMIN & GUDANG -->
            <?php if ($role == 'admin' || $role == 'gudang') { ?>

                <li>
                    <a href="data_barang.php">
                        <span class="icon">📦</span>
                        <span>Kelola Stok & Barang</span>
                    </a>
                </li>

            <?php } ?>

            <!-- ADMIN & KASIR -->
            <?php if ($role == 'admin' || $role == 'kasir') { ?>

                <li>
                    <a href="riwayat_transaksi.php">
                        <span class="icon">📋</span>
                        <span>Riwayat Transaksi</span>
                    </a>
                </li>

            <?php } ?>

            <!-- KHUSUS KASIR -->
            <?php if ($role == 'kasir') { ?>

                <li>
                    <a href="transaksi.php">
                        <span class="icon">💰</span>
                        <span>Transaksi Penjualan</span>
                    </a>
                </li>

                <li>
                    <a href="data_pelanggan.php">
                        <span class="icon">👥</span>
                        <span>Kelola Pelanggan</span>
                    </a>
                </li>

            <?php } ?>

        </ul>

        <div class="logout">
            <a href="logout.php">
                🚪 Logout
            </a>
        </div>

    </div>


    <!-- CONTENT -->
    <div class="content">

        <div class="header">
            <h1>Dashboard</h1>
            <p>Halaman utama sistem KasirPro</p>
        </div>

        <div class="welcome">

            <h2>
                Selamat Datang, <?php echo htmlspecialchars($nama); ?> 👋
            </h2>

            <p>
                Anda login sebagai
                <strong><?php echo strtoupper(htmlspecialchars($role)); ?></strong>.
                Silakan pilih menu yang tersedia sesuai hak akses Anda.
            </p>

        </div>


        <!-- CARD SESUAI ROLE -->
        <div class="card-container">

            <!-- ADMIN & GUDANG -->
            <?php if ($role == 'admin' || $role == 'gudang') { ?>

                <div class="card">

                    <div class="card-icon">
                        📦
                    </div>

                    <h3>Kelola Stok & Barang</h3>

                    <p>
                        Mengelola data barang, stok, harga dan informasi produk.
                    </p>

                    <a href="data_barang.php">
                        Buka Menu →
                    </a>

                </div>

            <?php } ?>


            <!-- ADMIN & KASIR -->
            <?php if ($role == 'admin' || $role == 'kasir') { ?>

                <div class="card">

                    <div class="card-icon">
                        📋
                    </div>

                    <h3>Riwayat Transaksi</h3>

                    <p>
                        Melihat daftar transaksi yang telah dilakukan.
                    </p>

                    <a href="riwayat_transaksi.php">
                        Buka Menu →
                    </a>

                </div>

            <?php } ?>


            <!-- KASIR -->
            <?php if ($role == 'kasir') { ?>

                <div class="card">

                    <div class="card-icon">
                        💰
                    </div>

                    <h3>Transaksi Penjualan</h3>

                    <p>
                        Melakukan transaksi penjualan dan mengelola keranjang.
                    </p>

                    <a href="transaksi.php">
                        Buka Menu →
                    </a>

                </div>


                <div class="card">

                    <div class="card-icon">
                        👥
                    </div>

                    <h3>Kelola Pelanggan</h3>

                    <p>
                        Menambah, mengubah dan mengelola data pelanggan.
                    </p>

                    <a href="data_pelanggan.php">
                        Buka Menu →
                    </a>

                </div>

            <?php } ?>

        </div>

    </div>

</body>
</html>