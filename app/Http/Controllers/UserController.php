<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Halaman Profil User
    public function profile()
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Anda harus login terlebih dahulu');
        }

        $user = Auth::user();
        
        return view('user.profile', compact('user'));
    }

    // Update Profil User
    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('profiles', 'public');
            $user->photo = $path;
        }

        $user->name = $request->name;
        $user->bio = $request->bio;
        $user->save();

        return back()->with('success', 'Profil berhasil diupdate');
    }

    // Riwayat Sewa User
    public function rentalHistory()
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Anda harus login terlebih dahulu');
        }

        $user = Auth::user();
        // Ambil riwayat booking user yang login
        $bookings = Booking::where('user_id', $user->id)->with('car')->latest()->get();
        
        return view('user.rental-history', compact('user', 'bookings'));
    }
}
