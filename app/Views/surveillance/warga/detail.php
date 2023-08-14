<?= $this->extend('template/surveillance/layout') ?>

<?= $this->section('css') ?>
<?= $this->endSection('css') ?>
<?= $this->section('content') ?>
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h5>Detail Warga</h5>
        </div>
        <div class="card-body">
            <div class="container">
                <div class="container mt-3 mb-5">
                    <div class="form-group row mt-2">
                        <label for="nik" class="col-md-1 text-end">NIK</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="nik" id="nik" placeholder="NIK" value="<?= $warga->warga_nik ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label for="nama" class="col-md-1 text-end">Nama</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?= $warga->warga_nama ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label for="rt_rw" class="col-md-1 text-end">RT/RW</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="rt_rw" id="rt_rw" placeholder="RT/RW" value="<?= $warga->warga_rt_rw ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label for="jk" class="col-md-1 text-end">Jenis Kelamin</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="jk" id="jk" placeholder="Jenis Kelamin" value="<?= $warga->warga_jk == 'L' ? 'Laki - Laki' : 'Perempuan' ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label for="usia" class="col-md-1 text-end">Usia</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="usia" id="usia" placeholder="Usia" value="<?= $warga->warga_usia ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label for="kecamatan" class="col-md-1 text-end">Kecamatan</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="kecamatan" id="kecamatan" placeholder="kecamatan" value="<?= $warga->desa->kecamatan->kecamatan_nama ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label for="desa" class="col-md-1 text-end">Desa</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="desa" id="desa" placeholder="Desa" value="<?= $warga->desa->desa_nama ?>" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('js') ?>
<?= $this->endSection('js') ?>