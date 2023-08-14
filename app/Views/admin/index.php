<?= $this->extend('template/admin/layout') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <div class="container">
        <h4 class="mb-1">Selamat Datang, <?= $_user->user_nama ?></h4>
        <p class="mb-3">Halaman dashboard admin, dapat melihat status data bansos </p>
        <br>


        <div class="container mb-5">
            <div class="card">
                <div class="card-header">
                    <h6 class="text-center">Status data bansos yang belum di approve</h6>
                </div>
                <div class="container mt-5">

                    <div class="card-body">
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
                                                <h1 class="text-center"><?= number_format($jenis_bansos->getJumlahByStatus(0)) ?></h1>
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