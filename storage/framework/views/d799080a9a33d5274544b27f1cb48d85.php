<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold" href="<?php echo e(url('/customer')); ?>">
            Adam Rental
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav gap-2">
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->is('customer') ? 'active fw-bold' : ''); ?>"
                        href="<?php echo e(url('/customer')); ?>">
                        Beranda
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->is('product*') ? 'active fw-bold' : ''); ?>"
                        href="<?php echo e(url('/product')); ?>">
                        Product
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->routeIs('payment.*') ? 'active fw-bold' : ''); ?>"
                        href="<?php echo e(route('payment.index')); ?>">
                        Pembayaran
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav><?php /**PATH C:\Kuliah\Tingkat 2\PBL\PEBEEL-GENAP-2026\resources\views/layouts/navbar.blade.php ENDPATH**/ ?>