<?= $this->extend('/layout/mastertemp/templet') ?>
<?= $this->section('content') ?>
<div class="main-panel">
    <div class="content">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">DATA BIDANG</h2>
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
                                <h4 class="card-title">Daftar Data Jabatan</h4>
                                <button class="btn bg-satu text-white fw-bold btn-round ml-auto" data-toggle="modal" data-target="#addModal">
                                    <i class="fas fa-plus-circle"></i>
                                    Tambah Jabatan
                                </button>
                            </div>
                        </div>

                        <div class="card-body">
                            <?php if (session()->getFlashdata('info')) : ?>
                                <div class="alert alert-success alert-dismissible show fade">
                                    <div class="alert-body">
                                        <button class="close" data-dismiss="alert">
                                            <span>&times;</span>
                                        </button>
                                        <?= session()->getFlashdata('info') ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Jabatan</th>
                                            <th>Nama Jabatan</th>
                                            <th>Nama Bidang</th>
                                            <th>Nama Sub Bidang</th>
                                            <th style="width: 10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($data as $jab) : ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $jab->kode; ?></td>
                                                <td><?= $jab->nama_jabatan; ?></td>
                                                <td><?= $jab->nama_bidang; ?></td>
                                                <td><?= $jab->nama_sub_bidang; ?></td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#viewModal<?= $jab->id; ?>">
                                                            <i class="fa fa-eye"></i>
                                                        </button>
                                                        <!-- Modal View-->
                                                        <div class="modal fade" id="viewModal<?= $jab->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">VIEW JABATAN</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-sm-3">
                                                                                ID <br />
                                                                                Kode Jabatan <br />
                                                                                Nama Bidang<br />
                                                                                Nama Sub Bidang
                                                                            </div>
                                                                            <div class="col-sm-9 fw-bold">
                                                                                : <?= $jab->id; ?><br />
                                                                                : <?= $jab->kode; ?><br />
                                                                                : <?= $jab->nama_jabatan; ?><br />
                                                                                : <?= $jab->nama_bidang; ?><br />
                                                                                : <?= $jab->nama_sub_bidang; ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- End Modal View-->


                                                        &nbsp;

                                                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#eeditModal<?= $jab->id; ?>">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <!-- Modal Edit-->
                                                        <form action="/updatejabatan" method="post">
                                                            <?= csrf_field(); ?>
                                                            <div class="modal fade" id="eeditModal<?= $jab->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">UBAH JABATAN</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <input type="hidden" name="_method" value="PUT">
                                                                            <input type="hidden" name="id" class="id">
                                                                            <div class="form-group">
                                                                                <label>Kode Jabatan</label>
                                                                                <input type="text" class="form-control" value="<?= $jab->kode; ?>" name="kode">
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label>Nama Jabatan</label>
                                                                                <input type="text" class="form-control" value="<?= $jab->nama_jabatan; ?>" name="nama_jabatan">
                                                                            </div>

                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <input type="hidden" name="_method" value="PUT">
                                                                            <input type="hidden" name="id" class="id" value="<?= $jab->id; ?>">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        <!-- End Modal Edit-->

                                                        &nbsp;
                                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusModal<?= $jab->id; ?>">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                        <!-- Modal Hapus-->
                                                        <form action="/deletejabatan" method="post">
                                                            <?= csrf_field(); ?>
                                                            <div class="modal fade" id="hapusModal<?= $jab->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Ingin hapus data ini?</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <div class="col-sm-3">
                                                                                    Kode Jabatan <br />
                                                                                    Nama Jabatan
                                                                                </div>
                                                                                <div class="col-sm-9 fw-bold">
                                                                                    : <?= $jab->kode; ?><br />
                                                                                    : <?= $jab->nama_jabatan; ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <input type="hidden" name="_method" value="DELETE">
                                                                            <input type="hidden" name="id" class="id" value="<?= $jab->id; ?>">
                                                                            <button type="button" class="btn btn-sm btn-info" data-dismiss="modal">
                                                                                <i class="fas fa-times"></i> Close
                                                                            </button>
                                                                            <button type="submit" class="btn btn-sm btn-danger">
                                                                                <i class="fa fa-trash"></i> Hapus...
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        <!-- End Modal Hapus-->
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <?= $this->include('/layout/mastertemp/_footer');  ?>
</div>


<!-- Modal Add Jabatan-->
<form action="/addjabatan" method="post">
    <?= csrf_field(); ?>
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">TAMBAH JABATAN</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <div class="form-group">
                        <label><small>LEVEL JABATAN</small></label>
                        <select class="form-control" name="level" id="level" required>
                            <option value="0">-- PILIH LEVEL JABATAN --</option>
                            <?php
                            foreach ($sjabatan as $value) : ?>
                                <option value="<?= $value->id; ?>"><?= $value->notes; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div id="bidang_view">
                        <div class="form-group">
                            <label><small>BIDANG</small></label>

                            <select class="form-control" name="bidang" id="bidang">
                                <option value="NULL">-- PILIH BIDANG --</option>
                                <?php
                                foreach ($select as $value) : ?>
                                    <option value="<?= $value->id; ?>"><?= $value->nama_bidang; ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>

                    <div id="subid_view">
                        <div class="form-group">
                            <label for=""><small>SUB BIDANG</small></label>
                            <select class="form-control" id="subid" name="subid">
                                <option value="NULL">- PILIH SUB BIDANG -</option>
                                <?php
                                foreach ($subid as $value) : ?>
                                    <option value="<?= $value->id; ?>"><?= $value->nama_sub_bidang; ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label><small>JABATAN</small></label>
                        <input type="text" class="form-control" name="jabatan" placeholder="Jabatan">
                    </div>


                    <div class="row">
                        <div class="form-group col">
                            <label><small>KODE</small></label>
                            <input type="text" class="form-control" name="kode" placeholder="KODE">
                        </div>


                        <div class="form-group col">
                            <label><small>HAK AKSES</small></label>
                            <select class="form-control hakakses" name="hakakses" id="hakakses">
                                <option value="">-- PILIH HAK AKSES --</option>
                                <?php
                                foreach ($hk as $value) : ?>
                                    <option value="<?= $value->id; ?>"><?= $value->nama_hak_akses; ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for=""><small>CATATAN</small></label>
                        <textarea class="form-control" name="notes" id="" rows="3"></textarea>
                    </div>




                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Modal Add Jabatan-->


<script>
    $(document).ready(function() {
        $('#bidang_view').hide();
        $('#subid_view').hide();


        $("#level").on("change", function() {

            var level = $("#level option:selected").attr("value");
            if (level == 1) {

                $('#bidang_view').hide();
                $('#subid_view').hide();

                console.log('level kadis');
            }
            if (level == 2) {
                $('#bidang_view').show();
                $('#subid_view').hide();
                console.log('level bidang');
            }
            if (level == 3) {
                $('#bidang_view').show();
                $('#subid_view').show();
                console.log('level subid');
            }
            if (level == 4) {
                console.log('level staf');
            }

            if (level == 0) {

                $('#bidang_view').hide();
                $('#subid_view').hide();
            }
            //return false;

        });

    });
</script>
<script>
    $(document).ready(function() {
        $("#bidang").on("change", function() {

            var value = $("#bidang option:selected").attr("value");
            $('#subid').html('<option>Sedang Mengambil Data ...</option>');
            $.ajax({
                url: "/selectsubid/" + value,
                type: "GET",

                async: true,
                dataType: 'json',
                success: function(data) {
                    // console.log(data);

                    var html = '<option value="NULL">-- PILIH SUB BIDANG --</option>';
                    $(data).each(function(key, value) {
                        // console.log(value);

                        html += '<option value=' + value.id + '>' + value.nama_sub_bidang + '</option>';
                    })

                    $('#subid').html(html);
                }
            });
            //return false;

        });

    });
</script>


<?= $this->endSection() ?>