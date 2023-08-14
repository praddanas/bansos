<?= $this->extend('template/admin/layout') ?>

<?= $this->section('css') ?>
<?= $this->endSection('css') ?>
<?= $this->section('content') ?>
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h5>Tambah Kecamatan</h5>
        </div>
        <div class="card-body">
            <div class="container">
                <div class="container mt-3 mb-5">
                    <div class="messageApi"></div>
                    <form>
                        <div class="form-group row mt-2">
                            <label for="nama" class="col-md-1 text-end">Nama</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="">
                                <div class="errorApi errorApi_nama invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12 d-grid gap-2">
                                <button class="btn btn-primary btn-block btnProcess">Tambah</button>
                                <button type="button" class="btn btn-primary btn-block btnLoading" disabled>Menambahkan...</button>
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
<script>
    $(document).ready(function() {
        $('.btnProcess').show()
        $('.btnLoading').hide()
        $('form').submit(function(e) {
            e.preventDefault()
            var formData = new FormData($(this)[0])
            $.ajax({
                method: "POST",
                url: "<?= base_url('admin/kecamatan/tambah') ?>",
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
    })
</script>
<?= $this->endSection('js') ?>