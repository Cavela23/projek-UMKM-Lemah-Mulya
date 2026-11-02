<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Daftar_UMKM;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $user = Auth::user();
        if (!$user && session('user_id')) {
            $user = User::find(session('user_id'));
        }
        if (!$user) {
            return redirect('login');
        }
        $request->validate([
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $filename = 'profile_' . $user->id . '_' . Str::uuid() . '.' . $file->extension();
            $destination = public_path('profile_photos');
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }
            $file->move($destination, $filename);
            $user->profile_photo = $filename;
            $user->save();
            $request->session()->put('user_profile_photo', $filename);
        }
        // ...update data lain jika ada...
        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}
