<?= $this->extend('/layout/pemdatemp/templet') ?>
<?= $this->section('content') ?>
<div class="main-panel">
    <div class="content">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">DETAIL ITEM PROFIL PEJABAT</h2>
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
                                <h4 class="card-title">Detail item Profil Pejabat</h4>
                                <a href="/administrator/portal-pemda/pejabat/v_pejabat" class="btn bg-satu text-white fw-bold btn-round ml-auto">
                                    <i class="fas fa-arrow-circle-left"></i> Kembali
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-text">
                                <div class="col-md-3 pl-md-0 pr-md-0">
                                    <div class="card-pricing2 card-primary">
                                        <div class="pricing-header">
                                            <h3 class="fw-bold">Detail Data</h3>
                                            <span class="sub-title">Profil Pejabat</span>
                                        </div>
                                        <div class="price-value">
                                            <span class="amount avatar avatar-xxl">
                                                <img class="avatar-img rounded" src="<?= base_url(); ?>/templet/foto-pejabat/1632976310_4acd4f7740731423e761.png">
                                            </span>
                                        </div>
                                        <ul class="pricing-content">
                                            <li><?= $v_pejabat->pegawai_id; ?></li>
                                            <li><?= $v_pejabat->user_created; ?></li>
                                            <li><?= $v_pejabat->user_updated; ?></li>
                                            <li><?= $v_pejabat->deskripsi; ?></li>
                                        </ul>
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

<?= $this->endSection() ?>