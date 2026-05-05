<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil User - Adam Rental</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            background: #f5f7fb;
        }

        .navbar-brand {
            font-size: 1.5rem;
        }

        .profile-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            margin-top: 30px;
        }

        .profile-header {
            text-align: center;
            margin-bottom: 40px;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 30px;
        }

        .profile-avatar {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 40px;
            color: white;
        }

        .profile-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 30px;
        }

        .profile-info-item {
            padding: 20px;
            background: #f8f9fa;
            border-radius: 15px;
            border-left: 4px solid #667eea;
        }

        .profile-info-label {
            font-size: 0.9rem;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .profile-info-value {
            font-size: 1.1rem;
            color: #212529;
            font-weight: 600;
        }

        .btn-group-custom {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .btn-custom {
            padding: 12px 30px;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
            color: white;
            text-decoration: none;
        }

        .btn-secondary-custom {
            background: white;
            color: #667eea;
            border: 2px solid #667eea;
        }

        .btn-secondary-custom:hover {
            background: #667eea;
            color: white;
            text-decoration: none;
        }

        @media (max-width: 768px) {
            .profile-info {
                grid-template-columns: 1fr;
            }

            .profile-card {
                padding: 20px;
            }

            .btn-group-custom {
                flex-direction: column;
            }

            .btn-custom {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>

    <!-- NAVBAR -->
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
                        <a class="nav-link" href="<?php echo e(url('/customer')); ?>">
                            Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(url('/product')); ?>">
                            Product
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('payment.index')); ?>">
                            Pembayaran
                        </a>
                    </li>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(Auth::check()): ?>
                        <!-- LOGIN SEBAGAI USER -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#"
                                data-bs-toggle="dropdown">
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
                                <li>
                                    <a class="dropdown-item active fw-bold" href="<?php echo e(route('user.profile')); ?>">Profil</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="<?php echo e(route('user.rental-history')); ?>">Riwayat Sewa</a>
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
    </nav>

    <!-- Hero -->
    <div class="container mb-4">
        <div class="hero-section text-white text-center shadow-sm"
            style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.6)),
            url('https://images.unsplash.com/photo-1503376780353-7e6692767b70') center/cover;
            border-radius: 20px; padding: 60px 20px;">

            <h1 class="fw-bold">Profil Saya</h1>
            <p class="text-white-50">Kelola akun dan informasi pribadi kamu</p>
        </div>
    </div>

    <!-- CONTENT -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="profile-card">
        <div class="row align-items-start">

            <!-- FOTO -->
            <div class="col-md-4 text-center border-end">
                <div class="position-relative d-inline-block mb-3">
                    <img src="<?php echo e($user->photo ? asset('storage/'.$user->photo) : 'https://ui-avatars.com/api/?name='.$user->name); ?>"
                        class="rounded-circle shadow"
                        width="130" height="130"
                        style="object-fit: cover;">
                </div>

                <h5 class="fw-bold"><?php echo e($user->name); ?></h5>
                <p class="text-muted small"><?php echo e($user->email); ?></p>

                <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                    ✏️ Edit Profil
                </button>
            </div>

            <!-- modal edit profil -->
            <div class="modal fade" id="editProfileModal">
    <div class="modal-dialog">
        <form action="<?php echo e(route('user.update-profile')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>

            <div class="modal-content p-3">
                <h5>Edit Profil</h5>

                <input type="file" name="photo" class="form-control mb-2">

                <input type="text" name="name" value="<?php echo e($user->name); ?>"
                    class="form-control mb-2" placeholder="Nama">

                <textarea name="bio" class="form-control mb-2"
                        placeholder="Bio"><?php echo e($user->bio); ?></textarea>

                <button class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

            <!-- INFO -->
            <div class="col-md-8">
                <div class="row g-3">

                    <div class="col-md-6">
                        <div class="profile-info-item">
                            <div class="profile-info-label">Total Booking</div>
                            <div class="profile-info-value"><?php echo e($user->bookings->count()); ?></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="profile-info-item">
                            <div class="profile-info-label">Bergabung</div>
                            <div class="profile-info-value">
                                <?php echo e($user->created_at->format('d M Y')); ?>

                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="profile-info-item">
                            <div class="profile-info-label">Bio</div>
                            <div class="profile-info-value">
                                <?php echo e($user->bio ?? 'Belum ada bio'); ?>

                            </div>
                        </div>
                    </div>

                </div>

                <div class="mt-4">
                    <a href="<?php echo e(route('user.rental-history')); ?>" class="btn btn-primary">
                        Riwayat Sewa
                    </a>
                    </button>
                </div>
            </div>

        </div>
    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
<?php /**PATH C:\laragon2\www\pbl_3\resources\views/user/profile.blade.php ENDPATH**/ ?>