<title><?= $title; ?></title>

<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600' rel='stylesheet' type='text/css'>

<link href="<?= base_url() ?>/auth/fontawesome/css/all.css" rel="stylesheet">

<link href="<?= base_url() ?>/auth/style.css" rel="stylesheet">
<div class="testbox">
    <h1>Registration</h1>

    <form action="/authcontroller/saveregister" method="POST">
        <?= csrf_field(); ?>
        <hr>
        <label id="icon" for="namaLengkap"><i class="fas fa-venus-mars"></i> </label>
        <input type="text" name="nama_lengkap" id="nama_lengkap" placeholder="Nama Lengkap" required />

        <label id="icon" for="username"><i class="fas fa-user"></i></label>
        <input type="text" name="username" id="username" placeholder="Username" required />

        <label id="icon" for="password"><i class="fas fa-shield-alt"></i></label>
        <input type="password" name="password" id="password" placeholder="Password" required />

        <label id="icon" for="confpassword"><i class="fas fa-shield-alt"></i></label>
        <input type="password" name="confpassword" id="password" placeholder="Password" required />

        <button type="submit" class="button">Register</button>
    </form>
</div>