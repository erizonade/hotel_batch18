<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::get();

        return view('user.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'namaUser' => 'required',
            'email' => 'required|email|unique:users,email,id',
            'password' => 'required|min:6',
            'roleName' => 'required',
        ]);

        User::insert([
            'name' => $request->namaUser,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_name' => $request->roleName,
        ]);

        return redirect('user')->with('status', 'Berhasil simpan data user');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::where('id', $id)->first();
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'namaUser' => 'required',
            'email' => 'required|email|unique:users,email,'.$id.',id',
            'password' => 'nullable|min:6',
            'roleName' => 'required',
        ]);

        $update = [
            'name' => $request->namaUser,
            'email' => $request->email,
            'role_name' => $request->roleName,
        ];

        if ($request->password) {
            $update['password'] = bcrypt($request->password);
        }


        User::where('id', $id)->update($update);

        return redirect('user')->with('status', 'Berhasil ubah data user');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::destroy($id);

        return redirect('user')->with('status', 'Berhasil hapus data user');
    }
}
