@extends('layouts.main')
@push('head')
    <!-- Script Add Baju -->
    <script src="{{ asset('js/onprogress/onProgress.js') }}"></script>
@endpush
@section('container')
    <table class="table mt-5">
        <thead>
            <tr>
                <th scope="col">No.</th>
                <th scope="col">No. PO</th>
                <th scope="col">Selesai</th>
                <th scope="col">Pemesan</th>
                @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                    <th scope="col">Form PO</th>
                @endif
                <th scope="col">Worksheet</th>
                @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                    <th scope="col">Invoice</th>
                @endif
                <th scope="col">Aksi</th>
                <th scope="col">Pembuat</th>
            </tr>
        </thead>
        <tbody>
            <?php $index = 1; ?>
            <?php foreach ($data as $d) : ?>
            <tr>
                <th scope="row"><?= $index++ ?></th>
                <td><?= $d->NoPO ?></td>
                <td><?= $d->deadline ?></td>
                <td><?= $d->pemesan ?></td>
                @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                    <td><button><a href="formpo/{{ $d->id }}">Form PO</a></button></td>
                @endif
                <td><button><a href="worksheet/{{ $d->id }}">Worksheet</a></button></td>
                @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                    <td><button><a href="forminvoice/{{ $d->id }}">Invoice</a></button></td>
                @endif
                <td>
                    <input type="hidden" name="transactions-{{ $d->id }}" value="{{ $d->NoPO }}">
                    @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                        <button type="button" class="selesai" id="{{ $d->id }}" data-bs-toggle="modal"
                            data-bs-target="#selesaiProgress">Selesai</button>
                    @endif
                    @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                        <button><a href="/input-form/{{ $d->id }}">Edit</a></button>
                    @endif
                    @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                        <button type="button" class="bg-danger delete" id="{{ $d->id }}" style="color:white"
                            data-bs-toggle="modal" data-bs-target="#deleteProgress">Delete</button>
                    @endif
                </td>
                <td><?= $d->namaUser ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    @include('partials.modals.delete')
    @include('partials.modals.selesai')
@endsection
