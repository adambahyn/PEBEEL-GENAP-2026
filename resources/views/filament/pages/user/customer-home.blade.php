<x-filament-panels::page>
<div class="rh-wrap">

    {{-- ===== HERO ===== --}}
    <div class="rh-hero text-white text-center mb-5">
        <p class="text-warning fw-semibold mb-2 text-uppercase" style="letter-spacing:3px; font-size:0.8rem;">✦ Platform Rental Terpercaya</p>
        <h1 style="font-size:clamp(2rem,5vw,3.5rem); font-weight:800; line-height:1.15;" class="mb-3">
            Temukan & Sewa Mobil<br>
            <span style="color:#ffc107;">Impianmu Hari Ini.</span>
        </h1>
        <p class="mb-4 mx-auto text-white-50" style="max-width:520px; font-size:1.05rem;">
            Mobil pilihan dari host lokal terpercaya. Proses mudah, harga transparan, bebas ribet.
        </p>

        {{-- Search Box --}}
        <div class="rh-search-box d-flex flex-wrap align-items-center gap-2">
            <div class="flex-grow-1 px-2">
                <label class="text-muted d-block" style="font-size:0.7rem; font-weight:700; text-transform:uppercase; letter-spacing:1px;">📍 Lokasi</label>
                <input type="text" class="form-control" placeholder="Kota, bandara, atau alamat" style="min-width:140px;">
            </div>
            <div class="border-start px-3">
                <label class="text-muted d-block" style="font-size:0.7rem; font-weight:700; text-transform:uppercase; letter-spacing:1px;">🚗 Tipe</label>
                <select class="form-select" style="min-width:110px;">
                    <option value="">Semua</option>
                    <option value="SUV">SUV</option>
                    <option value="MPV">MPV</option>
                    <option value="Sedan">Sedan</option>
                </select>
            </div>
            <div class="border-start px-3">
                <label class="text-muted d-block" style="font-size:0.7rem; font-weight:700; text-transform:uppercase; letter-spacing:1px;">📅 Dari</label>
                <input type="date" class="form-control" style="min-width:130px;">
            </div>
            <div class="border-start px-3">
                <label class="text-muted d-block" style="font-size:0.7rem; font-weight:700; text-transform:uppercase; letter-spacing:1px;">📅 Sampai</label>
                <input type="date" class="form-control" style="min-width:130px;">
            </div>
            <a href="/product" class="btn btn-warning fw-bold rounded-pill px-4 py-2 flex-shrink-0" style="white-space:nowrap;">
                <i class="bi bi-search me-1"></i> Cari Mobil
            </a>
        </div>
    </div>

    {{-- ===== STATS ===== --}}
    <div class="row g-3 mb-5">
        <div class="col-6 col-md-3">
            <div class="rh-stat-card bg-warning bg-opacity-10 border border-warning border-opacity-25">
                <div class="fs-1 fw-black text-warning mb-1">{{ $cars->count() }}+</div>
                <div class="text-muted small fw-semibold">🚗 Mobil Aktif</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="rh-stat-card bg-success bg-opacity-10 border border-success border-opacity-25">
                <div class="fs-1 fw-black text-success mb-1">15+</div>
                <div class="text-muted small fw-semibold">📍 Kota Tersedia</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="rh-stat-card bg-info bg-opacity-10 border border-info border-opacity-25">
                <div class="fs-1 fw-black text-info mb-1">500+</div>
                <div class="text-muted small fw-semibold">😊 Pelanggan Puas</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="rh-stat-card bg-danger bg-opacity-10 border border-danger border-opacity-25">
                <div class="fs-1 fw-black text-danger mb-1">4.9 ⭐</div>
                <div class="text-muted small fw-semibold">🏆 Rating Rata-rata</div>
            </div>
        </div>
    </div>

    {{-- ===== DAFTAR MOBIL ===== --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="fw-bold mb-0">Rekomendasi Mobil</h4>
            <p class="text-muted small mb-0">Pilihan terbaik untuk perjalananmu</p>
        </div>
        <a href="/product" class="btn btn-outline-warning btn-sm rounded-pill fw-semibold">
            Lihat Semua <i class="bi bi-arrow-right"></i>
        </a>
    </div>

    {{-- Filter Tipe --}}
    <div class="d-flex flex-wrap gap-2 mb-4">
        <button class="btn btn-sm rounded-pill rh-filter-btn active fw-semibold" data-filter="all"
                style="border:2px solid #ffc107; padding:6px 18px;">
            <i class="bi bi-grid me-1"></i> Semua
        </button>
        <button class="btn btn-sm btn-outline-secondary rounded-pill rh-filter-btn fw-semibold" data-filter="SUV"
                style="border:2px solid #dee2e6; padding:6px 18px;">
            <i class="bi bi-truck me-1"></i> SUV
        </button>
        <button class="btn btn-sm btn-outline-secondary rounded-pill rh-filter-btn fw-semibold" data-filter="MPV"
                style="border:2px solid #dee2e6; padding:6px 18px;">
            <i class="bi bi-car-front me-1"></i> MPV
        </button>
        <button class="btn btn-sm btn-outline-secondary rounded-pill rh-filter-btn fw-semibold" data-filter="Sedan"
                style="border:2px solid #dee2e6; padding:6px 18px;">
            <i class="bi bi-car-front-fill me-1"></i> Sedan
        </button>
    </div>

    {{-- Grid Mobil --}}
    <div class="row g-4 mb-5" id="car-grid">
        @forelse ($cars as $car)
        <div class="col-sm-6 col-lg-3 car-item" data-type="{{ $car->type }}">
            <div class="card rh-car-card shadow-sm h-100 border-0">
                <div class="rh-car-img-wrap">
                    <img
                        src="{{ $car->image ? asset('storage/' . $car->image) : 'https://images.unsplash.com/photo-1550355291-bbee04a92027?q=80&w=800&auto=format&fit=crop' }}"
                        alt="{{ $car->name }}"
                        class="rh-car-img"
                    >
                    {{-- Badge Type --}}
                    @if ($car->type)
                    <span class="badge bg-warning text-dark position-absolute fw-bold"
                          style="top:12px; right:12px; font-size:0.7rem; padding:5px 10px; border-radius:20px;">
                        {{ $car->type }}
                    </span>
                    @endif
                    {{-- Rating Badge --}}
                    <span class="badge bg-white text-dark position-absolute shadow-sm"
                          style="top:12px; left:12px; font-size:0.7rem; padding:5px 10px; border-radius:20px;">
                        ⭐ 4.9
                    </span>
                    {{-- Stok habis overlay --}}
                    @if ($car->stock <= 0)
                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center"
                         style="background:rgba(0,0,0,0.5); border-radius:0;">
                        <span class="badge bg-danger fs-6">Stok Habis</span>
                    </div>
                    @endif
                </div>
                <div class="card-body d-flex flex-column p-3">
                    <h6 class="fw-bold mb-1 text-truncate" title="{{ $car->name }}">{{ $car->name }}</h6>
                    <p class="text-muted small mb-1">
                        <i class="bi bi-geo-alt me-1"></i>{{ $car->location ?? 'Tersedia di kota Anda' }}
                    </p>
                    <p class="mb-2">
                        @if ($car->stock > 5)
                            <span class="badge bg-success-subtle text-success border border-success-subtle" style="font-size:0.7rem;">
                                <i class="bi bi-check-circle me-1"></i>Tersedia ({{ $car->stock }} unit)
                            </span>
                        @elseif ($car->stock > 0)
                            <span class="badge bg-warning-subtle text-warning border border-warning-subtle" style="font-size:0.7rem;">
                                <i class="bi bi-exclamation-circle me-1"></i>Stok Terbatas ({{ $car->stock }})
                            </span>
                        @else
                            <span class="badge bg-danger-subtle text-danger border border-danger-subtle" style="font-size:0.7rem;">
                                <i class="bi bi-x-circle me-1"></i>Habis
                            </span>
                        @endif
                    </p>
                    <div class="mt-auto d-flex justify-content-between align-items-center pt-2 border-top">
                        <div>
                            <span class="fw-bold text-warning" style="font-size:1.05rem;">
                                Rp {{ number_format($car->price, 0, ',', '.') }}
                            </span>
                            <span class="text-muted" style="font-size:0.75rem;">/hari</span>
                        </div>
                        @if ($car->stock > 0)
                        <a href="/payment" class="btn btn-warning btn-sm rounded-pill fw-bold px-3"
                           style="font-size:0.78rem;">
                            Booking
                        </a>
                        @else
                        <button class="btn btn-outline-secondary btn-sm rounded-pill" disabled style="font-size:0.78rem;">
                            Tidak Tersedia
                        </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <i class="bi bi-car-front" style="font-size:4rem; color:#dee2e6;"></i>
            <p class="mt-3 fw-semibold text-muted">Belum ada mobil yang tersedia.</p>
            <p class="text-muted small">Cek kembali nanti ya!</p>
        </div>
        @endforelse
    </div>

    {{-- ===== CARA BOOKING ===== --}}
    <div class="bg-light rounded-4 p-5 mb-5">
        <div class="text-center mb-4">
            <h4 class="fw-bold mb-1">Cara Booking di Adam Rental</h4>
            <p class="text-muted">Mudah, cepat, dan transparan</p>
        </div>
        <div class="row g-4 text-center">
            <div class="col-md-4">
                <div class="rh-step-icon">🔍</div>
                <h6 class="fw-bold">1. Pilih Mobil</h6>
                <p class="text-muted small mb-0">
                    Temukan mobil yang sesuai kebutuhan. Filter berdasarkan tipe, lokasi, dan harga.
                </p>
            </div>
            <div class="col-md-4 position-relative">
                <div class="rh-step-icon">📋</div>
                <h6 class="fw-bold">2. Isi Data Booking</h6>
                <p class="text-muted small mb-0">
                    Lengkapi data diri, pilih tanggal sewa, dan metode pembayaran favoritmu.
                </p>
            </div>
            <div class="col-md-4">
                <div class="rh-step-icon">🚗</div>
                <h6 class="fw-bold">3. Nikmati Perjalanan</h6>
                <p class="text-muted small mb-0">
                    Mobil siap diantar ke lokasi Anda. Perjalanan nyaman menanti!
                </p>
            </div>
        </div>
    </div>

    {{-- ===== KEUNGGULAN ===== --}}
    <div class="mb-5">
        <div class="text-center mb-4">
            <h4 class="fw-bold mb-1">Mengapa Memilih Adam Rental?</h4>
            <p class="text-muted">Kami berkomitmen memberikan pengalaman terbaik</p>
        </div>
        <div class="row g-3">
            <div class="col-md-6 col-lg-3">
                <div class="d-flex align-items-start gap-3 p-3 bg-white rounded-3 shadow-sm h-100">
                    <span style="font-size:2rem;">🛡️</span>
                    <div>
                        <h6 class="fw-bold mb-1">Terpercaya & Aman</h6>
                        <p class="text-muted small mb-0">Semua host telah terverifikasi dan mobil dalam kondisi prima.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="d-flex align-items-start gap-3 p-3 bg-white rounded-3 shadow-sm h-100">
                    <span style="font-size:2rem;">💰</span>
                    <div>
                        <h6 class="fw-bold mb-1">Harga Transparan</h6>
                        <p class="text-muted small mb-0">Tidak ada biaya tersembunyi. Bayar sesuai yang tertera.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="d-flex align-items-start gap-3 p-3 bg-white rounded-3 shadow-sm h-100">
                    <span style="font-size:2rem;">📞</span>
                    <div>
                        <h6 class="fw-bold mb-1">Support 24/7</h6>
                        <p class="text-muted small mb-0">Tim kami siap membantu kapan pun Anda membutuhkan.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="d-flex align-items-start gap-3 p-3 bg-white rounded-3 shadow-sm h-100">
                    <span style="font-size:2rem;">🗺️</span>
                    <div>
                        <h6 class="fw-bold mb-1">Antar Jemput</h6>
                        <p class="text-muted small mb-0">Layanan antar jemput ke lokasi pilihan Anda.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== CTA ===== --}}
    <div class="rh-cta mb-2">
        <h4 class="fw-black mb-2" style="font-size:1.8rem;">Siap Memulai Perjalananmu?</h4>
        <p class="mb-4 opacity-75">Ribuan pelanggan sudah merasakan kemudahannya. Giliran kamu!</p>
        <div class="d-flex gap-3 justify-content-center flex-wrap">
            <a href="/product" class="btn btn-dark btn-lg rounded-pill px-5 fw-bold">
                <i class="bi bi-search me-2"></i>Cari Mobil
            </a>
            <a href="/customer/register" class="btn btn-outline-dark btn-lg rounded-pill px-5 fw-bold">
                <i class="bi bi-person-plus me-2"></i>Daftar Gratis
            </a>
        </div>
    </div>

</div>

<script>
// Filter berdasarkan tipe mobil
document.querySelectorAll('.rh-filter-btn').forEach(function(btn) {
    btn.addEventListener('click', function() {
        // Reset semua tombol
        document.querySelectorAll('.rh-filter-btn').forEach(function(b) {
            b.classList.remove('active');
            b.style.borderColor = '#dee2e6';
            b.style.background  = '';
            b.style.color       = '';
        });

        // Aktifkan tombol yang diklik
        this.classList.add('active');
        this.style.borderColor = '#ffc107';
        this.style.background  = '#ffc107';
        this.style.color       = '#000';

        var filter = this.dataset.filter;

        // Tampilkan/sembunyikan kartu
        document.querySelectorAll('.car-item').forEach(function(item) {
            if (filter === 'all' || item.dataset.type === filter) {
                item.style.display = '';
                item.style.animation = 'fadeIn 0.3s ease';
            } else {
                item.style.display = 'none';
            }
        });
    });
});
</script>

<style>
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(8px); }
    to   { opacity: 1; transform: translateY(0); }
}
</style>
</x-filament-panels::page>
