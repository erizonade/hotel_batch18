@extends('layouts.app')
@section('title')
    User Tambah
@endsection
@section('content')
<form action="{{ url('user') }}" method="POST" >
    @csrf
    <div class="form-group mb-3">
        <label for="namaUser">Nama User</label>
        <input class="form-control" id="namaUser" name="namaUser" type="text" placeholder="Nama User" />
        @error('namaUser')
            <span class="text text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email">
        @error('email')
            <span class="text text-danger">{{ $message }}"</span>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password">
        @error('password')
            <span class="text text-danger">{{ $message }}"</span>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label for="roleName">Role</label>
        <select name="roleName" id="roleName" class="form-control">
            <option value="">Pilih Role</option>
            <option value="Admin">Admin</option>
            <option value="Member">Member</option>
        </select>
        @error('roleName')
            <span class="text text-danger">{{ $message }}"</span>
        @enderror
    </div>

    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
        <button class="btn btn-success" type="submit">Simpan</button>
    </div>
</form>
@endsection
