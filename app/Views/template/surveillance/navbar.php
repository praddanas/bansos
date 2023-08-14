<nav class="navbar navbar-expand-lg bg-success" data-bs-theme="dark">
    <div class="container-fluid">
        <div class="navbar-brand">
            Surveillance
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?= base_url('surveillance') ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?= base_url('surveillance/warga') ?>">Data
                        Warga</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?= base_url('surveillance/data_bansos') ?>">Data
                        Bansos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?= base_url('logout') ?>">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>