<?= $this->extend('/layout/opdtemp/templet') ?>
<?= $this->section('content') ?>
<div class="main-panel">
    <div class="content">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">BERITA PORTAL</h2>
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
                                <h4 class="card-title">Form Edit Artikel</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="/OPDController/updateOPD/" enctype="multipart/form-data">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="put">
                                <input type="hidden" name="id" value="<?= $v_opdedit->id; ?>">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <input type="text" name="kode" value="<?= $v_opdedit->kode; ?>" class="form-control" placeholder="Kode OPD" required>
                                            </div>
                                            <div class="mb-3">
                                                <input type="text" name="nama_opd" value="<?= $v_opdedit->nama_opd; ?>" class="form-control" placeholder="Nama OPD" required>
                                            </div>
                                            <div class="mb-3">
                                                <input type="text" name="alamat_opd" value="<?= $v_opdedit->alamat_opd; ?>" class="form-control" placeholder="Alamat OPD" required>
                                            </div>
                                            <div class="mb-3">
                                                <input type="text" name="kode_pos" value="<?= $v_opdedit->kode_pos; ?>" class="form-control" placeholder="Kode Pos" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-3">
                                                <input type="text" name="telepon" value="<?= $v_opdedit->telepon; ?>" class="form-control" placeholder="Telepon" required>
                                            </div>
                                            <div class="mb-3">
                                                <input type="text" name="fax" value="<?= $v_opdedit->fax; ?>" class="form-control" placeholder="Fax" required>
                                            </div>
                                            <div class="mb-3">
                                                <input type="text" name="email" value="<?= $v_opdedit->email; ?>" class="form-control" placeholder="Alamat Email" required>
                                            </div>
                                            <div class="mb-3">
                                                <input type="text" name="website" value="<?= $v_opdedit->website; ?>" class="form-control" placeholder="Link Website" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-3">
                                                <input type="text" name="nomor_unit_kerja" value="<?= $v_opdedit->nomor_unit_kerja; ?>" class="form-control" placeholder="Nomor Unit Kerja" required>
                                            </div>

                                            <label><small>LEVEL</small></label>
                                            <select name="level" class="form-control level" required>
                                                <option value="<?= $v_opdedit->level; ?>" selected><?= $v_opdedit->level; ?></option>
                                                <option value="">-- PILIH LEVEL OPD --</option>
                                                <?php foreach ($level_opd as $opd) : ?>
                                                    <option value="<?= $opd['kode']; ?>"><?= $opd['nama_level']; ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer no-bd">
                                    <button type="submit" class="btn btn-primary" id="displayNotif"><i class="fas fa-save"></i> Simpan Data...</button>
                                    <a href="/administrator/portal-opd/v_opd" class="btn btn-danger"><i class="fas fa-times-circle"></i> Batalkan...</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= $this->include('/layout/adminportal/_footer');  ?>
</div>

<?= $this->endSection() ?>