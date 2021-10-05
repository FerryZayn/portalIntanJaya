<?= $this->extend('/layout/pemdatemp/templet') ?>
<?= $this->section('content') ?>
<div class="main-panel">
    <div class="content">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">PEJABAT PEMERINTAH DAERAH</h2>
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
                                    Tambah Pejabat
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pejabat</th>
                                            <th>Deskripsi</th>
                                            <th>User Created</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($p_tampil as $pejabat) : ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $pejabat->pegawai_id; ?></td>
                                                <td><?= $pejabat->deskripsi; ?></td>
                                                <td><?= $pejabat->user_created; ?></td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <a href="/administrator/portal-pemda/pejabat/<?= $pejabat->id; ?>" data-toggle="tooltip" class="btn btn-info btn-sm" data-original-title="Lihat detail data...">
                                                            <i class="fa fa-eye"></i>
                                                        </a> &nbsp;
                                                        <a href="/administrator/portal-pemda/pejabat/edit/<?= $pejabat->pegawai_id; ?>" data-toggle="tooltip" class="btn btn-warning btn-sm" data-original-title="Edit Task">
                                                            <i class="fa fa-edit"></i>
                                                        </a> &nbsp;
                                                        <form action="<?= base_url() ?>/administrator/portal-pemda/pejabat/<?= $pejabat->id; ?>" method="POST" class="d-inline">
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
    <?= $this->include('/layout/adminportal/_footer');  ?>
</div>
<!-- Modal Tambah Pejabat -->
<div class="modal fade" id="addPejabat" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">FORM INPUT PEJABAT</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="/PejabatController/simpanPejabat" enctype="multipart/form-data">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-6">
                            <select class="form-control" name="p_id">
                                <option value="">- PILIH PEGAWAI -</option>
                                <?php foreach ($pegawai as $data) : ?>
                                    <option value="<?= $data->id; ?>"><?= $data->nama_pegawai; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <br />
                            <img src="/admintemp/img/logo/user.png" class="img-thumbnail img-preview">
                        </div>
                        <div class="col-6">
                            <label for="fileFotoLabel" class="fileFotoLabel">File Foto</label>
                            <input type="file" class="form-control" name="file_foto" id="file_foto" onchange="previewImg()">
                            <div class="mb-3">
                                <input type="hidden" name="pegawai_id" value="<?= session()->get('id'); ?>" class="form-control">
                                <input type="hidden" name="path_file_foto" class="form-control" value="/foto-pejabat">
                            </div>
                            <div class="mb-3">
                                <textarea name="deskripsi" class="form-control" placeholder="Deskripsi"></textarea>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer no-bd">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Data...</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times-circle"></i> Batalkan...</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>