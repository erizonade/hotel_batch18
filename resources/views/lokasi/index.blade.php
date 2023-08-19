@extends('layouts.app')
@section('title')
    Master Lokasi
@endsection

@section('content')

    @if(session('status'))
        <div class="alert alert-succes">
            {{ session('status') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <a href="{{ url('master-lokasi/create') }}" class="btn btn-info">Tambah</a>
        </div>
        <div class="card-body">
            <table class="table" width="100" border="1">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Foto Lokasi</th>
                        <th>Nama Lokasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                @foreach ($lokasi as $res)
                    <tbody>
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $res->nama_lokasi }}</td>
                            <td><img src="{{ asset('lokasi/'.$res->foto_lokasi) }}" width="100" height="100" alt=""></td>
                            <td>
                                <a href="{{ url('master-lokasi/'.$res->id.'/edit') }}" class="btn btn-info">Ubah</a>
                                <form action="{{ url('master-lokasi/'. $res->id) }}" method="POST">
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
