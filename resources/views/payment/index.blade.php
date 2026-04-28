<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
                        <a class="nav-link {{ request()->is('product') ? 'active fw-bold' : '' }}" href="{{ route('product.index') }}">Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active fw-bold" href="{{ route('payment.index') }}">Pembayaran</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-4">
        <div class="row g-4">
            <div class="col-lg-7">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body">
                        <h3 class="card-title mb-3">Form Booking & Pembayaran</h3>

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

                            <div class="mb-3">
                                <label for="car_id" class="form-label">Pilih Mobil</label>
                                <select class="form-select" id="car_id" name="car_id" required>
                                    <option value="">-- Pilih mobil --</option>
                                    @foreach($cars as $car)
                                        <option value="{{ $car->id }}" data-price="{{ $car->price }}"
                                            {{ old('car_id') == $car->id ? 'selected' : '' }}>
                                            {{ $car->brand }} {{ $car->model }} — Rp {{ number_format($car->price, 0, ',', '.') }} /hari
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="customer_name" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="customer_name" name="customer_name" value="{{ old('customer_name') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="customer_contact" class="form-label">Nomor WA / Kontak</label>
                                <input type="text" class="form-control" id="customer_contact" name="customer_contact" value="{{ old('customer_contact') }}" required>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6 mb-3">
                                    <label for="start_date" class="form-label">Tanggal Mulai</label>
                                    <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date', now()->format('Y-m-d')) }}" min="{{ now()->format('Y-m-d') }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="duration" class="form-label">Durasi (hari)</label>
                                    <input type="number" class="form-control" id="duration" name="duration" value="{{ old('duration', 1) }}" min="1" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="payment_method" class="form-label">Metode Pembayaran</label>
                                <select class="form-select" id="payment_method" name="payment_method" required>
                                    <option value="">-- Pilih metode --</option>
                                    <option value="transfer" {{ old('payment_method') == 'transfer' ? 'selected' : '' }}>Transfer Bank</option>
                                    <option value="e_wallet" {{ old('payment_method') == 'e_wallet' ? 'selected' : '' }}>E-Wallet (GoPay, OVO, Dana)</option>
                                    <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>Tunai</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Total Harga</label>
                                <input type="text" class="form-control" id="total_price" value="Rp 0" readonly>
                            </div>

                            <button type="submit" class="btn btn-primary">Book Sekarang</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Cara Bayar</h5>
                        <p class="text-muted small mb-3">Pilih metode pembayaran yang sesuai. Booking akan masuk ke status <strong>Menunggu Konfirmasi</strong>, lalu admin akan menghubungi Anda.</p>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>Transfer Bank:</strong> Kirim ke BCA 123-456-7890 a.n. Adam Rental.</li>
                            <li class="list-group-item"><strong>E-Wallet:</strong> GoPay / OVO / Dana.</li>
                            <li class="list-group-item"><strong>Tunai:</strong> Bayar langsung saat penjemputan / pengambilan mobil.</li>
                        </ul>
                    </div>
                </div>

                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Mobil Tersedia</h5>
                        @if($cars->isEmpty())
                            <p class="text-muted">Belum ada mobil tersedia. Cek kembali nanti.</p>
                        @else
                            <ul class="list-group list-group-flush">
                                @foreach($cars as $car)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>{{ $car->brand }} {{ $car->model }}</span>
                                        <span class="text-success">Rp {{ number_format($car->price, 0, ',', '.') }}</span>
                                    </li>
                                @endforeach
                            </ul>
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
