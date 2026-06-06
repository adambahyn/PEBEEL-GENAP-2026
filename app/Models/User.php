<?php
// app/Models/User.php
namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser, MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'role', 'photo', 'bio', 'alamat', 'ktp_file', 'sim_file'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Fungsi ini membatasi siapa yang bisa login ke Filament Admin Panel
    public function canAccessPanel(Panel $panel): bool
    {
        if ($panel->getId() === 'admin') {
            return $this->role === 'admin'; // Hanya admin ke panel admin
        }

        if ($panel->getId() === 'user') {
            return true; // Semua user yang login bisa akses panel user
        }

        return false;
    }

    
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
