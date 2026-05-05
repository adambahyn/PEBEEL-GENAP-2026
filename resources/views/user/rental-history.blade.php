<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Sewa - Adam Rental</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            background: #f5f7fb;
        }

        .navbar-brand {
            font-size: 1.5rem;
        }

        .page-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px 0;
            margin-bottom: 30px;
            border-radius: 0;
        }

        .page-header h1 {
            margin: 0;
            font-weight: 700;
        }

        .rental-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            border-left: 5px solid #667eea;
            transition: all 0.3s ease;
        }

        .rental-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.12);
        }

        .rental-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .rental-car-name {
            font-size: 1.3rem;
            font-weight: 700;
            color: #212529;
            margin-bottom: 5px;
        }

        .rental-date {
            font-size: 0.9rem;
            color: #6c757d;
        }

        .status-badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-completed {
            background: #d4edda;
            color: #155724;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-cancelled {
            background: #f8d7da;
            color: #721c24;
        }

        .rental-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .detail-item {
            padding: 15px;
            background: #f8f9fa;
            border-radius: 10px;
            border-left: 3px solid #667eea;
        }

        .detail-label {
            font-size: 0.85rem;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 5px;
            font-weight: 600;
        }

        .detail-value {
            font-size: 1.1rem;
            color: #212529;
            font-weight: 600;
        }

        .detail-value.price {
            color: #667eea;
            font-size: 1.3rem;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        .empty-state-icon {
            font-size: 60px;
            color: #ddd;
            margin-bottom: 20px;
        }

        .empty-state-text {
            color: #6c757d;
            margin-bottom: 30px;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn-custom {
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 0.9rem;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
            color: white;
            text-decoration: none;
        }

        .btn-secondary-custom {
            background: white;
            color: #667eea;
            border: 2px solid #667eea;
        }

        .btn-secondary-custom:hover {
            background: #667eea;
            color: white;
            text-decoration: none;
        }

        @media (max-width: 768px) {
            .rental-header {
                flex-direction: column;
            }

            .rental-details {
                grid-template-columns: 1fr;
            }

            .page-header {
                padding: 20px 0;
            }
        }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/customer') }}">
                Adam Rental
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav gap-2">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/customer') }}">
                            Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/product') }}">
                            Product
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('payment.index') }}">
                            Pembayaran
                        </a>
                    </li>

                    @if (Auth::check())
                        <!-- LOGIN SEBAGAI USER -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#"
                                data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle fs-4"></i>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end">
                                <!-- NAMA USER -->
                                <li class="dropdown-item-text fw-semibold">
                                    👤 {{ Auth::user()->name }}
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                <!-- MENU TAMBAHAN -->
                                <li>
                                    <a class="dropdown-item" href="{{ route('user.profile') }}">Profil</a>
                                </li>
                                <li>
                                    <a class="dropdown-item active fw-bold" href="{{ route('user.rental-history') }}">Riwayat Sewa</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                <!-- LOGOUT -->
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button class="dropdown-item">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- PAGE HEADER -->
    <div class="page-header">
        <div class="container">
            <h1><i class="bi bi-clock-history"></i> Riwayat Sewa Mobil</h1>
            <p class="text-white-50 mb-0">Kelola dan lihat detail semua penyewaan Anda</p>
        </div>
    </div>

    <!-- CONTENT -->
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto">

                @if ($bookings->isEmpty())
                    <!-- EMPTY STATE -->
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <i class="bi bi-inbox"></i>
                        </div>
                        <h3 class="fw-bold mb-2">Belum Ada Riwayat Sewa</h3>
                        <p class="empty-state-text">Anda belum melakukan penyewaan mobil. Mulai sewa mobil favorit Anda sekarang!</p>
                        <a href="{{ url('/product') }}" class="btn-custom btn-primary-custom">
                            <i class="bi bi-car-front"></i> Sewa Mobil Sekarang
                        </a>
                    </div>
                @else
                    <!-- RENTAL LIST -->
                    @foreach ($bookings as $booking)
                        <div class="rental-card">
                            <div class="rental-header">
                                <div>
                                    <div class="rental-car-name">
                                        <i class="bi bi-car-front"></i> {{ $booking->car->name ?? 'N/A' }}
                                    </div>
                                    <div class="rental-date">
                                        <i class="bi bi-calendar-event"></i> {{ $booking->start_date }}
                                    </div>
                                </div>
                                <div>
                                    <span class="status-badge status-{{ strtolower($booking->status) }}">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </div>
                            </div>

                            <div class="rental-details">
                                <div class="detail-item">
                                    <div class="detail-label">
                                        <i class="bi bi-calendar2-event"></i> Durasi Sewa
                                    </div>
                                    <div class="detail-value">
                                        {{ $booking->duration }} hari
                                    </div>
                                </div>

                                <div class="detail-item">
                                    <div class="detail-label">
                                        <i class="bi bi-person"></i> Nama Penyewa
                                    </div>
                                    <div class="detail-value">
                                        {{ $booking->customer_name }}
                                    </div>
                                </div>

                                <div class="detail-item">
                                    <div class="detail-label">
                                        <i class="bi bi-telephone"></i> Nomor Kontak
                                    </div>
                                    <div class="detail-value">
                                        {{ $booking->customer_contact }}
                                    </div>
                                </div>

                                <div class="detail-item">
                                    <div class="detail-label">
                                        <i class="bi bi-credit-card"></i> Metode Pembayaran
                                    </div>
                                    <div class="detail-value">
                                        {{ ucfirst($booking->payment_method) }}
                                    </div>
                                </div>

                                <div class="detail-item">
                                    <div class="detail-label">
                                        <i class="bi bi-cash"></i> Total Harga
                                    </div>
                                    <div class="detail-value price">
                                        Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                    </div>
                                </div>

                                <div class="detail-item">
                                    <div class="detail-label">
                                        <i class="bi bi-clock"></i> Tanggal Pemesanan
                                    </div>
                                    <div class="detail-value">
                                        {{ $booking->created_at->format('d M Y H:i') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- BACK TO PROFILE BUTTON -->
                    <div class="mt-4">
                        <a href="{{ route('user.profile') }}" class="btn-custom btn-secondary-custom">
                            <i class="bi bi-arrow-left"></i> Kembali ke Profil
                        </a>
                    </div>
                @endif

            </div>
        </div>
    </div>

    <!-- SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
