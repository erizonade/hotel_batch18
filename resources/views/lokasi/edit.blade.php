@extends('layouts.app')
@section('title')
    Edit
@endsection
@section('content')
    <form action="{{ url('master-lokasi/'.$data->id) }}" method="POST" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <input type="hidden" name="idHotel" id="idHotel">

        <div class="form-group mb-3">
            <label for="namaLokasi">Nama Lokasi</label>
            <input class="form-control" id="namaLokasi" name="namaLokasi" type="text" placeholder="Nama Hotel"
            value="{{ $data->nama_lokasi }}" />

            @error('namaLokasi')
                <span class="text text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="fotoLokasi">Foto Lokasi</label>
            <input class="form-control" id="fotoLokasi" name="fotoLokasi" type="file" placeholder="Foto Hotel" />

            @error('fotoLokasi')
                <span class="text text-danger">{{ $message }}</span>
            @enderror
        </div>


        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
            <button class="btn btn-success" type="submit">Update</button>
        </div>
    </form>
@endsection
