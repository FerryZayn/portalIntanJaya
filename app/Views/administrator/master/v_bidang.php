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
                                <h4 class="card-title">Daftar Data Bidang</h4>
                                <button class="btn bg-satu text-white fw-bold btn-round ml-auto" data-toggle="modal" data-target="#addModal">
                                    <i class="fas fa-plus-circle"></i>
                                    Tambah Bidang
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
                                            <th>Kode Bidang</th>
                                            <th>Nama Bidang</th>
                                            <th style="width: 10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($data as $peg) : ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $peg['kode']; ?></td>
                                                <td><?= $peg['nama_bidang']; ?></td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#viewModal<?= $peg['id']; ?>">
                                                            <i class="fa fa-eye"></i>
                                                        </button>
                                                        <!-- Modal View-->
                                                        <div class="modal fade" id="viewModal<?= $peg['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
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
                                                                                ID <br />
                                                                                Kode Bidang <br />
                                                                                Nama Bidang
                                                                            </div>
                                                                            <div class="col-sm-9 fw-bold">
                                                                                : <?= $peg['id']; ?><br />
                                                                                : <?= $peg['kode']; ?><br />
                                                                                : <?= $peg['nama_bidang']; ?>
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

                                                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#eeditModal<?= $peg['id']; ?>">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <!-- Modal Edit-->
                                                        <form action="/updatebidang" method="post">
                                                            <?= csrf_field(); ?>
                                                            <div class="modal fade" id="eeditModal<?= $peg['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">UBAH BIDANG</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <input type="hidden" name="_method" value="PUT">
                                                                            <input type="hidden" name="id" class="id">
                                                                            <div class="form-group">
                                                                                <label>Kode Bidang</label>
                                                                                <input type="text" class="form-control" value="<?= $peg['kode']; ?>" name="kode">
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label>Nama Bidang</label>
                                                                                <input type="text" class="form-control" value="<?= $peg['nama_bidang']; ?>" name="nama_bidang">
                                                                            </div>

                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <input type="hidden" name="_method" value="PUT">
                                                                            <input type="hidden" name="id" class="id" value="<?= $peg['id']; ?>">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        <!-- End Modal Edit-->

                                                        &nbsp;
                                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusModal<?= $peg['id']; ?>">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                        <!-- Modal Hapus-->
                                                        <form action="/hapusbidang" method="post">
                                                            <?= csrf_field(); ?>
                                                            <div class="modal fade" id="hapusModal<?= $peg['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                                    Kode Bidang <br />
                                                                                    Nama Bidang
                                                                                </div>
                                                                                <div class="col-sm-9 fw-bold">
                                                                                    : <?= $peg['kode']; ?><br />
                                                                                    : <?= $peg['nama_bidang']; ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <input type="hidden" name="_method" value="DELETE">
                                                                            <input type="hidden" name="id" class="id" value="<?= $peg['id']; ?>">
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


<!-- Modal Add Product-->
<form action="/addbidang" method="post">
    <?= csrf_field(); ?>
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">TAMBAH BIDANG</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <div class="form-group">
                        <label>Kode Bidang</label>
                        <input type="text" class="form-control" name="kd" placeholder="Kode Bidang" required>
                    </div>

                    <div class="form-group">
                        <label>Nama Bidang</label>
                        <input type="text" class="form-control" name="nama_bidang" placeholder="Nama Bidang" required>
                    </div>
                    <div class="form-group">
                        <label for="">Tipe Bidang</label>
                        <select class="form-control" name="tipe_b_id">
                            <option value="1">Sekretariat</option>
                            <option value="2">Umum</option>
                            <option value="100">Lainnya</option>
                        </select>
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
<!-- End Modal Add Product-->


<?= $this->endSection() ?>