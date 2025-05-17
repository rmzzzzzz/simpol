<?php

namespace App\Http\Controllers;

use App\Models\produkModel;
use Illuminate\Http\Request;

class produkController extends Controller
{
     public function produk()
    {
        $data['user'] = produkModel::get();
        return view('admin/data/produk', $data);
    }
    //  public function tambah()
    // {
    //     $data = [
    //         'name' => User::all(),
    //         'email' => user::all(),
    //         'password' => user::all(),
    //     ];
    //     return view('admin/add/user', $data);
    // }
}
