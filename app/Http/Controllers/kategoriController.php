<?php

namespace App\Http\Controllers;

use App\Models\kategoriModel;
use Illuminate\Http\Request;

class kategoriController extends Controller
{
    public function kategori()
    {
        $data['user'] = kategoriModel::get();
        return view('admin/data/kategori', $data);
    }
}
