<?= $this->extend('template/surveillance/layout') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <div class="container">
        <h4 class="mb-2">Selamat Datang, <?= $_user->user_nama ?></h4>
        <p>Halaman dashboard berisikan status data bantuan sosial</p>
        <br>
        <div class="container">

            <div class="card">
                <div class="card-header">
                    <h6>Halaman dashboard admin, dapat melihat status data bansos</h6>
                </div>
                <div class="card-body">
                    <div class="container mt-5">
                        <h5>Status data bansos yang belum di approve</h5>
                        <div class="container mt-3">
                            <div class="row">
                                <?php foreach ($jenis_bansoss as $jenis_bansos) : ?>
                                    <div class="col-lg-5">
                                        <div class="card mb-5">
                                            <div class="card-header">
                                                <?= $jenis_bansos->jenis_nama ?>
                                            </div>
                                            <div class="card-body">
                                                <h6 class="text-center">Jumlah</h6>
                                                <h1 class="text-center"><?= number_format($jenis_bansos->getJumlahByStatusKecamatan(0, $_user->kecamatan_id)) ?></h1>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg"> </div>
                                    <div class="col-lg"> </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>
</div>

<?= $this->endSection() ?>