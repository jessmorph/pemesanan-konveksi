@extends('layouts.pdf')

@section('container')



<div class="row border bg-white m-3">
    <div class="row">
    <a class=" mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <img src="{{  public_path('static/logo.jpeg') }}" alt="gambar" style="width: 25%;"> 
    </a>
        <h1 class="text-center">Invoice</h1>
    </div>
    <table class="mb-5">
        <tr style="border: 1px solid black">
            <td>No. Invoice</td>
            <td><input class="border-0" type="text" disabled value="{{ $dataTransaksi->NoPO }}" /></td>
        </tr>
        <tr style="border: 1px solid black">
            <td>Tanggal</td>
            <td><input class="border-0" type="text" disabled value="{{ $dataTransaksi->created_at }}" /></td>
        </tr>
        <tr style="border: 1px solid black">
            <td>Kepada</td>
            <td><input class="border-0" type="text" disabled value="{{ $dataTransaksi->pemesan }}" /></td>
        </tr>
    </table>

    <table style="border: 1px solid black">
        <thead>
            <tr style="border: 1px solid black" class="text-center">
                <th style="border: 1px solid black" scope="col">No.</th>
                <th style="border: 1px solid black" scope="col">Nama</th>
                <th style="border: 1px solid black" scope="col">Quantity</th>
                <th style="border: 1px solid black" scope="col">Harga/pcs</th>
                <th style="border: 1px solid black" scope="col">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dataBaju as $baju)
            <tr style="border: 1px solid black" class="text-center">
                <th style="border: 1px solid black" scope="row">1</th>
                <td style="border: 1px solid black">{{ $baju->model }} | {{ $baju->bahan }} | {{ $baju->warna}}</td>
                <td style="border: 1px solid black">{{ $baju->totalBaju }}</td>
                <td style="border: 1px solid black">{{ $baju->hargaSatuan }}</td>
                <td style="border: 1px solid black">{{ $baju->totalHarga }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <table class="mt-3" style="border: 1px solid black">
        <tr style="border: 1px solid black">
            <th>DP</th>
            <th>:</th>
            <th><input class="border-0 text-center" type="text" disabled value="{{ $dataTransaksi->total_DP }}" /></th>
        </tr>
        <tr style="border: 1px solid black">
            <th>Grand Total</th>
            <th>:</th>
            <th><input class="border-0 text-center" type="text" disabled value="{{ $dataTransaksi->total_transaksi }}" /></th>
        </tr>
    </table>
</div>


@endsection