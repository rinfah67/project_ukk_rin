<?php

include 'includes/cek_session.php';
include 'config/koneksi.php';

$sql = "SELECT * FROM tbl_pelanggan ORDER BY nama_pelanggan ASC";
$hasil = mysqli_query($koneksi, $sql);

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Data Pelanggan - KasirPro</title>

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
            top: 0;
            left: 0;

            width: 260px;
            height: 100vh;

            background: linear-gradient(
                180deg,
                #1e3a8a,
                #172554
            );

            color: white;

            padding: 25px 18px;

            box-shadow: 3px 0 15px rgba(0,0,0,0.15);
        }

        /* LOGO */

        .logo {
            text-align: center;

            padding-bottom: 25px;

            margin-bottom: 25px;

            border-bottom: 1px solid rgba(
                255,
                255,
                255,
                0.15
            );
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
            background: rgba(
                255,
                255,
                255,
                0.1
            );

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
        }

        .role-kasir {
            background: #16a34a;
        }

        .role-gudang {
            background: #f59e0b;
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

            color: #dbeafe;

            text-decoration: none;

            border-radius: 9px;

            font-size: 14px;

            transition: 0.3s;
        }

        .menu a:hover {
            background: rgba(
                255,
                255,
                255,
                0.12
            );

            color: white;

            transform: translateX(4px);
        }

        .menu a.active {
            background: #2563eb;

            color: white;

            box-shadow: 0 4px 10px rgba(
                37,
                99,
                235,
                0.3
            );
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

            font-size: 14px;

            font-weight: bold;

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

            margin-bottom: 8px;
        }

        .header p {
            font-size: 14px;

            color: #64748b;
        }

        /* ================= CARD ================= */

        .card {
            background: white;

            border-radius: 16px;

            padding: 25px;

            box-shadow: 0 5px 20px rgba(
                0,
                0,
                0,
                0.07
            );
        }

        /* CARD HEADER */

        .card-header {
            display: flex;

            justify-content: space-between;

            align-items: center;

            margin-bottom: 20px;
        }

        .card-header h2 {
            font-size: 19px;

            color: #0f172a;
        }

        /* ================= BUTTON TAMBAH ================= */

        .btn-tambah {
            display: inline-block;

            background: #2563eb;

            color: white;

            padding: 11px 18px;

            border-radius: 8px;

            text-decoration: none;

            font-size: 14px;

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
        }

        table th {
            background: #eff6ff;

            color: #1e3a8a;

            padding: 14px;

            text-align: left;

            font-size: 13px;

            border-bottom: 2px solid #dbeafe;
        }

        table td {
            padding: 14px;

            font-size: 13px;

            color: #475569;

            border-bottom: 1px solid #e2e8f0;
        }

        table tbody tr:hover {
            background: #f8fafc;
        }

        /* ================= AKSI ================= */

        .aksi {
            display: flex;

            gap: 8px;
        }

        .btn-edit {
            display: inline-block;

            background: #f59e0b;

            color: white;

            padding: 7px 12px;

            border-radius: 6px;

            text-decoration: none;

            font-size: 12px;

            font-weight: bold;

            transition: 0.3s;
        }

        .btn-edit:hover {
            background: #d97706;
        }

        .btn-hapus {
            display: inline-block;

            background: #dc2626;

            color: white;

            padding: 7px 12px;

            border-radius: 6px;

            text-decoration: none;

            font-size: 12px;

            font-weight: bold;

            transition: 0.3s;
        }

        .btn-hapus:hover {
            background: #b91c1c;
        }

        /* ================= KEMBALI ================= */

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

        .btn-dashboard:hover {
            background: #475569;

            transform: translateY(-2px);
        }

        /* ================= DATA KOSONG ================= */

        .kosong {
            text-align: center;

            padding: 30px !important;

            color: #94a3b8 !important;
        }

        /* ================= RESPONSIVE ================= */

        @media (max-width: 800px) {

            .sidebar {
                width: 220px;
            }

            .content {
                margin-left: 220px;
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

            .card-header {
                flex-direction: column;

                align-items: flex-start;

                gap: 15px;
            }

            .btn-tambah {
                width: 100%;

                text-align: center;
            }

            .aksi {
                flex-direction: column;
            }

        }

    </style>

</head>


<body>


<!-- ================= SIDEBAR ================= -->

<div class="sidebar">

    <div class="logo">

        <h2>💼 KasirPro</h2>

        <p>
            Cashier Management System
        </p>

    </div>


    <!-- PROFILE -->

    <div class="profile">

        <div class="profile-name">

            👤
            <?php
            echo htmlspecialchars(
                $_SESSION['nama_lengkap']
            );
            ?>

        </div>


        <?php

        if ($_SESSION['role'] == 'admin') {

        ?>

            <span class="role role-admin">
                Admin
            </span>

        <?php

        } elseif ($_SESSION['role'] == 'kasir') {

        ?>

            <span class="role role-kasir">
                Kasir
            </span>

        <?php

        } elseif ($_SESSION['role'] == 'gudang') {

        ?>

            <span class="role role-gudang">
                Gudang
            </span>

        <?php

        }

        ?>

    </div>


    <!-- MENU -->

    <div class="menu-title">
        Menu Utama
    </div>


    <ul class="menu">


        <!-- ADMIN + GUDANG -->

        <?php

        if (
            $_SESSION['role'] == 'admin' ||
            $_SESSION['role'] == 'gudang'
        ) {

        ?>

            <li>

                <a href="data_barang.php">

                    <span class="icon">
                        📦
                    </span>

                    Kelola Stok & Barang

                </a>

            </li>

        <?php

        }

        ?>


        <!-- ADMIN + KASIR -->

        <?php

        if (
            $_SESSION['role'] == 'admin' ||
            $_SESSION['role'] == 'kasir'
        ) {

        ?>

            <li>

                <a href="riwayat_transaksi.php">

                    <span class="icon">
                        📋
                    </span>

                    Riwayat Transaksi

                </a>

            </li>

        <?php

        }

        ?>


        <!-- KASIR -->

        <?php

        if ($_SESSION['role'] == 'kasir') {

        ?>

            <li>

                <a href="transaksi.php">

                    <span class="icon">
                        💰
                    </span>

                    Transaksi Penjualan

                </a>

            </li>


            <li>

                <a
                    href="data_pelanggan.php"
                    class="active"
                >

                    <span class="icon">
                        👥
                    </span>

                    Kelola Pelanggan

                </a>

            </li>

        <?php

        }

        ?>

    </ul>


    <!-- LOGOUT -->

    <div class="logout">

        <a href="logout.php">
            🚪 Logout
        </a>

    </div>

</div>


<!-- ================= CONTENT ================= -->

<div class="content">


    <!-- HEADER -->

    <div class="header">

        <h1>
            👥 Data Pelanggan
        </h1>

        <p>
            Kelola data pelanggan pada sistem KasirPro.
        </p>

    </div>


    <!-- CARD -->

    <div class="card">


        <div class="card-header">

            <h2>
                Daftar Pelanggan
            </h2>


            <a
                href="tambah_pelanggan.php"
                class="btn-tambah"
            >

                ➕ Tambah Pelanggan

            </a>

        </div>


        <!-- TABLE -->

        <div class="table-wrapper">

            <table>

                <thead>

                    <tr>

                        <th>
                            Nama Pelanggan
                        </th>

                        <th>
                            No. HP
                        </th>

                        <th>
                            Alamat
                        </th>

                        <th>
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>


                    <?php

                    if (
                        mysqli_num_rows($hasil) > 0
                    ) {

                        while (
                            $row =
                            mysqli_fetch_assoc($hasil)
                        ) {

                    ?>

                        <tr>

                            <td>

                                <?php

                                echo htmlspecialchars(
                                    $row['nama_pelanggan']
                                );

                                ?>

                            </td>


                            <td>

                                <?php

                                echo htmlspecialchars(
                                    $row['no_hp']
                                );

                                ?>

                            </td>


                            <td>

                                <?php

                                echo htmlspecialchars(
                                    $row['alamat']
                                );

                                ?>

                            </td>


                            <td>

                                <div class="aksi">


                                    <a
                                        href="edit_pelanggan.php?id=<?php echo $row['id_pelanggan']; ?>"
                                        class="btn-edit"
                                    >

                                        ✏ Edit

                                    </a>


                                    <a
                                        href="hapus_pelanggan.php?id=<?php echo $row['id_pelanggan']; ?>"
                                        class="btn-hapus"
                                        onclick="return confirm('Yakin ingin menghapus pelanggan ini?');"
                                    >

                                        🗑 Hapus

                                    </a>


                                </div>

                            </td>

                        </tr>


                    <?php

                        }

                    } else {

                    ?>

                        <tr>

                            <td
                                colspan="4"
                                class="kosong"
                            >

                                📭 Belum ada data pelanggan.

                            </td>

                        </tr>

                    <?php

                    }

                    ?>


                </tbody>

            </table>

        </div>


    </div>


    <!-- KEMBALI -->

    <a
        href="dashboard.php"
        class="btn-dashboard"
    >

        ← Kembali ke Dashboard

    </a>


</div>


</body>

</html>