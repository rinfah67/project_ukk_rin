<?php

include 'includes/cek_session.php';

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah Pelanggan - KasirPro</title>

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

        /* CONTENT */

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

        /* CARD */

        .card {
            background: white;

            width: 650px;

            max-width: 100%;

            border-radius: 16px;

            padding: 28px;

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

            margin-bottom: 25px;
        }

        /* FORM */

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;

            margin-bottom: 8px;

            font-size: 13px;

            font-weight: bold;

            color: #334155;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;

            padding: 12px 14px;

            border: 1px solid #cbd5e1;

            border-radius: 8px;

            outline: none;

            font-size: 14px;

            background: white;

            transition: 0.3s;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: #2563eb;

            box-shadow: 0 0 0 3px rgba(
                37,
                99,
                235,
                0.12
            );
        }

        .form-group textarea {
            height: 100px;

            resize: vertical;
        }

        /* BUTTON */

        .button-group {
            display: flex;

            gap: 10px;

            margin-top: 25px;
        }

        .btn-simpan {
            border: none;

            background: #2563eb;

            color: white;

            padding: 12px 20px;

            border-radius: 8px;

            font-size: 14px;

            font-weight: bold;

            cursor: pointer;

            transition: 0.3s;
        }

        .btn-simpan:hover {
            background: #1d4ed8;

            transform: translateY(-2px);
        }

        .btn-kembali {
            display: inline-block;

            background: #64748b;

            color: white;

            padding: 12px 20px;

            border-radius: 8px;

            text-decoration: none;

            font-size: 14px;

            font-weight: bold;

            transition: 0.3s;
        }

        .btn-kembali:hover {
            background: #475569;

            transform: translateY(-2px);
        }

        /* RESPONSIVE */

        @media (max-width: 800px) {

            .sidebar {
                width: 220px;
            }

            .content {
                margin-left: 220px;
            }

            .card {
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

            .button-group {
                flex-direction: column;
            }

            .btn-simpan,
            .btn-kembali {
                width: 100%;

                text-align: center;
            }

        }

    </style>

</head>


<body>


<!-- SIDEBAR -->

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


    <!-- MENU -->

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

        <?php } ?>


    </ul>


    <!-- LOGOUT -->

    <div class="logout">

        <a href="logout.php">
            🚪 Logout
        </a>

    </div>

</div>


<!-- CONTENT -->

<div class="content">


    <div class="header">

        <h1>
            👥 Tambah Pelanggan
        </h1>

        <p>
            Tambahkan data pelanggan baru ke sistem KasirPro.
        </p>

    </div>


    <!-- FORM CARD -->

    <div class="card">

        <h2>
            Form Tambah Pelanggan
        </h2>


        <form
            action="proses_tambah_pelanggan.php"
            method="POST"
        >


            <!-- NAMA -->

            <div class="form-group">

                <label>
                    Nama Pelanggan
                </label>

                <input
                    type="text"
                    name="nama_pelanggan"
                    placeholder="Masukkan nama pelanggan"
                    required
                >

            </div>


            <!-- NO HP -->

            <div class="form-group">

                <label>
                    No. HP
                </label>

                <input
                    type="text"
                    name="no_hp"
                    placeholder="Masukkan nomor HP"
                    required
                >

            </div>


            <!-- ALAMAT -->

            <div class="form-group">

                <label>
                    Alamat
                </label>

                <textarea
                    name="alamat"
                    placeholder="Masukkan alamat pelanggan"
                    required
                ></textarea>

            </div>


            <!-- BUTTON -->

            <div class="button-group">

                <button
                    type="submit"
                    class="btn-simpan"
                >

                    💾 Simpan

                </button>


                <a
                    href="data_pelanggan.php"
                    class="btn-kembali"
                >

                    ← Kembali

                </a>

            </div>


        </form>

    </div>


</div>


</body>

</html>