<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Adam Rental</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.95) !important;
        }

        .navbar-brand {
            color: #667eea !important;
            font-weight: 700;
            font-size: 1.5rem;
        }

        .register-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .register-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 450px;
        }

        .register-header {
            text-align: center;
            margin-bottom: 35px;
        }

        .register-header h2 {
            color: #667eea;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .register-header p {
            color: #6c757d;
            margin: 0;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: 600;
            color: #212529;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-control {
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
        }

        .btn-register {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
            color: white;
        }

        .register-footer {
            text-align: center;
            margin-top: 25px;
            padding-top: 25px;
            border-top: 1px solid #e0e0e0;
        }

        .register-footer p {
            margin: 0;
            color: #6c757d;
        }

        .register-footer a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .register-footer a:hover {
            text-decoration: underline;
        }

        .alert {
            border-radius: 12px;
            border: none;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .register-card {
                padding: 25px;
            }

            .register-header {
                margin-bottom: 25px;
            }
        }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/customer') }}">
                <i class="bi bi-car-front"></i> Adam Rental
            </a>
        </div>
    </nav>

    <!-- REGISTER CONTAINER -->
    <div class="register-container">
        <div class="register-card">

            <!-- REGISTER HEADER -->
            <div class="register-header">
                <h2><i class="bi bi-person-plus"></i> Register</h2>
                <p>Buat akun baru untuk mulai menyewa</p>
            </div>

            <!-- REGISTER FORM -->
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label><i class="bi bi-person"></i> Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" placeholder="Masukkan nama lengkap Anda" required>
                </div>

                <div class="form-group">
                    <label><i class="bi bi-envelope"></i> Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Masukkan email Anda" required>
                </div>

                <div class="form-group">
                    <label><i class="bi bi-lock"></i> Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Masukkan password Anda" required>
                </div>

                <button type="submit" class="btn-register">
                    <i class="bi bi-check-circle"></i> Register
                </button>
            </form>

            <!-- REGISTER FOOTER -->
            <div class="register-footer">
                <p>
                    Sudah punya akun?
                    <a href="{{ route('login') }}">Login di sini</a>
                </p>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>