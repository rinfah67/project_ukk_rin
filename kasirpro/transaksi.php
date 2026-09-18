<?php
include 'includes/cek_session.php';
include 'config/koneksi.php';

if (!isset($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = array();
}

/* Ambil data pelanggan */
$sql_pelanggan = "SELECT * FROM tbl_pelanggan ORDER BY nama_pelanggan ASC";
$hasil_pelanggan = mysqli_query($koneksi, $sql_pelanggan);

/* Ambil data barang */
$sql_barang = "SELECT * FROM tbl_barang WHERE stok > 0 ORDER BY nama_barang ASC";
$hasil_barang = mysqli_query($koneksi, $sql_barang);

/* Hitung total */
$total = 0;

foreach ($_SESSION['keranjang'] as $item) {
    $total += $item['subtotal'];
}
?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Transaksi Penjualan - KasirPro</title>

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

        /* =========================
           SIDEBAR
        ========================= */

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

            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
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

        /* =========================
           CONTENT
        ========================= */

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

        /* =========================
           CARD
        ========================= */

        .card {
            background: white;

            border-radius: 16px;

            padding: 25px;

            margin-bottom: 20px;

            box-shadow: 0 5px 20px rgba(
                0,
                0,
                0,
                0.07
            );
        }

        .card h2 {
            font-size: 19px;

            color: #0f172a;

            margin-bottom: 20px;
        }

        /* =========================
           FORM TRANSAKSI
        ========================= */

        .form-row {
            display: grid;

            grid-template-columns:
                1fr 180px auto;

            gap: 15px;

            align-items: end;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-size: 13px;

            font-weight: bold;

            color: #334155;

            margin-bottom: 8px;
        }

        .form-group select,
        .form-group input {
            width: 100%;

            padding: 11px 13px;

            border: 1px solid #cbd5e1;

            border-radius: 8px;

            outline: none;

            background: white;

            font-size: 14px;
        }

        .form-group select:focus,
        .form-group input:focus {
            border-color: #2563eb;

            box-shadow: 0 0 0 3px rgba(
                37,
                99,
                235,
                0.12
            );
        }

        /* BUTTON TAMBAH */

        .btn-tambah {
            border: none;

            background: #2563eb;

            color: white;

            padding: 11px 18px;

            border-radius: 8px;

            font-size: 13px;

            font-weight: bold;

            cursor: pointer;

            transition: 0.3s;
        }

        .btn-tambah:hover {
            background: #1d4ed8;

            transform: translateY(-2px);
        }

        /* =========================
           KERANJANG
        ========================= */

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;

            border-collapse: collapse;

            min-width: 650px;
        }

        table th {
            background: #eff6ff;

            color: #1e3a8a;

            padding: 13px;

            text-align: left;

            font-size: 13px;

            border-bottom: 2px solid #dbeafe;
        }

        table td {
            padding: 13px;

            font-size: 13px;

            color: #475569;

            border-bottom: 1px solid #e2e8f0;
        }

        table tbody tr:hover {
            background: #f8fafc;
        }

        .harga {
            font-weight: bold;

            color: #334155;
        }

        .subtotal {
            color: #16a34a;

            font-weight: bold;
        }

        /* =========================
           TOTAL
        ========================= */

        .total-box {
            display: flex;

            justify-content: flex-end;

            margin-top: 20px;
        }

        .total-content {
            background: #eff6ff;

            border-radius: 12px;

            padding: 18px 25px;

            min-width: 280px;

            text-align: right;
        }

        .total-label {
            font-size: 13px;

            color: #64748b;

            margin-bottom: 5px;
        }

        .total-harga {
            font-size: 25px;

            color: #1d4ed8;

            font-weight: bold;
        }

        /* =========================
           PELANGGAN
        ========================= */

        .pelanggan {
            margin-top: 20px;

            display: flex;

            align-items: end;

            gap: 15px;
        }

        .pelanggan .form-group {
            width: 350px;
        }

        .pelanggan select {
            width: 100%;

            padding: 11px;

            border: 1px solid #cbd5e1;

            border-radius: 8px;
        }

        /* =========================
           SIMPAN TRANSAKSI
        ========================= */

        .aksi {
            display: flex;

            justify-content: flex-end;

            gap: 10px;

            margin-top: 20px;
        }

        .btn-simpan {
            border: none;

            background: #16a34a;

            color: white;

            padding: 12px 20px;

            border-radius: 8px;

            font-weight: bold;

            cursor: pointer;

            transition: 0.3s;
        }

        .btn-simpan:hover {
            background: #15803d;

            transform: translateY(-2px);
        }

        /* KEMBALI */

        .btn-dashboard {
            display: inline-block;

            margin-top: 5px;

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

        /* EMPTY */

        .empty {
            text-align: center;

            padding: 30px !important;

            color: #94a3b8 !important;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 900px) {

            .sidebar {
                width: 220px;
            }

            .content {
                margin-left: 220px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .pelanggan {
                flex-direction: column;

                align-items: stretch;
            }

            .pelanggan .form-group {
                width: 100%;
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

            .total-box {
                justify-content: stretch;
            }

            .total-content {
                width: 100%;
            }

            .aksi {
                justify-content: stretch;
            }

            .btn-simpan {
                width: 100%;
            }

        }

    </style>

</head>

<body>


<!-- =========================
     SIDEBAR
========================= -->

<div class="sidebar">

    <div class="logo">

        <h2>💼 KasirPro</h2>

        <p>
            Cashier Management System
        </p>

    </div>


    <div class="profile">

        <div class="profile-name">

            👤
            <?php
            echo htmlspecialchars(
                $_SESSION['nama_lengkap']
            );
            ?>

        </div>


        <?php if ($_SESSION['role'] == 'admin') { ?>

            <span class="role role-admin">
                Admin
            </span>

        <?php } elseif ($_SESSION['role'] == 'kasir') { ?>

            <span class="role role-kasir">
                Kasir
            </span>

        <?php } elseif ($_SESSION['role'] == 'gudang') { ?>

            <span class="role role-gudang">
                Gudang
            </span>

        <?php } ?>

    </div>


    <div class="menu-title">
        Menu Utama
    </div>


    <ul class="menu">

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

        <?php } ?>


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

        <?php } ?>


        <?php
        if ($_SESSION['role'] == 'kasir') {
        ?>

            <li>

                <a
                    href="transaksi.php"
                    class="active"
                >

                    <span class="icon">
                        💰
                    </span>

                    Transaksi Penjualan

                </a>

            </li>


            <li>

                <a href="data_pelanggan.php">

                    <span class="icon">
                        👥
                    </span>

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


<!-- =========================
     CONTENT
========================= -->

<div class="content">


    <div class="header">

        <h1>
            💰 Transaksi Penjualan
        </h1>

        <p>
            Kelola transaksi penjualan barang
            dengan mudah.
        </p>

    </div>


    <!-- PILIH BARANG -->

    <div class="card">

        <h2>
            🛒 Pilih Barang
        </h2>


        <form
            action="proses_tambah_keranjang.php"
            method="POST"
        >

            <div class="form-row">


                <div class="form-group">

                    <label>
                        Barang
                    </label>

                    <select
                        name="id_barang"
                        required
                    >

                        <option value="">
                            -- Pilih Barang --
                        </option>

                        <?php
                        while (
                            $barang =
                            mysqli_fetch_assoc(
                                $hasil_barang
                            )
                        ) {
                        ?>

                            <option
                                value="<?php
                                echo $barang['id_barang'];
                                ?>"
                            >

                                <?php
                                echo htmlspecialchars(
                                    $barang['nama_barang']
                                );
                                ?>

                                (Stok:
                                <?php
                                echo $barang['stok'];
                                ?>)

                            </option>

                        <?php } ?>

                    </select>

                </div>


                <div class="form-group">

                    <label>
                        Jumlah
                    </label>

                    <input
                        type="number"
                        name="jumlah"
                        min="1"
                        required
                    >

                </div>


                <button
                    type="submit"
                    class="btn-tambah"
                >

                    ➕ Tambah ke Keranjang

                </button>

            </div>

        </form>

    </div>


    <!-- KERANJANG -->

    <div class="card">

        <h2>
            🛍️ Keranjang Belanja
        </h2>


        <div class="table-wrapper">

            <table>

                <thead>

                    <tr>

                        <th>
                            Nama Barang
                        </th>

                        <th>
                            Harga
                        </th>

                        <th>
                            Jumlah
                        </th>

                        <th>
                            Subtotal
                        </th>

                        <th>
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>


                    <?php

                    if (
                        count($_SESSION['keranjang']) > 0
                    ) {

                        foreach (
                            $_SESSION['keranjang']
                            as $index => $item
                        ) {

                    ?>

                        <tr>

                            <td>
                                <?php
                                echo htmlspecialchars(
                                    $item['nama_barang']
                                );
                                ?>
                            </td>

                            <td class="harga">

                                Rp
                                <?php
                                echo number_format(
                                    $item['harga'],
                                    0,
                                    ',',
                                    '.'
                                );
                                ?>

                            </td>

                            <td>
                                <?php
                                echo $item['jumlah'];
                                ?>
                            </td>

                            <td class="subtotal">

                                Rp
                                <?php
                                echo number_format(
                                    $item['subtotal'],
                                    0,
                                    ',',
                                    '.'
                                );
                                ?>

                            </td>

                            <td>

                                <a
                                    href="hapus_keranjang.php?index=<?php echo $index; ?>"
                                    onclick="return confirm('Hapus barang dari keranjang?');"
                                    style="
                                        color:#dc2626;
                                        text-decoration:none;
                                        font-weight:bold;
                                    "
                                >

                                    🗑 Hapus

                                </a>

                            </td>

                        </tr>

                    <?php

                        }

                    } else {

                    ?>

                        <tr>

                            <td
                                colspan="5"
                                class="empty"
                            >

                                🛒 Keranjang masih kosong.

                            </td>

                        </tr>

                    <?php } ?>


                </tbody>

            </table>

        </div>


        <!-- TOTAL -->

        <div class="total-box">

            <div class="total-content">

                <div class="total-label">
                    Total Pembayaran
                </div>

                <div class="total-harga">

                    Rp
                    <?php
                    echo number_format(
                        $total,
                        0,
                        ',',
                        '.'
                    );
                    ?>

                </div>

            </div>

        </div>


        <!-- PELANGGAN -->

        <form
            action="proses_simpan_transaksi.php"
            method="POST"
        >

            <div class="pelanggan">

                <div class="form-group">

                    <label>
                        Pelanggan
                    </label>

                    <select
                        name="id_pelanggan"
                        required
                    >

                        <option value="">
                            -- Pelanggan Umum --
                        </option>

                        <?php
                        while (
                            $pelanggan =
                            mysqli_fetch_assoc(
                                $hasil_pelanggan
                            )
                        ) {
                        ?>

                            <option
                                value="<?php
                                echo $pelanggan['id_pelanggan'];
                                ?>"
                            >

                                <?php
                                echo htmlspecialchars(
                                    $pelanggan['nama_pelanggan']
                                );
                                ?>

                            </option>

                        <?php } ?>

                    </select>

                </div>

            </div>


            <!-- BUTTON SIMPAN -->

            <div class="aksi">

                <button
                    type="submit"
                    class="btn-simpan"
                    <?php
                    if (
                        count($_SESSION['keranjang']) == 0
                    ) {
                        echo 'disabled';
                    }
                    ?>
                >

                    💾 Simpan Transaksi

                </button>

            </div>

        </form>


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