<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email - Adam Rental</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.95) !important;
        }

        .navbar-brand {
            color: #2563eb !important;
            font-weight: 700;
            font-size: 1.5rem;
        }

        .verify-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .verify-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 500px;
            text-align: center;
        }

        .verify-icon {
            font-size: 4.5rem;
            color: #2563eb;
            margin-bottom: 20px;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 1;
            }
            50% {
                transform: scale(1.05);
                opacity: 0.8;
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .verify-header h2 {
            color: #212529;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .verify-body {
            color: #4b5563;
            font-size: 1.05rem;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .btn-resend {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-resend:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(37, 99, 235, 0.4);
            color: white;
        }

        .btn-logout {
            background: transparent;
            border: 2px solid #e5e7eb;
            color: #4b5563;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 12px;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-logout:hover {
            background: #f3f4f6;
            border-color: #d1d5db;
            color: #1f2937;
        }

        .alert {
            border-radius: 12px;
            border: none;
            margin-bottom: 25px;
            text-align: left;
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

    <!-- VERIFY CONTAINER -->
    <div class="verify-container">
        <div class="verify-card">

            <!-- ICON -->
            <div class="verify-icon">
                <i class="bi bi-envelope-check-fill"></i>
            </div>

            <!-- HEADER -->
            <div class="verify-header">
                <h2>Verifikasi Email Anda</h2>
            </div>

            <!-- BODY -->
            <div class="verify-body">
                <p>Terima kasih telah mendaftar! Sebelum mulai menggunakan layanan rental mobil kami, harap verifikasi alamat email Anda dengan mengeklik tautan yang baru saja kami kirimkan melalui email.</p>
                <p class="text-muted small">Jika Anda tidak menerima email tersebut, kami dengan senang hati akan mengirimkan ulang link yang baru.</p>
            </div>

            <!-- SUCCESS MESSAGE -->
            @if (session('message'))
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                    <div>
                        {{ session('message') }}
                    </div>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                    <div>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            <!-- RESEND BUTTON FORM -->
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="btn-resend">
                    <i class="bi bi-send-fill"></i> Kirim Ulang Email Verifikasi
                </button>
            </form>

            <!-- LOGOUT FORM (For correction of wrong email) -->
            <form method="POST" action="{{ route('logout') }}" class="mt-3">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="bi bi-box-arrow-right me-1"></i> Keluar (Logout)
                </button>
            </form>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
