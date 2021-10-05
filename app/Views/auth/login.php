<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>LOGIN FORM</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="<?= base_url(); ?>/admintemp/img/logo/icon.ico" type="image/x-icon" />

    <link rel="stylesheet" href="<?= base_url(); ?>/admintemp/css/fonts.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/admintemp/css/bootstrap.min.css">
    <style>
        body {
            background-image: url("https://d8it4huxumps7.cloudfront.net/uploads/images/opportunity/mobile_banner/5ea7081697ac7_lavakidneys_800x4002x-2db5e5a0c944e2b16a11a18674570f76.jpg");
        }
    </style>
</head>

<body>
    <div class="d-flex justify-content-center" style="margin-top: 150px;">
        <div class="card" style="width: 25rem; box-shadow: 10px 10px 0px rgba(14, 2, 2, 0.1);">
            <div class="card-body">
                <h2 class="text-center" style="text-shadow: 1px 1px 0px rgba(12, 0, 0, 13); color: #C84B31;">FORM LOGIN</h2>
                <hr>
                <form action="/AuthController/loginProses" method="POST">
                    <?= csrf_field(); ?>

                    <?php if (session()->getFlashdata('message')) : ?>
                        <?= session()->getFlashdata('message') ?>
                    <?php endif; ?>

                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" name="email" placeholder="Username">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-shield-alt"></i></span>
                            </div>
                            <input type="password" class="form-control" name="password" placeholder="Username">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" style="position: relative; width: 100%;">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>