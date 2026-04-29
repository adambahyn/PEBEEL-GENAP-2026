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
            ->topNavigation()
            ->login()
            ->registration()
            ->homeUrl('/customer')
            ->renderHook(
                PanelsRenderHook::HEAD_END,
                fn(): string => '
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
        <style>
            /* Menyamakan Button Bootstrap dengan Warna Amber Filament */
            .btn-primary {
                background-color: #ffbf00 !important; /* Amber */
                border-color: #ffbf00 !important;
                color: #000 !important;
                font-weight: 600;
            }
            .btn-primary:hover {
                background-color: #e6ac00 !important;
                border-color: #e6ac00 !important;
            }
            
            /* Menyamakan Font dan Tekstur */
            body { font-family: "Inter", sans-serif; }
            
            /* Styling Card agar sama dengan halaman Product */
            .rh-car-card {
                border: none !important;
                border-radius: 12px !important;
                box-shadow: 0 4px 12px rgba(0,0,0,0.05) !important;
                transition: all 0.3s ease;
            }
            .rh-car-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 8px 24px rgba(255,191,0,0.2) !important;
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
