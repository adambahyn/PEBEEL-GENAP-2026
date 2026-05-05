<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - Adam Rental</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            background: #f5f7fb;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.6)), url('https://images.unsplash.com/photo-1503376780353-7e6692767b70') center/cover;
            border-radius: 22px;
            padding: 80px 20px;
            overflow: hidden;
        }

        /* Search Box */
        .search-box {
            background: white;
            padding: 15px 25px;
            border-radius: 18px;
            max-width: 900px;
        }
        .search-box input:focus, .search-box select:focus {
            box-shadow: none !important;
        }

        /* Cards */
        .page-card { border-radius: 22px; }
        .feature-card { border-radius: 18px; }
        
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

        /* Zoom Image Effect */
        .card-img-hover {
            overflow: hidden;
            border-radius: 18px 18px 0 0;
        }
        .card-img-hover img {
            height: 180px;
            width: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        .page-card:hover .card-img-hover img {
            transform: scale(1.1);
        }

        /* Animations */
        .rh-filter-btn { transition: all 0.2s ease; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

    <?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    


    <div class="container pb-5">

        
        <div class="hero-section text-white text-center mb-5 position-relative shadow-sm">
            <div class="position-relative z-1">
                <p class="text-info fw-semibold mb-2 text-uppercase" style="letter-spacing:2px; font-size:0.85rem;">✦ Platform Rental Terpercaya</p>
                <h1 class="display-4 fw-bold mb-3">Adam Rental</h1>
                <p class="mb-4 mx-auto text-white-50" style="max-width:520px; font-size:1.1rem;">
                    Rental Mobil Terpercaya se Kota Malang. Proses mudah, harga transparan, bebas ribet.
                </p>
            </div>
        </div>

        
        <div class="row g-3 mb-5">
            <div class="col-6 col-md-3">
                <div class="card feature-card shadow-sm border-0 h-100 text-center p-3">
                    <div class="fs-2 fw-bold text-primary mb-1"><?php echo e($carsCount); ?>+</div>
                    <div class="text-muted small fw-semibold section-label">Mobil Aktif</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card feature-card shadow-sm border-0 h-100 text-center p-3">
                    <div class="fs-2 fw-bold text-success mb-1">15+</div>
                    <div class="text-muted small fw-semibold section-label">Kota Tersedia</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card feature-card shadow-sm border-0 h-100 text-center p-3">
                    <div class="fs-2 fw-bold text-info mb-1">500+</div>
                    <div class="text-muted small fw-semibold section-label">Pelanggan Puas</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card feature-card shadow-sm border-0 h-100 text-center p-3">
                    <div class="fs-2 fw-bold text-warning mb-1">4.9 ⭐</div>
                    <div class="text-muted small fw-semibold section-label">Rating Rata-rata</div>
                </div>
            </div>
        </div>

        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <p class="section-label mb-1">Tersedia</p>
                <h4 class="fw-bold mb-0">Rekomendasi Mobil</h4>
            </div>
            <a href="/product" class="btn btn-outline-primary btn-sm rounded-pill fw-semibold px-3">
                Lihat Semua <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        <div class="d-flex flex-wrap gap-2 mb-4">
            <button class="btn btn-sm btn-dark rh-filter-btn fw-semibold" data-filter="all">All</button>
            <button class="btn btn-sm btn-outline-dark rh-filter-btn fw-semibold" data-filter="SUV">SUV</button>
            <button class="btn btn-sm btn-outline-dark rh-filter-btn fw-semibold" data-filter="MPV">MPV</button>
            <button class="btn btn-sm btn-outline-dark rh-filter-btn fw-semibold" data-filter="Sedan">Sedan</button>
        </div>

        <div class="row g-4 mb-5" id="car-grid">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $cars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $car): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
            <div class="col-sm-6 col-lg-3 car-item" data-type="<?php echo e($car->type); ?>">
                <div class="card shadow-sm border-0 h-100 page-card overflow-hidden">
                    <div class="card-img-hover position-relative">
                        <a href="/product/<?php echo e($car->id); ?>">
                            <img src="<?php echo e($car->image ? asset('storage/' . $car->image) : 'https://images.unsplash.com/photo-1550355291-bbee04a92027?q=80&w=800&auto=format&fit=crop'); ?>" alt="<?php echo e($car->name ?? $car->brand); ?>" class="card-img-top">
                        </a>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($car->type): ?>
                        <span class="badge bg-dark text-white position-absolute shadow-sm" style="top:12px; right:12px; font-weight:500;">
                            <?php echo e($car->type); ?>

                        </span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                    
                    <div class="card-body d-flex flex-column">
                        <h6 class="fw-bold mb-1 text-truncate"><?php echo e($car->name ?? $car->brand . ' ' . $car->model); ?></h6>
                        <small class="text-muted d-block mb-3">
                            <?php echo e($car->type ?? 'Unit'); ?> • <?php echo e($car->location ?? 'Malang'); ?>

                        </small>

                        <div class="mt-auto">
                            <div class="d-flex align-items-center gap-1 mb-3">
                                <strong class="fs-6 mb-0 price-value">
                                    Rp <?php echo e(number_format($car->price, 0, ',', '.')); ?>

                                </strong>
                                <small class="text-muted mb-0">/ hari</small>
                            </div>
                            
                            <div class="d-grid">
                                <a href="<?php echo e(route('payment.index')); ?>" class="btn btn-primary btn-sm fw-semibold rounded-3">
                                    Booking Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            <div class="col-12 text-center py-5">
                <i class="bi bi-car-front text-muted" style="font-size:4rem;"></i>
                <p class="mt-3 fw-semibold text-muted">Belum ada mobil yang tersedia.</p>
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        
        <div class="row g-4 mb-5">
            <div class="col-lg-7">
                <div class="card page-card shadow-sm border-0 p-4 h-100">
                    <p class="section-label mb-1">Panduan Booking</p>
                    <h4 class="fw-bold mb-4">Cara Booking di Adam Rental</h4>
                    
                    <div class="list-group list-group-flush">
                        <div class="list-group-item px-0 py-3 border-0 d-flex align-items-start gap-3">
                            <span class="badge bg-primary rounded-circle p-2">1</span>
                            <div>
                                <div class="fw-semibold">Pilih Mobil</div>
                                <small class="text-muted">Temukan mobil yang sesuai kebutuhan. Filter berdasarkan tipe, lokasi, dan harga.</small>
                            </div>
                        </div>
                        <div class="list-group-item px-0 py-3 border-0 d-flex align-items-start gap-3">
                            <span class="badge bg-primary rounded-circle p-2">2</span>
                            <div>
                                <div class="fw-semibold">Isi Data Booking</div>
                                <small class="text-muted">Lengkapi form pembayaran, pilih tanggal sewa, dan metode pembayaran favoritmu.</small>
                            </div>
                        </div>
                        <div class="list-group-item px-0 py-3 border-0 d-flex align-items-start gap-3">
                            <span class="badge bg-primary rounded-circle p-2">3</span>
                            <div>
                                <div class="fw-semibold">Nikmati Perjalanan</div>
                                <small class="text-muted">Mobil siap digunakan. Perjalanan nyaman dan aman menanti!</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-5">
                <div class="card feature-card shadow-sm border-0 p-4 h-100">
                    <p class="section-label mb-1">Keunggulan</p>
                    <h4 class="fw-bold mb-4">Mengapa Memilih Kami?</h4>
                    <div class="d-flex flex-column gap-4 mt-2">
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">🛡️</div>
                            <div>
                                <h6 class="fw-bold mb-0">Terpercaya & Aman</h6>
                                <small class="text-muted">Host terverifikasi, mobil prima.</small>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-success bg-opacity-10 text-success p-3 rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">💰</div>
                            <div>
                                <h6 class="fw-bold mb-0">Harga Transparan</h6>
                                <small class="text-muted">Tanpa biaya tersembunyi.</small>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-info bg-opacity-10 text-info p-3 rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">📞</div>
                            <div>
                                <h6 class="fw-bold mb-0">Support 24/7</h6>
                                <small class="text-muted">Tim siap sedia membantu.</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="card page-card bg-primary text-white text-center p-5 mb-2 border-0 shadow-sm" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">
            <h3 class="fw-bold mb-2">Siap Memulai Perjalananmu?</h3>
            <p class="mb-4 text-white-50">Ribuan pelanggan sudah merasakan kemudahannya. Giliran kamu!</p>
            <a href="/product" class="btn btn-light text-primary btn-lg rounded-pill px-5 fw-bold shadow-sm d-inline-block mx-auto">
                Cari Mobil
            </a>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
    document.querySelectorAll('.rh-filter-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.rh-filter-btn').forEach(function(b) {
                b.classList.remove('btn-dark');
                b.classList.add('btn-outline-dark');
            });

            this.classList.remove('btn-outline-dark');
            this.classList.add('btn-dark');

            var filter = this.dataset.filter;

            document.querySelectorAll('.car-item').forEach(function(item) {
                if (filter === 'all' || item.dataset.type === filter) {
                    item.style.display = '';
                    item.style.animation = 'fadeIn 0.4s ease forwards';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
    </script>
</body>
</html><?php /**PATH C:\laragon\www\PEBEEL-GENAP-2026\resources\views/home/index.blade.php ENDPATH**/ ?>