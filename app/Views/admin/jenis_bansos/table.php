<table class="table" id="datatabledata">
    <thead>
        <tr class="text-center">
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Opsi</th>
        </tr>
    </thead>
    <tbody class="table-group-divider">
        <?php

        $no_jenis_bansos = 1;
        foreach ($jenis_bansoss as $jenis_bansos) :
        ?>
            <tr class="text-center">
                <th scope="row"><?= $no_jenis_bansos ?></th>
                <td><?= $jenis_bansos->jenis_nama ?></td>
                <td>
                    <a type="button" href="<?= base_url('admin/jenis_bansos/' . $jenis_bansos->id . "/edit") ?>" class="btn btn-primary">Edit</a>
                    <button class="btn btn-danger btnHapusData" data-id="<?= $jenis_bansos->id ?>">Hapus</button>
                </td>
            </tr>
        <?php
            $no_jenis_bansos++;
        endforeach ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        let table = new DataTable('#datatabledata', {
            'destroy': true
        })
        $('#datatabledata').on('click', '.btnHapusData', function() {
            var id = $(this).data('id')
            Swal.fire({
                title: 'Yakin Ingin Menghapus data ini?',
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
                        url: "<?= base_url('admin/jenis_bansos') ?>/"+id+'/delete',
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