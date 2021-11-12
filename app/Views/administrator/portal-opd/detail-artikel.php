<?= $this->extend('/layout/opdtemp/templet') ?>
<?= $this->section('content') ?>
<div class="main-panel">
    <div class="content">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">LAMPIRAN ARTIKEL PORTAL</h2>
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
                                <h4 class="card-title">Form Lampiran Artikel</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <?= $d_artikel->judul; ?><br />
                            <?= $d_artikel->isi_artikel; ?>

                            <form method="POST" action="/OPDController/simpanLampiranartikel/" enctype="multipart/form-data">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="put">
                                <input type="text" name="art_id" value="<?= $d_artikel->id; ?>">
                                <div class="row">
                                    <div class="col-sm-12">


                                        <div class="mb-3">
                                            <label for="fileFotoLabel" class="fileFotoLabel fw-bold mb-2">Tambah File Lapiran</label>
                                            <input type="file" class="form-control" name="file_lam">
                                        </div>
                                        <div class="mb-3">
                                            <input type="hidden" name="path_file_lam" class="form-control" value="/templet/file-upload">
                                        </div>


                                    </div>
                                </div>
                                <div class="modal-footer no-bd">
                                    <button type="submit" class="btn btn-primary" id="displayNotif"><i class="fas fa-save"></i> Simpan Data...</button>
                                    <a href="/administrator/portal-opd/berita/v_berita" class="btn btn-danger"><i class="fas fa-times-circle"></i> Batalkan...</a>
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