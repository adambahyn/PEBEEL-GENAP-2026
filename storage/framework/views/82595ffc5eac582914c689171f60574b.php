<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Rental Mobil</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        .hero {
            background: url('https://images.unsplash.com/photo-1503376780353-7e6692767b70') center/cover;
            height: 300px;
            border-radius: 15px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            text-align: center;
        }

        .search-box {
            background: white;
            padding: 15px;
            border-radius: 12px;
            margin-top: 20px;
            display: flex;
            gap: 10px;
        }

        .card img {
            height: 180px;
            object-fit: cover;
        }

        .badge-save {
            background: #d4f5e9;
            color: green;
        }

        .card-img-hover {
            overflow: hidden;
            border-radius: 8px;
        }

        .card-img-hover img {
            transition: transform 0.3s ease;
        }

        .card-img-hover:hover img {
            transform: scale(1.1);
        }
    </style>
    <!-- NAVBAR -->
    <?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    
</head>

<body class="bg-light">

    <div class="container py-4">

        <!-- ALERT ERROR -->
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any() || session('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>⚠️ Perhatian!</strong>
                <?php echo e(session('error') ?? $errors->first()); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <!-- HERO -->
        <div class="hero mb-4">
            <h1 class="fw-bold">Adam Rental</h1>
            <p>Rental Mobil Terpercaya se Kota Malang dan Surabaya</p>

            <!-- SEARCH -->
            <form method="GET" class="search-box w-75">
                <input type="text" name="location" class="form-control" placeholder="Lokasi"
                    value="<?php echo e(request('location')); ?>">
                <input type="number" name="min_price" class="form-control" placeholder="Min Harga">
                <input type="number" name="max_price" class="form-control" placeholder="Max Harga">

                <select name="sort" class="form-select">
                    <option value="">Sort</option>
                    <option value="cheapest">Termurah</option>
                    <option value="expensive">Termahal</option>
                </select>

                <button class="btn btn-primary">🔍</button>
            </form>
        </div>

        <!-- FILTER CATEGORY -->
        <div class="mb-4 d-flex gap-2">

            <a href="/product" class="btn btn-sm <?php echo e(request('type') ? 'btn-outline-dark' : 'btn-dark'); ?>">
                All
            </a>

            <a href="?type=SUV" class="btn btn-sm <?php echo e(request('type') == 'SUV' ? 'btn-dark' : 'btn-outline-dark'); ?>">
                SUV
            </a>

            <a href="?type=MPV" class="btn btn-sm <?php echo e(request('type') == 'MPV' ? 'btn-dark' : 'btn-outline-dark'); ?>">
                MPV
            </a>

            <a href="?type=Sedan"
                class="btn btn-sm <?php echo e(request('type') == 'Sedan' ? 'btn-dark' : 'btn-outline-dark'); ?>">
                Sedan
            </a>

        </div>

        <!--  LIST MOBIL -->
        <div class="row g-4">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                <div class="col-md-3">
                    <div class="card shadow-sm border-0">

                        <div class="card-img-hover">
                            <a href="http://127.0.0.1:8000/detail">
                                <img src="<?php echo e(asset('storage/' . $product->image)); ?>" class="card-img-top">
                            <a href="<?php echo e($product->car_id && $product->car ? route('cars.user-show', $product->id) : '#'); ?>"
                                <?php if(!($product->car_id && $product->car)): ?> onclick="alert('Maaf, detail mobil belum tersedia. Hubungi admin untuk informasi lebih lanjut'); return false;"
           style="cursor: not-allowed;" <?php endif; ?>>
                                <img src="<?php echo e(asset('storage/' . $product->image)); ?>" class="card-img-top"
                                    <?php if(!($product->car_id && $product->car)): ?>  <?php endif; ?>>
                            </a>
                        </div>

                        <div class="card-body">

                            <h6 class="fw-bold"><?php echo e($product->name); ?></h6>

                            <small class="text-muted">
                                <?php echo e($product->type); ?> <?php echo e($product->location); ?>

                            </small>

                            <div class="mt-2">

                                <div class="d-flex align-items-center gap-1">
                                    <strong class="fs-6 mb-0">
                                        Rp <?php echo e(number_format($product->price)); ?>

                                    </strong>
                                    <small class="text-muted mb-0">/ hari</small>
                                </div>

                            </div>


                            <!-- BUTTON BOOKING -->
                            <div class="d-grid mt-3">
                                <a href="<?php echo e(route('payment.index')); ?>" class="btn btn-primary btn-sm">
                                    Booking Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                <p>Tidak ada mobil ditemukan.</p>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <!-- PAGINATION -->
        <div class="mt-4">
            <?php echo e($products->withQueryString()->links()); ?>

        </div>

    </div>
    <!-- Bootstrap JS (WAJIB untuk dropdown) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php /**PATH C:\Kuliah\Tingkat 2\PBL\PEBEEL-GENAP-2026\resources\views/product/index.blade.php ENDPATH**/ ?>