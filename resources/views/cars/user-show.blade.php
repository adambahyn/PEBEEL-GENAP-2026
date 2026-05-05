<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $car->brand }} {{ $car->model }}</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .hero-banner {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            height: 200px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
        }

        .car-img {
            height: 300px;
            object-fit: cover;
            border-radius: 10px;
        }

        .info-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 15px;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-label {
            font-weight: 600;
            color: #6c757d;
        }

        .info-value {
            font-weight: 500;
            color: #212529;
        }

        .price-section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin: 20px 0;
            border-left: 4px solid #667eea;
        }

        .price-tag {
            font-size: 32px;
            font-weight: bold;
            color: #667eea;
        }

        .specs-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin: 20px 0;
        }

        .spec-item {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
        }

        .spec-value {
            font-size: 24px;
            font-weight: bold;
            color: #667eea;
        }

        .spec-label {
            font-size: 12px;
            color: #6c757d;
            margin-top: 5px;
        }

        .navbar {
            background: white !important;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .btn-booking {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 12px 30px;
            font-weight: 600;
        }

        .btn-booking:hover {
            background: linear-gradient(135deg, #5568d3 0%, #6a3d8f 100%);
            color: white;
        }

        .description {
            line-height: 1.8;
            color: #495057;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="bg-light">

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/home') }}">
                Adam Rental
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav gap-2">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/customer') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ url('/product') }}">Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('payment.index') }}">Pembayaran</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-5">

        <!-- TOMBOL KEMBALI -->
        <a href="{{ url('/product') }}" class="btn btn-outline-secondary mb-4">
            ← Kembali ke Product
        </a>

        <div class="row">

            <!-- GAMBAR MOBIL -->
            <div class="col-lg-6 mb-4">
                <img src="{{ asset('storage/' . $car->image) }}" class="w-100 car-img">
            </div>

            <!-- DETAIL MOBIL -->
            <div class="col-lg-6">

                <!-- JUDUL -->
                <h1 class="fw-bold mb-2">
                    {{ $car->brand }} {{ $car->model }}
                </h1>
                <p class="text-muted">Tipe: {{ $car->type ?? 'N/A' }}</p>

                <!-- HARGA -->
                <div class="price-section">
                    <p class="text-muted mb-2">Harga Rental</p>
                    <div class="price-tag">Rp {{ number_format($product->price) }}</div>
                    <small class="text-muted">Per Hari</small>
                </div>

                <!-- SPESIFIKASI -->
                <h5 class="fw-bold mb-3">Spesifikasi</h5>
                <div class="specs-grid">
                    <div class="spec-item">
                        <div class="spec-value">{{ $car->capacity }}</div>
                        <div class="spec-label">Kapasitas Penumpang</div>
                    </div>
                    <div class="spec-item">
                        <div class="spec-value">{{ $car->transmission }}</div>
                        <div class="spec-label">Transmisi</div>
                    </div>
                    <div class="spec-item">
                        <div class="spec-value">{{ $car->fuel_type }}</div>
                        <div class="spec-label">Tipe Bahan Bakar</div>
                    </div>
                    <div class="spec-item">
                        <div class="spec-value">{{ $car->stock }}</div>
                        <div class="spec-label">Stok Tersedia</div>
                    </div>
                </div>

                <!-- INFO DETAIL -->
                <div class="info-card">
                    <h5 class="fw-bold mb-3">Detail Kendaraan</h5>
                    <div class="info-item">
                        <span class="info-label">Merek</span>
                        <span class="info-value">{{ $car->brand }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Model</span>
                        <span class="info-value">{{ $car->model }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Tahun</span>
                        <span class="info-value">{{ $car->year ?? 'N/A' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Warna</span>
                        <span class="info-value">{{ $car->color ?? 'N/A' }}</span>
                    </div>
                </div>

                <!-- TOMBOL BOOKING -->
                <button type="button" class="btn btn-booking btn-lg w-100 mb-3" data-bs-toggle="modal"
                    data-bs-target="#bookingModal">
                    🚗 Booking Sekarang
                </button>

                <a href="{{ url('/product') }}" class="btn btn-outline-secondary w-100">
                    Lihat Mobil Lain
                </a>

            </div>

        </div>

        <!-- DESKRIPSI -->
        <div class="row mt-5">
            <div class="col-12">
                <h5 class="fw-bold mb-3">Deskripsi Kendaraan</h5>
                <div class="description">
                    {{ $car->description }}
                </div>
            </div>
        </div>

        <!-- INFO PENYEDIA -->
        <div class="row mt-4 mb-5">
            <div class="col-md-6">
                <div class="info-card">
                    <h5 class="fw-bold mb-3">📞 Informasi Penyedia</h5>
                    <div class="info-item">
                        <span class="info-label">Nama</span>
                        <span class="info-value">{{ $car->provider_name }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Kontak</span>
                        <span class="info-value">{{ $car->provider_contact }}</span>
                    </div>
                </div>
            </div>
        </div>

    </div>

                <!-- MODAL BOOKING -->
    <div class="modal fade" id="bookingModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Booking</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p><strong>{{ $car->brand }} {{ $car->model }}</strong></p>
                    <p>Harga: <strong>Rp {{ number_format($product->price) }} / hari</strong></p>
                    <p class="text-muted">Silakan lanjutkan ke halaman pembayaran untuk menyelesaikan booking Anda.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a href="{{ route('payment.index') }}" class="btn btn-booking">Lanjut Booking</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
