<?= $this->extend('template/surveillance/layout') ?>

<?= $this->section('css') ?>
<link rel="stylesheet" href="<?= base_url('plugins/select2/select2.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('plugins/datatables/datatables.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('plugins/datatables/plugins/buttons/css/buttons.bootstrap5.min.css') ?>">
<?= $this->endSection('css') ?>
<?= $this->section('content') ?>
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h5>Data Bansos Warga</h5>
        </div>
        <div class="card-body">
            <div class="container">
                <div class="container mb-5">
                    <a href="<?= base_url('surveillance/data_bansos/' . $bansos->id . '/warga/tambah') ?>" class="btn btn-primary mb-2">Tambah Data Warga</a>
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
<script src="<?= base_url('plugins/datatables/plugins/buttons/js/dataTables.buttons.min.js') ?>"></script>
<script src="<?= base_url('plugins/datatables/plugins/buttons/js/buttons.bootstrap5.min.js') ?>"></script>
<script src="<?= base_url('plugins/datatables/plugins/buttons/js/jszip.min.js') ?>"></script>
<script src="<?= base_url('plugins/datatables/plugins/buttons/js/buttons.html5.min.js') ?>"></script>
<script src="<?= base_url('plugins/datatables/plugins/buttons/js/buttons.print.min.js') ?>"></script>
<script>
    function getTable() {
        var formData = new FormData()
        $.ajax({
            method: "POST",
            url: "<?= base_url('surveillance/data_bansos/' . $bansos->id . "/warga") ?>",
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
        getTable()
    });
</script>
<?= $this->endSection('js') ?>