@extends('layouts.app')
@section('title')
    Tambah
@endsection
@section('content')
    <form action="{{ url('master-hotel/store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-3">
            <label for="namaHotel">Nama Hotel</label>
            <input class="form-control" id="namaHotel" name="namaHotel" type="text" placeholder="Nama Hotel" />
            @error('namaHotel')
                <span class="text text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="alamatHotel">Alamat Hotel</label>
            <textarea name="alamatHotel" id="alamatHotel" class="form-control" cols="10" rows="5"></textarea>
            @error('alamatHotel')
                <span class="text text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="hargaHotel">Harga Hotel</label>
            <input class="form-control" id="hargaHotel" name="hargaHotel" type="number" placeholder="Harga Hotel" />
            @error('hargaHotel')
                <span class="text text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="fotoHotel">Foto Hotel</label>
            <input class="form-control" id="fotoHotel" name="fotoHotel" type="file" placeholder="Foto Hotel" />
            @error('fotoHotel')
                <span class="text text-danger">{{ $message }}</span>
            @enderror
        </div>


        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
            <button class="btn btn-success" type="submit">Simpan</button>
        </div>
    </form>
@endsection
