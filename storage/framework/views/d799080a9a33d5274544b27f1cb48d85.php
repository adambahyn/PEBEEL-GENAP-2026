<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold" href="<?php echo e(url('/customer')); ?>">
            Adam Rental
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <form action="<?php echo e(url('/search')); ?>" method="GET" class="d-flex">
            <input class="form-control me-2" type="search" name="q"
                placeholder="Cari mobil, spesifikasi, atau bantuan..." aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Cari</button>
        </form>
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
                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!Auth::check()): ?>
                    <!-- BELUM LOGIN -->
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->is('login') ? 'active fw-bold' : ''); ?> btn btn-primary text-white px-3"
                            href="<?php echo e(route('login')); ?>">
                            Login
                        </a>
                    </li>
                <?php elseif(Auth::user()->role === 'user'): ?>
                    <!-- LOGIN SEBAGAI USER -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" data-bs-toggle="dropdown">

                            <i class="bi bi-person-circle fs-4"></i>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end">

                            <!-- NAMA USER -->
                            <li class="dropdown-item-text fw-semibold">
                                👤 <?php echo e(Auth::user()->name); ?>

                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <!-- MENU TAMBAHAN -->
                            <li>
                                <a class="dropdown-item" href="#">Profil</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">Riwayat Sewa</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <!-- LOGOUT -->
                            <li>
                                <form method="POST" action="<?php echo e(route('logout')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <button class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </ul>
        </div>
    </div>
</nav><?php /**PATH C:\Kuliah\Tingkat 2\PBL\PEBEEL-GENAP-2026\resources\views/layouts/navbar.blade.php ENDPATH**/ ?>