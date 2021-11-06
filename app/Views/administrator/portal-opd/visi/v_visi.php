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
                                <h4 class="card-title">Daftar Berita</h4>
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
                                            <th>Judul Berita</th>
                                            <th>Nama Pengarang</th>
                                            <th>File Gambar</th>
                                            <th style="width: 10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($v_artikel as $informasi) :
                                        ?>

                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $informasi['judul']; ?></td>
                                                <td><?= $informasi['nama_pengarang']; ?></td>
                                                <td><?= $informasi['file_gambar']; ?></td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <a href="/administrator/portal-opd/<?= $informasi['id']; ?>" data-toggle="tooltip" class="btn btn-info btn-sm" data-original-title="Lihat detail data...">
                                                            <i class="fa fa-eye"></i>
                                                        </a> &nbsp;
                                                        <a href="/administrator/portal-opd/artikel-edit/<?= $informasi['id']; ?>" data-toggle="tooltip" class="btn btn-warning btn-sm" data-original-title="Edit Task">
                                                            <i class="fa fa-edit"></i>
                                                        </a> &nbsp;
                                                        <form action="<?= base_url() ?>/administrator/portal-opd/<?= $informasi['id']; ?>" method="POST" class="d-inline">
                                                            <?= csrf_field(); ?>
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Hapus item ini..."><i class="fa fa-trash"></i>
                                                        </form>
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
    <?= $this->include('/layout/adminportal/_footer');  ?>
</div>



<script src="<?= base_url() ?>/admintemp/ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace('deskberita');
</script>


<?= $this->endSection() ?>