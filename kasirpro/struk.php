<?php

include 'includes/cek_session.php';
include 'config/koneksi.php';


// Cek ID transaksi
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ID transaksi tidak ditemukan.";
    exit;
}

$id_transaksi = (int) $_GET['id'];


// Ambil data transaksi
$sql_transaksi = "SELECT 
                    t.id_transaksi,
                    t.no_transaksi,
                    t.tanggal,
                    t.total_bayar,
                    u.nama_lengkap AS nama_kasir,
                    p.nama_pelanggan,
                    p.no_hp
                  FROM tbl_transaksi t
                  JOIN tbl_user u 
                    ON t.id_kasir = u.id_user
                  LEFT JOIN tbl_pelanggan p 
                    ON t.id_pelanggan = p.id_pelanggan
                  WHERE t.id_transaksi = $id_transaksi";

$hasil_transaksi = mysqli_query($koneksi, $sql_transaksi);

if (!$hasil_transaksi || mysqli_num_rows($hasil_transaksi) == 0) {
    echo "Data transaksi tidak ditemukan.";
    exit;
}

$transaksi = mysqli_fetch_assoc($hasil_transaksi);


// Ambil detail barang
$sql_detail = "SELECT
                d.id_detail,
                d.jumlah,
                d.subtotal,
                b.kode_barang,
                b.nama_barang,
                b.harga_satuan
               FROM tbl_detail_transaksi d
               JOIN tbl_barang b
                 ON d.id_barang = b.id_barang
               WHERE d.id_transaksi = $id_transaksi";

$hasil_detail = mysqli_query($koneksi, $sql_detail);

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Struk - <?php echo $transaksi['no_transaksi']; ?></title>


    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 30px;

            background: #f1f5f9;

            font-family: Arial, Helvetica, sans-serif;

            color: #1e293b;
        }


        /* CONTAINER STRUK */

        .struk {
            width: 380px;

            margin: 0 auto;

            background: white;

            padding: 25px;

            border-radius: 10px;

            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.10);
        }


        /* HEADER */

        .header {
            text-align: center;

            border-bottom: 1px dashed #94a3b8;

            padding-bottom: 15px;

            margin-bottom: 15px;
        }

        .header h1 {
            margin: 0;

            font-size: 24px;

            color: #1e3a8a;
        }

        .header p {
            margin: 5px 0;

            font-size: 12px;

            color: #64748b;
        }


        /* INFORMASI TRANSAKSI */

        .info {
            font-size: 12px;

            margin-bottom: 15px;
        }

        .info-row {
            display: flex;

            justify-content: space-between;

            margin-bottom: 6px;
        }

        .info-row span:first-child {
            color: #64748b;
        }

        .info-row span:last-child {
            font-weight: bold;

            text-align: right;
        }


        /* GARIS */

        .garis {
            border-top: 1px dashed #94a3b8;

            margin: 15px 0;
        }


        /* BARANG */

        .barang {
            margin-bottom: 12px;
        }

        .nama-barang {
            font-size: 13px;

            font-weight: bold;

            margin-bottom: 4px;
        }

        .detail-barang {
            display: flex;

            justify-content: space-between;

            font-size: 12px;

            color: #64748b;
        }


        /* TOTAL */

        .total {
            border-top: 1px dashed #94a3b8;

            padding-top: 15px;

            margin-top: 15px;
        }

        .total-row {
            display: flex;

            justify-content: space-between;

            font-size: 17px;

            font-weight: bold;
        }

        .total-row span:last-child {
            color: #1e3a8a;
        }


        /* FOOTER */

        .footer {
            text-align: center;

            margin-top: 20px;

            padding-top: 15px;

            border-top: 1px dashed #94a3b8;
        }

        .footer p {
            margin: 4px 0;

            font-size: 12px;

            color: #64748b;
        }


        /* TOMBOL */

        .button-area {
            width: 380px;

            margin: 20px auto 0;

            display: flex;

            gap: 10px;
        }

        .btn {
            flex: 1;

            border: none;

            padding: 12px;

            border-radius: 8px;

            text-decoration: none;

            text-align: center;

            font-size: 13px;

            font-weight: bold;

            cursor: pointer;
        }

        .btn-print {
            background: #2563eb;

            color: white;
        }

        .btn-print:hover {
            background: #1d4ed8;
        }

        .btn-dashboard {
            background: #64748b;

            color: white;
        }

        .btn-dashboard:hover {
            background: #475569;
        }


        /* =========================
           CETAK
        ========================= */

        @media print {

            body {
                background: white;

                padding: 0;
            }

            .struk {
                width: 100%;

                margin: 0;

                padding: 10px;

                box-shadow: none;

                border-radius: 0;
            }

            .button-area {
                display: none;
            }

        }

    </style>

</head>


<body>


<!-- STRUK -->

<div class="struk">


    <!-- HEADER -->

    <div class="header">

        <h1>
            KASIRPRO
        </h1>

        <p>
            Sistem Kasir & Penjualan
        </p>

        <p>
            Terima kasih telah berbelanja
        </p>

    </div>


    <!-- INFORMASI TRANSAKSI -->

    <div class="info">

        <div class="info-row">

            <span>
                No. Transaksi
            </span>

            <span>
                <?php echo htmlspecialchars($transaksi['no_transaksi']); ?>
            </span>

        </div>


        <div class="info-row">

            <span>
                Tanggal
            </span>

            <span>
                <?php echo date('d-m-Y H:i', strtotime($transaksi['tanggal'])); ?>
            </span>

        </div>


        <div class="info-row">

            <span>
                Kasir
            </span>

            <span>
                <?php echo htmlspecialchars($transaksi['nama_kasir']); ?>
            </span>

        </div>


        <div class="info-row">

            <span>
                Pelanggan
            </span>

            <span>

                <?php

                if (!empty($transaksi['nama_pelanggan'])) {

                    echo htmlspecialchars(
                        $transaksi['nama_pelanggan']
                    );

                } else {

                    echo "Pelanggan Umum";

                }

                ?>

            </span>

        </div>

    </div>


    <div class="garis"></div>


    <!-- DETAIL BARANG -->

    <?php

    $jumlah_item = 0;

    while ($detail = mysqli_fetch_assoc($hasil_detail)) {

        $jumlah_item += $detail['jumlah'];

    ?>

        <div class="barang">


            <div class="nama-barang">

                <?php
                echo htmlspecialchars(
                    $detail['nama_barang']
                );
                ?>

            </div>


            <div class="detail-barang">

                <span>

                    <?php
                    echo $detail['jumlah'];
                    ?>
                    x
                    Rp
                    <?php
                    echo number_format(
                        $detail['harga_satuan'],
                        0,
                        ',',
                        '.'
                    );
                    ?>

                </span>


                <span>

                    Rp
                    <?php
                    echo number_format(
                        $detail['subtotal'],
                        0,
                        ',',
                        '.'
                    );
                    ?>

                </span>

            </div>


        </div>


    <?php

    }

    ?>


    <!-- TOTAL -->

    <div class="total">


        <div class="total-row">

            <span>
                Total
            </span>

            <span>

                Rp
                <?php

                echo number_format(
                    $transaksi['total_bayar'],
                    0,
                    ',',
                    '.'
                );

                ?>

            </span>

        </div>


    </div>


    <!-- FOOTER -->

    <div class="footer">

        <p>
            Total item:
            <?php echo $jumlah_item; ?>
        </p>

        <p>
            *** Terima Kasih ***
        </p>

    </div>


</div>


<!-- BUTTON -->

<div class="button-area">


    <button
        onclick="window.print()"
        class="btn btn-print"
    >

        🖨 Cetak Struk

    </button>


    <a
        href="riwayat_transaksi.php"
        class="btn btn-dashboard"
    >

        ← Kembali

    </a>


</div>


</body>

</html>