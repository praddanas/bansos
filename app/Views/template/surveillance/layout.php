<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$page_title ?? 'Dashboard'?></title>
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>" />
    <?= $this->renderSection('css') ?>
</head>

<body>

    <?= $this->include('template/surveillance/navbar') ?>
    <?= $this->renderSection('content') ?>


    <script src="<?= base_url('js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('js/popper.min.js') ?>"></script>
    <script src="<?= base_url('js/bootstrap.min.js') ?>"></script>
    <?= $this->renderSection('js') ?>
</body>

</html>