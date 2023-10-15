@extends('layouts.main')
@push('head')
    <!-- Script Add Baju -->
    <script src="{{ asset('js/inputform/inputForm.js') }}"></script>
@endpush
@section('container')
    @if (session()->has('successUpdate'))
        <div class="alert alert-success alert-dismissible fade show mt-4 mb-0" role="alert">
            {{ session('successUpdate') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <form class="input-form" enctype="multipart/form-data"
        action="{{ isset($dataTransaksi) ? '/transactions/update' : '/transactions' }}" method="POST">
        @csrf
        <input type="hidden" name="listBaju" id="listBaju" value="{{ isset($dataBaju) ? $dataBaju : '' }}">
        @if (Request::segment(1) == 'input-form' && Request::segment(2))
            <input type="hidden" name="id" value="{{ Request::segment(2) }}">
        @endif
        <input type="hidden" name="user-id" value="{{ Auth::user()->role_id }}">
        <input type="hidden" name="type">
        <div class="row d-flex justify-content-center align-items-center mt-5">
            <div class="row border bgBox text-center my-auto">

                <h2>Lembar Kerja Konveksi Gundjaja Abadi</h2>

            </div>
            <div class="row bgBox border-start border-end border-bottom  ">

                <div class="col-6 border-end pt-1">
                    <div class="row pt-1">
                        <label class="col-2 text-center my-auto" for="">Deadline </label>
                        <h5 class="col-auto my-auto ">:</h5>
                        <input class="col-3 form-control-sm text-center border-0  my-auto" id="deadline" name="deadline"
                            type="date" placeholder="dd-mm-yyyy"
                            value="{{ isset($dataTransaksi->deadline) ? $dataTransaksi->deadline : '' }}" />

                        <label class="col-2 text-center my-auto" for="">Telepon </label>
                        <h5 class="col-auto my-auto ">:</h5>
                        <input class="col-3 form-control-sm text-center border-0  my-auto" id="noTelp" name="noTelp"
                            type="number" placeholder="081xxxxxxxx"
                            value="{{ isset($dataTransaksi->noTelp) ? $dataTransaksi->noTelp : '' }}" />
                    </div>

                    <div class="row mt-3">
                        <label class="col-2 text-center my-auto" for="">Pemesan </label>
                        <h5 class="col-auto my-auto ">:</h5>
                        <input class="col-9 form-control-sm text-center border-0  my-auto" id="pemesan" name="pemesan"
                            type="text" placeholder="pemesan" style="text-transform: capitalize;"
                            value="{{ isset($dataTransaksi->pemesan) ? $dataTransaksi->pemesan : '' }}" />
                    </div>
                </div>

                <div class="col-6 pt-1 mb-2">
                    <div class="row pt-1">
                        <label class="col-2 text-center my-auto" for="">Kota</label>
                        <h5 class="col-auto my-auto ">:</h5>
                        <input class="col-3 form-control-sm text-center border-0  my-auto" id="kota" name="kota"
                            type="text" placeholder="kota" style="text-transform: capitalize;"
                            value="{{ isset($dataTransaksi->kota) ? $dataTransaksi->kota : '' }}" />

                        <label class="col-2 text-center my-auto" for="">Provinsi </label>
                        <h5 class="col-auto my-auto ">:</h5>
                        <input class="col-3 form-control-sm text-center border-0  my-auto" id="provinsi" name="provinsi"
                            type="text" placeholder="provinsi" style="text-transform: capitalize;"
                            value="{{ isset($dataTransaksi->provinsi) ? $dataTransaksi->provinsi : '' }}" />
                    </div>

                    <div class="row mt-3">
                        <label class="col-2 text-center my-auto" for="">Alamat </label>
                        <h5 class="col-auto my-auto ">:</h5>
                        <div class="col-8 ms-0 ps-0">
                            <textarea class="col-10 form-control form-control-sm" id="alamat" name="alamat" cols="12" rows="2"
                                placeholder="Alamat" style="text-transform: capitalize;">{{ isset($dataTransaksi->alamat) ? $dataTransaksi->alamat : '' }}</textarea>

                        </div>
                    </div>
                </div>
            </div>
            @include('inputform.listbaju')
        </div>

        <div class="row border-bottom border-start bgBox">
            <div class="col-6 ">
            </div>
            <div class="col-6 border">
                <div class="row border-bottom bgBox">
                    <label class="col-4 border-end d-flex align-items-center justify-content-center"
                        for=""><strong>Total Quantity</strong></label>
                    <label class="col-4 border-end d-flex align-items-center justify-content-center"
                        for=""><strong>Harga Total</strong></label>
                    <label class="col-1 d-flex align-items-center justify-content-center"
                        for=""><strong>DP</strong></label>
                    <input class="col-2 d-flex align-items-center justify-content-center form-control-sm text-center"
                        type="number" name="persenDP" id="persenDP" min="0" placeholder="0"
                        value="{{ isset($dataTransaksi->persen_DP) ? $dataTransaksi->persen_DP : '' }}">
                    <label class="col-1 d-flex align-items-center justify-content-center" for="">%</label>
                </div>
                <div class="row">
                    <input class="col-4 border-end d-flex align-items-center justify-content-center text-center"
                        type="text" id="totalPOQty" disabled
                        value="{{ isset($dataTransaksi->total_qty) ? $dataTransaksi->total_qty : '' }}" />
                    <input type="hidden" name="totalPOQty"
                        value="{{ isset($dataTransaksi->total_qty) ? $dataTransaksi->total_qty : '' }}" />
                    <input class="col-4 border-end d-flex align-items-center justify-content-center text-center"
                        type="text" id="hargaPOTotal" disabled
                        value="{{ isset($dataTransaksi->total_transaksi_currency) ? $dataTransaksi->total_transaksi_currency : '' }}" />
                    <input type="hidden" name="hargaPOTotal"
                        value="{{ isset($dataTransaksi->total_transaksi) ? $dataTransaksi->total_transaksi : '' }}" />
                    <input class="col-4 border-end d-flex align-items-center justify-content-center text-center"
                        type="text" id="hargaPODP" disabled
                        value="{{ isset($dataTransaksi->total_DP_currency) ? $dataTransaksi->total_DP_currency : '' }}" />
                    <input type="hidden" name="hargaPODP"
                        value="{{ isset($dataTransaksi->total_DP) ? $dataTransaksi->total_DP : '' }}" />
                </div>
            </div>
        </div>

        <div class="row bgBox border-end border-start pt-2 pb-2">
            <label><strong>Keterangan Tambahan</strong></label>
            <textarea class="form-control form-control-sm " name="keteranganTambahan" id="keteranganTambahan" cols="13"
                rows="4" placeholder="Masukan keterangan">{{ isset($dataTransaksi->ket_tambahan) ? $dataTransaksi->ket_tambahan : '' }}</textarea>
        </div>
        <div class="row bgBox border-end border-start border-top pt-2 pb-2">
            <label><strong>Syarat dan Ketentuan</strong></label>
            <textarea class="form-control form-control-sm" name="sk" id="sk" cols="13" rows="5"
                placeholder="Masukan keterangan">{{ isset($dataTransaksi->sk) ? $dataTransaksi->sk : '' }}</textarea>
        </div>
        <div class="border-bottom border-start border-top row bgBox">
            <div class="col-2 d-flex justify-content-center align-items-center ">
                <Button>
                    <input class="form-control" style="background-color: transparent" type="submit"
                        value="Pending" id="pending-form" />
                </Button>
            </div>
            <div
                class="col-4 border-start border-end text-center d-flex justify-content-center align-items-center pt-3 pb-3">
                <p class="my-auto">
                    <strong>
                        Setuju dengan lembar ini tidak akan terjadi perubahan, jika ada maka harus
                        dengan persetujuan 2 belah pihak
                    </strong>
                </p>
            </div>
            <div class="col-4 border-end text-center d-flex justify-content-center align-items-center pt-3 pb-3">
                <p class="my-auto">
                    <strong>
                        Apabila barang tidak diambil dalam waktu 30 hari, maka resiko rusak, hilang bukan tanggung jawab
                        kami
                    </strong>
                </p>
            </div>
            @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                <div class="col-2 d-flex justify-content-center align-items-center border-end">
                    <Button>
                        <input class="form-control" style="background-color: transparent" type="submit"
                            value="Submit" id="submit-form" />
                    </Button>
                </div>
            @endif
        </div>
    </form>
    <!-- modal -->
    @include('inputform.modalinput')
    @include('inputform.deletebaju')
    @include('inputform.preview')
@endsection
