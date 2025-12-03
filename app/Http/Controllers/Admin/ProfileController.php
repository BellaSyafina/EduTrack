<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use function League\Flysystem\Local\read;

class ProfileController extends Controller
{
    public function index()
    {
        // Ambil data user login
        $user = Auth::user();

        return view('admin.profile.index', [
            'user' => $user,
            'title' => 'Profil Pengguna',
        ]);
    }

    public function edit($id)
    {
        // Ambil data user berdasarkan ID
        $user = Auth::user();

        return view('admin.profile.update', [
            'user' => $user,
            'title' => 'Edit Profil',
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            // Validasi input
            $request->validate(
                [
                    'username' => 'required|string|max:255',
                    'email' => 'required|email|max:255|unique:users,email,' . $id,
                    'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                ],
                [
                    'username.required' => 'Username wajib diisi.',
                    'email.required' => 'Email wajib diisi.',
                    'email.email' => 'Format email tidak valid.',
                    'email.unique' => 'Email sudah digunakan oleh pengguna lain.',
                    'photo.image' => 'File harus berupa gambar.',
                    'photo.mimes' => 'Format gambar harus jpg, jpeg, atau png.',
                    'photo.max' => 'Ukuran gambar maksimal 2MB.',
                ],
            );

            // Ambil user
            $user = User::findOrFail($id);
            $user->username = $request->username;
            $user->email = $request->email;

            // Upload foto
            if ($request->hasFile('photo')) {
                // Hapus foto lama jika ada
                if ($user->photo && file_exists(public_path('photos/' . $user->photo))) {
                    unlink(public_path('photos/' . $user->photo));
                }

                // Generate nama unik
                $photoName = time() . '_' . uniqid() . '.' . $request->photo->extension();

                // Simpan ke folder public/photos
                $request->photo->move(public_path('photos'), $photoName);

                // Simpan nama foto ke database
                $user->photo = $photoName;
            }

            $user->save();

            return redirect('/profile')->with('success', 'Profil berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => 'Terjadi kesalahan saat memperbarui profil: ' . $e->getMessage()]);
        }
    }

    public function changePassword($id)
    {
        $user = User::findOrFail($id);

        return view('admin.profile.gantiPassword', [
            'user' => $user,
            'title' => 'Ganti Password',
        ]);
    }

    public function updatePassword(Request $request, $id)
    {
        try {
            $request->validate(
                [
                    'current_password' => ['required'],
                    'new_password' => ['required', 'min:6'],
                    'confirm_password' => ['required', 'same:new_password'],
                ],
                [
                    'current_password.required' => 'Password lama wajib diisi.',
                    'new_password.required' => 'Password baru wajib diisi.',
                    'new_password.min' => 'Password baru minimal 6 karakter.',
                    'confirm_password.required' => 'Konfirmasi password wajib diisi.',
                    'confirm_password.same' => 'Konfirmasi password tidak sesuai dengan password baru.',
                ],
            );

            $user = User::findOrFail($id);

            // Cek password lama
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['error' => 'Password lama tidak sesuai!']);
            }

            // Update password
            $user->update([
                'password' => Hash::make($request->new_password),
                'dummy_password' => $request->new_password,
            ]);

            return redirect('/profile ')->with('success', 'Password berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => 'Terjadi kesalahan saat memperbarui password: ' . $e->getMessage()]);
        }
    }
}
