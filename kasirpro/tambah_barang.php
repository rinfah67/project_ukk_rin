<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah Barang - KasirPro</title>

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

        .content {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 35px;
        }
        .header {
            width: 100%;
            max-width: 700px;
            margin-bottom: 25px;
        }

        .header h1 {
            font-size: 28px;
            color: #0f172a;
            margin-bottom: 8px;
        }

        .header p {
            color: #64748b;
            font-size: 14px;
        }

        .form-card {
            width: 100%;
            max-width: 700px;
            background: white;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }
        .form-card h2 {
            font-size: 20px;
            margin-bottom: 25px;
            color: #0f172a;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: bold;
            color: #334155;
        }

        .form-group input {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            outline: none;
            font-size: 14px;
        }

        .form-group input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37,99,235,0.12);
        }

        .form-button {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }

        .btn-simpan {
            border: none;
            background: #2563eb;
            color: white;
            padding: 12px 22px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
        }

        .btn-simpan:hover {
            background: #1d4ed8;
        }

        .btn-kembali {
            background: #64748b;
            color: white;
            text-decoration: none;
            padding: 12px 22px;
            border-radius: 8px;
            font-weight: bold;
        }

        .btn-kembali:hover {
            background: #475569;
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
    </style>
</head>

<body>

    <div class="content">

        <div class="header">
            <h1>📦 Tambah Barang</h1>
            <p>Tambahkan data barang baru ke dalam sistem KasirPro.</p>
        </div>

        <div class="form-card">

            <h2>Form Tambah Barang</h2>

            <form action="proses_tambah_barang.php" method="POST">

                <div class="form-group">
                    <label>Kode Barang</label>
                    <input type="text" name="kode_barang" required>
                </div>

                <div class="form-group">
                    <label>Nama Barang</label>
                    <input type="text" name="nama_barang" required>
                </div>

                <div class="form-group">
                    <label>Harga Satuan</label>
                    <input type="number" name="harga_satuan" required>
                </div>

                <div class="form-group">
                    <label>Stok</label>
                    <input type="number" name="stok" required>
                </div>



                <div class="form-button">

                    <button type="submit" class="btn-simpan">
                        💾 Simpan
                    </button>

                    <a href="data_barang.php" class="btn-kembali">
                        ← Kembali
                    </a>

                </div>

            </form>

        </div>
<a href="dashboard.php" class="btn-dashboard">
    ← Kembali ke Dashboard
</a>
    </div>
    

</body>

</html>