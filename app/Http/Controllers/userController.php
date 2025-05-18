<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\userModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class userController extends Controller
{
     public function userdata()
    {
        $data['user'] = userModel::get();
        return view('admin/data/userdata', $data);
    }
     public function tambah()
    {
        $data = [
            'name' => User::all(),
            'email' => user::all(),
            'password' => user::all(),
        ];
        return view('admin/add/user', $data);
    }
    public function action_tambah(Request $request){
     $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'role' => ['required|in:admin,petugas,anggota',],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

       $request['password'] = Hash::make($request['password']);
        user::create($request->all());
        return redirect('/admin/data/userdata')->with('success', 'Berhasil Di Tambah');
    }
       public function edit($id)
    {
        $data = ['detail' => userModel::findOrfail($id)];

        return view("admin/edit/user", $data);
}

}