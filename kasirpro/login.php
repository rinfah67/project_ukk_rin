<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - KasirPro</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #1e3a8a, #2563eb);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        /* CONTAINER */
        .login-container {
            width: 100%;
            max-width: 900px;
            min-height: 500px;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            display: flex;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
        }

        /* BAGIAN KIRI */
        .login-left {
            width: 45%;
            background: linear-gradient(180deg, #1e3a8a, #172554);
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
            text-align: center;
        }

        .logo {
            font-size: 65px;
            margin-bottom: 15px;
        }

        .login-left h1 {
            font-size: 32px;
            margin-bottom: 10px;
        }

        .login-left p {
            color: #bfdbfe;
            font-size: 14px;
            line-height: 1.6;
        }

        .system-text {
            margin-top: 30px;
            padding: 10px 18px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            font-size: 12px;
            color: #dbeafe;
        }

        /* BAGIAN KANAN */
        .login-right {
            width: 55%;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-right h2 {
            font-size: 28px;
            color: #0f172a;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #64748b;
            font-size: 14px;
            margin-bottom: 30px;
        }

        /* ERROR */
        .error {
            background: #fee2e2;
            color: #b91c1c;
            border: 1px solid #fecaca;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        /* FORM */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: bold;
            color: #334155;
            margin-bottom: 8px;
        }

        .input-box {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
        }

        .input-box input {
            width: 100%;
            padding: 13px 15px 13px 45px;
            border: 1px solid #cbd5e1;
            border-radius: 9px;
            outline: none;
            font-size: 14px;
            transition: 0.3s;
        }

        .input-box input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
        }

        /* BUTTON */
        .btn-login {
            width: 100%;
            border: none;
            background: linear-gradient(135deg, #2563eb, #1e3a8a);
            color: white;
            padding: 14px;
            border-radius: 9px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 5px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 7px 15px rgba(37, 99, 235, 0.3);
        }

        .footer {
            text-align: center;
            margin-top: 25px;
            color: #94a3b8;
            font-size: 12px;
        }

        /* RESPONSIVE */
        @media (max-width: 700px) {

            .login-container {
                flex-direction: column;
            }

            .login-left {
                width: 100%;
                padding: 30px 20px;
            }

            .login-right {
                width: 100%;
                padding: 35px 25px;
            }

            .logo {
                font-size: 45px;
            }

            .login-left h1 {
                font-size: 26px;
            }
        }
    </style>
</head>

<body>

    <div class="login-container">

        <!-- BAGIAN KIRI -->
        <div class="login-left">

            <div class="logo">
                💼
            </div>

            <h1>KasirPro</h1>

            <p>
                Cashier Management System
                <br>
                Sistem pengelolaan kasir yang mudah
                dan praktis.
            </p>

            <div class="system-text">
                🔐 Sistem Login Aman
            </div>

        </div>


        <!-- BAGIAN KANAN -->
        <div class="login-right">

            <h2>Selamat Datang 👋</h2>

            <p class="subtitle">
                Silakan login untuk masuk ke sistem KasirPro.
            </p>


            <?php
            if (isset($_SESSION['pesan_error'])) {
                echo '<div class="error">⚠️ ' .
                     htmlspecialchars($_SESSION['pesan_error']) .
                     '</div>';

                unset($_SESSION['pesan_error']);
            }
            ?>


            <form action="proses_login.php" method="POST">

                <!-- USERNAME -->
                <div class="form-group">

                    <label for="username">
                        Username
                    </label>

                    <div class="input-box">

                        <span class="input-icon">
                            👤
                        </span>

                        <input
                            type="text"
                            id="username"
                            name="username"
                            placeholder="Masukkan username"
                            required
                        >

                    </div>

                </div>


                <!-- PASSWORD -->
                <div class="form-group">

                    <label for="password">
                        Password
                    </label>

                    <div class="input-box">

                        <span class="input-icon">
                            🔒
                        </span>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Masukkan password"
                            required
                        >

                    </div>

                </div>


                <!-- LOGIN -->
                <button type="submit" class="btn-login">
                    🔐 Login
                </button>

            </form>


            <div class="footer">
                © 2026 KasirPro - Cashier Management System
            </div>

        </div>

    </div>

</body>

</html>