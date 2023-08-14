<?= $this->extend('template/admin/layout') ?>

<?= $this->section('css') ?>
<link rel="stylesheet" href="<?= base_url('plugins/select2/select2.min.css') ?>">
<?= $this->endSection('css') ?>
<?= $this->section('content') ?>
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h5>Edit Warga</h5>
        </div>
        <div class="card-body">
            <div class="container">
                <div class="container mt-3 mb-5">
                    <div class="messageApi"></div>
                    <form>
                        <div class="form-group row mt-2">
                            <label for="nik" class="col-md-1 text-end">NIK</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="nik" id="nik" placeholder="NIK" value="<?= $warga->warga_nik ?>">
                                <div class="errorApi errorApi_nik invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row mt-2">
                            <label for="nama" class="col-md-1 text-end">Nama</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?= $warga->warga_nama ?>">
                                <div class="errorApi errorApi_nama invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row mt-2">
                            <label for="rt_rw" class="col-md-1 text-end">RT/RW</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="rt_rw" id="rt_rw" placeholder="RT/RW" value="<?= $warga->warga_rt_rw ?>">
                                <div class="errorApi errorApi_rt_rw invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row mt-2">
                            <label for="jk" class="col-md-1 text-end">Jenis Kelamin</label>
                            <div class="col-md-8">
                                <select class="form-select" name="jk" id="jk">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="L" <?= $warga->warga_jk == 'L' ? 'selected' : '' ?>>Laki - Laki</option>
                                    <option value="P" <?= $warga->warga_jk == 'P' ? 'selected' : '' ?>>Perempuan</option>
                                </select>
                                <div class="errorApi errorApi_jk invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row mt-2">
                            <label for="usia" class="col-md-1 text-end">Usia</label>
                            <div class="col-md-8">
                                <input type="number" min="0" class="form-control" name="usia" id="usia" placeholder="Usia" value="<?= $warga->warga_usia ?>">
                                <div class="errorApi errorApi_usia invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row mt-2">
                            <label for="kecamatan" class="col-md-1 text-end">Kecamatan</label>
                            <div class="col-md-8">
                                <select class="form-select selectKecamatan" name="kecamatan_id" style="width: 100%;">
                                    <option value="">Pilih Kecamatan</option>
                                    <?php foreach ($kecamatans as $kecamatan) : ?>
                                        <option value="<?= $kecamatan->kecamatan_id ?>" <?= $warga->desa->kecamatan_id == $kecamatan->kecamatan_id ? 'selected' : '' ?>><?= $kecamatan->kecamatan_nama ?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                                <div class="errorApi errorApi_kecamatan_id invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row mt-2 formSelectDesa">
                            <label for="desa" class="col-md-1 text-end">Desa</label>
                            <div class="col-md-8 selectsDesa">

                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12 d-grid gap-2">
                                <button class="btn btn-primary btn-block btnProcess">Simpan</button>
                                <button type="button" class="btn btn-primary btn-block btnLoading" disabled>Menyimpan...</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('js') ?>
<script src="<?= base_url('plugins/select2/select2.min.js') ?>"></script>
<script>
    $(document).ready(function() {
        $('.btnProcess').show()
        $('.btnLoading').hide()
        $('.formSelectDesa').hide()
        $('form').submit(function(e) {
            e.preventDefault()
            var formData = new FormData($(this)[0])
            $.ajax({
                method: "POST",
                url: "<?= base_url('admin/warga/' . $warga->warga_id . "/edit") ?>",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                beforeSend: function(xhr) {
                    $('.btnProcess').hide()
                    $('.btnLoading').show()
                    $('.errorApi').html('')
                    $('.is-invalid').removeClass('is-invalid')
                },
                complete: function(res) {
                    if (res.status === 200) {
                        var data = res.responseJSON;
                        if (data.status) {
                            $('.messageApi').html('<div class="alert alert-success">' +
                                data
                                .message + '</div>')
                            setTimeout(() => {
                                window.location.href = data.data.redir;
                            }, 1000);
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
                    $('.btnProcess').show()
                    $('.btnLoading').hide()
                }
            })
        })
        $('.selectKecamatan').select2();

        $('.selectKecamatan').on('change', function() {
            var formData = new FormData()
            formData.append('kecamatan', $(this).val())
            formData.append('desa_id', "<?= $warga->desa_id ?>")
            $.ajax({
                method: "POST",
                url: "<?= base_url('admin/warga/get_desa_form') ?>",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                beforeSend: function(xhr) {
                    $('.selectsDesa').html('')
                    $('.formSelectDesa').hide()
                },
                complete: function(res) {
                    $('.formSelectDesa').show()
                    $('.selectsDesa').html(res.responseText)
                }
            });
        })
        $('.selectKecamatan').trigger('change');
    })
</script>
<?= $this->endSection('js') ?>