<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - Adam Rental</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- NAVBAR SEDERHANA -->
<nav class="navbar navbar-light bg-white shadow-sm mb-5">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/customer">Adam Rental</a>
    </div>
</nav>

<!-- CONTENT -->
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-5">
            <div class="card border-0 shadow-sm rounded-4 p-4">

                <h4 class="fw-bold text-center mb-3">Register</h4>
                <p class="text-muted text-center mb-4">Buat akun baru</p>

                <form method="POST" action="<?php echo e(route('register')); ?>">
                    <?php echo csrf_field(); ?>

                    <div class="mb-3">
                        <label>Nama</label>
                        <input type="text" name="name" class="form-control rounded-3" placeholder="Nama">
                    </div>

                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control rounded-3" placeholder="Email">
                    </div>

                    <div class="mb-4">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control rounded-3" placeholder="Password">
                    </div>

                    <button class="btn btn-primary w-100 rounded-3">
                        Register
                    </button>
                </form>

                <p class="text-center mt-4 mb-0">
                    Sudah punya akun?
                    <a href="<?php echo e(route('login')); ?>" class="text-primary fw-semibold">Login</a>
                </p>

            </div>
        </div>

    </div>
</div>

</body>
</html><?php /**PATH C:\laragon\www\PEBEEL-GENAP-2026-1\resources\views/auth/register.blade.php ENDPATH**/ ?>