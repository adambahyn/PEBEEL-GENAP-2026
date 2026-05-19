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

        /* FOOTER STYLES */
        .footer-section {
            background: linear-gradient(135deg, #0066cc 0%, #0099ff 100%);
            color: white;
            padding: 60px 0;
            margin-top: 30px;
        }

        .footer-content {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 40px;
        }

        .footer-column h5 {
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .footer-column p {
            font-size: 0.95rem;
            line-height: 1.6;
            opacity: 0.9;
        }

        .help-section {
            margin-top: 30px;
        }

        .help-item {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
            padding: 12px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            text-decoration: none;
            color: white;
            transition: all 0.3s ease;
        }

        .help-item:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateX(5px);
        }

        .help-item i {
            font-size: 1.3rem;
            min-width: 30px;
            text-align: center;
        }

        .btn-about {
            background: white;
            color: #0066cc;
            padding: 12px 30px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            display: inline-block;
            margin-top: 20px;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-about:hover {
            background: #f0f0f0;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .social-media-section h5 {
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .social-icons {
            display: flex;
            gap: 15px;
            margin-top: 15px;
        }

        .social-icon {
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            text-decoration: none;
            color: white;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .social-icon:hover {
            background: white;
            color: #0066cc;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            margin-top: 40px;
            padding-top: 30px;
            text-align: center;
            opacity: 0.9;
            font-size: 0.9rem;
        }

        /* NEW SIDEBAR LAYOUT STYLES */
        .profile-container {
            display: flex;
            gap: 30px;
            min-height: calc(100vh - 400px);
        }

        .sidebar-menu {
            background: white;
            border-radius: 15px;
            padding: 30px 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            width: 280px;
            height: fit-content;
            /* Hapus position sticky dan align-self */
            z-index: 100;
        }

        .sidebar-profile {
            text-align: center;
            padding-bottom: 25px;
            border-bottom: 2px solid #f0f0f0;
            margin-bottom: 25px;
        }

        .sidebar-profile-photo {
            width: 140px;
            height: 140px;
            margin: 0 auto 15px;
            position: relative;
            display: inline-block;
        }

        .sidebar-profile-photo img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            border: 4px solid #0066cc;
            object-fit: cover;
            box-shadow: 0 4px 15px rgba(0, 102, 204, 0.2);
        }

        .sidebar-profile-name {
            font-size: 1.2rem;
            font-weight: 700;
            color: #212529;
            margin-bottom: 5px;
        }

        .sidebar-profile-email {
            font-size: 0.9rem;
            color: #6c757d;
            word-break: break-word;
        }

        .sidebar-menu-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-menu-item {
            margin: 0;
            padding: 0;
        }

        .sidebar-menu-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 15px;
            color: #212529;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
            font-size: 0.95rem;
        }

        .sidebar-menu-link:hover {
            background: #f0f0f0;
            color: #0066cc;
            transform: translateX(5px);
        }

        .sidebar-menu-link.active {
            background: #0066cc;
            color: white;
        }

        .sidebar-menu-link i {
            font-size: 1.2rem;
            min-width: 20px;
        }

        .content-area {
            flex: 1;
        }

        .profile-content-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .profile-tab-header {
            background: #0066cc;
            color: white;
            padding: 20px 30px;
            font-size: 1.1rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .profile-content-inner {
            padding: 40px 30px;
        }

        .profile-row {
            display: flex;
            gap: 40px;
            align-items: flex-start;
        }

        .profile-left-column {
            text-align: center;
            flex-shrink: 0;
        }

        .profile-main-photo {
            width: 150px;
            height: 150px;
            margin: 0 auto 20px;
            border-radius: 50%;
            border: 3px solid #0066cc;
            object-fit: cover;
            box-shadow: 0 4px 15px rgba(0, 102, 204, 0.2);
        }

        .profile-name-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: #212529;
            margin-bottom: 8px;
        }

        .profile-email-display {
            font-size: 0.95rem;
            color: #6c757d;
            margin-bottom: 20px;
        }

        .profile-right-column {
            flex: 1;
        }

        .profile-info-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }

        .profile-info-box {
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px;
            border-left: 4px solid #0066cc;
        }

        .profile-info-box-label {
            font-size: 0.85rem;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .profile-info-box-value {
            font-size: 1.1rem;
            color: #212529;
            font-weight: 600;
        }

        .profile-bio-section {
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px;
            border-left: 4px solid #0066cc;
            margin-bottom: 30px;
        }

        .profile-bio-label {
            font-size: 0.85rem;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .profile-bio-value {
            font-size: 1rem;
            color: #212529;
            line-height: 1.5;
        }

        .profile-action-buttons {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .btn-profile-action {
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 0.95rem;
        }

        .btn-profile-edit {
            background: #0066cc;
            color: white;
        }

        .btn-profile-edit:hover {
            background: #0052a3;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 102, 204, 0.3);
            color: white;
        }

        @media (max-width: 1024px) {
            .profile-container {
                flex-direction: column;
            }

            .sidebar-menu {
                width: 100%;
                position: static;
            }

            .profile-row {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .profile-right-column {
                width: 100%;
            }

            .profile-info-row {
                grid-template-columns: 1fr;
            }
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

            .footer-content {
                grid-template-columns: 1fr;
                gap: 30px;
            }

            .profile-content-inner {
                padding: 20px;
            }

            .profile-tab-header {
                padding: 15px 20px;
            }
        }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/customer') }}">
                Adam Rental
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav gap-2">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/customer') }}">
                            Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/product') }}">
                            Product
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('payment.index') }}">
                            Pembayaran
                        </a>
                    </li>

                    @if (Auth::check())
                        <!-- LOGIN SEBAGAI USER -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#"
                                data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle fs-4"></i>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end">
                                <!-- NAMA USER -->
                                <li class="dropdown-item-text fw-semibold">
                                    👤 {{ Auth::user()->name }}
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item active fw-bold" href="{{ route('user.profile') }}">Profil</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('user.rental-history') }}">Riwayat Sewa</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                <!-- LOGOUT -->
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button class="dropdown-item">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
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
    <div class="container mb-5">
        <div class="profile-container">
            <!-- SIDEBAR -->
            <div class="sidebar-menu">
                <!-- SIDEBAR PROFILE -->
                <div class="sidebar-profile">
                    <div class="sidebar-profile-photo">
                        <img src="{{ $user->photo ? asset('storage/'.$user->photo) : 'https://ui-avatars.com/api/?name='.$user->name }}"
                            alt="{{ $user->name }}">
                    </div>
                    <div class="sidebar-profile-name">{{ $user->name }}</div>
                    <div class="sidebar-profile-email">{{ $user->email }}</div>
                </div>

                <!-- SIDEBAR MENU -->
                <ul class="sidebar-menu-list">
                    <li class="sidebar-menu-item">
                        <a href="{{ route('user.profile') }}" class="sidebar-menu-link active">
                            <i class="bi bi-person-fill"></i>
                            <span>Profil</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a href="{{ route('user.rental-history') }}" class="sidebar-menu-link">
                            <i class="bi bi-clock-history"></i>
                            <span>Riwayat Sewa</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- CONTENT AREA -->
            <div class="content-area">
                <!-- PROFILE CARD -->
                <div class="profile-content-card">
                    <!-- TAB HEADER -->
                    <div class="profile-tab-header">
                        Profil
                    </div>

                    <!-- CONTENT -->
                    <div class="profile-content-inner">
                        <div class="profile-row">
                            <!-- LEFT COLUMN - FOTO -->
                            <div class="profile-left-column">
                                <img src="{{ $user->photo ? asset('storage/'.$user->photo) : 'https://ui-avatars.com/api/?name='.$user->name }}"
                                    class="profile-main-photo"
                                    alt="{{ $user->name }}">
                                <div class="profile-name-title">{{ $user->name }}</div>
                                <div class="profile-email-display">{{ $user->email }}</div>
                            </div>

                            <!-- RIGHT COLUMN - INFO -->
                            <div class="profile-right-column">
                                <!-- INFO ITEMS -->
                                <div class="profile-info-row">
                                    <div class="profile-info-box">
                                        <div class="profile-info-box-label">Total Booking</div>
                                        <div class="profile-info-box-value">{{ $user->bookings->count() }}</div>
                                    </div>

                                    <div class="profile-info-box">
                                        <div class="profile-info-box-label">Bergabung</div>
                                        <div class="profile-info-box-value">{{ $user->created_at->format('d M Y') }}</div>
                                    </div>
                                </div>

                                <!-- BIO SECTION -->
                                <div class="profile-bio-section">
                                    <div class="profile-bio-label">Bio</div>
                                    <div class="profile-bio-value">{{ $user->bio ?? 'Belum ada bio' }}</div>
                                </div>

                                <!-- ACTION BUTTONS -->
                                <div class="profile-action-buttons">
                                    <button class="btn-profile-action btn-profile-edit" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                                        <i class="bi bi-pencil"></i> Edit Profil
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL EDIT PROFIL -->
    <div class="modal fade" id="editProfileModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Edit Profil</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('user.update-profile') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Foto Profil</label>
                            <input type="file" name="photo" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama</label>
                            <input type="text" name="name" value="{{ $user->name }}"
                                class="form-control" placeholder="Nama Lengkap">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Bio</label>
                            <textarea name="bio" class="form-control" placeholder="Ceritakan tentang diri Anda" rows="4">{{ $user->bio }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- FOOTER SECTION -->
    <footer class="footer-section">
        <div class="container">
            <div class="footer-content">
                <!-- KOLOM 1: PENJELASAN WEBSITE -->
                <div class="footer-column">
                    <h5>Tentang Adam Rental</h5>
                    <p>
                        Adam Rental adalah platform penyewaan kendaraan terpercaya yang menyediakan berbagai pilihan kendaraan berkualitas untuk memenuhi kebutuhan transportasi Anda dengan harga terjangkau dan layanan terbaik.
                    </p>
                </div>

                <!-- KOLOM 2: BANTUAN & KONTAK -->
                <div class="footer-column">
                    <h5>Bantuan & Kontak</h5>
                    <div class="help-section">
                        <a href="https://wa.me/628XXXXXXXXX" class="help-item" target="_blank">
                            <i class="bi bi-whatsapp"></i>
                            <span>Hubungi via WhatsApp</span>
                        </a>
                        <a href="mailto:info@adamrental.com" class="help-item">
                            <i class="bi bi-envelope"></i>
                            <span>Email: info@adamrental.com</span>
                        </a>
                    </div>
                    <button class="btn-about" data-bs-toggle="modal" data-bs-target="#aboutModal">
                        Tentang Kami
                    </button>
                </div>

                <!-- KOLOM 3: IKUTI MEDIA SOSIAL -->
                <div class="footer-column social-media-section">
                    <h5>Ikuti Kami Di</h5>
                    <p style="margin-bottom: 20px;">Tetap update dengan promo dan tips terbaru dari kami</p>
                    <div class="social-icons">
                        <a href="https://www.instagram.com/beansfolks?igsh=MWtqOXlqd3NhbHgxbA==" class="social-icon" title="Instagram" target="_blank">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="https://www.facebook.com/share/1PREsxVQ2H/" class="social-icon" title="Facebook" target="_blank">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="https://www.tiktok.com/@wskyyyw?_r=1&_t=ZS-96JSOSyWBZk" class="social-icon" title="TikTok" target="_blank">
                            <i class="bi bi-tiktok"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- FOOTER BOTTOM -->
            <div class="footer-bottom">
                <p>&copy; 2026 Adam Rental. All rights reserved. | <a href="#" style="color: white; text-decoration: none;">Privacy Policy</a> | <a href="#" style="color: white; text-decoration: none;">Terms of Service</a></p>
            </div>
        </div>
    </footer>

    <!-- MODAL TENTANG KAlas-->
    <div class="modal fade" id="aboutModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Tentang Kami</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <h6 class="fw-bold mb-3">Visi Kami</h6>
                    <p>Menjadi platform penyewaan kendaraan nomor satu di Indonesia dengan memberikan layanan terbaik dan terpercaya.</p>

                    <h6 class="fw-bold mb-3 mt-4">Misi Kami</h6>
                    <ul>
                        <li>Menyediakan kendaraan berkualitas tinggi dengan harga terjangkau</li>
                        <li>Memberikan layanan pelanggan yang responsif dan profesional</li>
                        <li>Memastikan pengalaman sewa yang aman dan nyaman</li>
                        <li>Inovasi berkelanjutan dalam teknologi dan layanan</li>
                    </ul>

                    <h6 class="fw-bold mb-3 mt-4">Mengapa Memilih Kami?</h6>
                    <ul>
                        <li>✅ Armada kendaraan terlengkap dan terawat</li>
                        <li>✅ Harga kompetitif dengan berbagai paket</li>
                        <li>✅ Proses booking mudah dan cepat</li>
                        <li>✅ Asuransi komprehensif tersedia</li>
                        <li>✅ Customer support 24/7</li>
                        <li>✅ Lokasi pickup di berbagai kota</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
