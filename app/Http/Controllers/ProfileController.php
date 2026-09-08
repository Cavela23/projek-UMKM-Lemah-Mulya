<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $request->validate([
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $filename = 'profile_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $destination = public_path('profile_photos');
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }
            $file->move($destination, $filename);
            $user->profile_photo = $filename;
            $user->save();
        }
        // ...update data lain jika ada...
        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}
