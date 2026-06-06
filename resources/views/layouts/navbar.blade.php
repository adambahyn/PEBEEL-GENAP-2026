{{-- @php
if (!function_exists('getRealCarPhoto')) {
    function getRealCarPhoto($name) {
        $name = strtolower($name);
        if (str_contains($name, 'avanza')) {
            return 'https://images.unsplash.com/photo-1605559424843-9e4c228bf1c2?auto=format&fit=crop&q=80&w=800'; // Toyota Avanza
        } elseif (str_contains($name, 'xenia')) {
            return 'https://images.unsplash.com/photo-1623859664444-4444e05b5b0b?auto=format&fit=crop&q=80&w=800'; // Daihatsu Xenia / MPV
        } elseif (str_contains($name, 'cr-v') || str_contains($name, 'crv')) {
            return 'https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7?auto=format&fit=crop&q=80&w=800'; // Honda CR-V (Red SUV)
        } elseif (str_contains($name, 'ertiga')) {
            return 'https://images.unsplash.com/photo-1626847037657-fd3622613ce3?auto=format&fit=crop&q=80&w=800'; // Suzuki Ertiga / MPV
        } elseif (str_contains($name, 'innova')) {
            return 'https://images.unsplash.com/photo-1631880383160-a84920c3b50a?auto=format&fit=crop&q=80&w=800'; // Toyota Innova / MPV
        } elseif (str_contains($name, 'xpander')) {
            return 'https://images.unsplash.com/photo-1632245889027-e406faaa19ee?auto=format&fit=crop&q=80&w=800'; // Mitsubishi Xpander
        } elseif (str_contains($name, 'fortuner')) {
            return 'https://images.unsplash.com/photo-1617814076367-b759c7d7e738?auto=format&fit=crop&q=80&w=800'; // Toyota Fortuner
        } elseif (str_contains($name, 'brio')) {
            return 'https://images.unsplash.com/photo-1609521263047-f8f205293f24?auto=format&fit=crop&q=80&w=800'; // Honda Brio / Hatchback
        } elseif (str_contains($name, 'creta')) {
            return 'https://images.unsplash.com/photo-1669019623628-98444a7f0580?auto=format&fit=crop&q=80&w=800'; // Hyundai Creta
        } elseif (str_contains($name, 'serena')) {
            return 'https://images.unsplash.com/photo-1502877338535-766e1452684a?auto=format&fit=crop&q=80&w=800'; // Nissan Serena / Minivan
        }
        return 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&q=80&w=800'; // Fallback Porsche
    }
}
@endphp --}}

<link rel="stylesheet" href="{{ asset('css/global-animations.css') }}">
<script src="{{ asset('js/global-transitions.js') }}"></script>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4 fixed-top" style="height: 70px; display: flex; align-items: center;">
    <div class="container">

        <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="{{ url('/customer') }}">
            <i class="bi bi-car-front"></i> Adam Rental
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <!-- SEARCH TENGAH -->
            <form action="{{ url('/search') }}" method="GET" class="d-flex mx-auto border rounded-pill shadow-sm bg-light" style="width: 100%; max-width: 550px; padding: 2px;">
                <input class="form-control bg-transparent border-0 px-3" type="search" name="q" value="{{ request('q') }}"
                    placeholder="Cari produk, halaman, atau bantuan..." aria-label="Search" style="box-shadow: none;">
                <button class="btn btn-primary rounded-pill px-4 d-flex align-items-center" type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </form>

            <ul class="navbar-nav gap-2 align-items-center">

                <!-- BERANDA -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('home') ? 'active fw-bold' : '' }}" href="{{ url('/') }}">
                        <i class="bi bi-house-door me-1"></i>
                        Beranda
                    </a>
                </li>

                <!-- PRODUCT -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('product*') ? 'active fw-bold' : '' }}"
                        href="{{ url('/product') }}">
                        <i class="bi bi-car-front me-1"></i>
                        Product
                    </a>
                </li>
                {{-- Payment --}}
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('payment*') ? 'active fw-bold' : '' }}"
                        href="{{ route('payment.index') }}">
                        <i class="bi bi-credit-card me-1"></i>
                        Pembayaran
                    </a>
                </li>

                {{-- About Us --}}
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('about*') ? 'active fw-bold' : '' }}"
                        href="{{ route('about') }}">
                        <i class="bi bi-info-circle me-1"></i>
                        About Us
                    </a>
                </li>
                

                {{-- LOGIN --}}
                @if (!Auth::check())

                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('login') ? 'active fw-bold' : '' }} btn btn-primary text-black px-3"
                            href="{{ route('login') }}">
                            <i class="bi bi-box-arrow-in-right me-1"></i>
                            Login
                        </a>
                    </li>

                @elseif(Auth::user()->role === 'user')

                    <!-- LOGIN SEBAGAI USER -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" data-bs-toggle="dropdown">
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

                            <!-- MENU TAMBAHAN -->
                            <li>
                                <a class="dropdown-item" href="{{ route('user.profile') }}">

                                    Profil
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('user.rental-history') }}">

                                    Riwayat Sewa
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <!-- LOGOUT -->
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <button class="dropdown-item">
                                        Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>