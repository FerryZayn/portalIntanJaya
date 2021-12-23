<?= $this->extend('/layout/mastersu/templet') ?>
<?= $this->section('content') ?>
<div class="main-panel">
    <div class="content">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">MASTER JABATAN</h2>
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
                            <div class="card-head-row">
                                <div class="card-title">
                                    <h4 class="card-title text-white fw-bold">
                                        <i class="fas fa-clipboard-list"></i> Master Jabatan OPD
                                    </h4>
                                </div>
                                <div class="card-tools">
                                    <button class="btn bg-empat text-white fw-bold btn-round ml-auto" data-toggle="modal" data-target="#addPejabat">
                                        <i class="fas fa-plus-circle"></i>
                                        Tambah Jabatan
                                    </button>
                                    <a href="/administrator/mastersu/v_opd" class="btn bg-empat text-white fw-bold btn-round ml-auto">
                                        <i class="fas fa-arrow-alt-circle-left"></i>
                                        Kembali
                                    </a>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>KODE</th>
                                            <th>NAMA JEBATAN</th>
                                            <th>NAMA BIDANG</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($data as $j_opd) : ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $j_opd['kode']; ?></td>
                                                <td><?= $j_opd['nama_jabatan']; ?></td>
                                                <td><?= $j_opd['nama_bidang']; ?></td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#viewModal<?= $j_opd['id']; ?>">
                                                            <i class="fa fa-eye"></i>
                                                        </button>
                                                        <!-- Modal View-->
                                                        <div class="modal fade" id="viewModal<?= $j_opd['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header bg-secondary">
                                                                        <h5 class="modal-title fw-bold" id="exampleModalLabel">
                                                                            <i class="fas fa-align-left"></i> VIEW OPD
                                                                        </h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-sm-3">
                                                                                KODE <br />
                                                                                Nama Jabatan<br />
                                                                                Nama Bidang <br />
                                                                                Nama Sub Bidang
                                                                            </div>
                                                                            <div class="col-sm-9 fw-bold">
                                                                                : <?= $j_opd['kode']; ?><br />
                                                                                : <?= $j_opd['nama_jabatan']; ?><br />
                                                                                : <?= $j_opd['nama_bidang']; ?><br />
                                                                                : <?= $j_opd['nama_sub_bidang']; ?>
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
                                                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal<?= $j_opd['id']; ?>">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <!-- Modal Edit Pegawai -->
                                                        <form action="/proseseditPegawai" method="post">
                                                            <?= csrf_field(); ?>
                                                            <div class="modal fade" id="editModal<?= $j_opd['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header bg-success">
                                                                            <h2 class="modal-title fw-bold text-primary" id="exampleModalLabel"><i class="fas fa-edit"></i> UPDATE JABATAN OPD</h2>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="form-group">
                                                                                <label for="">NAMA JABATAN</label>
                                                                                <input type="text" class="form-control" name="nama_jabatan" value="<?= $j_opd['nama_jabatan']; ?>" required>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-sm-6">
                                                                                    <div class="form-group">
                                                                                        <label for="">KODE</label>
                                                                                        <input type="text" class="form-control" name="kode" value="<?= $j_opd['kode']; ?>" equired>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-6">
                                                                                    <div class="form-group">
                                                                                        <label for="">LEVEL</label>
                                                                                        <select name="level" class="form-control" required>
                                                                                            <option value="">-- PILIH LEVEL --</option>
                                                                                            <option value="1">Bupati</option>
                                                                                            <option value="2">Skretaris</option>
                                                                                            <option value="3">OPD</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">
                                                                                <div class="col-sm-12">
                                                                                    <div class="form-group">
                                                                                        <label for="">NAMA BIDANG</label>
                                                                                        <select name="level" class="form-control" required>
                                                                                            <option value="<?= $j_opd['nama_jabatan']; ?>" selected><?= $j_opd['nama_bidang']; ?></option>
                                                                                            <option value="">PILIH NAMA BIDANG...</option>
                                                                                            <?php foreach ($select as $bidang) : ?>
                                                                                                <option value="1"><?= $bidang['nama_bidang']; ?></option>
                                                                                            <?php endforeach; ?>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-sm-12">
                                                                                    <div class="form-group">
                                                                                        <label for="">NAMA SUB BIDANG</label>
                                                                                        <select name="level" class="form-control" required>
                                                                                            <option value="">PILIH SUB BIDANG...</option>
                                                                                            <?php foreach ($subbid as $sb) : ?>
                                                                                                <option value="1"><?= $sb['nama_sub_bidang']; ?></option>
                                                                                            <?php endforeach; ?>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>


                                                                            <div class="form-group">
                                                                                <label for="">HAK AKSES</label>
                                                                                <input type="text" class="form-control" name="alamat" required>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="">CATATAN</label>
                                                                                <textarea name="note" class="form-control" required></textarea>
                                                                            </div>





                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="submit" class="btn btn-success"><i class="fa fa-edit"></i> Update</button>
                                                                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- End Edit Pegawai -->
                                                        </form>


                                                        &nbsp;
                                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusModal<?= $j_opd['id']; ?>">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                        <!-- Modal Hapus-->
                                                        <form action="/deljabatansu" method="post">
                                                            <?= csrf_field(); ?>
                                                            <div class="modal fade" id="hapusModal<?= $j_opd['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                                    Nama Pegawai <br />
                                                                                    Nomor Induk Pegawai<br />
                                                                                    Golongan
                                                                                </div>
                                                                                <div class="col-sm-9 fw-bold">
                                                                                    : <?= $j_opd['kode']; ?><br />
                                                                                    : <?= $j_opd['nama_jabatan']; ?><br />
                                                                                    : <? //= $j_opd['alamat_opd']; 
                                                                                        ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <input type="hidden" name="_method" value="DELETE">
                                                                            <input type="text" name="opd_hdr_id" class="opd_hdr_id" value="<?= $j_opd['id']; ?>">

                                                                            <input type="text" name="opd_id" value="<?= $j_opd['opd_hdr_id']; ?>">


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
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <?= $this->include('/layout/opdtemp/_footer');  ?>
</div>



<!-- Modal Tambah Pejabat -->
<form method="POST" action="/addmasterjabatansu" enctype="multipart/form-data">
    <?= csrf_field(); ?>
    <div class="modal fade" id="addPejabat" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h3 class="modal-title fw-bold">
                        <i class="fas fa-pencil-alt"></i> FORM INPUT JABATAN OPD
                    </h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <!-- <label for="">NAMA BIDANG</label> -->
                                <select name="b_id" class="form-control" required>
                                    <option value="">PILIH NAMA BIDANG...</option>
                                    <?php foreach ($select as $bidang) : ?>
                                        <option value="1"><?= $bidang['nama_bidang']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <select name="sb_id" class="form-control" required>
                                    <option value="">PILIH SUB BIDANG...</option>
                                    <?php foreach ($subbid as $sb) : ?>
                                        <option value="1"><?= $sb['nama_sub_bidang']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="">NAMA JABATAN</label>
                        <input type="text" class="form-control" name="nama_j" required>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">KODE</label>
                                <input type="text" class="form-control" name="kd" equired>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Pilih Level</label>
                                <select name="lvl" class="form-control" required>
                                    <option value="">PILIH LEVEL...</option>
                                    <option value="1">Bupati</option>
                                    <option value="2">Sekretaris</option>
                                    <option value="3">OPD</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Hak Akses</label>
                        <input type="text" class="form-control" name="hah_id" required>
                    </div>
                    <div class="form-group">
                        <label for="">Catatan</label>
                        <textarea name="notes" class="form-control" required></textarea>
                    </div>



                </div>
                <div class="modal-footer">
                    <input type="hidden" name="opd_id" value="<?= $j_opd['opd_hdr_id']; ?>">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Data...</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times-circle"></i> Batalkan...</button>
                </div>

            </div>
        </div>
    </div>
</form>
<?= $this->endSection() ?>