<title><?= $title; ?></title>

<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600' rel='stylesheet' type='text/css'>

<link href="<?= base_url() ?>/auth/fontawesome/css/all.css" rel="stylesheet">

<link href="<?= base_url() ?>/auth/style.css" rel="stylesheet">
<div class="testbox">
    <h1>Login</h1>
    <form action="/AuthController/loginProses" method="POST">
        <?= csrf_field(); ?>
        <hr>
        <?php if (session()->getFlashdata('message')) : ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('message') ?></div>
        <?php endif; ?>


        <label id="icon" for="email"><i class="fas fa-user"></i></label>
        <input type="text" name="email" class="form-control <?= session()->getFlashdata('email') ? 'error' : '' ?>" id="email" placeholder="Email" />

        <label id="icon" for="name"><i class="fas fa-shield-alt"></i></label>
        <input type="password" name="password" class="form-control <?= session()->getFlashdata('password') ? 'error' : '' ?>" id="password" placeholder="Password" />

        <button type="submit" class="button">Login</button>
    </form>
</div>