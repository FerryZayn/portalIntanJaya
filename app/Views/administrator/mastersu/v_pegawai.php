<?= $this->extend('/layout/mastersu/templet') ?>
<?= $this->section('content') ?>
<div class="main-panel">
    <div class="content">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">MASTER PEGAWAI</h2>
                        <h5 class="text-white op-7 mb-2">Kabupaten Intan Jaya...</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-inner mt--5">
            <div class="row mt--2">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title fw-bold text-white">
                                    <i class="fas fa-list"></i> Daftar Data Pegawai
                                </h4>
                                <button class="btn bg-empat text-white fw-bold btn-round ml-auto" data-toggle="modal" data-target="#addModal">
                                    <i class="fas fa-plus-circle"></i>
                                    Tambah Pegawai
                                </button>

                            </div>
                        </div>

                        <div class="card-body">
                            <?php if (session()->getFlashdata('pesan')) : ?>
                                <div class="alert alert-success alert-dismissible show fade">
                                    <div class="alert-body">
                                        <button class="close" data-dismiss="alert">
                                            <span>&times;</span>
                                        </button>
                                        <?= session()->getFlashdata('pesan') ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pegawai</th>
                                            <th>NIP</th>
                                            <th>Jabatan</th>
                                            <th style="width: 10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        `
                                        <?php foreach ($tampilpegawai as $peg) : ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $peg['nama_pegawai']; ?></td>
                                                <td><?= $peg['nip']; ?></td>
                                                <td><?= $peg['nama_jabatan']; ?></td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#viewModal<?= $peg['id']; ?>">
                                                            <i class="fa fa-eye"></i>
                                                        </button>
                                                        <!-- Modal View-->
                                                        <div class="modal fade" id="viewModal<?= $peg['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">VIEW BIDANG</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-sm-3">
                                                                                Nama Pegawai <br />
                                                                                Nomor Induk Pegawai<br />
                                                                                Nama Jabatan<br />
                                                                                Nama Bidang<br />
                                                                                Nama Sub Bidang
                                                                            </div>
                                                                            <div class="col-sm-9 fw-bold">
                                                                                : <?= $peg['nama_pegawai']; ?><br />
                                                                                : <?= $peg['nip']; ?><br />
                                                                                : <?= $peg['nama_jabatan']; ?><br />
                                                                                : <?= $peg['nama_bidang']; ?><br />
                                                                                : <?= $peg['nama_sub_bidang']; ?><br />
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
                                                        <a href="/edit/<?= $peg['id']; ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>



                                                        &nbsp;
                                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusModal<?= $peg['id']; ?>">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                        <!-- Modal Hapus-->
                                                        <form action="/hapuspegsu" method="post">
                                                            <?= csrf_field(); ?>
                                                            <div class="modal fade" id="hapusModal<?= $peg['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-lg" role="document">
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
                                                                                    Nama Pegawai <br />
                                                                                    Nomor Induk Pegawai<br />
                                                                                    Nama Jabatan<br />
                                                                                    Nama Bidang<br />
                                                                                    Nama Sub Bidang
                                                                                </div>
                                                                                <div class="col-sm-9 fw-bold">
                                                                                    : <?= $peg['nama_pegawai']; ?><br />
                                                                                    : <?= $peg['nip']; ?><br />
                                                                                    : <?= $peg['nama_jabatan']; ?><br />
                                                                                    : <?= $peg['nama_bidang']; ?><br />
                                                                                    : <?= $peg['nama_sub_bidang']; ?><br />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <input type="hidden" name="_method" value="DELETE">
                                                                            <input type="text" name="pegawai_id" class="pegawai_id" value="<?= $peg['id']; ?>">
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


<!-- Modal Add Pegawai -->
<form action="/addPegawaisu" method="post">
    <?= csrf_field(); ?>
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h2 class="modal-title fw-bold text-primary" id="exampleModalLabel">
                        <i class="fas fa-user-plus"></i> TAMBAH PEGAWAI
                    </h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="">NAMA OPD</label>
                                <select class="form-control" name="opd_id" id="opd_id" required>
                                    <option value="">-- PILIH OPD --</option>
                                    <?php foreach ($opdview as $value) : ?>
                                        <option value="<?= $value->id; ?>"><?= $value->nama_opd; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">JABATAN PEGAWAI NEGRI</label>
                                <select class="form-control" name="p_jabatan" id="jabatan" required>
                                    <option value="">-- PILIH JABATAN --</option>
                                </select>
                                <?php if (session()->getFlashdata('jabatan')) : ?>
                                    <small class="text-danger">
                                        <?= session()->getFlashdata('jabatan') ?>
                                    </small>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <label for="">NAMA LENGKAP</label>
                                <input id="namalengkap" type="text" class="form-control msg" name="p_nama" required>

                            </div>

                            <div class="form-group">
                                <label for="">NOMOR INDUK PEGAWAI NEGRI</label>
                                <input id="p_nip" type="text" class="form-control" name="p_nip" required>

                            </div>

                            <div class="form-group">
                                <label for="">NOMOR INDUK KEPENDUDUKAN</label>
                                <input type="text" class="form-control" name="p_nik" required>

                            </div>
                            <div class="form-group">
                                <label for="">TEMPAT LAHIR</label>
                                <input type="text" class="form-control <?= session()->getFlashdata('tempat') ? 'is-invalid' : '' ?>" name="tempat" value="<?= old('tempat') ?>">
                            </div>
                            <div class="form-group">
                                <label for="">TANGGAL LAHIR</label>
                                <input type="date" class="form-control" name="p_tanggal_lahir" required>
                            </div>
                            <div class="form-group">

                                <label class="selectgroup-item"><label for="">IS PEGAWAI ?</label>
                                    <input type="checkbox" class="selectgroup-input" id="customSwitch1" name="is_p">
                                    <span class="selectgroup-button">IS PEGAWAI</span>
                                </label>
                            </div>

                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="">NO TELEPON</label>
                                <input type="text" class="form-control" name="p_no_hp" required>

                            </div>
                            <div class="form-group">
                                <label for="">ALAMAT E-MAIL</label>
                                <input id="p_email" type="email" class="form-control" name="p_email" required>
                            </div>
                            <div class="form-group">
                                <label for="">USERNAME</label>
                                <input type="text" class="form-control" name="p_username" required>
                            </div>
                            <div class="form-group">
                                <label for="">PASSWORD</label>
                                <input id="p_passwd" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="p_passwd" required>

                                <div id="pwindicator" class="pwindicator">
                                    <div class="bar"></div>
                                    <div class="label"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">PASSWORD KONFRIMASI</label>
                                <input id="p_passwd2" type="password" class="form-control" name="p_passwd-confirm" required>

                            </div>

                            <div class="form-group">
                                <label for="">GOLONGAN</label>
                                <select class="form-control golongan" name="p_golongan_id" required>
                                    <option value="">-- PILIH GOLONGAN --</option>
                                    <?php foreach ($golongan as $value) : ?>
                                        <option value="<?= $value->id ?>"><?= $value->kode; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">KODE</label>
                                <select class="form-control" name="p_kode" required>
                                    <option value="" required>-- PILIH KODE --</option>
                                    <option value="AAA">AAA</option>
                                    <option value="BBB">BBB</option>
                                    <option value="CCC">CCC</option>
                                    <option value="DDD">DDD</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">JENIS KELAIMIN</label>
                                <select class="form-control" name="p_kelamin_code" required>
                                    <option value="" required>-- PILIH GENDER --</option>
                                    <option value="1">LAKI-LAKI</option>
                                    <option value="2">PEREMPUAN</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="customSwitch1" name="is_p">
                            <label class="custom-control-label" for="customSwitch1">IS PEGAWAI !</label>
                        </div>
                    </div> -->
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Modal Add Pegawai -->

<script>
    // Star Proses Ambil Jabatan OPD
    $("#opd_id").on("change", function() {
        var value = $("#opd_id option:selected").attr("value");
        $('#jabatan').html('<option>Mencari Jabatan...</option>');
        $.ajax({
            url: "<?php echo site_url('/prosesCariJabatan'); ?>/" + value,
            type: "GET",
            async: true,
            dataType: 'json',
            success: function(data) {
                var html = '';
                $(data).each(function(key, value) {
                    html += '<option value=' + value.id + '>' + value.nama_jabatan + '</option>';
                })
                $('#jabatan').html(html);
            }
        });
    });
    // End Proses Ambil Jabatan OPD
</script>


<?= $this->endSection() ?>