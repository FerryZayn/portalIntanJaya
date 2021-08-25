<?= $this->extend('/layout/pemdatemp/templet') ?>
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
                                <h4 class="card-title">Form Edit Berita</h4>
                            </div>
                        </div>
                        <div class="card-body">

                            <form method="POST" action="/PemdaController/updateBerita" enctype="multipart/form-data">
                                <?= csrf_field(); ?>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <input type="text" name="judul" value="<?= $v_berita->judul; ?>" class="form-control" placeholder="Judul Artikel">
                                            </div>
                                            <div class="mb-3">
                                                <textarea name="isi_artikel" class="form-control" id="deskberita" placeholder="Isi Artikel"><?= $v_berita->isi_artikel; ?></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col-2">
                                                        <img src="<?= base_url(); ?>/templet/gambar-berita/<?= $v_berita->file_gambar; ?>" class="img-thumbnail img-preview">
                                                    </div>
                                                    <div class="col-10">
                                                        <div class="mb-3">
                                                            <input type="text" name="nama_pengarang" value="<?= $v_berita->nama_pengarang; ?>" class="form-control" placeholder="Nama Pengarang">
                                                        </div>

                                                        <div class="mb-3">
                                                            <select id="basic" name="tipe_artikel_id" class="selectpicker show-tick form-control" data-live-search="true">
                                                                <option value="<?= $v_berita->id; ?>"><?= $v_berita->tipe; ?></option>
                                                                <option value="">- Pilih Tipe Artikel -</option>
                                                                <?php foreach ($v_tipeartikel as $ta) : ?>
                                                                    <option value="<?= $ta['id']; ?>"><?= $ta['tipe']; ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="fileFotoLabel" class="fileFotoLabel">File Foto</label>
                                                            <input type="file" class="form-control" name="file_gambar" id="file_foto" onchange="previewImg()">
                                                        </div>
                                                        <div class="mb-3">
                                                            <input type="hidden" name="opd_hdr_id" value="<?= session()->get('id'); ?>" class="form-control">
                                                        </div>
                                                        <div class="mb-3">
                                                            <input type="hidden" name="path_file_gambar" class="form-control" value="/templet/gambar-berita">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer no-bd">
                                    <button type="button" class="btn btn-primary" id="displayNotif"><i class="fas fa-save"></i> Simpan Perubahan...</button>
                                    <a href="/administrator/portal-pemda/berita/home" class="btn btn-danger"><i class="fas fa-times-circle"></i> Batalkan...</a>
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