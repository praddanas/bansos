<?= $this->extend('template/surveillance/layout') ?>

<?= $this->section('css') ?>
<link rel="stylesheet" href="<?=base_url('plugins/select2/select2.min.css')?>">
<link rel="stylesheet" href="<?=base_url('plugins/datatables/datatables.min.css')?>">
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
                    <a href="<?=base_url('surveillance/warga/tambah')?>" class="btn btn-primary">Tambah Warga</a>
                    <form id="formCari">
                        <div class="row mt-2">
                            <div class="col-md-2">
                                <select class="form-select selectDesa" name="desa_id" style="width: 100%;">
                                    <option value="-1">Semua Desa</option>
                                    <?php foreach($desas as $desa):?>
                                    <option value="<?=$desa->desa_id?>"><?=$desa->desa_nama?>
                                    </option>
                                    <?php endforeach?>
                                </select>
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
<script src="<?=base_url('plugins/select2/select2.min.js')?>"></script>
<script src="<?=base_url('plugins/sweetalert2/sweetalert2.min.js')?>"></script>
<script src="<?=base_url('plugins/datatables/datatables.min.js')?>"></script>
<script>
    function getTable() {
        var formData = new FormData($('#formCari')[0])
        $.ajax({
            method: "POST",
            url: "<?=base_url('surveillance/warga')?>",
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
        $('.selectDesa').select2();
        $('.selectDesa').on('change', function () {
            getTable()
        })
    });
</script>
<?= $this->endSection('js') ?>