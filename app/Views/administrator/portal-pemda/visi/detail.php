<?= $this->extend('/layout/pemdatemp/templet') ?>
<?= $this->section('content') ?>
<div class="main-panel">
    <div class="content">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">DETAIL ITEM BERITA PORTAL</h2>
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
                                <h4 class="card-title">Detail item Berita</h4>
                                <a href="/administrator/portal-pemda/berita/home" class="btn bg-satu text-white fw-bold btn-round ml-auto">
                                    <i class="fas fa-arrow-circle-left"></i>
                                    Kembali
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-text">
                                <h2 class="fw-bold"><?= $v_berita->judul; ?></h2>
                                <div class="flex-1 ml-3 pt-1">
                                    <h6 class="text-uppercase fw-bold mb-1"><i class="icon-user"></i> <?= $v_berita->nama_pengarang; ?>
                                        <span class="text-info pl-3"><i class="icon-clock"></i>
                                            <?php
                                            echo date('d F Y - H:i:s', strtotime($v_berita->created_date));
                                            ?>
                                        </span>
                                        <span class="text-success pl-3"><?= $v_berita->tipe; ?></span>
                                        <span class="text-success pl-3"><?= $v_berita->kategori; ?></span>
                                        <span class="text-success pl-3"><?= $v_berita->nama_status; ?></span>
                                    </h6>
                                </div>
                                <p><?= $v_berita->isi_artikel; ?></p>
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