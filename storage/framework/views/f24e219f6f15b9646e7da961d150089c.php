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
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="<?php echo e(route('product.index')); ?>">Adam Rental</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav gap-2">
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->is('product') ? 'active fw-bold' : ''); ?>" href="<?php echo e(route('product.index')); ?>">Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active fw-bold" href="<?php echo e(route('payment.index')); ?>">Pembayaran</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

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

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
                        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <li><?php echo e($error); ?></li>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </ul>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <form action="<?php echo e(route('payment.store')); ?>" method="POST" id="payment-form">
                        <?php echo csrf_field(); ?>

                        <div class="mb-4">
                            <label for="car_id" class="form-label">Pilih Mobil</label>
                            <select class="form-select form-select-lg" id="car_id" name="car_id" required>
                                <option value="">-- Pilih mobil --</option>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $cars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $car): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <option value="<?php echo e($car->id); ?>" data-price="<?php echo e($car->price); ?>" data-name="<?php echo e($car->brand); ?> <?php echo e($car->model); ?>"
                                        <?php echo e(old('car_id') == $car->id ? 'selected' : ''); ?>>
                                        <?php echo e($car->brand); ?> <?php echo e($car->model); ?> — Rp <?php echo e(number_format($car->price, 0, ',', '.')); ?> /hari
                                    </option>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="customer_name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control form-control-lg" id="customer_name" name="customer_name" value="<?php echo e(old('customer_name')); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="customer_contact" class="form-label">Nomor WA / Kontak</label>
                            <input type="text" class="form-control form-control-lg" id="customer_contact" name="customer_contact" value="<?php echo e(old('customer_contact')); ?>" required>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="start_date" class="form-label">Tanggal Mulai</label>
                                <input type="date" class="form-control" id="start_date" name="start_date" value="<?php echo e(old('start_date', now()->format('Y-m-d'))); ?>" min="<?php echo e(now()->format('Y-m-d')); ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="duration" class="form-label">Durasi (hari)</label>
                                <input type="number" class="form-control" id="duration" name="duration" value="<?php echo e(old('duration', 1)); ?>" min="1" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="payment_method" class="form-label">Metode Pembayaran</label>
                            <select class="form-select" id="payment_method" name="payment_method" required>
                                <option value="">-- Pilih metode --</option>
                                <option value="transfer" <?php echo e(old('payment_method') == 'transfer' ? 'selected' : ''); ?>>Transfer Bank</option>
                                <option value="e_wallet" <?php echo e(old('payment_method') == 'e_wallet' ? 'selected' : ''); ?>>E-Wallet (GoPay, OVO, Dana)</option>
                                <option value="cash" <?php echo e(old('payment_method') == 'cash' ? 'selected' : ''); ?>>Tunai</option>
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
                            <span class="badge bg-success bg-opacity-10 text-success"><?php echo e($cars->count()); ?> unit</span>
                        </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($cars->isEmpty()): ?>
                            <div class="alert alert-secondary mb-0">Belum ada mobil tersedia. Cek kembali nanti.</div>
                        <?php else: ?>
                            <div class="list-group list-group-flush">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $cars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $car): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <div class="list-group-item px-0 py-3 border-0">
                                        <div class="d-flex justify-content-between align-items-start gap-3">
                                            <div>
                                                <div class="fw-semibold"><?php echo e($car->brand); ?> <?php echo e($car->model); ?></div>
                                                <div class="text-muted small"><?php echo e($car->capacity); ?> penumpang • <?php echo e($car->transmission); ?></div>
                                            </div>
                                            <div class="text-end">
                                                <div class="price-value">Rp <?php echo e(number_format($car->price, 0, ',', '.')); ?></div>
                                                <small class="badge bg-success bg-opacity-10 text-success">Stock <?php echo e($car->stock ?? '-'); ?></small>
                                            </div>
                                        </div>
                                    </div>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
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
<?php /**PATH C:\laragon\www\PEBEEL-GENAP-2026\resources\views/payment/index.blade.php ENDPATH**/ ?>