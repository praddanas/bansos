<?= $this->extend('template/surveillance/layout') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h5>Data Warga</h5>
        </div>
        <div class="card-body">
            <div class="container">
                <div class="container mt-3 mb-5">
                    <div class="row">
                        <div class="col-lg-6"><select class="form-select" aria-label="Default select example" style="width: 50%;">
                                <option selected>Desa</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select></div>
                        <div class="col-4"><input type="text" class="form-control"></div>
                        <div class="col-2"><button class="btn btn-primary">Cari</button></div>
                    </div>
                </div>

                <div class="container mb-5">
                    <table class="table">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">NIK</th>
                                <th scope="col">Kecamatan</th>
                                <th scope="col">Desa</th>
                                <th scope="col">Opsi</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            <tr class="text-center">
                                <th scope="row">1</th>
                                <td>Anda</td>
                                <td>330216237182</td>
                                <td>Purbalingga</td>
                                <td>Purbalingga Lor</td>
                                <td>
                                    <button class="btn btn-warning">Lihat</button>
                                    <button class="btn btn-primary">Edit</button>
                                    <button class="btn btn-danger">Hapus</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>


                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>