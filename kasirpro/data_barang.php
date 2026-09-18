<?php
include 'includes/cek_session.php';
include 'config/koneksi.php';

$sql = "SELECT * FROM tbl_barang ORDER BY nama_barang ASC";
$hasil = mysqli_query($koneksi, $sql);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Data Barang - KasirPro</title>

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

        /* ================= SIDEBAR ================= */

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

        .logo {
            text-align: center;
            padding-bottom: 25px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
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
            background: rgba(255, 255, 255, 0.1);
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 25px;
        }

        .profile-name {
            font-size: 14px;
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
            background: rgba(255, 255, 255, 0.12);
            color: white;
            transform: translateX(4px);
        }

        .menu a.active {
            background: #2563eb;
            color: white;
        }

        .icon {
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

        /* ================= CONTENT ================= */

        .content {
            margin-left: 260px;
            padding: 35px;
            min-height: 100vh;
        }

        /* HEADER */

        .header {
            margin-bottom: 25px;
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

        /* ================= CARD ================= */

        .table-card {
            background: white;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.07);
        }

        /* TOP BAR */

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            gap: 15px;
        }

        .top-bar h2 {
            font-size: 20px;
            color: #0f172a;
        }

        /* BUTTON TAMBAH */

        .btn-tambah {
            display: inline-block;
            background: #2563eb;
            color: white;
            padding: 11px 18px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 13px;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn-tambah:hover {
            background: #1d4ed8;
            transform: translateY(-2px);
        }

        /* ================= TABLE ================= */

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 750px;
        }

        table th {
            background: #eff6ff;
            color: #1e3a8a;
            padding: 14px 12px;
            text-align: left;
            font-size: 13px;
            border-bottom: 2px solid #dbeafe;
        }

        table td {
            padding: 14px 12px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 13px;
            color: #475569;
        }

        table tbody tr {
            transition: 0.2s;
        }

        table tbody tr:hover {
            background: #f8fafc;
        }

        /* KODE BARANG */

        .kode {
            background: #dbeafe;
            color: #1d4ed8;
            padding: 5px 9px;
            border-radius: 6px;
            font-weight: bold;
            font-size: 12px;
        }

        /* HARGA */

        .harga {
            font-weight: bold;
            color: #16a34a;
        }

        /* STOK */

        .stok {
            font-weight: bold;
        }

        /* ================= ACTION ================= */

        .aksi {
            display: flex;
            gap: 7px;
        }

        .btn-edit {
            background: #f59e0b;
            color: white;
            padding: 7px 11px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 12px;
            font-weight: bold;
        }

        .btn-edit:hover {
            background: #d97706;
        }

        .btn-hapus {
            background: #dc2626;
            color: white;
            padding: 7px 11px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 12px;
            font-weight: bold;
        }

        .btn-hapus:hover {
            background: #b91c1c;
        }

        /* ================= EMPTY ================= */

        .empty {
            text-align: center;
            padding: 40px;
            color: #94a3b8;
        }
        .btn-dashboard {
                        display: inline-block;
                        margin-top: 20px;
                        padding: 11px 18px;
                        background: #64748b;
                        color: white;
                        text-decoration: none;
                        border-radius: 8px;
                        font-size: 14px;
                        font-weight: bold;
                        transition: 0.3s;
                    }
        /* ================= RESPONSIVE ================= */

        @media (max-width: 800px) {

            .sidebar {
                width: 220px;
            }

            .content {
                margin-left: 220px;
                padding: 25px;
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
                padding: 20px;
            }

            .top-bar {
                flex-direction: column;
                align-items: flex-start;
            }

            .btn-tambah {
                width: 100%;
                text-align: center;
            }
            

.btn-dashboard:hover {
    background: #475569;
    transform: translateY(-2px);
}
        }
    </style>
</head>

<body>

    <!-- ================= SIDEBAR ================= -->

    <div class="sidebar">

        <div class="logo">
            <h2>💼 KasirPro</h2>
            <p>Cashier Management System</p>
        </div>

        <div class="profile">

            <div class="profile-name">
                👤 <?php echo htmlspecialchars($_SESSION['nama_lengkap']); ?>
            </div>

            <?php if ($_SESSION['role'] == 'admin') { ?>

                <span class="role role-admin">
                    Admin
                </span>

            <?php } elseif ($_SESSION['role'] == 'gudang') { ?>

                <span class="role role-gudang">
                    Gudang
                </span>

            <?php } elseif ($_SESSION['role'] == 'kasir') { ?>

                <span class="role role-kasir">
                    Kasir
                </span>

            <?php } ?>

        </div>

        <div class="menu-title">
            Menu Utama
        </div>

        <ul class="menu">

            <?php if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'gudang') { ?>

                <li>
                    <a href="data_barang.php" class="active">
                        <span class="icon">📦</span>
                        Kelola Stok & Barang
                    </a>
                </li>

            <?php } ?>

            <?php if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'kasir') { ?>

                <li>
                    <a href="riwayat_transaksi.php">
                        <span class="icon">📋</span>
                        Riwayat Transaksi
                    </a>
                </li>

            <?php } ?>

            <?php if ($_SESSION['role'] == 'kasir') { ?>

                <li>
                    <a href="transaksi.php">
                        <span class="icon">💰</span>
                        Transaksi Penjualan
                    </a>
                </li>

                <li>
                    <a href="data_pelanggan.php">
                        <span class="icon">👥</span>
                        Kelola Pelanggan
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


    <!-- ================= CONTENT ================= -->

    <div class="content">

        <div class="header">

            <h1>📦 Data Barang</h1>

            <p>
                Kelola data barang dan stok produk KasirPro.
            </p>

        </div>


        <div class="table-card">

            <div class="top-bar">

                <h2>Daftar Barang</h2>

                <a href="tambah_barang.php" class="btn-tambah">
                    + Tambah Barang
                </a>

            </div>


            <div class="table-wrapper">

                <table>

                    <thead>

                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama Barang</th>
                            <th>Harga Satuan</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>

                    </thead>

                    <tbody>

                        <?php
                        $no = 1;

                        if (mysqli_num_rows($hasil) > 0) {

                            while ($row = mysqli_fetch_assoc($hasil)) {
                        ?>

                                <tr>

                                    <td>
                                        <?php echo $no++; ?>
                                    </td>

                                    <td>
                                        <span class="kode">
                                            <?php echo htmlspecialchars($row['kode_barang']); ?>
                                        </span>
                                    </td>

                                    <td>
                                        <strong>
                                            <?php echo htmlspecialchars($row['nama_barang']); ?>
                                        </strong>
                                    </td>

                                    <td>
                                        <span class="harga">
                                            Rp <?php echo number_format($row['harga_satuan'], 0, ',', '.'); ?>
                                        </span>
                                    </td>

                                    <td>
                                        <span class="stok">
                                            <?php echo $row['stok']; ?>
                                        </span>
                                    </td>

                                    <td>

                                        <div class="aksi">

                                            <a
                                                href="edit_barang.php?id=<?php echo $row['id_barang']; ?>"
                                                class="btn-edit">
                                                Edit
                                            </a>

                                            <a
                                                href="hapus_barang.php?id=<?php echo $row['id_barang']; ?>"
                                                class="btn-hapus"
                                                onclick="return confirm('Yakin ingin menghapus barang ini?');">
                                                Hapus
                                            </a>

                                        </div>

                                    </td>

                                </tr>

                        <?php
                            }

                        } else {
                        ?>

                            <tr>
                                <td colspan="6" class="empty">
                                    📦 Belum ada data barang.
                                </td>
                            </tr>

                        <?php } ?>

                    </tbody>

                </table>

            </div>

        </div>
<a href="dashboard.php" class="btn-dashboard">
    ← Kembali ke Dashboard
</a>
    </div>

</body>

</html>