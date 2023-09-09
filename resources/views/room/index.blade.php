@extends('layouts.app')
@section('title')
    Room Hotel
@endsection
@section('content')

    @if(session('status'))
        <div class="alert alert-succes">
            {{ session('status') }}
        </div>
    @endif

<div class="card">
    <div class="card-header">
        <a href="{{ url('room/create') }}" class="btn btn-info">Tambah</a>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Room Foto</th>
                    <th>Nama Hotel</th>
                    <th>Nama Room</th>
                    <th>Room Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>
@endsection
