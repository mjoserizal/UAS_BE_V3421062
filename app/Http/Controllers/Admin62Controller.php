<?php

namespace App\Http\Controllers;

use App\Models\Agama62;
use App\Models\User;
use Illuminate\Http\Request;

class Admin62Controller extends Controller
{

    public function dashboardPage62()
    {
        $user = User::where('role', 'user')->get();
        $agama = Agama62::all();

        return view('dashboard', ['data' => $user, 'agama' => $agama]);
    }

    public function detailPage62(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);

        if (!$user) {
            return redirect('/dashboard62')->with('error', 'User tidak ditemukan');
        }

        $agama = Agama62::all();

        $detail = $user->detail;
        $data = array_merge($user->toArray(), $detail->toArray());

        return view('profile', ['user' => $data, 'agama' => $agama, 'is_preview' => true]);
    }

    public function updateUserStatus62(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);

        if (!$user) {
            return redirect('/dashboard62')->with('error', 'User tidak ditemukan');
        }

        $updateStatus = $user->update([
            'is_active' => $user->is_active == 1 ? 0 : 1
        ]);

        if ($updateStatus) {
            return redirect('/dashboard62')->with('success', 'Status berhasil diubah');
        } else {
            return redirect('/dashboard62')->with('error', 'Status gagal diubah');
        }
    }

    public function deleteUser62(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);

        if (!$user) {
            return redirect('/dashboard62')->with('error', 'User tidak ditemukan');
        }

        $deleteUser = $user->delete();

        if ($deleteUser) {
            return redirect('/dashboard62')->with('success', 'User berhasil dihapus');
        } else {
            return redirect('/dashboard62')->with('error', 'User gagal dihapus');
        }
    }

    public function agamaPage62()
    {
        $agama = Agama62::all();

        return view('agama', ['all_agama' => $agama]);
    }

    public function createAgama62(Request $request)
    {
        $request->validate([
            'nama_agama' => 'required'
        ]);

        $createAgama = Agama62::create([
            'nama_agama' => $request->nama_agama
        ]);

        if ($createAgama) {
            return redirect('/agama62')->with('success', 'Agama berhasil ditambahkan');
        } else {
            return redirect('/agama62')->with('error', 'Agama gagal ditambahkan');
        }
    }

    public function editAgamaPage62(Request $request)
    {

        $id = $request->id;

        $agama = Agama62::find($id);

        if (!$agama) {
            return back()->with('error', 'Agama tidak ditemukan');
        }

        $all_agama = Agama62::all();

        return view('agama', ['all_agama' => $all_agama, 'agama' => $agama]);
    }


    public function updateUserAgama62(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);

        if (!$user) {
            return redirect('/dashboard62')->with('error', 'User tidak ditemukan');
        }

        $request->validate([
            'agama' => 'required|exists:agama62,id'
        ]);

        $user->detail->id_agama = $request->agama;
        $updateAgama = $user->detail->save();

        if ($updateAgama) {
            return redirect('/dashboard62')->with('success', 'Agama berhasil diubah');
        } else {
            return redirect('/dashboard62')->with('error', 'Agama gagal diubah');
        }
    }


    public function deleteAgama62(Request $request)
    {
        $id = $request->id;
        $agama = Agama62::find($id);

        if (!$agama) {
            return redirect('/agama62')->with('error', 'Agama tidak ditemukan');
        }

        $deleteAgama = $agama->delete();


        if ($deleteAgama) {
            return redirect('/agama62')->with('success', 'Agama berhasil dihapus');
        } else {
            return redirect('/agama62')->with('error', 'Agama gagal dihapus');
        }
    }

    public function updateAgama62(Request $request)
    {
        $id = $request->id;
        $agama = Agama62::find($id);

        if (!$agama) {
            return redirect('/agama62')->with('error', 'Agama tidak ditemukan');
        }

        $request->validate([
            'nama_agama' => 'required'
        ]);

        $updateAgama = $agama->update([
            'nama_agama' => $request->nama_agama
        ]);

        if ($updateAgama) {
            return redirect('/agama62')->with('success', 'Agama berhasil diubah');
        } else {
            return redirect('/agama62')->with('error', 'Agama gagal diubah');
        }
    }

}
