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
                                        Tambah Bidang
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
                                            <th>NAMA OPD</th>
                                            <th>NAMA SUB BIDANG</th>
                                            <th>PEMBUAT</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($data as $j_opd) : ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $j_opd['kode']; ?></td>
                                                <td><?= $j_opd['nama_bidang']; ?></td>
                                                <td><? //= $j_opd['nama_sub_bidang']; 
                                                    ?></td>
                                                <td><? //= $j_opd['user_create']; 
                                                    ?></td>
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
                                                                                Nama OPD<br />
                                                                                Nama Sub Bidang <br />
                                                                                Nama Pembuat
                                                                            </div>
                                                                            <div class="col-sm-9 fw-bold">
                                                                                : <?= $j_opd['kode']; ?><br />
                                                                                : <?= $j_opd['nama_bidang']; ?><br />
                                                                                : <? //= $j_opd['']; 
                                                                                    ?><br />
                                                                                : <? //= $j_opd['nama_sub_bidang']; 
                                                                                    ?>
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
                                                        <form action="/updatemasterbidangsu" method="POST">
                                                            <?= csrf_field(); ?>
                                                            <div class="modal fade" id="editModal<?= $j_opd['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header bg-warning">
                                                                            <h2 class="modal-title fw-bold text-primary" id="exampleModalLabel"><i class="fas fa-edit"></i> UPDATE JABATAN OPD</h2>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">



                                                                            <input type="hidden" name="bidang_id" value="<?= $j_opd['id']; ?>">
                                                                            <input type="hidden" name="opd_id" value="<?= $j_opd['opd_hdr_id']; ?>">

                                                                            <div class="row">
                                                                                <div class="col-sm-12">
                                                                                    <div class="form-group">
                                                                                        <label for="">KODE BIDANG</label>
                                                                                        <input type="text" class="form-control" name="kode_bidang" value="<?= $j_opd['kode']; ?>" equired>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-sm-12">
                                                                                    <div class="form-group">
                                                                                        <label for="">NAMA BIDANG</label>
                                                                                        <input type="text" class="form-control" name="nama_bidang" value="<?= $j_opd['nama_bidang']; ?>" required>
                                                                                    </div>
                                                                                </div>
                                                                            </div>




                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="submit" class="btn btn-warning"><i class="fa fa-edit"></i> Update</button>
                                                                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        <!-- End Edit Pegawai -->


                                                        &nbsp;
                                                        <button class="btn btn-danger btn-sm" id="alert_demo_8" data-toggle="modal" data-target="#hapusModal<?= $j_opd['id']; ?>">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                        <!-- Modal Hapus-->
                                                        <form action="/delmasterbidang" method="POST">
                                                            <?= csrf_field(); ?>
                                                            <div class="modal fade" id="hapusModal<?= $j_opd['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header bg-danger">
                                                                            <h5 class="modal-title fw-bold" id="exampleModalLabel">
                                                                                <i class="fas fa-trash-alt"></i> Ingin hapus data ini?
                                                                            </h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <div class="col-sm-3">
                                                                                    KODE <br />
                                                                                    Nama OPD
                                                                                </div>
                                                                                <div class="col-sm-9 fw-bold">
                                                                                    : <?= $j_opd['kode']; ?><br />
                                                                                    : <?= $j_opd['nama_bidang']; ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <input type="hidden" name="_method" value="DELETE">
                                                                            <input type="hidden" name="bidang_id" value="<?= $j_opd['id']; ?>">
                                                                            <input type="hidden" name="opd_id" value="<?= $j_opd['opd_hdr_id']; ?>">

                                                                            <button type="button" class="btn btn-info" data-dismiss="modal"><i class="far fa-times-circle"></i> Close</button>
                                                                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus...</button>
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
<form method="POST" action="/addmasterbidangsu" enctype="multipart/form-data">
    <?= csrf_field(); ?>
    <div class="modal fade" id="addPejabat" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h3 class="modal-title fw-bold">
                        <i class="fas fa-pencil-alt"></i> INPUT MASTER BIDANG
                    </h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">




                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">KODE BIDANG</label>
                                <input type="text" class="form-control" name="kd" equired>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">NAMA BIDANG</label>
                                <input type="text" class="form-control" name="nama_bidang" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">KATEGORI</label>
                                <select name="tipe_b_id" class="form-control" required>
                                    <option value="">PILIH KATEGORI...</option>
                                    <option value="1">Sekretaris</option>
                                    <option value="2">Umum</option>
                                    <option value="100">Lainnya</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">NAMA OPD</label>
                                <select name="opd_id" class="form-control" required>
                                    <option value="">PILIH NAMA OPD...</option>
                                    <?php foreach ($select as $opd) : ?>
                                        <option value="<?= $opd->id; ?>"><?= $opd->nama_opd; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Data...</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times-circle"></i> Batalkan...</button>
                </div>

            </div>
        </div>
    </div>
</form>




<?= $this->endSection() ?>