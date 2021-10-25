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
                                <h4 class="card-title fw-bold"><i class="fas fa-key"></i> HAK AKSES </h4>
                            </div>
                        </div>
                        <div class="card-body">


                            <div class="row">
                                <div class="col-5 col-md-2">
                                    <div class="nav flex-column nav-pills nav-secondary nav-pills-no-bd nav-pills-icons" id="v-pills-tab-with-icon" role="tablist" aria-orientation="vertical">
                                        <a class="nav-link active" id="v-pills-super-user-tab-icons" data-toggle="pill" href="#super-user" role="tab" aria-controls="super-user" aria-selected="true">
                                            <!-- <i class="flaticon-home"></i> -->
                                            <i class="fas fa-user-lock"></i>
                                            Super User
                                        </a>
                                        <a class="nav-link" id="v-pills-admin-pemda-tab-icons" data-toggle="pill" href="#admin-pemda" role="tab" aria-controls="admin-pemda" aria-selected="false">
                                            <i class="flaticon-home"></i>
                                            Admin Pemda
                                        </a>
                                        <a class="nav-link" id="v-pills-user-tab-icons" data-toggle="pill" href="#user" role="tab" aria-controls="user" aria-selected="false">
                                            <i class="flaticon-user-4"></i>
                                            User
                                        </a>
                                        <a class="nav-link" id="v-pills-admin-opd-tab-icons" data-toggle="pill" href="#admin-opd" role="tab" aria-controls="admin-opd" aria-selected="false">
                                            <i class="flaticon-home"></i>
                                            Admin OPD
                                        </a>
                                    </div>
                                </div>


                                <div class="col-7 col-md-10">
                                    <div class="tab-content" id="v-pills-with-icon-tabContent">
                                        <div class="tab-pane fade show active" id="super-user" role="tabpanel" aria-labelledby="v-pills-super-user-tab-icons">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title">MODUL HAK AKSES SUPER USER</h3>
                                                </div>
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>MODUL AKSES</th>
                                                            <th><i class="fa fa-eye"></i></th>
                                                            <th><i class="fas fa-pencil-alt"></i></th>
                                                            <th><i class="fa fa-edit"></i></th>
                                                            <th><i class="fa fa-trash"></i></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>MENU SETTING</td>
                                                            <td><input type="checkbox" class="view11" id="11" name="is_view" value="1" checked=""></td>
                                                            <td><input type="checkbox" class="insert11" id="11" name="is_insert" value="1" checked=""></td>
                                                            <td><input type="checkbox" class="update11" id="11" name="is_update" value="1" checked=""></td>
                                                            <td><input type="checkbox" class="delete11" id="11" name="is_delete" value="1" checked=""></td>
                                                        </tr>
                                                        <tr>
                                                            <td>MENU SETTING </td>
                                                            <td><input type="checkbox" class="view12" id="12" name="is_view" value="1" checked=""></td>
                                                            <td><input type="checkbox" class="insert12" id="12" name="is_insert" value="1" checked=""></td>
                                                            <td><input type="checkbox" class="update12" id="12" name="is_update" value="1" checked=""></td>
                                                            <td><input type="checkbox" class="delete12" id="12" name="is_delete" value="1" checked=""></td>
                                                        </tr>
                                                        <tr>
                                                            <td>MENU SETTING </td>
                                                            <td><input type="checkbox" class="view13" id="13" name="is_view" value="1" checked=""></td>
                                                            <td><input type="checkbox" class="insert13" id="13" name="is_insert" value="1" checked=""></td>
                                                            <td><input type="checkbox" class="update13" id="13" name="is_update" value="1" checked=""></td>
                                                            <td><input type="checkbox" class="delete13" id="13" name="is_delete" value="1" checked=""></td>
                                                        </tr>
                                                        <tr>
                                                            <td>MENU SETTING </td>
                                                            <td><input type="checkbox" class="view14" id="14" name="is_view" value="1" checked=""></td>
                                                            <td><input type="checkbox" class="insert14" id="14" name="is_insert" value="1" checked=""></td>
                                                            <td><input type="checkbox" class="update14" id="14" name="is_update" value="1" checked=""></td>
                                                            <td><input type="checkbox" class="delete14" id="14" name="is_delete" value="1" checked=""></td>
                                                        </tr>
                                                        <tr>
                                                            <td>MENU SETTING </td>
                                                            <td><input type="checkbox" class="view15" id="15" name="is_view" value="1" checked=""></td>
                                                            <td><input type="checkbox" class="insert15" id="15" name="is_insert" value="1" checked=""></td>
                                                            <td><input type="checkbox" class="update15" id="15" name="is_update" value="1" checked=""></td>
                                                            <td><input type="checkbox" class="delete15" id="15" name="is_delete" value="1" checked=""></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>


                                        <div class="tab-pane fade" id="admin-pemda" role="tabpanel" aria-labelledby="v-pills-admin-pemda-tab-icons">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title">MODUL HAK AKSES ADMIN PEMDA</h3>
                                                </div>


                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>MODUL AKSES</th>
                                                            <th><i class="fa fa-eye"></i></th>
                                                            <th><i class="fas fa-pencil-alt"></i></th>
                                                            <th><i class="fa fa-edit"></i></th>
                                                            <th><i class="fa fa-trash"></i></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>MENU SETTING</td>
                                                            <td><input type="checkbox" class="view11" id="11" name="is_view" value="1" checked=""></td>
                                                            <td><input type="checkbox" class="insert11" id="11" name="is_insert" value="1" checked=""></td>
                                                            <td><input type="checkbox" class="update11" id="11" name="is_update" value="1" checked=""></td>
                                                            <td><input type="checkbox" class="delete11" id="11" name="is_delete" value="1" checked=""></td>
                                                        </tr>
                                                        <tr>
                                                            <td>MENU SETTING </td>
                                                            <td><input type="checkbox" class="view12" id="12" name="is_view" value="1" checked=""></td>
                                                            <td><input type="checkbox" class="insert12" id="12" name="is_insert" value="1" checked=""></td>
                                                            <td><input type="checkbox" class="update12" id="12" name="is_update" value="1" checked=""></td>
                                                            <td><input type="checkbox" class="delete12" id="12" name="is_delete" value="1" checked=""></td>
                                                        </tr>
                                                        <tr>
                                                            <td>MENU SETTING </td>
                                                            <td><input type="checkbox" class="view13" id="13" name="is_view" value="1" checked=""></td>
                                                            <td><input type="checkbox" class="insert13" id="13" name="is_insert" value="1" checked=""></td>
                                                            <td><input type="checkbox" class="update13" id="13" name="is_update" value="1" checked=""></td>
                                                            <td><input type="checkbox" class="delete13" id="13" name="is_delete" value="1" checked=""></td>
                                                        </tr>
                                                        <tr>
                                                            <td>MENU SETTING </td>
                                                            <td><input type="checkbox" class="view14" id="14" name="is_view" value="1" checked=""></td>
                                                            <td><input type="checkbox" class="insert14" id="14" name="is_insert" value="1" checked=""></td>
                                                            <td><input type="checkbox" class="update14" id="14" name="is_update" value="1" checked=""></td>
                                                            <td><input type="checkbox" class="delete14" id="14" name="is_delete" value="1" checked=""></td>
                                                        </tr>
                                                        <tr>
                                                            <td>MENU SETTING </td>
                                                            <td><input type="checkbox" class="view15" id="15" name="is_view" value="1" checked=""></td>
                                                            <td><input type="checkbox" class="insert15" id="15" name="is_insert" value="1" checked=""></td>
                                                            <td><input type="checkbox" class="update15" id="15" name="is_update" value="1" checked=""></td>
                                                            <td><input type="checkbox" class="delete15" id="15" name="is_delete" value="1" checked=""></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>


                                        <div class="tab-pane fade" id="user" role="tabpanel" aria-labelledby="v-pills-user-tab-icons">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title">MODUL HAK AKSES USER</h3>
                                                </div>
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>MODUL AKSES</th>
                                                            <th><i class="fa fa-eye"></i></th>
                                                            <th><i class="fas fa-pencil-alt"></i></th>
                                                            <th><i class="fa fa-edit"></i></th>
                                                            <th><i class="fa fa-trash"></i></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>MENU SETTING</td>
                                                            <td><input type="checkbox" class="view11" id="11" name="is_view" value="1" checked=""></td>
                                                            <td><input type="checkbox" class="insert11" id="11" name="is_insert" value="1" checked=""></td>
                                                            <td><input type="checkbox" class="update11" id="11" name="is_update" value="1" checked=""></td>
                                                            <td><input type="checkbox" class="delete11" id="11" name="is_delete" value="1" checked=""></td>
                                                        </tr>
                                                        <tr>
                                                            <td>MENU SETTING </td>
                                                            <td><input type="checkbox" class="view12" id="12" name="is_view" value="1" checked=""></td>
                                                            <td><input type="checkbox" class="insert12" id="12" name="is_insert" value="1" checked=""></td>
                                                            <td><input type="checkbox" class="update12" id="12" name="is_update" value="1" checked=""></td>
                                                            <td><input type="checkbox" class="delete12" id="12" name="is_delete" value="1" checked=""></td>
                                                        </tr>
                                                        <tr>
                                                            <td>MENU SETTING </td>
                                                            <td><input type="checkbox" class="view13" id="13" name="is_view" value="1" checked=""></td>
                                                            <td><input type="checkbox" class="insert13" id="13" name="is_insert" value="1" checked=""></td>
                                                            <td><input type="checkbox" class="update13" id="13" name="is_update" value="1" checked=""></td>
                                                            <td><input type="checkbox" class="delete13" id="13" name="is_delete" value="1" checked=""></td>
                                                        </tr>
                                                        <tr>
                                                            <td>MENU SETTING </td>
                                                            <td><input type="checkbox" class="view14" id="14" name="is_view" value="1" checked=""></td>
                                                            <td><input type="checkbox" class="insert14" id="14" name="is_insert" value="1" checked=""></td>
                                                            <td><input type="checkbox" class="update14" id="14" name="is_update" value="1" checked=""></td>
                                                            <td><input type="checkbox" class="delete14" id="14" name="is_delete" value="1" checked=""></td>
                                                        </tr>
                                                        <tr>
                                                            <td>MENU SETTING </td>
                                                            <td><input type="checkbox" class="view15" id="15" name="is_view" value="1" checked=""></td>
                                                            <td><input type="checkbox" class="insert15" id="15" name="is_insert" value="1" checked=""></td>
                                                            <td><input type="checkbox" class="update15" id="15" name="is_update" value="1" checked=""></td>
                                                            <td><input type="checkbox" class="delete15" id="15" name="is_delete" value="1" checked=""></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="admin-opd" role="tabpanel" aria-labelledby="v-pills-admin-opd-tab-icons">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title">MODUL HAK AKSES ADMIN OPD</h3>
                                                </div>
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>MODUL AKSES</th>
                                                            <th><i class="fa fa-eye"></i></th>
                                                            <th><i class="fas fa-pencil-alt"></i></th>
                                                            <th><i class="fa fa-edit"></i></th>
                                                            <th><i class="fa fa-trash"></i></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>MENU SETTING</td>
                                                            <td><input type="checkbox" class="view11" id="11" name="is_view" value="1" checked=""></td>
                                                            <td><input type="checkbox" class="insert11" id="11" name="is_insert" value="1" checked=""></td>
                                                            <td><input type="checkbox" class="update11" id="11" name="is_update" value="1" checked=""></td>
                                                            <td><input type="checkbox" class="delete11" id="11" name="is_delete" value="1" checked=""></td>
                                                        </tr>
                                                        <tr>
                                                            <td>MENU SETTING </td>
                                                            <td><input type="checkbox" class="view12" id="12" name="is_view" value="1" checked=""></td>
                                                            <td><input type="checkbox" class="insert12" id="12" name="is_insert" value="1" checked=""></td>
                                                            <td><input type="checkbox" class="update12" id="12" name="is_update" value="1" checked=""></td>
                                                            <td><input type="checkbox" class="delete12" id="12" name="is_delete" value="1" checked=""></td>
                                                        </tr>
                                                        <tr>
                                                            <td>MENU SETTING </td>
                                                            <td><input type="checkbox" class="view13" id="13" name="is_view" value="1" checked=""></td>
                                                            <td><input type="checkbox" class="insert13" id="13" name="is_insert" value="1" checked=""></td>
                                                            <td><input type="checkbox" class="update13" id="13" name="is_update" value="1" checked=""></td>
                                                            <td><input type="checkbox" class="delete13" id="13" name="is_delete" value="1" checked=""></td>
                                                        </tr>
                                                        <tr>
                                                            <td>MENU SETTING </td>
                                                            <td><input type="checkbox" class="view14" id="14" name="is_view" value="1" checked=""></td>
                                                            <td><input type="checkbox" class="insert14" id="14" name="is_insert" value="1" checked=""></td>
                                                            <td><input type="checkbox" class="update14" id="14" name="is_update" value="1" checked=""></td>
                                                            <td><input type="checkbox" class="delete14" id="14" name="is_delete" value="1" checked=""></td>
                                                        </tr>
                                                        <tr>
                                                            <td>MENU SETTING </td>
                                                            <td><input type="checkbox" class="view15" id="15" name="is_view" value="1" checked=""></td>
                                                            <td><input type="checkbox" class="insert15" id="15" name="is_insert" value="1" checked=""></td>
                                                            <td><input type="checkbox" class="update15" id="15" name="is_update" value="1" checked=""></td>
                                                            <td><input type="checkbox" class="delete15" id="15" name="is_delete" value="1" checked=""></td>
                                                        </tr>
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
        </div>
    </div>
    <?= $this->include('/layout/hakakses/_footer');  ?>
</div>


<script>
    $(document).ready(function() {

        dataportal()

        $('#tabel');

        $('.click-modul').on('click', function() {
            const modul = $(this).data('modul');

            $.ajax({
                type: 'GET',
                url: 'http://localhost:8080/administrator/hak-akses/jsonakses/' + modul,
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
                    $('#datasuratmasuk').html(html);
                    crudView(data);
                    crudInsert(data);
                    crudUpdate(data);
                    crudDelete(data);
                }

            });
        });

        function dataportal() {
            $.ajax({
                type: 'GET',
                url: 'http://localhost:8080/administrator/hak-akses/jsonakses/1',
                async: false,
                dataType: 'json',
                success: function(data) {
                    // console.log(data);
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
                    $('#datasuratmasuk').html(html);
                    crudView(data);
                    crudInsert(data);
                    crudUpdate(data);
                    crudDelete(data);



                }

            });
        }

    });


    function crudView(data) {

        for (let i = 0; i < data.length; i++) {
            $('.view' + data[i].id).click(function() {
                var id = $(this).attr('id');
                var name = $(this).attr('name');
                var value = $(this).attr('value');
                $.ajax({
                    type: 'GET',
                    url: '/crudupdate/',
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
                    url: '/crudupdate/',
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
                    url: '/crudupdate/',
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
                    url: '/crudupdate/',
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


    function crudView(data) {

        for (let i = 0; i < data.length; i++) {
            $('.view' + data[i].id).click(function() {
                var id = $(this).attr('id');
                var name = $(this).attr('name');
                var value = $(this).attr('value');
                $.ajax({
                    type: 'GET',
                    url: '/crudupdate/',
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
                    url: '/crudupdate/',
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
                    url: '/crudupdate/',
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
                    url: '/crudupdate/',
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
<?= $this->endSection() ?>