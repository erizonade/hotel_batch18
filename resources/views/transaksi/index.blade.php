@extends('layouts.app')
@section('title')
    Transaksi
@endsection
@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <h3>Transaksi</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>User Booking</th>
                        <th>Bukti Bayar</th>
                        <th>Room</th>
                        <th>Checkin - Checkout</th>
                        <th>Method Bayar</th>
                        <th>Total Bayar</th>
                        <th>Status Booking</th>
                        <th>Aksi</th>
                    </tr>
                    <tbody>
                        @foreach ($data as $res)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $res->user->name }}</td>
                                <td>
                                    @if ($res->bukti_bayar)
                                        <a href="{{ asset('transaksi/'.$res->bukti_bayar) }}" target="_blank"><img src="{{ asset('transaksi/'.$res->bukti_bayar) }}" width="100px" height="100px" alt=""></a>
                                    @else
                                        Bukti Belum diupload
                                    @endif
                                </td>
                                <td>{{ $res->room->room_name }} <br> {{ number_format($res->room_price) }}</td>
                                <td>{{ $res->check_in }} s.d {{ $res->check_out }}</td>
                                <td>{{ $res->methode_bayar }}</td>
                                <td>{{ number_format($res->total) }}</td>
                                <td>
                                    @switch($res->status)
                                        @case(0)
                                            <div class="btn btn-info btn-sm">SELESAI UPLOAD BUKTI BAYAR</div>
                                            @break
                                        @case(1)
                                            <div class="btn btn-sm btn-success">TRANSAKSI SELESAI</div>
                                            @break
                                        @case(2)
                                            <div class="btn btn-sm btn-warning">BELUM UPLOAD BUKTI BAYAR</div>
                                            @break
                                        @case(3)
                                            <div class="btn btn-sm btn-primary">Member Selesai Menginap</div>
                                            @break

                                    @endswitch
                                </td>
                                <td>
                                    @if ($res->status == 0)
                                        <a href="{{ url('approve/'.$res->id) }}" class="btn btn-sm btn-success">KOMFIRMASI PERMBAYARAN</a>
                                    @elseif ($res->status == 1)
                                        <a href="{{ url('done/'.$res->id) }}" class="btn btn-sm btn-success">SELESAI MENGINAP</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </thead>
            </table>
        </div>
    </div>
@endsection
