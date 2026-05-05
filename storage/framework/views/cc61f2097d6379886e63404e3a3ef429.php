<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detail Mobil</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .car-img {
            height: 350px;
            object-fit: cover;
            border-radius: 10px;
        }
        .info-label {
            font-weight: 600;
            color: #6c757d;
        }
        .price {
            font-size: 24px;
            font-weight: bold;
            color: #0d6efd;
        }
    </style>
</head>
<body class="bg-light">

<div class="container py-5">

    <!-- tombol kembali -->
    <a href="/product" class="btn btn-outline-secondary mb-4">
        ← Kembali
    </a>

    <div class="card shadow-lg border-0">
        <div class="row g-0">

            <!-- GAMBAR -->
            <div class="col-md-6 p-3">
                <img src="<?php echo e(asset('storage/' . $car->image)); ?>"
                    class="w-100 car-img">
            </div>

            <!-- DETAIL -->
            <div class="col-md-6 p-4">

                <h2 class="fw-bold">
                    <?php echo e($car->brand); ?> <?php echo e($car->model); ?>

                </h2>

                <div class="price mb-3">
                    Rp <?php echo e(number_format($car->price)); ?> / hari
                </div>

                <hr>

                <!-- INFO UTAMA -->
                <div class="row mb-3">
                    <div class="col-6">
                        <div class="info-label">Kapasitas</div>
                        <div><?php echo e($car->capacity); ?> Orang</div>
                    </div>

                    <div class="col-6">
                        <div class="info-label">Transmisi</div>
                        <div><?php echo e($car->transmission); ?></div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-6">
                        <div class="info-label">Bahan Bakar</div>
                        <div><?php echo e($car->fuel_type); ?></div>
                    </div>

                    <div class="col-6">
                        <div class="info-label">Stok</div>
                        <div><?php echo e($car->stock); ?></div>
                    </div>
                </div>

                <hr>

                <!-- DESKRIPSI -->
                <h5>Deskripsi</h5>
                <p><?php echo e($car->description); ?></p>

                <hr>

                <!-- INFO PENYEDIA -->
                <h5>Info Penyedia</h5>
                <div class="row">
                    <div class="col-6">
                        <div class="info-label">Nama</div>
                        <div><?php echo e($car->provider_name); ?></div>
                    </div>

                    <div class="col-6">
                        <div class="info-label">Kontak</div>
                        <div><?php echo e($car->provider_contact); ?></div>
                    </div>
                </div>

                <!-- BUTTON -->
                <div class="mt-4">
                    <a href="<?php echo e(route('payment.index')); ?>" class="btn btn-primary w-100">
                        Booking Sekarang
                    </a>
                </div>

            </div>

        </div>
    </div>

</div>

</body>
</html><?php /**PATH C:\Kuliah\Tingkat 2\PBL\PEBEEL-GENAP-2026\resources\views/cars/show.blade.php ENDPATH**/ ?>