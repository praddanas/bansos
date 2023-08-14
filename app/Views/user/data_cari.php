<?= $this->extend('template/user/layout') ?>

<?= $this->section('content') ?>
<?php

use App\Models\Warga;

$warga = model(Warga::class)->where('warga_nik', htmlspecialchars($_GET['nik']))->first();
if (!$warga) :
?>
    <div class="container mt-5 mb-5" style="height: 750px;">
        <div class="card">
            <div class="card-header">
                <h5>Data Bansos</h5>
            </div>
            <div class="card-body">
                Maaf Warga Dengan NIK <?= $_GET['nik'] ?> tidak ditemukan
            </div>
        </div>
    </div>
<?php else : ?>
    <div class="container mt-5 mb-5" style="height: 750px;">
        <div class="card">
            <div class="card-header">
                <h5>Data Bansos</h5>
            </div>
            <div class="card-body">
                <table>
                    <tr>
                        <td width="70">NIK</td>
                        <td width="30">:</td>
                        <td><?= $warga->warga_nik ?></td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td><?= $warga->warga_nama ?></td>
                    </tr>
                </table>
                <br>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th width="5">No</th>
                            <th>Bantuan Sosial</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $bansoss = $warga->bansos;
                        $no = 1;
                        foreach ($bansoss as $bansos) :
                        ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $bansos->bansos->bansos_nama ?></td>
                                <td><?php
                                    if ($bansos->status == 1) {
                                        echo "Terverifikasi";
                                    } else if ($bansos->status == 2) {
                                        echo "Ditolak";
                                    } else {
                                        echo "Diproses";
                                    }
                                    ?></td>
                            </tr>
                        <?php
                            $no++;
                        endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php endif ?>
<?= $this->endSection() ?>