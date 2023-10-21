<table class="table text-center table-striped table-hover mt-2 p-2">
    <thead>
        <tr>
            <th scope="col">No.</th>
            <th scope="col">Username</th>
            <th scope="col">Nama</th>
            <th scope="col">Role</th>
            @if (Auth::user()->role_id == 1)
                <th scope="col">Aksi</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $d)
            <tr class="">
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $d->username }}</td>
                <td>{{ $d->namaUser }}</td>
                <td>{{ $d->roleName }}</td>
                @if (Auth::user()->role_id == 1)
                    <td>
                        <button class="btn-edit-user" id={{ $d->id }}>Edit</button>
                        <button class="btn-delete-user bg-danger" style="color:white" value="{{ $d->namaUser }}" id={{ $d->id }}>Delete</button>
                    </td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
