@extends('layouts.app')
@section('title')
    Edit
@endsection
@section('content')
    <form action="{{ url('master-hotel/'.$data->id) }}" method="POST" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <input type="hidden" name="idHotel" id="idHotel">

        <div class="form-group mb-3">
            <label for="namaHotel">Nama Hotel</label>
            <input class="form-control" id="namaHotel" name="namaHotel" type="text" placeholder="Nama Hotel"
            value="{{ $data->nama_hotel }}" />

            @error('namaHotel')
                <span class="text text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="alamatHotel">Alamat Hotel</label>
            <textarea name="alamatHotel" id="alamatHotel" class="form-control" cols="10" rows="5">
                {{ $data->alamat_hotel }}
            </textarea>

            @error('alamatHotel')
                <span class="text text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="hargaHotel">Harga Hotel</label>
            <input class="form-control" id="hargaHotel" name="hargaHotel" type="number" placeholder="Harga Hotel"
            value="{{ $data->harga_hotel }}" />

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
            <button class="btn btn-success" type="submit">Update</button>
        </div>
    </form>
@endsection
