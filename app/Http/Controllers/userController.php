<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use App\Models\userModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
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
            'role' => ['required','in:admin,petugas,anggota',],
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
 
public function action_edit(Request $request, $id)
{
    $user = User::findOrFail($id);

    $validatedData = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
        'role' => ['required', 'in:admin,petugas,anggota'],
        'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
    ]);

    if (!empty($validatedData['password'])) {
        $validatedData['password'] = Hash::make($validatedData['password']);
    } else {
        unset($validatedData['password']);
    }

    $user->update($validatedData); // pastikan $fillable benar di model User

    return redirect('/admin/data/userdata')->with('success', 'Data Berhasil Diperbarui');
}

 public function hapus($id)
    {
        $user = user::findOrfail($id);
         if ($user->detail_anggota()->exists()) {
            return back()->withErrors(['errors' => 'Tidak bisa menghapus user karena masih memiliki data terkait.']);
        }
        $user->delete();
        return back()->with('success', 'data user berhasil dihapus');
    }

}