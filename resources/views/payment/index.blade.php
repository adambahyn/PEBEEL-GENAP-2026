<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f5f7fb;
        }
        .page-card {
            border: 0;
            border-radius: 22px;
        }
        .feature-card {
            border: 0;
            border-radius: 18px;
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
    @include('layouts.navbar')

    <div class="container py-4">
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

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
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
                                @foreach($cars as $car)
                                    <option value="{{ $car->id }}" data-price="{{ $car->price }}" data-name="{{ $car->brand }} {{ $car->model }}"
                                        {{ old('car_id') == $car->id ? 'selected' : '' }}>
                                        {{ $car->brand }} {{ $car->model }} — Rp {{ number_format($car->price, 0, ',', '.') }} /hari
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="customer_name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control form-control-lg" id="customer_name" name="customer_name" value="{{ old('customer_name') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="customer_contact" class="form-label">Nomor WA / Kontak</label>
                            <input type="text" class="form-control form-control-lg" id="customer_contact" name="customer_contact" value="{{ old('customer_contact') }}" required>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="start_date" class="form-label">Tanggal Mulai</label>
                                <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date', now()->format('Y-m-d')) }}" min="{{ now()->format('Y-m-d') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="duration" class="form-label">Durasi (hari)</label>
                                <input type="number" class="form-control" id="duration" name="duration" value="{{ old('duration', 1) }}" min="1" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="payment_method" class="form-label">Metode Pembayaran</label>
                            <select class="form-select" id="payment_method" name="payment_method" required>
                                <option value="">-- Pilih metode --</option>
                                <option value="transfer" {{ old('payment_method') == 'transfer' ? 'selected' : '' }}>Transfer Bank</option>
                                <option value="e_wallet" {{ old('payment_method') == 'e_wallet' ? 'selected' : '' }}>E-Wallet (GoPay, OVO, Dana)</option>
                                <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>Tunai</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Total Harga</label>
                            <div class="input-group input-group-lg shadow-sm rounded-3 overflow-hidden">
                                <span class="input-group-text bg-white border-end-0">Rp</span>
                                <input type="text" class="form-control border-start-0" id="total_price" value="Rp 0" readonly>
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
                        <p class="text-muted small mb-3">Pilih metode pembayaran yang sesuai. Booking akan masuk ke status <strong>Menunggu Konfirmasi</strong>, lalu admin akan menghubungi Anda.</p>
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
                                <small class="text-muted d-block">Bayar langsung saat penjemputan / pengambilan mobil.</small>
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
                        @if($cars->isEmpty())
                            <div class="alert alert-secondary mb-0">Belum ada mobil tersedia. Cek kembali nanti.</div>
                        @else
                            <div class="list-group list-group-flush">
                                @foreach($cars as $car)
                                    <div class="list-group-item px-0 py-3 border-0">
                                        <div class="d-flex justify-content-between align-items-start gap-3">
                                            <div>
                                                <div class="fw-semibold">{{ $car->brand }} {{ $car->model }}</div>
                                                <div class="text-muted small">{{ $car->capacity }} penumpang • {{ $car->transmission }}</div>
                                            </div>
                                            <div class="text-end">
                                                <div class="price-value">Rp {{ number_format($car->price, 0, ',', '.') }}</div>
                                                <small class="badge bg-success bg-opacity-10 text-success">Stock {{ $car->stock ?? '-' }}</small>
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
</body>
</html>
