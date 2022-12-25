<?php

namespace App\Http\Controllers;

use App\Models\Agama62;
use Illuminate\Http\Request;

class Agama62Controller extends Controller
{
    public function agamaPage62()
    {
        $agama = Agama62::all();

        return view('agama', ['all_agama' => $agama]);
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

    public function createAgama62(Request $request)
    {
        $request->validate([
            'nama_agama' => 'required'
        ]);

        $createAgama = Agama62::create([
            'nama_agama' => $request->nama_agama
        ]);

        if ($createAgama) {
            return back()->with('success', 'Agama berhasil ditambahkan');
        } else {
            return back()->with('error', 'Agama gagal ditambahkan');
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
}
