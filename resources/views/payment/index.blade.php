<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kendaraan - Adam Rental</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
            color: #333;
        }

        .hero-section {
            background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('https://images.unsplash.com/photo-1449965408869-eaa3f722e40d?auto=format&fit=crop&q=80&w=2000') center/cover;
            height: 250px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
        }

        .car-image-container img {
            width: 100%;
            border-radius: 8px;
            object-fit: cover;
        }

        .car-specs {
            display: flex;
            justify-content: space-between;
            background: white;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
            text-align: center;
            font-size: 0.85rem;
        }

        .car-specs .spec-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 5px;
        }

        .car-specs .spec-item i {
            font-size: 1.2rem;
            color: #555;
        }

        .warning-box {
            background-color: #fffbea;
            border: 1px solid #fceca1;
            padding: 15px;
            border-radius: 8px;
            font-size: 0.8rem;
            color: #d97706;
            margin-bottom: 20px;
        }

        .section-card {
            background: white;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
            padding: 20px;
            margin-bottom: 20px;
        }

        .section-title {
            font-weight: 600;
            font-size: 1rem;
            margin-bottom: 15px;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }

        .form-label {
            font-size: 0.85rem;
            font-weight: 500;
        }

        .form-control, .form-select {
            font-size: 0.9rem;
            border-radius: 6px;
        }

        .btn-green {
            background-color: #10b981;
            border-color: #10b981;
            color: white;
            font-weight: 600;
        }
        .btn-green:hover {
            background-color: #059669;
            border-color: #059669;
            color: white;
        }

        .price-summary {
            background-color: #e2e8f0;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            margin-bottom: 20px;
        }

        .price-summary h4 {
            font-weight: 700;
            margin: 0;
            color: #1e293b;
        }

        .file-upload-btn {
            background-color: #10b981;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            font-size: 0.85rem;
            cursor: pointer;
            width: 100%;
            text-align: center;
            display: inline-block;
        }
    </style>
</head>
<body>
    @include('layouts.navbar')

    <div class="hero-section">
        <h1 class="fw-bold">Detail Kendaraan</h1>
    </div>

    <div class="container py-5">
        
        @if(session('warning'))
            <div class="alert alert-warning">{{ session('warning') }}</div>
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

        <form action="{{ route('payment.store') }}" method="POST" enctype="multipart/form-data" id="bookingForm">
            @csrf
            <input type="hidden" name="car_id" value="{{ $car->id }}">
            <input type="hidden" id="car_price" value="{{ $car->price }}">

            <div class="row g-4">
                <!-- Kiri: Detail Mobil -->
                <div class="col-lg-6">
                    <div class="car-image-container mb-3">
                        <img src="{{ $car->image ? asset('storage/' . $car->image) : 'https://images.unsplash.com/photo-1550355291-bbee04a92027?q=80&w=800&auto=format&fit=crop' }}" alt="{{ $car->brand }} {{ $car->model }}">
                    </div>

                    <div class="car-specs mb-3">
                        <div class="spec-item">
                            <i class="bi bi-calendar"></i>
                            <span>Year<br><b>{{ $car->year ?? '2024' }}</b></span>
                        </div>
                        <div class="spec-item">
                            <i class="bi bi-fuel-pump"></i>
                            <span>Fuel<br><b>Pertamax</b></span>
                        </div>
                        <div class="spec-item">
                            <i class="bi bi-palette"></i>
                            <span>Color<br><b>{{ $car->color ?? 'Hitam' }}</b></span>
                        </div>
                        <div class="spec-item">
                            <i class="bi bi-car-front"></i>
                            <span>Capacity<br><b>{{ $car->capacity ?? '4' }}</b></span>
                        </div>
                        <div class="spec-item">
                            <i class="bi bi-gear"></i>
                            <span>Transmission<br><b>{{ $car->transmission ?? 'Auto' }}</b></span>
                        </div>
                    </div>

                    <div class="warning-box">
                        <strong>PERINGATAN</strong><br>
                        MOHON SELALU LAKUKAN PENGECEKAN KENDARAAN SAAT SERAH TERIMA. KAMI TIDAK MENERIMA KOMPLAIN JIKA KENDARAAN SUDAH BERPINDAH TANGAN.
                    </div>

                    <div class="section-card">
                        <h4 class="fw-bold mb-3">{{ $car->brand }} {{ $car->model }}</h4>
                        <p class="text-muted small mb-3">Rental Sewa Mobil {{ $car->brand }} Lepas Kunci</p>
                        
                        <div class="small">
                            <p>{{ $car->description ?? 'Mobil ini tersedia dalam kondisi prima, sangat cocok untuk perjalanan dalam dan luar kota. Fitur lengkap meliputi AC, Power Steering, dan Audio System yang memadai.' }}</p>
                            <p>* Gambar unit di aplikasi hanya ilustrasi, untuk real picture bisa hubungi customer service kami.</p>
                        </div>
                    </div>
                </div>

                <!-- Kanan: Form Transaksi -->
                <div class="col-lg-6">
                    
                    <div class="price-summary">
                        <div class="text-muted small mb-1">Total Harga</div>
                        <div class="small mb-1">Lokasi - {{ $car->location ?? 'Malang' }}</div>
                        <div class="small fw-semibold mb-2" id="date-summary">-</div>
                        <h4 id="display-total-price">Rp {{ number_format($car->price, 0, ',', '.') }}</h4>
                    </div>

                    <!-- Data Pribadi -->
                    <div class="section-card">
                        <div class="section-title">Data Pribadi</div>
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" name="customer_name" value="{{ old('customer_name', auth()->user()->name) }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ old('email', auth()->user()->email) }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nomor telepon / WA</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white">+62</span>
                                <input type="text" class="form-control border-start-0" name="customer_contact" value="{{ old('customer_contact') }}" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <input type="text" class="form-control" name="alamat" value="{{ old('alamat') }}" placeholder="Masukkan alamat Anda" required>
                        </div>
                        
                        <div class="row g-2">
                            <div class="col-6">
                                <label class="form-label">Unggah Kartu Identitas (KTP)</label>
                                <input type="file" name="ktp_file" class="form-control form-control-sm" accept="image/*">
                            </div>
                            <div class="col-6">
                                <label class="form-label">Unggah SIM</label>
                                <input type="file" name="sim_file" class="form-control form-control-sm" accept="image/*">
                            </div>
                        </div>
                    </div>

                    <!-- Detail Sewa Mobil -->
                    <div class="section-card">
                        <div class="section-title">Detail Sewa Mobil</div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal Mulai</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date', now()->format('Y-m-d')) }}" min="{{ now()->format('Y-m-d') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal Selesai</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date', now()->addDay()->format('Y-m-d')) }}" min="{{ now()->format('Y-m-d') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Lokasi Mobil</label>
                            <input type="text" class="form-control" name="pickup_location" value="{{ old('pickup_location', $car->location) }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pengambilan Mobil</label>
                            <div class="d-flex gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="pickup_method" id="pickup_1" value="Ambil Sendiri" checked>
                                    <label class="form-check-label small" for="pickup_1">Ambil Sendiri</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="pickup_method" id="pickup_2" value="Diantar">
                                    <label class="form-check-label small" for="pickup_2">Diantar (Biaya Tambahan)</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pengembalian Mobil</label>
                            <div class="d-flex gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="return_method" id="return_1" value="Kembalikan Sendiri" checked>
                                    <label class="form-check-label small" for="return_1">Kembalikan Sendiri</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="return_method" id="return_2" value="Diambil">
                                    <label class="form-check-label small" for="return_2">Diambil (Biaya Tambahan)</label>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="form-label">Anda tahu Adam Rental darimana?</label>
                            <select class="form-select" name="source_info">
                                <option value="">Pilih Status</option>
                                <option value="Instagram">Instagram</option>
                                <option value="Tiktok">Tiktok</option>
                                <option value="Teman">Teman</option>
                                <option value="Google">Google</option>
                            </select>
                        </div>
                    </div>

                    <!-- Detail Pembayaran -->
                    <div class="section-card">
                        <div class="section-title">Detail Pembayaran</div>
                        
                        <div class="d-flex justify-content-between mb-3 small">
                            <span id="price-calculation-text">Harga (1 hari)</span>
                            <span id="price-calculation-value">Rp {{ number_format($car->price, 0, ',', '.') }}</span>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label text-success">Pilih Metode Pembayaran</label>
                            <select class="form-select" name="payment_method" required>
                                <option value="transfer">Transfer Bank</option>
                                <option value="e_wallet">E-Wallet (OVO/GoPay/Dana)</option>
                                <option value="cash">Bayar Tunai</option>
                            </select>
                        </div>

                        <hr>
                        
                        <div class="d-flex justify-content-between fw-bold mb-3">
                            <span>Total Harga</span>
                            <span id="final-total-price">Rp {{ number_format($car->price, 0, ',', '.') }}</span>
                        </div>

                        <div class="warning-box" style="font-size: 0.7rem; margin-bottom: 0;">
                            <strong>PERINGATAN</strong><br>
                            Harap pastikan untuk membaca syarat dan ketentuan sepenuhnya karena TIDAK AKAN ADA PENGEMBALIAN UANG jika Anda gagal memenuhi syarat.
                        </div>
                    </div>

                    <button type="submit" class="btn btn-green btn-lg w-100 mb-2">Pesan sekarang</button>
                    <p class="text-center text-muted" style="font-size: 0.75rem;">Diperlukan uang jaminan yang akan dikembalikan saat masa sewa berakhir.</p>

                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const startDateInput = document.getElementById('start_date');
            const endDateInput = document.getElementById('end_date');
            const carPrice = parseInt(document.getElementById('car_price').value);
            
            function calculateTotal() {
                const start = new Date(startDateInput.value);
                const end = new Date(endDateInput.value);
                
                let days = 1;
                if (!isNaN(start.getTime()) && !isNaN(end.getTime())) {
                    const diffTime = Math.abs(end - start);
                    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                    days = diffDays > 0 ? diffDays : 1;
                }
                
                const total = carPrice * days;
                const formattedTotal = 'Rp ' + total.toLocaleString('id-ID');
                
                document.getElementById('display-total-price').textContent = formattedTotal;
                document.getElementById('final-total-price').textContent = formattedTotal;
                document.getElementById('price-calculation-text').textContent = `Harga (${days} hari)`;
                document.getElementById('price-calculation-value').textContent = formattedTotal;
                
                // Update Date Summary
                if (!isNaN(start.getTime()) && !isNaN(end.getTime())) {
                    const options = { day: 'numeric', month: 'short', year: 'numeric' };
                    document.getElementById('date-summary').textContent = 
                        start.toLocaleDateString('id-ID', options) + ' - ' + end.toLocaleDateString('id-ID', options);
                }
            }
            
            startDateInput.addEventListener('change', calculateTotal);
            endDateInput.addEventListener('change', calculateTotal);
            
            // Initial calculation
            calculateTotal();
        });
    </script>
</body>
</html>
