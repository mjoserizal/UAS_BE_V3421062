<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Agama62;


class Halo62Controller extends Controller
{
    public function halo62()
    {
        $user = User::where('role', 'user')->get();
        $agama = Agama62::all();

        return view('welcome', ['data' => $user, 'agama' => $agama]);
    }


}
