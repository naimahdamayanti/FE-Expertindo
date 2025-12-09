<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Tampilkan halaman profil
     */
    public function index()
    {
        // Ambil user dari session atau token
        $userId = session('id');
        
        if (!$userId) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu!');
        }
        
        $user = User::find($userId);
        
        if (!$user) {
            return redirect()->route('login')->with('error', 'User tidak ditemukan!');
        }
        
        return view('profile.index', compact('user'));
    }

    public function create()
    {
        return view('profile.create');
    }

    /**
     * Tampilkan form edit profil
     */
    public function edit()
    {
        $userId = session('id');
        
        if (!$userId) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu!');
        }
        
        $user = User::find($userId);
        
        if (!$user) {
            return redirect()->route('login')->with('error', 'User tidak ditemukan!');
        }
        
        return view('profile.edit', compact('user'));
    }

    /**
     * Update profil user
     */
    public function update(Request $request)
    {
        $userId = session('id');
        
        if (!$userId) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu!');
        }
        
        $user = User::findOrFail($userId);

        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:100|unique:user,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Data yang akan diupdate
        $updateData = [
            'nama' => $request->nama,
            'email' => $request->email,
        ];

        // Upload avatar jika ada
        if ($request->hasFile('avatar')) {
            // Hapus avatar lama jika ada
            if ($user->avatar && file_exists(public_path($user->avatar))) {
                unlink(public_path($user->avatar));
            }
            
            $avatar = $request->file('avatar');
            $avatarName = time() . '_' . uniqid() . '.' . $avatar->extension();
            
            // Pastikan folder ada
            $uploadPath = public_path('uploads/avatars');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            
            $avatar->move($uploadPath, $avatarName);
            $updateData['avatar'] = 'uploads/avatars/' . $avatarName;
        }

        // Update password jika diisi
        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        // Update menggunakan DB::table untuk memastikan tersimpan
        DB::table('user')
            ->where('id', $userId)
            ->update($updateData);
        
        // Refresh user data
        $user = User::find($userId);
        
        // Update session
        session([
            'user_id' => $user->id,
            'email' => $user->email,
            'nama' => $user->nama,
            'role' => $user->role,
            'avatar' => $user->avatar,
        ]);

        return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui!');
    }

    public function view()
    {
        $user = User::first();
        
        if (!$user) {
            $user = (object) [
                'logo' => null,
                'visi' => 'Visi belum tersedia.',
                'misi' => 'Misi belum tersedia.',
                'tujuan' => 'Tujuan belum tersedia.',
            ];
        }
        
        return view('user.view', compact('user'));
    }
    /**
     * Hapus akun user
     */
    public function destroy(Request $request)
    {
        $user = Auth::user();

        // Validasi password untuk keamanan
        $request->validate([
            'password' => 'required',
        ]);

        // Cek apakah password benar
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Password salah!']);
        }

        // Logout dan hapus akun
        Auth::logout();
        $user->delete();

        return redirect()->route('login')->with('success', 'Akun berhasil dihapus!');
    }
}