<table class="table" id="datatabledata">
    <thead>
        <tr class="text-center">
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">NIK</th>
            <th scope="col">Kecamatan</th>
            <th scope="col">Desa</th>
            <th scope="col">RT/RW</th>
            <th scope="col">Jenis Kelamin</th>
            <th scope="col">Usia</th>
            <th scope="col">Status</th>
            <th scope="col">Opsi</th>
        </tr>
    </thead>
    <tbody class="table-group-divider">
        <?php

        use App\Models\Desa;
        use App\Models\Warga;

        $no_warga = 1;
        foreach ($bansos_wargas as $bansos_warga) :
            $warga = model(Warga::class)->where('warga_nik', $bansos_warga['bansos_warga_nik'])->get()->getRowArray();
            $desa = model(Desa::class)->where('desa_id', $bansos_warga['desa_id'])->first();
        ?>
            <tr class="text-center">
                <th scope="row"><?= $no_warga ?></th>
                <td><?= $warga['warga_nama'] ?></td>
                <td><?= $bansos_warga['bansos_warga_nik'] ?></td>
                <td><?= $desa->kecamatan->kecamatan_nama ?></td>
                <td><?= $desa->desa_nama ?></td>
                <td><?= $bansos_warga['warga_rt_rw'] ?></td>
                <td><?= $warga['warga_jk'] == 'L' ? 'Laki - Laki' : 'Perempuan' ?></td>
                <td><?= $bansos_warga['warga_usia'] ?></td>
                <td>
                    <?php if ($bansos_warga['status'] == 0) : ?>
                        Belum Diproses
                    <?php elseif ($bansos_warga['status'] == 1) : ?>
                        Diterima
                    <?php else : ?>
                        Ditolak
                    <?php endif ?>
                </td>
                <td>
                    <?php if ($bansos_warga['status'] == 0) : ?>
                        <button class="btn btn-danger btnHapusData" data-id="<?= $bansos_warga['bansos_warga_id'] ?>">Hapus</button>
                    <?php else : ?>
                        -
                    <?php endif ?>
                </td>
            </tr>
        <?php
            $no_warga++;
        endforeach ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        let table = new DataTable('#datatabledata', {
            'destroy': true,
            'dom': 'Bfrtip',
            'buttons': [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        })
        $('#datatabledata').on('click', '.btnHapusData', function() {
            var id = $(this).data('id')
            Swal.fire({
                title: "Yakin ingin menghapus data ini?",
                showCancelButton: true,
                icon: 'warning',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#3085d6',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    var formData = new FormData()
                    $.ajax({
                        method: "POST",
                        url: "<?= base_url('surveillance/data_bansos/' . $bansos->id . "/warga") ?>/" + id + '/delete',
                        data: formData,
                        processData: false,
                        contentType: false,
                        cache: false,
                        beforeSend: function(xhr) {
                            $('.messageApi').html('')
                        },
                        complete: function(res) {
                            if (res.status === 200) {
                                var data = res.responseJSON;
                                if (data.status) {
                                    $('.messageApi').html('<div class="alert alert-success">' +
                                        data
                                        .message + '</div>')
                                    getTable()
                                } else {
                                    $('.messageApi').html('<div class="alert alert-danger">' +
                                        data
                                        .message + '</div>')
                                }
                            } else {
                                if (res.status === 400) {
                                    $('.messageApi').html('<div class="alert alert-danger">' +
                                        res
                                        .responseJSON.message + '</div>')
                                    var data = res.responseJSON.data
                                    for (key in data) {
                                        if (data.hasOwnProperty(key)) {
                                            $("[name=" + key + "]").addClass('is-invalid')
                                            $('.errorApi_' + key).html(data[key])
                                        }
                                    }
                                } else {
                                    $('.messageApi').html(
                                        '<div class="alert alert-danger"> Error ' +
                                        res.status + '</div>')
                                }
                            }

                        }
                    });
                }
            })
        })
    })
</script>