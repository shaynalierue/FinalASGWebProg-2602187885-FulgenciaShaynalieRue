<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function changeVisibility()
    {
        // Ambil data pengguna yang sedang login
        $user = Auth::user();
        
        // Tentukan harga berdasarkan status visibility saat ini
        if ($user->visibility && $user->coin >= 50) {
            // Jika profil terlihat dan pengguna memiliki cukup koin untuk menyembunyikannya
            $price = 50;
        } elseif (!$user->visibility && $user->coin >= 5) {
            // Jika profil tersembunyi dan pengguna memiliki cukup koin untuk menampilkannya
            $price = 5;
        } else {
            // Jika koin tidak cukup
            return back()->with('error', __('lang.insufficient_coins'));
        }

        // Proses pembaruan status dan pengurangan koin
        $user->update([
            'coin' => $user->coin - $price,
            'visibility' => !$user->visibility, // Toggle status visibility
        ]);

        // Kembalikan ke halaman home dengan pesan sukses
        return redirect()->route('homePage')->with('success', __('lang.visibility_updated'));
    }


    public function changeAvatar(Request $request)
    {
        User::findOrFail(Auth::user()->id)->update([
            'profile_picture' => $request->avatar_path
        ]);

        return back();
    }
}
