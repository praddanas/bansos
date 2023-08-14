<?= $this->extend('template/surveillance/layout') ?>
<?= $this->section('content') ?>
<div class="container mt-5">
    <div class="row">
        <div class="col"></div>
        <div class="col-5">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Admin</h3>
                </div>
                <div class="card-body">
                    <form>

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Username</label>
                            <input type="text" class="form-control" id="exampleInputPassword1">

                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button class="btn btn-secondary">Kembali</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col"></div>
    </div>

</div>
<?= $this->endSection() ?>