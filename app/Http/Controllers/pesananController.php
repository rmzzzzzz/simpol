<?php

namespace App\Http\Controllers;

use App\Models\pesananModel;
use Illuminate\Http\Request;

class pesananController extends Controller
{
    public function pesanan()
    {
        $data['pesanan'] = pesananModel::get();
        return view('admin/data/pesanan', $data);
    }
}
