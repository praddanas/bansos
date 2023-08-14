<?= $this->extend('template/user/layout') ?>

<?= $this->section('content') ?>

<div class="container" style="height: 900px;">
    <div class="row">
        <div class="col"></div>
        <div class="col-lg-8">
            <div class="container pt-5">
                <div class="card">
                    <h4 class="card-header">Cari Data</h4>
                    <div class="card-body">
                        <p class="card-text">Silahkan masukan NIK anda, jika anda terdaftar untuk mendapatkan bantuan sosial maka data akan muncul pada halaman website (harap isi dengan teliti dan benar).</p>
                        <form action="<?= base_url('data_cari') ?>" method="get">
                            <div class="row">
                                <div class="col-lg-5 mt-2">
                                    <input type="text" class="form-control" name="nik" placeholder="Masukan NIK">
                                </div>
                                <div class="col mt-2">
                                    <button class="btn btn-primary" type="submit"> Cari </button>
                                </div>
                                <div class="col mt-2"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col"></div>
    </div>
</div>

<?= $this->endSection() ?>