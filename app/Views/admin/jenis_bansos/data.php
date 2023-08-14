<?= $this->extend('template/admin/layout') ?>

<?= $this->section('css') ?>
<link rel="stylesheet" href="<?=base_url('plugins/select2/select2.min.css')?>">
<link rel="stylesheet" href="<?=base_url('plugins/datatables/datatables.min.css')?>">
<?= $this->endSection('css') ?>
<?= $this->section('content') ?>
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h5>Data Jenis Bansos</h5>
        </div>
        <div class="card-body">
            <div class="container">
                <div class="container mt-3 mb-5">
                    <a href="<?=base_url('admin/jenis_bansos/tambah')?>" class="btn btn-primary">Tambah Jenis Bansos</a>
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
<script src="<?=base_url('plugins/select2/select2.min.js')?>"></script>
<script src="<?=base_url('plugins/sweetalert2/sweetalert2.min.js')?>"></script>
<script src="<?=base_url('plugins/datatables/datatables.min.js')?>"></script>
<script>
    function getTable() {
        var formData = new FormData()
        $.ajax({
            method: "POST",
            url: "<?=base_url('admin/jenis_bansos')?>",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function (xhr) {
                $('.tableData').html('')
            },
            complete: function (res) {
                $('.tableData').html(res.responseText)
            }
        });
    }
    $(document).ready(function () {
        getTable()
    });
</script>
<?= $this->endSection('js') ?>