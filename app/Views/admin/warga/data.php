<?= $this->extend('template/admin/layout') ?>

<?= $this->section('css') ?>
<link rel="stylesheet" href="<?= base_url('plugins/select2/select2.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('plugins/datatables/datatables.min.css') ?>">
<?= $this->endSection('css') ?>
<?= $this->section('content') ?>
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h5>Data Warga</h5>
        </div>
        <div class="card-body">
            <div class="container">
                <div class="container mt-3 mb-5">
                    <a href="<?= base_url('admin/warga/tambah') ?>" class="btn btn-primary">Tambah Warga</a>
                    <form id="formCari">
                        <div class="row mt-2">
                            <div class="col-md-2">
                                <select class="form-select selectKecamatan" name="kecamatan_id" style="width: 100%;">
                                    <?php foreach ($kecamatans as $kecamatan) : ?>
                                        <option value="<?= $kecamatan->kecamatan_id ?>"><?= $kecamatan->kecamatan_nama ?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="col-md-3 selectsDesa">
                            </div>
                        </div>
                    </form>
                </div>

                <div class="container mb-5">
                    <div class="messageApi"></div>
                    <div class="table-responsive tableData"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('js') ?>
<script src="<?= base_url('plugins/select2/select2.min.js') ?>"></script>
<script src="<?= base_url('plugins/sweetalert2/sweetalert2.min.js') ?>"></script>
<script src="<?= base_url('plugins/datatables/datatables.min.js') ?>"></script>
<script>
    function getTable() {
        var formData = new FormData($('#formCari')[0])
        $.ajax({
            method: "POST",
            url: "<?= base_url('admin/warga') ?>",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function(xhr) {
                $('.tableData').html('')
            },
            complete: function(res) {
                $('.tableData').html(res.responseText)
            }
        });
    }
    $(document).ready(function() {
        $('.selectKecamatan').select2();
        $('.selectKecamatan').on('change', function() {
            var formData = new FormData()
            formData.append('kecamatan', $(this).val())
            $.ajax({
                method: "POST",
                url: "<?= base_url('admin/warga/get_desa') ?>",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                beforeSend: function(xhr) {
                    $('.selectsDesa').html('')
                },
                complete: function(res) {
                    $('.selectsDesa').html(res.responseText)
                    getTable()
                }
            });
        })
        getTable()
    });
</script>
<?= $this->endSection('js') ?>