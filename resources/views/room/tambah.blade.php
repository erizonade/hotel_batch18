@extends('layouts.app')
@section('title')
    Tambah
@endsection
@section('content')
    <form action="{{ url('rooms') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group mb-3">
            <label for="hotel_id">Hotel</label>
            <select name="hotel_id" id="hotel_id" class="form-control">
                <option value="">Pilih Hotel</option>
                @foreach ($hotel as $item)
                    <option value="{{ $item->id }}">{{ $item->nama_hotel }}</option>
                @endforeach
            </select>
            @error('hotel_id')
                <span class="text text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="room_name">Nama Room</label>
            <input class="form-control" id="room_name" name="room_name" type="text" placeholder="Nama Room" />
            @error('room_name')
                <span class="text text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="room_price">Room Harga</label>
            <input class="form-control" id="room_price" name="room_price" type="number" placeholder="Harga" />
            @error('room_price')
                <span class="text text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="room_description">Room Deskripsi</label>
            <textarea name="room_description" class="form-control" id="room_description" cols="30" rows="4"></textarea>
            @error('room_description')
                <span class="text text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="room_photo">Room Foto</label>
            <input class="form-control" id="room_photo" name="room_photo" type="file" placeholder="Foto" />
            @error('room_photo')
                <span class="text text-danger">{{ $message }}</span>
            @enderror
        </div>


        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
            <button class="btn btn-success" type="submit">Simpan</button>
        </div>
    </form>
@endsection
