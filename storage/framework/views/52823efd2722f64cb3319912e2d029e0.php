<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>

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
<div class="container mt-5 pt-4">
    <h3 class="mb-4">Hasil Pencarian untuk: <strong>"<?php echo e($keyword); ?>"</strong></h3>

    <div class="row">
        
        <div class="col-md-12 mb-4">
            <h5>🚗 Mobil Terkait</h5>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($cars->count() > 0): ?>
                <div class="list-group">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $cars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $car): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <a href="<?php echo e(url('/cars/'.$car->id)); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1 fw-bold"><?php echo e($car->brand); ?> <?php echo e($car->model); ?></h6>
                                
                                <small class="text-muted">
                                    ⚙️ <?php echo e($car->transmission); ?> | 👥 <?php echo e($car->capacity); ?> Penumpang | ⛽ <?php echo e($car->fuel_type); ?>

                                </small><br>
                                
                                <small class="text-muted"><?php echo e(Str::limit($car->description, 100)); ?></small><br>
                                
                                <span class="text-success fw-bold">Rp <?php echo e(number_format($car->price, 0, ',', '.')); ?> / hari</span>
                            </div>
                            <span class="badge bg-primary rounded-pill">Lihat Detail</span>
                        </a>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>
            <?php else: ?>
                <div class="alert alert-light border text-muted">Tidak ada mobil yang cocok dengan pencarianmu.</div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <div class="col-md-12 mb-4">
            <h5>📦 Produk Terkait</h5>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($products->count() > 0): ?>
                <div class="list-group">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <a href="<?php echo e(url('/product/'.$product->id)); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1 fw-bold">
                                    <?php echo e($product->name); ?> 
                                    <span class="badge bg-secondary ms-2 text-xs">SKU: <?php echo e($product->sku); ?></span>
                                </h6>
                                
                                <small class="text-muted">
                                    🏷️ <?php echo e($product->type); ?> | 📍 <?php echo e($product->location); ?>

                                </small><br>

                                <small class="text-muted"><?php echo e(Str::limit($product->description, 100)); ?></small><br>
                                
                                <span class="text-success fw-bold">Rp <?php echo e(number_format($product->price, 0, ',', '.')); ?></span>
                            </div>
                            <span class="badge bg-primary rounded-pill">Lihat Detail</span>
                        </a>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>
            <?php else: ?>
                <div class="alert alert-light border text-muted">Tidak ada produk yang cocok dengan pencarianmu.</div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($helpTopics) > 0): ?>
            <div class="col-md-12 mb-4">
                <h5>💡 Bantuan / Info Halaman</h5>
                <div class="alert alert-info">
                    <ul class="mb-0">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $helpTopics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $help): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                            <li><?php echo e($help); ?></li>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </ul>
                </div>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($cars->isEmpty() && $products->isEmpty() && empty($helpTopics)): ?>
            <div class="col-md-12 text-center mt-5 mb-5">
                <h1 class="display-1 text-muted">🧐</h1>
                <h4 class="text-muted mt-3">Yah, pencarianmu tidak membuahkan hasil.</h4>
                <p>Coba gunakan kata kunci lain seperti nama brand (misal: Toyota), tipe bensin, atau nama produk.</p>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
<?php /**PATH C:\Kuliah\Tingkat 2\PBL\PEBEEL-GENAP-2026\resources\views/search/results.blade.php ENDPATH**/ ?>