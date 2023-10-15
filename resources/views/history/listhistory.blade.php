<table class="table text-center table-striped table-hover mt-5">
    <thead>
        <tr>
            <th scope="col">No.</th>
            <th scope="col">Tanggal</th>
            <th scope="col">Pemesan</th>
            <th scope="col">Form</th>
            <th scope="col">Penyetuju</th>
        </tr>
    </thead>
    <tbody>
        <?php $index = 1; ?>
        @if (count($dataHistory) < 1)
            <tr>
                <td colspan="6">
                    No data available!
                </td>
            </tr>
        @else
            <?php foreach ($dataHistory as $d) : ?>
            <tr>
                <th scope="row"><?= $index++ ?></th>
                <td><?= $d->updated_at ?></td>
                <td><?= $d->pemesan ?></td>
                <td>
                    <button><a href="formpo/{{ $d->id }}">Form PO</a></button>
                    <button><a href="worksheet/{{ $d->id }}">Worksheet</a></button>
                    <button><a href="forminvoice/{{ $d->id }}">Invoice</a></button>
                </td>
                </td>
                <td><?= $d->namaUser ?></td>
            </tr>
            <?php endforeach; ?>
        @endif
    </tbody>
</table>
