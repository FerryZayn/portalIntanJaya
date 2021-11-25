<?= $this->extend('/layout/mastertemp/templet') ?>
<?= $this->section('content') ?>
<div class="main-panel">
    <div class="content">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">MASTER PEGAWAI</h2>
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
                                <h4 class="card-title">Daftar Data Pegawai</h4>
                                <button class="btn bg-satu text-white fw-bold btn-round ml-auto" data-toggle="modal" data-target="#addModal">
                                    <i class="fas fa-plus-circle"></i>
                                    Tambah Pegawai
                                </button>

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
                                            <th>Nama Pegawai</th>
                                            <th>Golongan</th>
                                            <th>NIP</th>
                                            <th>Nama Jabatan</th>
                                            <th style="width: 10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($v_pegawai as $peg) : ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $peg['nama_pegawai']; ?></td>
                                                <td><?= $peg['golongan']; ?></td>
                                                <td><?= $peg['nip']; ?></td>
                                                <td><?= $peg['nama_jabatan']; ?></td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <a href="/administrator/master/v_pegawai/<?= $peg['id']; ?>" data-toggle="tooltip" class="btn btn-info btn-sm" data-original-title="Lihat detail data...">
                                                            <i class="fa fa-eye"></i>
                                                        </a> &nbsp;
                                                        <a href="/administrator/master/v_pegawai/edit/<?= $peg['id']; ?>" data-toggle="tooltip" class="btn btn-warning btn-sm" data-original-title="Edit Task">
                                                            <i class="fa fa-edit"></i>
                                                        </a> &nbsp;
                                                        <form action="<?= base_url() ?>/administrator/master/v_pegawai/<?= $peg['id'] ?>" method="POST" class="d-inline">
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
    <?= $this->include('/layout/mastertemp/_footer');  ?>
</div>


<!-- Modal Add Product-->
<form action="/prosesaddPegawai" method="post">
    <?= csrf_field(); ?>
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">TAMBAH PEGAWAI</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <div class="form-group">
                        <!-- <label for="">NAMA LENGKAP</label> -->
                        <input id="namalengkap" placeholder="NAMA LENGKAP" type="text" class="form-control msg <?= session()->getFlashdata('fullname') ? 'is-invalid' : '' ?>" name="fullname" value="<?= old('fullname') ?>">

                    </div>

                    <div class="row">
                        <div class="form-group col">
                            <!-- <label for="">NOMOR INDUK PEGAWAI NEGRI</label> -->
                            <input id="nip" placeholder="NOMOR INDUK PEGAWAI NEGRI" type="text" class="form-control <?= session()->getFlashdata('nip') ? 'is-invalid' : '' ?>" name="nip" value="">
                        </div>

                        <div class="form-group col">
                            <!-- <label for="">NOMOR INDUK KEPENDUDUKAN</label> -->
                            <input type="text" placeholder="NOMOR INDUK KEPENDUDUKAN" class="form-control <?= session()->getFlashdata('nik') ? 'is-invalid' : '' ?>" name="nik" value="<?= old('nik') ?>">

                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col">
                            <select class="form-control <?= session()->getFlashdata('jabatan') ? 'is-invalid' : '' ?>" name="jabatan" required>
                                <option value="">-- PILIH JABATAN PNS--</option>
                                <?php foreach ($jabatan as $value) :
                                ?>
                                    <option value="<?php $value->id ?>"><?php $value->nama_jabatan; ?></option>
                                <?php endforeach; ?>
                            </select>

                        </div>
                        <div class="form-group col">
                            <!-- <label for="">GOLONGAN</label> -->
                            <select class="form-control <?= session()->getFlashdata('golongan') ? 'is-invalid' : '' ?>" name="golongan" required>
                                <option value="">-- PILIH GOLONGAN --</option>
                                <?php foreach ($golongan as $value) : ?>
                                    <option value="<?= $value->id ?>"><?= $value->kode; ?></option>
                                <?php endforeach; ?>
                            </select>

                        </div>

                    </div>

                    <div class="row">
                        <div class="form-group col">
                            <!-- <label for="">ALAMAT E-MAIL</label> -->
                            <input id="email" placeholder="ALAMAT E-MAIL" type="email" class="form-control <?= session()->getFlashdata('email') ? 'is-invalid' : '' ?>" name="email" value="<?= old('email') ?>">

                        </div>
                        <div class="form-group col">
                            <!-- <label for="">USERNAME</label> -->
                            <input type="text" placeholder="USERNAME" class="form-control <?= session()->getFlashdata('username') ? 'is-invalid' : '' ?>" name="username" value="<?= old('username') ?>">

                        </div>
                    </div>



                    <div class="row">
                        <div class="form-group col">
                            <!-- <label for="">PASSWORD</label> -->
                            <input id="password" placeholder="PASSWORD" type="password" class="form-control pwstrength <?= session()->getFlashdata('password') ? 'is-invalid' : '' ?>" data-indicator="pwindicator" name="password">

                            <div id="pwindicator" class="pwindicator">
                                <div class="bar"></div>
                                <div class="label"></div>
                            </div>
                        </div>
                        <div class="form-group col">
                            <!-- <label for="">KONFRIMASI PASSWORD</label> -->
                            <input id="password2" placeholder="KONFRIMASI PASSWORD" type="password" class="form-control <?= session()->getFlashdata('password') ? 'is-invalid' : '' ?>" name="password-confirm">

                        </div>
                    </div>

                    <div class="row">

                        <div class="form-group col">
                            <label for="">TANGGAL LAHIR</label>
                            <input type="date" class="form-control <?= session()->getFlashdata('tgl_lahir') ? 'is-invalid' : '' ?>" name="tgl_lahir" value="<?= old('tgl_lahir') ?>">

                        </div>
                        <div class="form-group col">
                            <label for="">NO TELEPON</label>
                            <input type="text" class="form-control <?= session()->getFlashdata('phone') ? 'is-invalid' : '' ?>" name="phone" value="<?= old('phone') ?>">

                        </div>
                    </div>


                    <div class="row">

                        <div class="form-group col">
                            <!-- <label for="">KODE</label> -->
                            <input type="text" placeholder="KODE" class="form-control <?= session()->getFlashdata('kode') ? 'is-invalid' : '' ?>" name="kode" value="<?= old('kode') ?>">

                        </div>
                        <div class="form-group col">
                            <!-- <label for="">JENIS KELAIMIN</label> -->
                            <select class="form-control <?= session()->getFlashdata('kode') ? 'is-invalid' : '' ?>" name="gender" required>
                                <option value="">-- Pilih Jenis Kelain --</option>
                                <option value="1">LAKI-LAKI</option>
                                <option value="2">PEREMPUAN</option>
                            </select>
                        </div>
                    </div>




                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Modal Add Product-->


<?= $this->endSection() ?>