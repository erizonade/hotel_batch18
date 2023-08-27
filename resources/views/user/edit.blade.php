@extends('layouts.app')
@section('title')
    User Edit
@endsection
@section('content')
<form action="{{ url('user/'.$user->id) }}" method="POST" >
    @csrf
    @method('PATCH')
    <div class="form-group mb-3">
        <label for="namaUser">Nama User</label>
        <input class="form-control" id="namaUser" name="namaUser" type="text" value="{{ $user->name }}" placeholder="Nama User" />
        @error('namaUser')
            <span class="text text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" value="{{ $user->email }}" name="email">
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
            @foreach (['Admin', 'Member'] as $item)
                <option value="{{ $item }}" {{ $user->role_name == $item ? 'selected' : '' }}>{{ $item }}</option>
            @endforeach
            {{-- <option value="Admin" {{ $user->role_name == 'Admin' ? 'selected' : '' }}>Admin</option>
            <option value="Member" {{ $user->role_name == 'Member' ? 'selected' : '' }}>Member</option> --}}
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
