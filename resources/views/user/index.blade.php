@extends('layouts.app')
@section('title')
    User
@endsection
@section('content')

    @if(session('status'))
        <div class="alert alert-succes">
            {{ session('status') }}
        </div>
    @endif

<div class="card">
    <div class="card-header">
        <a href="{{ url('user/create') }}" class="btn btn-info">Tambah</a>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user as $res)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $res->name }}</td>
                        <td>{{ $res->email }}</td>
                        <td>{{ $res->role_name }}</td>
                        <td>
                            <a href="{{ url('user/'.$res->id.'/edit') }}" class="btn btn-info">Edit</a>
                            <form action="{{ url('user/'.$res->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
