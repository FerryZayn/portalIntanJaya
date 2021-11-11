<?= $this->extend('/layout/opdtemp/templet') ?>
<?= $this->section('content') ?>
<div class="main-panel">
    <div class="content">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">PUBLIKASI ARTIKEL PORTAL OPD</h2>
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
                                <h4 class="card-title">Konfirmasi Publikasi Artikel</h4>
                            </div>
                        </div>
                        <div class="card-body">

                            <form method="POST" action="/OPDController/publikasiPublishArtikel/" enctype="multipart/form-data">
                                <?= csrf_field(); ?>
                                <!-- <input type="hidden" name="_method" value="put"> -->
                                <input type="hidden" name="artikel_id" value="<?= $artikel_edit->id; ?>">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <label for="fileFotoLabel" class="fileFotoLabel mb-2 fw-bold">File Lampiran Publikasi Artikel</label>
                                                <input type="file" class="form-control" name="ba_fl">
                                                <input type="hidden" name="path_ba_fl" class="form-control" value="/templet/file-upload">
                                                <!-- <input type="text" name="p_input_id" value="<?php // session()->get('id'); 
                                                                                                    ?>" class="form-control"> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer no-bd">
                                    <button type="submit" class="btn btn-primary" id="displayNotif"><i class="fas fa-directions"></i> Publish artikel ini...</button>
                                    <a href="/administrator/portal-opd/dashboard" class="btn btn-danger"><i class="fas fa-times-circle"></i> Batalkan...</a>
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


<script src="<?= base_url() ?>/admintemp/ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace('deskberita');
</script>
<?= $this->endSection() ?>