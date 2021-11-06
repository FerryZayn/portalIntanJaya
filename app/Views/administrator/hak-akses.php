<?= $this->extend('/layout/hakakses/templet') ?>
<?= $this->section('content') ?>
<div class="main-panel">
    <div class="content">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">HAK AKSES PORTAL</h2>
                        <h5 class="text-white op-7 mb-2">Kabupaten Intan Jaya...</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-inner mt--5">
            <div class="row mt--2">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title fw-bold"><i class="fas fa-key"></i> SETTING HAK AKSES </h4>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-5 col-md-3">
                                    <div class="nav flex-column nav-pills nav-secondary nav-pills-no-bd nav-pills-icons" id="v-pills-tab-with-icon" role="tablist" aria-orientation="vertical">
                                        <?php foreach ($data as $item) : ?>
                                            <ul class="nav nav-pills flex-column">
                                                <li class="nav-item click-modul" data-modul="<?= $item->id; ?>">
                                                    <a class="nav-link bg-danger text-white">
                                                        <i class="fas fa-user-lock"></i> <?= $item->nama_hak_akses; ?>
                                                    </a>
                                                </li>
                                            </ul>
                                        <?php endforeach ?>
                                    </div>
                                </div>
                                <div class="col-5 col-md-9">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-head-bg-danger mt-4">
                                            <thead>
                                                <tr>
                                                    <th>MODUL AKSES</th>
                                                    <th><i class="fa fa-eye"></i> View</th>
                                                    <th><i class="fas fa-pencil-alt"></i> Input</th>
                                                    <th><i class="fa fa-edit"></i> Edit</th>
                                                    <th><i class="fa fa-trash"></i> Hapus</th>
                                                </tr>
                                            </thead>
                                            <tbody id="settings">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>






                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= $this->include('/layout/hakakses/_footer');  ?>
</div>
<style type="text/css">
    a:hover {
        cursor: pointer;
    }
</style>

<script src="<?= base_url(); ?>/admintemp/js/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        dataesurat()
        $('#tabel');
        $('.click-modul').on('click', function() {
            const modul = $(this).data('modul');
            $.ajax({
                type: 'GET',
                url: '<?php echo base_url() ?>/ambilakses/' + modul,
                async: true,
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    for (var i = 0; i < data.length; i++) {
                        var is_view = (data[i].is_view == 1) ? "checked" : "";
                        var is_insert = (data[i].is_insert == 1) ? "checked" : "";
                        var is_update = (data[i].is_update == 1) ? "checked" : "";
                        var is_delete = (data[i].is_delete == 1) ? "checked" : "";
                        html += '<tr>' +
                            '<td>' + data[i].nama_modul + '</td>' +
                            '<td><input type = "checkbox" class="view' + data[i].id + '" id="' + data[i].id + '"  name="is_view"  value ="' + data[i].is_view + '"  ' + is_view + '></td>' +
                            '<td><input type = "checkbox" class="insert' + data[i].id + '" id="' + data[i].id + '"  name="is_insert"  value ="' + data[i].is_insert + '"  ' + is_insert + '></td>' +
                            '<td><input type = "checkbox" class="update' + data[i].id + '" id="' + data[i].id + '"  name="is_update"  value ="' + data[i].is_update + '"  ' + is_update + '></td>' +
                            '<td><input type = "checkbox" class="delete' + data[i].id + '" id="' + data[i].id + '"  name="is_delete"  value ="' + data[i].is_delete + '"  ' + is_delete + '></td>' +
                            '</tr>';
                    }
                    $('#settings').html(html);
                    crudView(data);
                    crudInsert(data);
                    crudUpdate(data);
                    crudDelete(data);
                }
            });
        });

        function dataesurat() {
            $.ajax({
                type: 'GET',
                url: '<?php echo base_url() ?>/ambilakses/1',
                async: false,
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    for (var i = 0; i < data.length; i++) {
                        var is_view = (data[i].is_view == 1) ? "checked" : "";
                        var is_insert = (data[i].is_insert == 1) ? "checked" : "";
                        var is_update = (data[i].is_update == 1) ? "checked" : "";
                        var is_delete = (data[i].is_delete == 1) ? "checked" : "";
                        html += '<tr>' +
                            '<td>' + data[i].nama_modul + '</td>' +
                            '<td><input type = "checkbox" class="view' + data[i].id + '" id="' + data[i].id + '"  name="is_view"  value ="' + data[i].is_view + '"  ' + is_view + '></td>' +
                            '<td><input type = "checkbox" class="insert' + data[i].id + '" id="' + data[i].id + '"  name="is_insert"  value ="' + data[i].is_insert + '"  ' + is_insert + '></td>' +
                            '<td><input type = "checkbox" class="update' + data[i].id + '" id="' + data[i].id + '"  name="is_update"  value ="' + data[i].is_update + '"  ' + is_update + '></td>' +
                            '<td><input type = "checkbox" class="delete' + data[i].id + '" id="' + data[i].id + '"  name="is_delete"  value ="' + data[i].is_delete + '"  ' + is_delete + '></td>' +
                            '</tr>';
                    }
                    $('#settings').html(html);
                    crudView(data);
                    crudInsert(data);
                    crudUpdate(data);
                    crudDelete(data);
                }
            });
        }
    });
</script>

<script>
    function crudView(data) {
        for (let i = 0; i < data.length; i++) {
            $('.view' + data[i].id).click(function() {
                var id = $(this).attr('id');
                var name = $(this).attr('name');
                var value = $(this).attr('value');
                $.ajax({
                    type: 'GET',
                    url: '/AdminController/crudupdate/',
                    dataType: 'json',
                    data: {
                        'id': id,
                        'name': name,
                        'value': value,
                    },
                });
            });

        }
    }

    function crudInsert(data) {
        for (let i = 0; i < data.length; i++) {
            $('.insert' + data[i].id).click(function() {
                var id = $(this).attr('id');
                var name = $(this).attr('name');
                var value = $(this).attr('value');
                $.ajax({
                    type: 'GET',
                    url: '/AdminController/crudupdate/',
                    dataType: 'json',
                    data: {
                        'id': id,
                        'name': name,
                        'value': value,
                    },
                });
            });
        }
    }

    function crudUpdate(data) {
        for (let i = 0; i < data.length; i++) {
            $('.update' + data[i].id).click(function() {
                var id = $(this).attr('id');
                var name = $(this).attr('name');
                var value = $(this).attr('value');
                $.ajax({
                    type: 'GET',
                    url: '/AdminController/crudupdate/',
                    dataType: 'json',
                    data: {
                        'id': id,
                        'name': name,
                        'value': value,
                    },
                });
            });
        }
    }

    function crudDelete(data) {
        for (let i = 0; i < data.length; i++) {
            $('.delete' + data[i].id).click(function() {
                var id = $(this).attr('id');
                var name = $(this).attr('name');
                var value = $(this).attr('value');
                $.ajax({
                    type: 'GET',
                    url: '/AdminController/crudupdate/',
                    dataType: 'json',
                    data: {
                        'id': id,
                        'name': name,
                        'value': value,
                    },
                });
            });
        }
    }
</script>
<?= $this->endSection(); ?>