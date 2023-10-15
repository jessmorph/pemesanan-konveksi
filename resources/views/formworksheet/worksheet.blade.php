@extends('layouts.pdf')

@section('container')
<div class="row border bg-white m-5">
    @foreach ($data as $baju)
    <div class="row">
    <a class=" mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <img src="{{  public_path('static/logo.jpeg') }}" alt="gambar" style="width: 25%;"> 
    </a>
        <h1 class="text-center">Work Sheet</h1>
        <div class="col-3"></div>
        <div style="text-align:center">
            @if ($baju->gambar)
            <img src="{{ public_path($baju->gambar) }}" alt="gambar" width="80%">
            @else
            <h5 class="mb-0">Tidak ada desain</h5>
            @endif
        </div>
    </div>
    <div>
        <label><strong>Keterangan Desain</strong></label> <br>
        <textarea class="form-control form-control-sm" name="" id="" cols="13" rows="5" disabled style="height: auto;">{{ $baju->keterangan }}</textarea>
    </div>

    <table class="table ms-5 border mt-5" style="width: 65vw; background-color:none;">
        <tbody>
            <tr class="ms-2">
                <th scope="col">XXS</th>
                <th scope="col">:</th>
                <th scope="col"><input class="col-8" type="text" disabled value="{{ $baju->xxs }}" /></th>
                <th scope="col">XS</th>
                <th scope="col">:</th>
                <th scope="col"><input class="col-8" type="text" disabled value="{{ $baju->xs }}" /></th>
                <th scope="col">S</th>
                <th scope="col">:</th>
                <th scope="col"><input class="col-8" type="text" disabled value="{{ $baju->s }}" /></th>
            </tr>
            <tr class="ms-2">
                <th scope="col">M</th>
                <th scope="col">:</th>
                <th scope="col"><input class="col-8" type="text" disabled value="{{ $baju->m }}" /></th>
                <th scope="col">L</th>
                <th scope="col">:</th>
                <th scope="col"><input class="col-8" type="text" disabled value="{{ $baju->l }}" /></th>
                <th scope="col">XL</th>
                <th scope="col">:</th>
                <th scope="col"><input class="col-8" type="text" disabled value="{{ $baju->xl }}" /></th>
            </tr>
            <tr class="ms-2">
                <th scope="col">XXL</th>
                <th scope="col">:</th>
                <th scope="col"><input class="col-8" type="text" disabled value="{{ $baju->xxl }}" /></th>
                <th scope="col">XXXL</th>
                <th scope="col">:</th>
                <th scope="col"><input class="col-8" type="text" disabled value="{{ $baju->xxxl }}" />
                </th>
                <th scope="col">XXXXL</th>
                <th scope="col">:</th>
                <th scope="col"><input class="col-8" type="text" disabled value="{{ $baju->xxxxl }}" />
                </th>
            </tr>
        </tbody>
    </table>

    <table style="border: 1px solid black">
        <th>Total Quantity : </th>
        <th><input class="border-0" type="text" disabled value="{{ $baju->totalBaju }}" /></th>
    </table>
    @if ($loop->remaining > 0)
    <div style="page-break-after: always;"></div>
    @endif
    @endforeach
</div>
@endsection