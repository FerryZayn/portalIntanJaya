<?= $this->extend('/layout/pemdatemp/templet') ?>
<?= $this->section('content') ?>
<div class="main-panel">
    <div class="content">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">VISI PEMERINTAH DAERAH</h2>
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
                                <h4 class="card-title">Daftar Visi</h4>
                                <button class="btn bg-satu text-white fw-bold btn-round ml-auto" data-toggle="modal" data-target="#addPejabat">
                                    <i class="fas fa-plus-circle"></i>
                                    Tambah Visi
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Isi Visi</th>
                                            <th>Author</th>
                                            <th>Tanggal Input</th>
                                            <th style="width: 10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Software Engineer</td>
                                            <td>Edinburgh</td>
                                            <td>Edinburgh</td>
                                            <td>
                                                <div class="form-button-action">
                                                    <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= $this->include('/layout/pemdatemp/_footer');  ?>
</div>

<!-- Modal Tambah Visi -->
<div class="modal fade" id="addPejabat" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">FORM INPUT VISI</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Visi Pemerintah Daerah</label>
                                <input type="text" class="form-control" id="deskberita">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer no-bd">
                    <button type="submit" id="addRowButton" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Data...</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times-circle"></i> Batalkan...</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?= $this->endSection() ?>