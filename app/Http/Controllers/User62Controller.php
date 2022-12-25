<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Agama62;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class User62Controller extends Controller
{

    public function profilePage62()
    {
        $user = Auth::user();
        $agama = Agama62::all();
        $usersData = User::with("detail")->where("id", $user->id)->first();
        $detail = $usersData->detail;
        $all_data = array_merge($usersData->toArray(), $detail->toArray());

        return view('profile', ['user' => $all_data, 'agama' => $agama, 'is_preview' => false]);
    }

    public function dashboardPage62()
    {
        $user = User::where('role', 'user')->get();
        $agama = Agama62::all();

        return view('dashboard', ['data' => $user, 'agama' => $agama]);
    }

    public function detailPage62(Request $request, $id)
    {
        $user = User::with('detail')->find($id);

        if (!$user) {
            return back()->with('error', 'User tidak ditemukan');
        }

        $agama = Agama62::all();

        return view('profile', ['user' => $user, 'agama' => $agama, 'is_preview' => true]);
    }

    public function putUserDetail62(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users62,email,' . $user->id,
            'alamat' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'id_agama' => 'required',
        ]);

        $userData = User::find($user->id);
        $detail = User::find($user->id)->detail;

        $isAgamaValid = Agama62::find($request->id_agama);

        if (!$isAgamaValid) {
            return back()->with('error', 'Agama tidak valid');
        }

        $userData->name = $request->name;
        $userData->email = $request->email;
        $saveUser = $userData->save();

        $detail->alamat = $request->alamat;
        $detail->tempat_lahir = $request->tempat_lahir;
        $detail->tanggal_lahir = $request->tanggal_lahir;
        $detail->id_agama = $request->id_agama;
        $detail->umur = date_diff(date_create($request->tanggal_lahir), date_create('now'))->y;
        $saveDetail = $detail->save();

        if ($saveUser && $saveDetail) {
            return back()->with('success', 'Update profile berhasil');
        } else {
            return back()->with('error', 'Update profile gagal');
        }
    }

    public function putUserStatus62(Request $request, $id)
    {

        $user = User::find($id);

        if (!$user) {
            return back()->with('error', 'User tidak ditemukan');
        }

        $updateStatus = $user->update([
            'is_active' => $user->is_active == 1 ? 0 : 1
        ]);

        if ($updateStatus) {
            return back()->with('success', 'Status berhasil diubah');
        } else {
            return back()->with('error', 'Status gagal diubah');
        }
    }

    public function putUserAgama62(Request $request, $id)
    {
        $user = User::with('detail')->find($id);

        if (!$user) {
            return back()->with('error', 'User tidak ditemukan');
        }

        $request->validate([
            'agama' => 'required|exists:agama62,id'
        ]);

        $user->detail->update([
            'id_agama' => $request->agama
        ]);

        $updateAgama = $user->detail->save();

        if ($updateAgama) {
            return back()->with('success', 'Agama berhasil diubah');
        } else {
            return back()->with('error', 'Agama gagal diubah');
        }
    }

    public function putUserPhotoKTP62()
    {
        $user = Auth::user();
        $detail = User::find($user->id)->detail;

        Validator::make(request()->all(), [
            'photoKTP' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ])->validate();

        if ($detail->foto_ktp != "foto_ktp.png") {
            if (file_exists(public_path('photo/' . $detail->foto_ktp))) {
                unlink(public_path('photo/' . $detail->foto_ktp));
            }
        }

        $file = request()->file('photoKTP');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('photo/'), $fileName);

        $detail->foto_ktp = $fileName;
        $savePhoto = $detail->save();

        if ($savePhoto) {
            return back()->with('success', 'Upload foto ktp berhasil');
        } else {
            return back()->with('error', 'Upload foto ktp gagal');
        }
    }

    public function putUserPhoto62(Request $request)
    {
        $user = Auth::user();
        $detail = User::find($user->id);


        Validator::make(request()->all(), [
            'photoProfil' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ])->validate();


        if ($detail->foto != "foto.png") {
            if (file_exists(public_path('photo/' . $detail->foto))) {
                unlink(public_path('photo/' . $detail->foto));
            }
        }


        $file = request()->file('photoProfil');

        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('photo/'), $fileName);

        $detail->foto = $fileName;

        $savePhoto = $detail->save();
        if ($savePhoto) {
            return back()->with('success', 'Upload foto profil berhasil');
        } else {
            return back()->with('error', 'Upload foto profil gagal');
        }
    }

    public function putUserPassword62(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'old_password' => 'required|min:8',
            'password' => 'required|min:8',
            'repassword' => 'required|same:password',
        ]);

        $userData = User::find($user->id);

        if (!Hash::check($request->old_password, $userData->password)) {
            return back()->with('error', 'Password lama tidak sesuai');
        }

        $userData->password = bcrypt($request->password);
        $saveUser = $userData->save();

        if ($saveUser) {
            return back()->with('success', 'Update password berhasil');
        } else {
            return back()->with('error', 'Update password gagal');
        }
    }

    public function logout62()
    {
        Auth::logout();
        return redirect('/login62');
    }
}
