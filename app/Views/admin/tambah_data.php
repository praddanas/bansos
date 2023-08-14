<?= $this->extend('template/surveillance/layout') ?>
<?= $this->section('content') ?>

<div class="container">
    <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-10">
            <div class="container mt-5 mb-5">
                <div class="card" style="width:70%;">
                    <div class="card-header">
                        <h5>Tambah Data Warga</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nama</label>
                                <input type="text" class="form-control" style="width: 70%;">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">NIK</label>
                                <input type="text" class="form-control" style="width: 50%;">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Kecamatan</label>
                                <select class="form-select" style="width: 35%;" aria-label="Disabled select example" disabled>
                                    <option selected>Silahkan Pilih</option>
                                    <option value="1">Kandang Gampang</option>
                                    <option value="2">Selatri</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Desa</label>
                                <select class="form-select" style="width: 35%;">
                                    <option selected>Silahkan Pilih</option>
                                    <option value="1">Kandang Gampang</option>
                                    <option value="2">Selatri</option>
                                </select>
                            </div>
                            <div class="form-outline mb-4">
                                <label for="exampleInputEmail1" class="form-label">Alamat</label>
                                <textarea class="form-control" id="form7Example7" rows="4" style="width: 55%;"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Jenis Kelamin</label>
                                <select class="form-select" style="width: 25%;">
                                    <option selected>Silahkan Pilih</option>
                                    <option value="1">Laki-laki</option>
                                    <option value="2">Perempuan</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Usia</label>
                                <input type="text" class="form-control" style="width: 10%;">
                            </div>
                            <div class="mb-4">
                                <label for="exampleInputEmail1" class="form-label">Jenis Bantuan Sosial</label>
                                <select class="form-select" style="width: 35%;">
                                    <option selected>Silahkan Pilih</option>
                                    <option value="1">Bansos Yatim</option>
                                    <option value="2">Bansos ODKB</option>
                                    <option value="3">Bansos Paket Sembako Penyandang Disabilitas</option>
                                    <option value="3">Bansos Paket Sembako Lansia</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Tambah</button>
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-1"></div>
    </div>
</div>

<?= $this->endSection() ?>