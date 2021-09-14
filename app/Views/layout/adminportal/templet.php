<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Administrator Portal | Kab. Intan Jaya</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="<?= base_url(); ?>/admintemp/img/logo/icon.ico" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="<?= base_url(); ?>/admintemp/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Lato:300,400,700,900"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"],
                urls: ['<?= base_url(); ?>/admintemp/css/fonts.min.css']
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>


    <!-- Big Icon Star -->
    <link rel="stylesheet" href="<?= base_url(); ?>/admintemp/css/big-icon.css">
    <!-- Big Icon Star -->


    <!-- CSS Files -->
    <link rel="stylesheet" href="<?= base_url(); ?>/admintemp/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/admintemp/css/atlantis.min.css">

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="<?= base_url(); ?>/admintemp/css/demo.css">
</head>

<body>
    <div class="wrapper overlay-sidebar">
        <?= $this->renderSection('content'); ?>
    </div>
    <!--   Core JS Files   -->
    <script src="<?= base_url(); ?>/admintemp/js/core/jquery.3.2.1.min.js"></script>
    <script src="<?= base_url(); ?>/admintemp/js/core/popper.min.js"></script>
    <script src="<?= base_url(); ?>/admintemp/js/core/bootstrap.min.js"></script>

    <!-- jQuery UI -->
    <script src="<?= base_url(); ?>/admintemp/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    <script src="<?= base_url(); ?>/admintemp/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="<?= base_url(); ?>/admintemp/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>


    <!-- Chart JS -->
    <script src="<?= base_url(); ?>/admintemp/js/plugin/chart.js/chart.min.js"></script>

    <!-- jQuery Sparkline -->
    <script src="<?= base_url(); ?>/admintemp/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

    <!-- Chart Circle -->
    <script src="<?= base_url(); ?>/admintemp/js/plugin/chart-circle/circles.min.js"></script>

    <!-- Datatables -->
    <script src="<?= base_url(); ?>/admintemp/js/plugin/datatables/datatables.min.js"></script>

    <!-- Bootstrap Notify -->
    <script src="<?= base_url(); ?>/admintemp/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

    <!-- jQuery Vector Maps -->
    <script src="<?= base_url(); ?>/admintemp/js/plugin/jqvmap/jquery.vmap.min.js"></script>
    <script src="<?= base_url(); ?>/admintemp/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>

    <!-- Sweet Alert -->
    <script src="<?= base_url(); ?>/admintemp/js/plugin/sweetalert/sweetalert.min.js"></script>

    <!-- Atlantis JS -->
    <script src="<?= base_url(); ?>/admintemp/js/atlantis.min.js"></script>

    <!-- Atlantis DEMO methods, don't include it in your project! -->
    <script src="<?= base_url(); ?>/admintemp/js/setting-demo.js"></script>
    <!-- <script src="<?= base_url(); ?>/admintemp/js/demo.js"></script> -->
</body>

</html>