<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>ADMINISTRATOR PORTAL PEMDA</title>
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

    <link rel="stylesheet" href="<?= base_url(); ?>/admintemp/css/bootstrap-select.css">

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="<?= base_url(); ?>/admintemp/css/demo.css">
</head>

<body>

    <div class="wrapper">
        <!-- Header Star -->
        <?= $this->include('/layout/pemdatemp/_header'); ?>
        <!-- Header End -->

        <!-- Sidebar Star -->
        <?= $this->include('/layout/pemdatemp/_sidebar'); ?>
        <!-- End Sidebar -->

        <!-- Content Srat -->
        <?= $this->renderSection('content'); ?>
        <!-- Content End -->

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

    <!-- Datatables -->
    <script src="<?= base_url(); ?>/admintemp/js/plugin/datatables/datatables.min.js"></script>

    <!-- Bootstrap Select -->
    <script src="<?= base_url(); ?>/admintemp/js/bootstrap-select.js"></script>


    <!-- Chart JS -->
    <script src="<?= base_url(); ?>/admintemp/js/plugin/chart.js/chart.min.js"></script>

    <!-- jQuery Sparkline -->
    <script src="<?= base_url(); ?>/admintemp/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

    <!-- Chart Circle -->
    <script src="<?= base_url(); ?>/admintemp/js/plugin/chart-circle/circles.min.js"></script>


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


    <script>
        $(document).ready(function() {
            $('#basic-datatables').DataTable({});

            $('#multi-filter-select').DataTable({
                "pageLength": 5,
                initComplete: function() {
                    this.api().columns().every(function() {
                        var column = this;
                        var select = $('<select class="form-control"><option value=""></option></select>')
                            .appendTo($(column.footer()).empty())
                            .on('change', function() {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );

                                column
                                    .search(val ? '^' + val + '$' : '', true, false)
                                    .draw();
                            });

                        column.data().unique().sort().each(function(d, j) {
                            select.append('<option value="' + d + '">' + d + '</option>')
                        });
                    });
                }
            });

            // Add Row
            $('#add-row').DataTable({
                "pageLength": 5,
            });

            var action = '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

            $('#addRowButton').click(function() {
                $('#add-row').dataTable().fnAddData([
                    $("#addName").val(),
                    $("#addPosition").val(),
                    $("#addOffice").val(),
                    action
                ]);
                $('#addRowModal').modal('hide');

            });
        });
    </script>

    <script>
        function previewImg() {
            const fileFoto = document.querySelector('#file_foto');
            const imgPreview = document.querySelector('.img-preview');
            const fileSampul = new FileReader();
            fileSampul.readAsDataURL(fileFoto.files[0]);
            fileSampul.onload = function(e) {
                imgPreview.src = e.target.result;
            }
        }
    </script>

    <script>
        $('#displayNotif').on('click', function() {
            var placementFrom = $('#notify_placement_from option:selected').val();
            var placementAlign = $('#notify_placement_align option:selected').val();
            var state = $('#notify_state option:selected').val();
            var style = $('#notify_style option:selected').val();
            var content = {};

            content.message = 'Terima kasih, Artikel anda berhasil diupload ke database...';
            content.title = 'NOTIFIKASI SISTEM';
            if (style == "withicon") {
                content.icon = 'fa fa-bell';
            } else {
                content.icon = 'none';
            }
            content.url = '#';
            content.target = '_blank';

            $.notify(content, {
                type: state,
                placement: {
                    from: placementFrom,
                    align: placementAlign
                },
                time: 100,
                delay: 0,
            });
        });
    </script>
</body>

</html>