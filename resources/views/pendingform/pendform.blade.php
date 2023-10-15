@extends('layouts.main')
@push('head')
<!-- Script Add Baju -->
<script src="{{ asset('js/onprogress/onProgress.js') }}"></script>
@endpush
@section('container')

<table class="table text-center table-striped table-hover mt-5">
  <thead>
    <tr>
      <th scope="col">No.</th>
      <th scope="col">Tanggal Dibuat</th>
      <th scope="col">Pemesan</th>
      <th scope="col">Telpon</th>
      <th scope="col">Pembuat</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php $index = 1; ?>
    <?php foreach ($dataPend as $d) : ?>
      <tr>
        <th scope="row"><?= $index++ ?></th>
        <td><?= $d->created_at ?></td>
        <td><?= $d->pemesan ?></td>
        <td><?= $d->noTelp ?></td>
        <td><?= $d->namaUser ?></td>
        <td>
          <input type="hidden" name="transactions-{{ $d->id }}" value="{{ $d->pemesan }}">
          <button><a href="/input-form/{{ $d->id }}">Edit</a></button>
          <button type="button" class="delete" id="{{ $d->id }}" data-bs-toggle="modal" data-bs-target="#deleteProgress">Delete</button>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
@include('partials.modals.delete')
@endsection