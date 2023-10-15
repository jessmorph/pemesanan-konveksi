@extends('layouts.main')
@push('head')
    <!-- Script Add User -->
    <script src="{{ asset('js/user/user.js') }}"></script>
@endpush
@section('container')
    <div class="row mt-5">
        <div class="d-flex justify-content-end">
            @if (Auth::user()->role_id == 1)
                <button type="button" class="btn btn-primary btn-tambah-user" data-bs-toggle="modal"
                    data-bs-target="#tambahRole">
                    Tambah User
                </button>
            @endif
        </div>
    </div>
    @include('user.listuser')
    @if (Auth::user()->role_id == 1)
        @include('user.modaluser')
    @endif
    @include('partials.modals.delete')
@endsection
