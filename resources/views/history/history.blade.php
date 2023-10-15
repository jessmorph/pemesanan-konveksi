@extends('layouts.main')
@push('head')
    <!-- Script Datepicker -->
    <script src="{{ asset('js/datepicker.js') }}"></script>
@endpush
@section('container')
    @if (Auth::user()->role_id == 1)
        <div class="row mt-5">
            <div class="d-flex align-items-center gap-4 justify-content-end">
                <label for="omzet" class="text-white">Total Omset</label>
                <input type="text" name="omzet" id="omzet" class="ps-5 pe-5 pt-3 pb-3 text-center"
                    value="{{ parseCurrency($totalOmset) }}" readonly>
            </div>
        </div>
    @endif

    <div class="row mt-5">
        <div class="col">
            <form action="/history" method="get">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="search" class="mb-3 text-white">Cari nama pemesan:</label>
                        <input type="text" class="form-control" placeholder="Nama Pemesan" name="q"
                            value="{{ app('request')->input('q') }}">
                    </div>
                    <div class="col-md-6">
                        <label for="startDate" class="mb-3 text-white">Filter tanggal: </label>
                        <div class="input-group" id="reportrange">
                            <input class="form-control range" type="text" disabled name="datefilter"
                                placeholder="Pilih tanggal" />
                            <span class="input-group-text clear-date" style="cursor: pointer">
                                <span class="close">X</span>
                            </span>
                            <span class="input-group-text calendar" style="cursor: pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-calendar" viewBox="0 0 16 16">
                                    <path
                                        d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
                                </svg>
                            </span>
                        </div>
                        <input type="hidden" name="startDate">
                        <input type="hidden" name="endDate">
                    </div>
                    <div class="col-md-2 mt-3">
                        <label for="search"></label>
                        <input type="submit" class="form-control" value="Search">
                    </div>
                </div>
            </form>
        </div>
    </div>
    @include('history.listhistory')
    <div class="bg-white p-2 mb-0 rounded no-padding">
        {{ $dataHistory->links() }}
    </div>
@endsection
