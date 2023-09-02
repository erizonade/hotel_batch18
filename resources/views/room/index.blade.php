@extends('layouts.app')
@section('title')
    Master Room
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
            <table class="table" width="100" border="1">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Hotel</th>
                        <th>Foto Room</th>
                        <th>Nama Room</th>
                        <th>Deskripsi</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                @foreach ($data as $res)
                    <tbody>
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $res->hotel->nama_hotel }}</td>
                            <td>{{ $res->nama_hotel }}</td>
                            <td>{{ $res->alamat_hotel }}</td>
                            <td><img src="{{ asset('hotel/'.$res->foto_hotel) }}" width="100" height="100" alt=""></td>
                            <td>{{ $res->harga_hotel }}</td>
                            <td>
                                <a href="{{ url('master-hotel/'.$res->id.'/edit') }}" class="btn btn-info">Ubah</a>
                                <form action="{{ url('master-hotel/'. $res->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger" type="submit">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                @endforeach

            </table>
        </div>
    </div>
@endsection
