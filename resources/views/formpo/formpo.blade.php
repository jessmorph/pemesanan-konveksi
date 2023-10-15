@extends('layouts.pdf')

@section('container')

<div class="row border bg-white m-5">
    <div class="row">
    <a class=" mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <img src="{{  public_path('static/logo.jpeg') }}" alt="gambar" style="width: 25%;"> 
    </a>
        <h1 class="text-center">Purchase Order</h1>
    </div>

    <table class="ms-5 mt-3">
        <tr>
            <th>Our Ref</th>
            <td>:</td>
            <td>Konveksi Gundjaja Abadi</td>
            <td></td>
            <th>Kepada</th>
            <td>:</td>
            <td><input class="col-6 border-0" type="text" disabled value="{{ $dataTransaksi->pemesan }}" /></td>
        </tr>
        <tr>
            <th>Telepon</th>
            <td>:</td>
            <td>08112229919</td>
            <td></td>
            <th>Telepon</th>
            <td>:</td>
            <td> <input class="col-6 border-0" type="text" disabled value="{{ $dataTransaksi->noTelp }}" /></td>
        </tr>
        <tr>
            <th>Kota</th>
            <td>:</td>
            <td>Bandung</td>
            <td></td>
            <th>Kota</th>
            <td>:</td>
            <td><input class="col-6 border-0" type="text" disabled value="{{ $dataTransaksi->kota }}" /></td>
        </tr>
        <tr>
            <th>Alamat</th>
            <td>:</td>
            <td><textarea disabled class="form-control-sm col-6 border-0" name="" id="" cols="12" rows="5" value="" style="height:auto">Sarimadu Permai no. 179</textarea></td>
            <td></td>
            <th>Alamat</th>
            <td>:</td>
            <td><textarea disabled class="form-control-sm col-6 border-0" name="" id="" cols="12" rows="5" value="" style="height:auto">{{ $dataTransaksi->alamat }}</textarea></td>
        </tr>
        <tr>
            <th>Tanggal</th>
            <td>:</td>
            <td><input class="col-6 border-0" type="text" disabled value="{{ $dataTransaksi->created_at }}" /></td>
            <td></td>
            <th>Dikirim</th>
            <td>:</td>
            <td><input class="col-6 border-0" type="text" disabled value="{{ $dataTransaksi->deadline }}" /></td>
        </tr>
    </table>
    @foreach($dataBaju as $baju)
    <table class="mt-5" style="border: 1px solid black">
        <tr>
            <th style="border: 1px solid black; text-align:center">No.</th>
            <th style="border: 1px solid black; text-align:center" colspan="4">Deskripsi</th>
            <th style="border: 1px solid black; text-align:center">Quantity</th>
            <th style="border: 1px solid black; text-align:center">Harga/pcs</th>
            <th style="border: 1px solid black; text-align:center">Total</th>
        </tr>

        <tr>
            <th style="border: 1px solid black; text-align:center" rowspan="13">1.</th>
            <th style="border: 1px solid black; text-align:center">Bahan</th>
            <td style="border: 1px solid black; text-align:center" colspan="3">{{ $baju->bahan }}</td>
            <td style="border: 1px solid black; text-align:center" rowspan="13">{{ $baju->totalBaju }}</th>
            <td style="border: 1px solid black; text-align:center" rowspan="13">{{ $baju->hargaSatuan }}</td>
            <td style="border: 1px solid black; text-align:center" rowspan="13">{{ $baju->totalHarga }}</td>
        </tr>
        <tr>
            <th style="border: 1px solid black">Warna</th>
            <td style="border: 1px solid black; text-align:center" colspan="3">{{ $baju->warna }}</td>
        </tr>
        <tr>
            <th style="border: 1px solid black">Model</th>
            <td style="border: 1px solid black; text-align:center" colspan="3">{{ $baju->model }}</td>
        </tr>
        <tr>
            <th style="border: 1px solid black">Nama</th>
            <td style="border: 1px solid black; text-align:center" colspan="3">{{ $baju->name }}</td>
        </tr>
        <tr>
            <th style="border: 1px solid black; text-align:center" rowspan="9">Size</th>
            <td>XXS</td>
            <td>:</td>
            <td><input class="col-6 border-0" type="text" disabled value="{{ $baju->xxs }}" /></td>
        </tr>
        <tr>
            <td>XS</td>
            <td>:</td>
            <td><input class="col-6 border-0" type="text" disabled value="{{ $baju->xs }}" /></td>
        </tr>
        <tr>
            <td>S</td>
            <td>:</td>
            <td><input class="col-6 border-0" type="text" disabled value="{{ $baju->s }}" /></td>
        </tr>
        <tr>
            <td>M</td>
            <td>:</td>
            <td><input class="col-6 border-0" type="text" disabled value="{{ $baju->m }}" /></td>
        </tr>
        <tr>
            <td>L</td>
            <td>:</td>
            <td><input class="col-6 border-0" type="text" disabled value="{{ $baju->l }}" /></td>
        </tr>
        <tr>
            <td>XL</td>
            <td>:</td>
            <td><input class="col-6 border-0" type="text" disabled value="{{ $baju->xl }}" /></td>
        </tr>
        <tr>
            <td>XXL</td>
            <td>:</td>
            <td><input class="col-6 border-0" type="text" disabled value="{{ $baju->xxl }}" /></td>
        </tr>
        <tr>
            <td>XXXL</td>
            <td>:</td>
            <td><input class="col-6 border-0" type="text" disabled value="{{ $baju->xxxl }}" /></td>
        </tr>
        <tr>
            <td>XXXXL</td>
            <td>:</td>
            <td><input class="col-6 border-0" type="text" disabled value="{{ $baju->xxxxl }}" /></td>
        </tr>


    </table>

    <div class="mt-3">
        <div>
            <label>Keterangan</label> <br>
            <textarea disabled class="col-10" name="" id="" cols="30" rows="1" style="height:auto">{{ $baju->keterangan }}</textarea>
        </div>
    </div>

    @if($loop->first)
    <div style="page-break-after: always;"></div>
    @endif
    @endforeach

    <table class="mt-4" style="border: 1px solid black">
        <tr>
            <th style="border: 1px solid black">Total</th>
            <th style="border: 1px solid black">{{ $dataTransaksi->total_qty }}</th>
        </tr>
        <tr>
            <th style="border: 1px solid black">DP {{ $dataTransaksi->persen_DP }}%</th>
            <th style="border: 1px solid black">{{ $dataTransaksi->total_DP }}</th>
        </tr>
        <tr>
            <th style="border: 1px solid black">Grand Total</th>
            <th style="border: 1px solid black">{{ $dataTransaksi->total_transaksi }}</th>
        </tr>
    </table>

    @foreach($dataBaju as $baju)
    <div style="page-break-after: always;"></div>
    @if($baju->gambar)
    <div class="row mt-4">
        <div class="col-3"></div>
        <div class="col-6 border rounded d-flex flex-column p-2">
            <span class="mb-3">DESAIN {{ $loop->iteration }}</span>
            <img src="{{ public_path($baju->gambar) }}" alt="gambar" style="width: 100%;">
        </div>
    </div>
    @endif
    @endforeach

    <table>
        <tr>
            <td><strong>Keterangan Tambahan</strong></td>
        </tr>
        <tr>
            <td><textarea disabled name="" id="" cols="13" rows="5" style="height: auto;">{{ $dataTransaksi->ket_tambahan }}</textarea></td>
        </tr>

        <tr>
            <td><strong>Syarat dan Ketentuan</strong></td>
        </tr>
        <tr>
            <textarea disabled name="" id="" cols="20" rows="5" style="height:auto">{{ $dataTransaksi->sk }}</textarea>
        </tr>
    </table>

    <table style="border: 1px solid black; padding: 15px">
        <tr>
            <th style="text-align: center; font-size:x-small; margin-top: -5px">TANDA TANGAN PRODUSEN</th>
            <th style="text-align: center; border: 1px solid black">Setuju dengan lembar ini tidak akan terjadi perubahan, jika ada maka harus
                dengan persetujuan 2 belah pihak
            </th>
            <th style="text-align: center; font-size:x-small;">TANDA TANGAN PEMESAN</th>
        </tr>
        <tr >
            <th style="text-align: center;">(.............................)</th>
            <th class="mt-3" style="text-align: center; border: 1px solid black">Apabila barang tidak diambil dalam waktu 30 hari, maka resiko rusak, 
                hilang bukan tanggung jawab kami
            </th>
            <th style="text-align: center; margin-top: 10px">(.............................)</th>
        </tr>
    </table>
</div>


@endsection