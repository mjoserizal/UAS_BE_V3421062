<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FormatApi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class User62Controller extends Controller
{

    public function getUsers62()
    {
        $user = User::with('detail')->where('role', 'user')->get();

        return new FormatApi(true, 'Berhasil mendapatkan data user', $user);
    }

    public function getUserDetail62(Request $request, $id)
    {
        $user = User::with('detail')->find($id);

        if (!$user) {
            return new FormatApi(false, 'User tidak ditemukan', null);
        }

        return new FormatApi(true, 'Berhasil mendapatkan data user', $user);
    }

    public function putUserDetail62(Request $request, $id)
    {
        $user = User::with('detail')->find($id);

        if (!$user) {
            return new FormatApi(false, 'User tidak ditemukan', null);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users62,email,' . $user->id,
            'alamat' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'id_agama' => 'required',
        ]);

        if ($validator->fails()) {
            return new FormatApi(false, 'Validasi gagal', $validator->errors()->all());
        }

        $updateUser = $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $updateDetail = $user->detail->update([
            'alamat' => $request->alamat,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'id_agama' => $request->id_agama,
        ]);

        if ($updateUser && $updateDetail) {
            return new FormatApi(true, 'Berhasil mengubah data user', null);
        } else {
            return new FormatApi(false, 'Gagal mengubah data user', null);
        }
    }

    public function putUserPhoto62(Request $request, $id)
    {
        $user = User::with('detail')->find($id);

        if (!$user) {
            return new FormatApi(false, 'User tidak ditemukan', null);
        }

        $validator = Validator::make($request->all(), [
            'photoProfil' => 'required',
        ]);

        $fileName = $request->photoProfil;

        if ($validator->fails()) {
            return new FormatApi(false, 'Validasi gagal', $validator->errors()->all());
        }

        if ($user->foto != "foto.png") {
            if (file_exists(public_path('images/' . $user->foto))) {
                unlink(public_path('photo/' . $user->foto));
            }
        }

        if (file_exists(public_path('tmp/' . $fileName))) {
            $updatePhoto = $user->update([
                'foto' => $fileName,
            ]);

            rename(public_path('tmp/' . $fileName), public_path('photo/' . $fileName));

            if ($updatePhoto) {
                return new FormatApi(true, 'Berhasil mengubah foto profil user', null);
            } else {
                return new FormatApi(false, 'Gagal mengubah foto profil user', null);
            }
        } else {
            return new FormatApi(false, 'File tidak ditemukan', null);
        }
    }

    public function putUserPhotoKTP62(Request $request, $id)
    {
        $user = User::with('detail')->find($id);

        if (!$user) {
            return new FormatApi(false, 'User tidak ditemukan', null);
        }

        $validator = Validator::make($request->all(), [
            'photoKTP' => 'required',
        ]);

        $fileName = $request->photoKTP;

        if ($validator->fails()) {
            return new FormatApi(false, 'Validasi gagal', $validator->errors()->all());
        }

        if ($user->foto != "foto_ktp.png") {
            if (file_exists(public_path('images/' . $user->detail->foto_ktp))) {
                unlink(public_path('photo/' . $user->detail->foto_ktp));
            }
        }

        if (file_exists(public_path('tmp/' . $fileName))) {
            $updatePhoto = $user->detail->update([
                'foto_ktp' => $fileName,
            ]);

            rename(public_path('tmp/' . $fileName), public_path('photo/' . $fileName));

            if ($updatePhoto) {
                return new FormatApi(true, 'Berhasil mengubah foto profil user', null);
            } else {
                return new FormatApi(false, 'Gagal mengubah foto profil user', null);
            }
        } else {
            return new FormatApi(false, 'File tidak ditemukan', null);
        }
    }

    public function putUserPassword62(Request $request, $id)
    {
        $user = User::with('detail')->find($id);

        if (!$user) {
            return new FormatApi(false, 'User tidak ditemukan', null);
        }

        $validator = Validator::make($request->all(), [
            'old_password' => 'required|min:8',
            'password' => 'required|min:8',
            'repassword' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return new FormatApi(false, 'Validasi gagal', $validator->errors()->all());
        }

        if (!Hash::check($request->old_password, $user->password)) {
            return new FormatApi(false, 'Password lama tidak sesuai', null);
        }

        $updatePassword = $user->update([
            'password' => bcrypt($request->password),
        ]);

        if ($updatePassword) {
            return new FormatApi(true, 'Berhasil mengubah password user', null);
        } else {
            return new FormatApi(false, 'Gagal mengubah password user', null);
        }
    }

    public function putUserStatus62(Request $request, $id)
    {
        $user = User::with('detail')->find($id);

        if (!$user) {
            return new FormatApi(false, 'User tidak ditemukan', null);
        }

        $validator = Validator::make($request->all(), [
            'is_active' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return new FormatApi(false, 'Validasi gagal', $validator->errors()->all());
        }

        $updateStatus = $user->update([
            'is_active' => $request->is_active,
        ]);

        if ($updateStatus) {
            return new FormatApi(true, 'Berhasil mengubah status user', null);
        } else {
            return new FormatApi(false, 'Gagal mengubah status user', null);
        }
    }

    public function putUserAgama62(Request $request, $id)
    {
        $user = User::with('detail')->find($id);

        if (!$user) {
            return new FormatApi(false, 'User tidak ditemukan', null);
        }

        $validator = Validator::make($request->all(), [
            'id_agama' => 'required|exists:agama62,id',
        ]);

        if ($validator->fails()) {
            return new FormatApi(false, 'Validasi gagal', $validator->errors()->all());
        }

        $updateAgama = $user->detail->update([
            'id_agama' => $request->id_agama,
        ]);

        if ($updateAgama) {
            return new FormatApi(true, 'Berhasil mengubah agama user', null);
        } else {
            return new FormatApi(false, 'Gagal mengubah agama user', null);
        }
    }

    public function deleteUser62($id)
    {
        $user = User::with('detail')->find($id);

        if (!$user) {
            return new FormatApi(false, 'User tidak ditemukan', null);
        }

        if ($user->foto != "foto.png") {
            if (file_exists(public_path('images/' . $user->foto))) {
                unlink(public_path('photo/' . $user->foto));
            }
        }

        if ($user->detail->foto_ktp != "foto_ktp.png") {
            if (file_exists(public_path('images/' . $user->detail->foto_ktp))) {
                unlink
                (public_path('photo/' . $user->detail->foto_ktp));
            }
        }

    }
}
