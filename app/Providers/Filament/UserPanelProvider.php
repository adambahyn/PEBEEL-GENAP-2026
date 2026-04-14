<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\View\PanelsRenderHook;
use Illuminate\Support\Facades\Blade;

class UserPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('user')
            ->path('customer')
            ->login()
            ->registration()
            ->homeUrl('/customer')
            ->renderHook(
                // ✅ Inject Bootstrap 5 CSS + JS untuk styling halaman customer
                // Filament punya CSS bundle sendiri (Tailwind compiled), tidak perlu Tailwind CDN.
                // Bootstrap digunakan khusus untuk konten halaman custom (customer-home, dll.)
                PanelsRenderHook::HEAD_END,
                fn(): string => '
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" defer></script>
                    <style>
                        /* =====================================================
                         * Perbaikan konflik Bootstrap vs Filament CSS
                         * Filament menggunakan class fi-* untuk UI-nya sendiri,
                         * Bootstrap digunakan di dalam .rh-wrap (rental home wrapper)
                         * ===================================================== */

                        /* Reset Bootstrap link color agar tidak merusak nav Filament */
                        .fi-sidebar a, .fi-topbar a, .fi-breadcrumbs a { color: inherit !important; }

                        /* Pastikan heading di Filament tidak terpengaruh Bootstrap */
                        .fi-header h1, .fi-page-heading { font-size: inherit; font-weight: inherit; }

                        /* Styling custom untuk halaman beranda */
                        .rh-hero {
                            background: linear-gradient(135deg, rgba(0,0,0,0.65) 0%, rgba(0,0,0,0.4) 100%),
                                        url("https://images.unsplash.com/photo-1449965408869-eaa3f722e40d?q=80&w=2070") center/cover no-repeat;
                            border-radius: 20px;
                            padding: 100px 40px;
                            margin-bottom: 40px;
                            position: relative;
                            overflow: hidden;
                        }

                        .rh-hero::before {
                            content: "";
                            position: absolute;
                            bottom: -2px;
                            left: 0; right: 0;
                            height: 60px;
                            background: linear-gradient(to top, #f8f9fa, transparent);
                            border-radius: 0 0 20px 20px;
                        }

                        .rh-search-box {
                            background: white;
                            border-radius: 50px;
                            padding: 8px 8px 8px 24px;
                            box-shadow: 0 10px 40px rgba(0,0,0,0.15);
                            max-width: 860px;
                            margin: 0 auto;
                        }

                        .rh-search-box input,
                        .rh-search-box select {
                            border: none !important;
                            outline: none !important;
                            box-shadow: none !important;
                            background: transparent !important;
                            font-size: 0.875rem;
                        }

                        .rh-stat-card {
                            border-radius: 16px;
                            padding: 24px;
                            text-align: center;
                            transition: transform 0.2s;
                        }
                        .rh-stat-card:hover { transform: translateY(-4px); }

                        .rh-car-card {
                            border-radius: 16px;
                            overflow: hidden;
                            transition: box-shadow 0.25s, transform 0.25s;
                            border: 1px solid #f0f0f0;
                        }
                        .rh-car-card:hover {
                            box-shadow: 0 12px 36px rgba(0,0,0,0.12) !important;
                            transform: translateY(-4px);
                        }
                        .rh-car-img {
                            height: 190px;
                            object-fit: cover;
                            width: 100%;
                            transition: transform 0.4s;
                        }
                        .rh-car-card:hover .rh-car-img { transform: scale(1.05); }
                        .rh-car-img-wrap { overflow: hidden; height: 190px; position: relative; }

                        .rh-step-icon {
                            width: 72px; height: 72px;
                            background: #fff3cd;
                            border-radius: 50%;
                            display: flex; align-items: center; justify-content: center;
                            font-size: 32px;
                            margin: 0 auto 16px;
                            box-shadow: 0 4px 16px rgba(255,193,7,0.3);
                        }

                        .rh-filter-btn.active {
                            background: #ffc107 !important;
                            color: #000 !important;
                            border-color: #ffc107 !important;
                        }

                        .rh-cta {
                            background: linear-gradient(135deg, #ffc107, #ff9800);
                            border-radius: 20px;
                            padding: 60px 40px;
                            text-align: center;
                        }
                    </style>
                '
            )
            ->renderHook(
                PanelsRenderHook::AUTH_LOGIN_FORM_AFTER,
                fn(): string => Blade::render('
                    <div class="mt-4 text-center">
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Pengelola Rental?
                            <a href="/admin/login" class="font-semibold text-primary-600 hover:text-primary-500 hover:underline">
                                Masuk sebagai Admin
                            </a>
                        </p>
                    </div>
                ')
            )
            ->profile()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources/User'), for: 'App\\Filament\\Resources\\User')
            ->discoverPages(in: app_path('Filament/Pages/User'), for: 'App\\Filament\\Pages\\User')
            ->pages([])
            ->discoverWidgets(in: app_path('Filament/Widgets/User'), for: 'App\\Filament\\Widgets\\User')
            ->widgets([
                AccountWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
