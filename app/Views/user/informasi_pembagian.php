<?= $this->extend('template/user/layout') ?>

<?= $this->section('content') ?>

<div class="container pt-2" style="margin-bottom: 100px;">
    <div class="mt-5">
        <h3 class="text-center mb-4">Alur Pembagian Bantuan Sosial</h3>
        <div class="container">
            <p>Seusai dengan peraturan DINSOSDALDUKDAKBP3A setiap warga yang kurang mampu berhak mendapatkan bantuan sosial yang seusai dengan kebutuhan setiap warga, dengan itu instansi melakukan kegiatan pembagian bantuan sosial dengan alur pembagain sebagai berikut :</p>
        </div>
        <div class="container mt-4">
            <div class="row">
                <div class="col-lg-3">
                    <div class="card mb-3" style="height:500px;">
                        <img src="<?= base_url('image/user/alur1.jpg') ?>" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">1. Desa Mengajukan</h5>
                            <p class="card-text" style="text-align: justify;">
                                Desa akan mengecek warga yang berpontensi untuk mendapatkan bantuan sosial, kemudian warga didata dan data akan diserahkan ke kecamatan
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card mb-3" style="height:500px;">
                        <img src="<?= base_url('image/user/alur2.jpg') ?>" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">2. Kecamatan Cek Data dan Mengajukan</h5>
                            <p class="card-text" style="text-align: justify;">
                                Data yang diajukan dari desa akan dicek terlebih dahulu ke kecamatan, setelah dicek data akan diajukan ke kantor DINSOSDALDUKDAKBP3A
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card mb-3" style="height:500px;">
                        <img src="<?= base_url('image/user/alur3.jpg') ?>" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">3. Verifikasi Data</h5>
                            <p class="card-text" style="text-align: justify;">
                                Setelah data sampai DINSOSDALDUKDAKBP3A tahapan selanjutnya data akan dicek oleh tim pegawai untuk mengecek status DTKS jika data lolos verfikasi maka data akan diteruskan ke team Kecamatan agar segera dilakukan pembagian bantuan sosial
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card mb-3" style="height:500px;">
                        <img src="<?= base_url('image/user/alur4.jpg') ?>" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">4. Pembagian</h5>
                            <p class="card-text" style="text-align: justify;">
                                Proses pembagian bantuan akan dilakukan dengan tahapan dari DINSOSDALDUKDAKBP3A menyerahkan ke Kecamatan dan kemudian Kecamatan menyerahkan ke Desa atau Kelurahan
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection() ?>