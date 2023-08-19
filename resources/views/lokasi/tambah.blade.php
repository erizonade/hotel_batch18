@extends('layouts.app')
@section('title')
    Tambah
@endsection
@section('content')
    <form action="{{ route('lokasi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-3">
            <label for="namaLokasi">Nama Lokasi</label>
            <input class="form-control" id="namaLokasi" name="namaLokasi" type="text" placeholder="Nama Lokasi" />
            @error('namaLokasi')
                <span class="text text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="fotoLokasi">Foto Lokasi</label>
            <input class="form-control" id="fotoLokasi" name="fotoLokasi" type="file" placeholder="Foto Lokasi" />
            @error('fotoLokasi')
                <span class="text text-danger">{{ $message }}</span>
            @enderror
        </div>


        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
            <button class="btn btn-success" type="submit">Simpan</button>
        </div>
    </form>
@endsection
