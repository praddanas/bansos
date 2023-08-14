<table class="table" id="datatabledata">
    <thead>
        <tr class="text-center">
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Jenis</th>
            <th scope="col">Belum Diproses</th>
            <th scope="col">Diterima</th>
            <th scope="col">Ditolak</th>
            <th scope="col">Opsi</th>
        </tr>
    </thead>
    <tbody class="table-group-divider">
        <?php

        $no_bansos = 1;
        foreach ($bansoss as $bansos) :
        ?>
            <tr class="text-center">
                <th scope="row"><?= $no_bansos ?></th>
                <td><?= $bansos->bansos_nama ?></td>
                <td><?= $bansos->jenis->jenis_nama ?></td>
                <td><?= $bansos->getJumlahWargaKecamatan(0,$_user->kecamatan_id) ?></td>
                <td><?= $bansos->getJumlahWargaKecamatan(1,$_user->kecamatan_id) ?></td>
                <td><?= $bansos->getJumlahWargaKecamatan(2,$_user->kecamatan_id) ?></td>
                <td>
                    <a type="button" href="<?= base_url('surveillance/data_bansos/' . $bansos->id . "/warga") ?>" class="btn btn-warning">Warga</a>
                </td>
            </tr>
        <?php
            $no_bansos++;
        endforeach ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        let table = new DataTable('#datatabledata', {
            'destroy': true
        })
    })
</script>