<nav class="navbar navbar-expand-lg bg-dark border-bottom border-bottom-dark" data-bs-theme="dark">
    <div class="container-fluid">
        <div class="navbar-brand">
            <img src="<?= base_url('image/user/logo_navbar.png') ?>" alt="Logo" height="30" class="d-inline-block align-text-top">
            DINSOSDALDUKDAKBP3A Purbalingga
        </div>



        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?= base_url('') ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?= base_url('cari_data') ?>">Cari Data</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Informasi
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= base_url('informasi_bantuan') ?>">Bantuan Sosial</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('informasi_pembagian') ?>">Alur Pembagian Bantuan Sosial</a></li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</nav>