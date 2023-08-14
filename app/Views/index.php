<?= $this->extend('template/user/layout') ?>
<?= $this->section('content') ?>
<div style="background: url(<?= base_url('image/user/background.jpg') ?>); height:450px; color:#f3f5f2; background-size:cover; background-attachment: fixed;background-repeat: no-repeat;">
    <div class="container" style="padding-top: 150px;">
        <div class="container-fluid pl-5">
            <h1 style="text-shadow: 2px 2px #000000;">
                Selamat Datang
            </h1>
        </div>
    </div>

    <div class="container">
        <div class="container-fluid pl-5">
            <div class="row">
                <div class="col-9">
                    <p style="text-align:justify; text-shadow: 1px 1px #000000;">Halaman website bantuan sosial dari instansi DINSOSDALDUKDAKBP3A Kabupaten Purbalingga yang berisikan informasi mengenai bantuan sosial yang akan diberikan kepada masyarakat yang sudah terdaftar dan terdapat informasi langkah-langkah pengambilan bantuan sosial.</p>
                </div>
                <div class="col-sm">
                </div>
                <div class="col-sm">
                </div>
            </div>
        </div>
    </div>

</div>

<div class="container mt-5 mb-5">
    <div class="row align-items-start">
        <div class="col-lg-6 mb-5">
            <div class="container">
                <img src="<?= base_url('image/user/kantor.jpg') ?>" style="width:100%;">
            </div>
        </div>
        <div class="col">
            <h4>DINSOSDALDUKDAKBP3A</h4>
            <p style="text-align: justify;">DINSOSDALDUKKBP3A Kabupaten Purbalingga mempunyai tugas membantu Bupati melaksanakan urusan pemerintahan dalam bidang sosial, pengendalian penduduk dan Keluarga Berencana (KB), pemberdayaan perempuan dan perlindungan anak yang menjadi kewenangan daerah salah satunya meliputi sebagai berikut :</p>
            <ul style="text-align: justify;">
                <li>Pemberdayaan sosial seperti pemberian bantuan sosial kepada warga yang tidak mampu </li>
                <li>Rehabilitasi sosial yaitu rehabilitasi sosial bukan atau tidak termasuk bekas korban penyalahgunaan NAPZA dan orang dengan HIV/AIDS </li>
                <li>Penanganan warga negara migran kobran tindak kekerasan yaitu pemulangan warga negara migran korban kekerasan dari titik debarkasi di Daerah untuk dipulangkan ke Desa atau Kelurahan asal</li>
            </ul>
            <p>Maka dari itu instansi DINSOSDALDUKDAKBP3A juga mengadakan kegiatan sosial berupa pemberian bantuan sosial setiap tahun dan dengan prosuder yang telah ditetapkan.</p>
        </div>
    </div>
</div>

<?= $this->endSection() ?>