<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: radial-gradient(circle at top, rgba(13, 110, 253, 0.12), transparent 30%), #eef5ff;
            color: #1f2937;
        }

        .page-card,
        .feature-card {
            background: #ffffff;
            border: 0;
            border-radius: 28px;
            box-shadow: 0 24px 70px rgba(15, 23, 42, 0.08);
        }

        .hero-panel {
            position: relative;
            background: linear-gradient(180deg, rgba(15, 23, 42, 0.18), rgba(15, 23, 42, 0.04)), url('{{ asset('images/payment-hero.jpg') }}') no-repeat center/cover;
            border-radius: 30px;
            border: 1px solid rgba(13, 110, 253, 0.12);
            overflow: hidden;
        }

        .hero-panel::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(15, 23, 42, 0.45), rgba(15, 23, 42, 0.18));
            pointer-events: none;
        }

        .hero-panel .row {
            position: relative;
            z-index: 1;
        }

        .hero-panel .section-label,
        .hero-panel h1,
        .hero-panel p,
        .hero-panel .step-badge,
        .hero-panel .d-inline-flex {
            color: #ffffff !important;
        }

        .hero-panel h1 {
            text-shadow: 0 18px 40px rgba(15, 23, 42, 0.18);
        }

        .hero-panel p {
            color: rgba(255, 255, 255, 0.88) !important;
        }

        .hero-panel .step-badge {
            background: rgba(255, 255, 255, 0.16);
            border: 1px solid rgba(255, 255, 255, 0.18);
            color: #f8fafc !important;
        }

        .hero-panel .d-inline-flex {
            border: 1px solid rgba(255, 255, 255, 0.25);
            background: rgba(255, 255, 255, 0.14);
        }

        .section-label {
            font-size: 0.83rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: #6c757d;
        }

        .price-value {
            color: #0d6efd;
            font-weight: 700;
        }

        .sticky-sidebar {
            position: sticky;
            top: 1.5rem;
        }

        .highlight-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            font-size: 0.82rem;
        }

        .highlight-badge::before {
            content: "";
            width: 0.6rem;
            height: 0.6rem;
            border-radius: 50%;
            background: #0d6efd;
        }
    </style>
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('product.index') }}">Adam Rental</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav gap-2">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('customer') ? 'active fw-bold' : '' }}"
                            href="{{ url('/customer') }}">
                            Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('product') ? 'active fw-bold' : '' }}"
                            href="{{ route('product.index') }}">Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active fw-bold" href="{{ route('payment.index') }}">Pembayaran</a>
                    </li>
                    {{-- LOGIN --}}
                    @if (!Auth::check())
                        <!-- BELUM LOGIN -->
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('login') ? 'active fw-bold' : '' }} btn btn-primary text-white px-3"
                                href="{{ route('login') }}">
                                Login
                            </a>
                        </li>
                    @elseif(Auth::user()->role === 'user')
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
                                    <a class="dropdown-item" href="#">Profil</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">Riwayat Sewa</a>
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

    <div class="container py-4">
        <div class="row mb-4">
            <div class="col-12">
                <div class="card hero-panel p-4 mb-4">
                    <div class="row align-items-center gy-3">
                        <div class="col-md-8">
                            <p class="section-label mb-2">Booking & Pembayaran</p>
                            <h1 class="h3 fw-semibold mb-2">Booking mobil dan bayar langsung dari satu halaman.</h1>
                            <p class="text-muted mb-3">Pilih mobil, tentukan tanggal sewa, dan pilih metode pembayaran —
                                semuanya mudah diatur di sini.</p>
                            <div class="d-flex flex-wrap gap-3">
                                <div class="step-badge">Booking cepat</div>
                                <div class="step-badge">Pembayaran fleksibel</div>
                                <div class="step-badge">Konfirmasi admin cepat</div>
                            </div>
                        </div>
                        <div class="col-md-4 text-md-end d-none d-md-block">
                            <!-- hero side spacing -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-7">
                <div class="card page-card p-4 mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <p class="section-label mb-1">Form Booking</p>
                            <h2 class="h4 mb-0">Booking Mobil dengan Lebih Mudah</h2>
                        </div>
                        <span class="badge bg-primary bg-opacity-10 text-primary py-2 px-3">Simpel & Cepat</span>
                    </div>

 HEAD
                    @if(session('warning'))
                        <div class="alert alert-warning">{{ session('warning') }}</div>
                    @endif

                    @if(session('success'))

                    @if (session('success'))
3c973db57c6115289193ce8ccce9391a0ecd7700
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('payment.store') }}" method="POST" id="payment-form">
                        @csrf

                        <div class="mb-4">
                            <label for="car_id" class="form-label">Pilih Mobil</label>
                            <select class="form-select form-select-lg" id="car_id" name="car_id" required>
                                <option value="">-- Pilih mobil --</option>
                                @foreach ($cars as $car)
                                    <option value="{{ $car->id }}" data-price="{{ $car->price }}"
                                        data-name="{{ $car->brand }} {{ $car->model }}"
                                        {{ old('car_id') == $car->id ? 'selected' : '' }}>
                                        {{ $car->brand }} {{ $car->model }} — Rp
                                        {{ number_format($car->price, 0, ',', '.') }} /hari
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="customer_name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control form-control-lg" id="customer_name"
                                name="customer_name" value="{{ old('customer_name') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="customer_contact" class="form-label">Nomor WA / Kontak</label>
                            <input type="text" class="form-control form-control-lg" id="customer_contact"
                                name="customer_contact" value="{{ old('customer_contact') }}" required>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="start_date" class="form-label">Tanggal Mulai</label>
                                <input type="date" class="form-control" id="start_date" name="start_date"
                                    value="{{ old('start_date', now()->format('Y-m-d')) }}"
                                    min="{{ now()->format('Y-m-d') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="duration" class="form-label">Durasi (hari)</label>
                                <input type="number" class="form-control" id="duration" name="duration"
                                    value="{{ old('duration', 1) }}" min="1" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="payment_method" class="form-label">Metode Pembayaran</label>
                            <select class="form-select" id="payment_method" name="payment_method" required>
                                <option value="">-- Pilih metode --</option>
                                <option value="transfer" {{ old('payment_method') == 'transfer' ? 'selected' : '' }}>
                                    Transfer Bank</option>
                                <option value="e_wallet" {{ old('payment_method') == 'e_wallet' ? 'selected' : '' }}>
                                    E-Wallet (GoPay, OVO, Dana)</option>
                                <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>Tunai
                                </option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Total Harga</label>
                            <div class="input-group input-group-lg shadow-sm rounded-3 overflow-hidden">
                                <span class="input-group-text bg-white border-end-0">Rp</span>
                                <input type="text" class="form-control border-start-0" id="total_price"
                                    value="Rp 0" readonly>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100">Book Sekarang</button>
                    </form>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card feature-card shadow-sm border-0 sticky-sidebar mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <p class="section-label mb-1">Panduan Pembayaran</p>
                                <h5 class="mb-0">Cara Bayar</h5>
                            </div>
                            <span class="badge bg-primary bg-opacity-10 text-primary">Update</span>
                        </div>
                        <p class="text-muted small mb-3">Pilih metode pembayaran yang sesuai. Booking akan masuk ke
                            status <strong>Menunggu Konfirmasi</strong>, lalu admin akan menghubungi Anda.</p>
                        <div class="list-group list-group-flush">
                            <div class="list-group-item px-0 py-3 border-0">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="fw-semibold">Transfer Bank</span>
                                    <span class="badge bg-info bg-opacity-10 text-info">Rekomendasi</span>
                                </div>
                                <small class="text-muted d-block">Kirim ke BCA 123-456-7890 a.n. Adam Rental.</small>
                            </div>
                            <div class="list-group-item px-0 py-3 border-0">
                                <div class="fw-semibold mb-1">E-Wallet</div>
                                <small class="text-muted d-block">GoPay / OVO / Dana.</small>
                            </div>
                            <div class="list-group-item px-0 py-3 border-0">
                                <div class="fw-semibold mb-1">Tunai</div>
                                <small class="text-muted d-block">Bayar langsung saat penjemputan / pengambilan
                                    mobil.</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card feature-card shadow-sm border-0 sticky-sidebar">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <p class="section-label mb-1">Tersedia</p>
                                <h5 class="mb-0">Mobil Siap Sewa</h5>
                            </div>
                            <span class="badge bg-success bg-opacity-10 text-success">{{ $cars->count() }} unit</span>
                        </div>
                        @if ($cars->isEmpty())
                            <div class="alert alert-secondary mb-0">Belum ada mobil tersedia. Cek kembali nanti.</div>
                        @else
                            <div class="list-group list-group-flush">
                                @foreach ($cars as $car)
                                    <div class="list-group-item px-0 py-3 border-0">
                                        <div class="d-flex justify-content-between align-items-start gap-3">
                                            <div>
                                                <div class="fw-semibold">{{ $car->brand }} {{ $car->model }}
                                                </div>
                                                <div class="text-muted small">{{ $car->capacity }} penumpang •
                                                    {{ $car->transmission }}</div>
                                            </div>
                                            <div class="text-end">
                                                <div class="price-value">Rp
                                                    {{ number_format($car->price, 0, ',', '.') }}</div>
                                                <small class="badge bg-success bg-opacity-10 text-success">Stock
                                                    {{ $car->stock ?? '-' }}</small>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateTotalPrice() {
            const selectedOption = document.querySelector('#car_id option:checked');
            const duration = Number(document.querySelector('#duration').value) || 0;
            const price = Number(selectedOption?.dataset.price || 0);
            const total = price * duration;
            document.querySelector('#total_price').value = total > 0 ? 'Rp ' + total.toLocaleString('id-ID') : 'Rp 0';
        }

        document.querySelector('#car_id').addEventListener('change', updateTotalPrice);
        document.querySelector('#duration').addEventListener('input', updateTotalPrice);
        updateTotalPrice();
    </script>
    <!-- Bootstrap JS (WAJIB untuk dropdown) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
