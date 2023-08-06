@extends('layouts.app')
@section('title')
    Master Hotel
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ url('master-hotel/create') }}" class="btn btn-info">Tambah</a>
        </div>
        <div class="card-body">
            <table class="table" width="100" border="1">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Hotel</th>
                        <th>Alamat Hotel</th>
                        <th>Foto Hotel</th>
                        <th>Harga Hotel</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                @foreach ($hotel as $res)
                    <tbody>
                        <tr>
                            <td>{{ $res->id }}</td>
                            <td>{{ $res->nama_hotel }}</td>
                            <td>{{ $res->alamat_hotel }}</td>
                            <td><img src="{{ asset('hotel/'.$res->foto_hotel) }}" width="100" height="100" alt=""></td>
                            <td>{{ $res->harga_hotel }}</td>
                            <td>
                                <a href="{{ url('master-hotel/'.$res->id.'/edit') }}" class="btn btn-info">Ubah</a>
                                <a href="" class="btn btn-danger">Hapus</a>
                            </td>
                        </tr>
                    </tbody>
                @endforeach

            </table>
        </div>
    </div>
@endsection
