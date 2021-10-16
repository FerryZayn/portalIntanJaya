<?= $this->extend('/layout/opdtemp/templet') ?>
<?= $this->section('content') ?>
<div class="main-panel">
    <div class="content">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">DATA Organisasi Pemerintah Daerah</h2>
                        <h5 class="text-white op-7 mb-2">Details item data OPD Kabupaten Intan Jaya...</h5>
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
                                <h4 class="card-title">Details Data OPD</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="col-md-4 pl-md-0 pr-md-0">
                                <div class="card card-pricing card-pricing-focus card-primary">
                                    <div class="card-header">
                                        <h4 class="card-title"><?= $v_opddetail->nama_opd; ?></h4>
                                        <div class="card-price">
                                            <span class="text">Kode</span>
                                            <span class="price">/<?= $v_opddetail->kode; ?></span>

                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <ul class="specification-list">
                                            <li>
                                                <span class="name-specification">Alamat OPD</span>
                                                <span class="status-specification"><?= $v_opddetail->alamat_opd; ?></span>
                                            </li>
                                            <li>
                                                <span class="name-specification">Kode Pos</span>
                                                <span class="status-specification"><?= $v_opddetail->kode_pos; ?></span>
                                            </li>
                                            <li>
                                                <span class="name-specification">Telepon</span>
                                                <span class="status-specification"><?= $v_opddetail->telepon; ?></span>
                                            </li>
                                            <li>
                                                <span class="name-specification">Fax</span>
                                                <span class="status-specification"><?= $v_opddetail->fax; ?></span>
                                            </li>
                                            <li>
                                                <span class="name-specification">Email</span>
                                                <span class="status-specification"><?= $v_opddetail->email; ?></span>
                                            </li>
                                            <li>
                                                <span class="name-specification">URL Website</span>
                                                <span class="status-specification"><?= $v_opddetail->website; ?></span>
                                            </li>
                                            <li>
                                                <span class="name-specification">Level OPD</span>
                                                <span class="status-specification"><?= $v_opddetail->level; ?></span>
                                            </li>
                                            <li>
                                                <span class="name-specification">Nomor Unit Kerja</span>
                                                <span class="status-specification"><?= $v_opddetail->nomor_unit_kerja; ?></span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card-footer">
                                        <a href="/administrator/portal-opd/v_opd" class="btn btn-success btn-block"><b><i class="fas fa-arrow-circle-left"></i> Kembali...</b></a>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= $this->include('/layout/adminportal/_footer');  ?>
</div>


<script src="<?= base_url() ?>/admintemp/ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace('deskberita');
</script>
<?= $this->endSection() ?>