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
        <a href="{{ url('rooms/create') }}" class="btn btn-info">Tambah</a>
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
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><img src="{{ asset('room/'.$item->room_photo) }}" width="100" height="100" alt=""></td>
                        <td>{{ $item->nama_hotel }}</td>
                        <td>{{ $item->room_name }}</td>
                        <td>{{ $item->room_price }}</td>
                        <td>
                            <a class="btn btn-info" href="{{ url('rooms/'.$item->id.'/edit') }}">Edit</a>
                            <form action="{{ url('rooms/'.$item->id) }}" method="POST">
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
