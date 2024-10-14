<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Log in</title>

    <!-- Import font Inter dari Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Import AdminLTE CSS -->
    <link rel="stylesheet" href="AdminLte/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="AdminLte/dist/css/adminlte.min.css?v=3.2.0">

    <!-- Custom CSS (inline) -->
    <style>
        /* Mengubah latar belakang halaman login */
        body.login-page {
            background-color: #4169E1; /* Latar belakang biru */
            font-family: 'Inter', sans-serif; /* Menggunakan font Inter */
            color: #333; /* Mengubah warna teks seluruh halaman */
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-box {
            background-color: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            width: 350px;
        }

        /* Menghapus tulisan "Login" */
        .login-logo {
            display: none;
        }

        .login-card-body {
            text-align: center;
        }

        .login-card-body .login-box-msg {
            font-family: 'Inter', sans-serif; /* Menggunakan font Inter */
            font-size: 20px; /* Mengubah ukuran font */
            margin-bottom: 30px; /* Menjaga jarak */
            font-weight: bold;
            color: #000000; /* Mengubah warna teks menjadi hitam */
        }

        /* Style input username dan password dengan jarak antar textfield */
        .input-group {
            margin-bottom: 20px; /* Jarak antar textfield */
        }

        .input-group input {
            background-color: #f0f0f0;
            border: none;
            border-radius: 5px;
            padding: 10px;
            font-family: 'Inter', sans-serif; /* Menggunakan font Inter */
            font-size: 16px; /* Mengubah ukuran font */
            color: #333; /* Mengubah warna teks input */
        }

        .input-group .input-group-text {
            background-color: #f0f0f0;
            border: none;
            border-radius: 5px;
            font-family: 'Inter', sans-serif; /* Menggunakan font Inter */
            color: #555; /* Mengubah warna teks ikon */
        }

        /* Custom button style */
        .btn-custom {
            background-color: black;
            color: white;
            border-radius: 5px;
            padding: 10px;
            font-size: 16px;
            font-family: 'Inter', sans-serif; /* Menggunakan font Inter untuk tombol */
            margin-top: 20px; /* Menambahkan jarak antara tombol dan textfield */
        }

        .btn-custom:hover {
            background-color: #333;
            color: white;
        }
    </style>
</head>
<body class="hold-transition login-page">
    <div class="login-container">
        <div class="login-box">
            <div class="card">
                <div class="card-body login-card-body">
                    <h2 class="login-box-msg">SIGN IN</h2>
                    <form action="{{ route('login') }}" method="POST">
                        @csrf <!-- Tambahkan CSRF token untuk keamanan -->
                        
                        <!-- Input untuk Username -->
                        <div class="input-group">
                            <input type="text" name="username" class="form-control" placeholder="Username" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Input untuk Password -->
                        <div class="input-group">
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Masuk -->
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-block btn-custom">Masuk</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- AdminLTE Scripts -->
    <script src="AdminLte/plugins/jquery/jquery.min.js"></script>
    <script src="AdminLte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="AdminLte/dist/js/adminlte.min.js?v=3.2.0"></script>
</body>
</html>
