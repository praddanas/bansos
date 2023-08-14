<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>" />
</head>

<body style="background: url(<?= base_url('image/user/bg_login.jpg') ?>); background-size:fix;">

    <div class="container">
        <div class="container" style="margin-top: 150px;">
            <div class="row">
                <div class="col">
                    <div class="card" style="width:400px;">
                        <div class="card-header">
                            <h4>Login</h4>
                        </div>
                        <div class="card-body">
                            <div class="messageApi"></div>
                            <form id="formLogin">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" name="username">
                                    <div class="errorApi errorApi_username invalid-feedback"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                    <div class="errorApi errorApi_password invalid-feedback"></div>
                                </div>
                                <button type="submit" class="btn btn-primary btnProcess">Login</button>
                                <button type="button" class="btn btn-primary btnLoading" disabled>Login...</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-6 mt-5 mb-5">
                    <h2 style="color:white; text-shadow: 2px 2px #000000;">Aplikasi Pendataan Bantuan Sosial
                        DINSOSDALDUKDAKBP3A</h2>
                </div>
            </div>
        </div>
    </div>


    <script src="<?= base_url('js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('js/popper.min.js') ?>"></script>
    <script src="<?= base_url('js/bootstrap.min.js') ?>"></script>
    <script>
        $(document).ready(function () {
            $('.btnProcess').show()
            $('.btnLoading').hide()
            $('#formLogin').submit(function (e) {
                e.preventDefault()
                var formData = new FormData($(this)[0])
                $.ajax({
                    method: "POST",
                    url: "<?=base_url('login')?>",
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    beforeSend: function (xhr) {
                        $('.btnProcess').hide()
                        $('.btnLoading').show()
                        $('.errorApi').html('')
                        $('.is-invalid').removeClass('is-invalid')
                    },
                    complete: function (res) {
                        if (res.status === 200) {
                            var data = res.responseJSON;
                            if (data.status) {
                                $('.messageApi').html('<div class="alert alert-success">' +
                                    data
                                    .message + '</div>')
                                setTimeout(() => {
                                    window.location.href = data.data.redir;
                                }, 1000);
                            } else {
                                $('.messageApi').html('<div class="alert alert-danger">' +
                                    data
                                    .message + '</div>')
                            }
                        } else {
                            if (res.status === 400) {
                                $('.messageApi').html('<div class="alert alert-danger">' +
                                    res
                                    .responseJSON.message + '</div>')
                                var data = res.responseJSON.data
                                for (key in data) {
                                    if (data.hasOwnProperty(key)) {
                                        $("[name=" + key + "]").addClass('is-invalid')
                                        $('.errorApi_' + key).html(data[key])
                                    }
                                }
                            } else {
                                $('.messageApi').html(
                                    '<div class="alert alert-danger"> Error ' +
                                    res.status + '</div>')
                            }
                        }
                        $('.btnProcess').show()
                        $('.btnLoading').hide()
                    }
                })
            })
        })
    </script>
</body>

</html>