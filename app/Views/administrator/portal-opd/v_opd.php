<?= $this->extend('/layout/opdtemp/templet') ?>
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
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Daftar Pejabat</h4>
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
                                            <th>KODE OPD</th>
                                            <th>NAMA OPD</th>
                                            <th>ALAMAT OPD</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($opdtampil as $v_opd) : ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $v_opd['kode']; ?></td>
                                                <td><?= $v_opd['nama_opd']; ?></td>
                                                <td><?= $v_opd['alamat_opd']; ?></td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <a href="/administrator/portal-opd/<?= $v_opd['id']; ?>" data-toggle="tooltip" class="btn btn-info btn-sm" data-original-title="Lihat detail data...">
                                                            <i class="fa fa-eye"></i>
                                                        </a> &nbsp;
                                                        <a href="/administrator/portal-opd/v_edit/<?= $v_opd['id']; ?>" data-toggle="tooltip" class="btn btn-warning btn-sm" data-original-title="Edit Task">
                                                            <i class="fa fa-edit"></i>
                                                        </a> &nbsp;
                                                        <form action="<?= base_url() ?>/administrator/portal-opd/<?= $v_opd['id']; ?>" method="POST" class="d-inline">
                                                            <?= csrf_field(); ?>
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Hapus item ini..."><i class="fa fa-trash"></i>
                                                        </form>
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
<form method="POST" action="/OPDController/tambahOpd" enctype="multipart/form-data">
    <?= csrf_field(); ?>
    <div class="modal fade" id="addPejabat" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header no-bd">
                    <h5 class="modal-title">FORM INPUT OPD</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="form-group">
                    <label><small>NAMA OPD</small></label>
                    <input type="text" class="form-control" name="opd" placeholder="Organisasi Perangkat Daerah" required>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label><small>KODE OPD</small></label>
                            <input type="text" class="form-control" name="kode" placeholder="Kode Instansi" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label><small>NOMOR UNIT KERJA</small></label>
                            <input type="text" class="form-control" name="nuk" placeholder="Nomor Unit Kerja" required>
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


                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Data...</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times-circle"></i> Batalkan...</button>
                </div>

            </div>
        </div>
    </div>
</form>
<?= $this->endSection() ?>