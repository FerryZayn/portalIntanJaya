<?= $this->extend('/layout/mastersu/templet') ?>
<?= $this->section('content') ?>
<div class="main-panel">
    <div class="content">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">ORGANISASI PEMERINTAH DAERAH</h2>
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
                                <h4 class="card-title fw-bold text-white">DAFTAR OPD INTAN JAYA</h4>
                                <button class="btn bg-satu text-white fw-bold btn-round ml-auto" data-toggle="modal" data-target="#addPejabat">
                                    <i class="fas fa-plus-circle"></i>
                                    Tambah OPD
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>NAMA OPD</th>
                                            <th>ALAMAT</th>
                                            <th>JABATAN</th>
                                            <th>BIDANG</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($opdtampil as $v_opd) :
                                        ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $v_opd['nama_opd']; ?></td>
                                                <td><?= $v_opd['alamat_opd']; ?></td>
                                                <td>
                                                    <a href="/masterjabatansu/<?= $v_opd['id']; ?>" class="btn btn-primary btn-sm">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="/masterbidangsu/<?= $v_opd['id']; ?>" class="btn btn-primary btn-sm">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#inputBidang<?= $v_opd['id']; ?>">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                    <!-- Input Data Bidang Star -->
                                                    <form action="/masterupdatejabatansu" method="post">
                                                        <?= csrf_field(); ?>
                                                        <div class="modal fade" id="inputBidang<?= $v_opd['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header bg-primary">
                                                                        <h2 class="modal-title fw-bold text-primary" id="exampleModalLabel">
                                                                            <i class="fas fa-pen"></i> INPUT DATA BIDANG
                                                                        </h2>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">


                                                                        <div class="col-sm-12">
                                                                            <div class="form-group">
                                                                                <label><small>KODE BIDANG</small></label>
                                                                                <input type="text" class="form-control" name="kd" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-12">
                                                                            <div class="form-group">
                                                                                <label><small>NAMA BIDANG</small></label>
                                                                                <input type="text" class="form-control" name="nama_bidang" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-12">
                                                                            <div class="form-group">
                                                                                <label><small>KATEGORI</small></label>
                                                                                <select name="tipe_b_id" class="form-control" required>
                                                                                    <option value="">-- PILIH LEVEL KATEGORI --</option>
                                                                                    <option value="1">Sekretaris</option>
                                                                                    <option value="2">Umum</option>
                                                                                    <option value="100">Lainnya</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>


                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit" class="btn btn-success"><i class="fa fa-edit"></i> Simpan</button>
                                                                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <!-- Input Data Bidang End -->
                                                </td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#viewModal<?= $v_opd['id']; ?>">
                                                            <i class="fa fa-eye"></i>
                                                        </button>
                                                        <!-- Star Modal View-->
                                                        <div class="modal fade" id="viewModal<?= $v_opd['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header bg-primary">
                                                                        <h5 class="modal-title fw-bold" id="exampleModalLabel">
                                                                            <i class="fa fa-list"></i> VIEW OPD
                                                                        </h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-sm-3">
                                                                                Kode OPD <br />
                                                                                Nama OPD<br />
                                                                                Alamat OPD
                                                                            </div>
                                                                            <div class="col-sm-9 fw-bold">
                                                                                : <?= $v_opd['kode']; ?><br />
                                                                                : <?= $v_opd['nama_opd']; ?><br />
                                                                                : <?= $v_opd['alamat_opd']; ?>
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
                                                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal<?= $v_opd['id']; ?>">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <!-- Modal Edit Pegawai -->
                                                        <form action="/proseseditPegawai" method="post">
                                                            <?= csrf_field(); ?>
                                                            <div class="modal fade" id="editModal<?= $v_opd['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-lg" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header bg-warning">
                                                                            <h2 class="modal-title fw-bold text-primary" id="exampleModalLabel">
                                                                                <i class="fas fa-edit"></i> UPDATE OPD
                                                                            </h2>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="form-group">
                                                                                <label><small>NAMA OPD</small></label>
                                                                                <input type="text" class="form-control" value="<?= $v_opd['nama_opd']; ?>" name="opd" placeholder="Organisasi Perangkat Daerah" required>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-sm-6">
                                                                                    <div class="form-group">
                                                                                        <label><small>KODE OPD</small></label>
                                                                                        <input type="text" class="form-control" value="<?= $v_opd['kode']; ?>" name="kode" placeholder="Kode Instansi" required>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-6">
                                                                                    <div class="form-group">
                                                                                        <label><small>NOMOR UNIT KERJA</small></label>
                                                                                        <input type="text" class="form-control" name="nuk" value="" placeholder="Nomor Unit Kerja" required>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label><small>ALAMAT</small></label>
                                                                                <input type="text" class="form-control" name="alamat" placeholder="Alamat Instansi" required>
                                                                            </div>


                                                                            <div class="row">
                                                                                <div class="col-sm-6">
                                                                                    <div class="form-group">
                                                                                        <label><small>KODE POS</small></label>
                                                                                        <input type="text" class="form-control" name="k_pos" placeholder="Kode Pos" required>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-sm-6">
                                                                                    <div class="form-group">
                                                                                        <label><small>FAX</small></label>
                                                                                        <input type="text" class="form-control" name="fax" placeholder="Nomor Fax" required>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">
                                                                                <div class="col-sm-6">
                                                                                    <div class="form-group">
                                                                                        <label><small>LEVEL</small></label>
                                                                                        <select name="level" class="form-control" required>
                                                                                            <option value="">-- PILIH LEVEL OPD --</option>
                                                                                            <option value="1">Bupati</option>
                                                                                            <option value="2">Sekretariat</option>
                                                                                            <option value="3">OPD</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-sm-6">
                                                                                    <div class="form-group">
                                                                                        <label><small>TELEPON</small></label>
                                                                                        <input type="text" class="form-control" name="telepone" placeholder="Telepon Instansi" required>
                                                                                    </div>
                                                                                </div>
                                                                            </div>



                                                                            <div class="row">
                                                                                <div class="col-sm-6">
                                                                                    <div class="form-group">
                                                                                        <label><small>EMAIL</small></label>
                                                                                        <input type="email" class="form-control" name="email" placeholder="E-Mail Instansi" required>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-6">
                                                                                    <div class="form-group">
                                                                                        <label><small>WEBSITE</small></label>
                                                                                        <input type="text" class="form-control" name="website" placeholder="Website Instansi" required>
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
                                                            <!-- End Edit Pegawai -->
                                                        </form>


                                                        &nbsp;
                                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusModal<?= $v_opd['id']; ?>">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                        <!-- Modal Hapus-->
                                                        <form action="/hapusopdsu" method="post">
                                                            <?= csrf_field(); ?>
                                                            <div class="modal fade" id="hapusModal<?= $v_opd['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                                    Kode OPD <br />
                                                                                    Nama OPD<br />
                                                                                    Alamat OPD
                                                                                </div>
                                                                                <div class="col-sm-9 fw-bold">
                                                                                    : <?= $v_opd['kode']; ?><br />
                                                                                    : <?= $v_opd['nama_opd']; ?><br />
                                                                                    : <?= $v_opd['alamat_opd']; ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <input type="hidden" name="_method" value="DELETE">
                                                                            <input type="hidden" name="opd_hdr_id" class="opd_hdr_id" value="<?= $v_opd['id']; ?>">
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
<form method="POST" action="/addopdsu" enctype="multipart/form-data">
    <?= csrf_field(); ?>
    <div class="modal fade" id="addPejabat" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h3 class="modal-title fw-bold"><i class="fas fa-pencil-alt"></i> FORM INPUT OPD</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">NAMA OPD</label>
                        <input type="text" class="form-control" name="opd" placeholder="Organisasi Perangkat Daerah" required>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">KODE</label>
                                <input type="text" class="form-control" name="kode" placeholder="Kode Instansi" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">NOMOR</label>
                                <input type="text" class="form-control" name="nuk" placeholder="Nomor Unit Kerja" required>
                            </div>
                        </div>
                    </div>




                    <div class="form-group">
                        <label for="">ALAMAT</label>
                        <input type="text" class="form-control" name="alamat" placeholder="Alamat Instansi" required>
                    </div>


                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">KODE</label>
                                <input type="text" class="form-control" name="k_pos" placeholder="Kode Pos" required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">FAX</label>
                                <input type="text" class="form-control" name="fax" placeholder="Nomor Fax" required>
                            </div>
                        </div>
                    </div>




                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">LEVEL</label>
                                <select name="level" class="form-control" required>
                                    <option value="">-- PILIH LEVEL OPD --</option>
                                    <option value="1">Bupati</option>
                                    <option value="2">Sekretariat</option>
                                    <option value="3">OPD</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">TELEPON</label>
                                <input type="text" class="form-control" name="telepone" placeholder="Telepon Instansi" required>
                            </div>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">EMAIL</label>
                                <input type="email" class="form-control" name="email" placeholder="E-Mail Instansi" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">WEBSITE</label>
                                <input type="text" class="form-control" name="website" placeholder="Website Instansi" required>
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