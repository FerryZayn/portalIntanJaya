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
                                            <th style="width: 10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($v_pegawai as $peg) : ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $peg['nama_pegawai']; ?></td>
                                                <td><?= $peg['nip']; ?></td>
                                                <td><?= $peg['golongan']; ?></td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#viewModal<?= $peg['id']; ?>">
                                                            <i class="fa fa-eye"></i>
                                                        </button>
                                                        <!-- Modal View-->
                                                        <div class="modal fade" id="viewModal<?= $peg['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">VIEW BIDANG</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-sm-3">
                                                                                Nama Pegawai <br />
                                                                                Nomor Induk Pegawai<br />
                                                                                Golongan<br />
                                                                                Nama Jabatan
                                                                            </div>
                                                                            <div class="col-sm-9 fw-bold">
                                                                                : <?= $peg['nama_pegawai']; ?><br />
                                                                                : <?= $peg['nip']; ?><br />
                                                                                : <?= $peg['golongan']; ?><br />
                                                                                : <?= $peg['nama_jabatan']; ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- End Modal View-->


                                                        &nbsp;
                                                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal<?= $peg['id']; ?>">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <!-- Modal Edit Pegawai -->
                                                        <form action="/proseseditPegawai" method="post">
                                                            <div class="modal fade" id="editModal<?= $peg['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-lg" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h2 class="modal-title fw-bold text-primary" id="exampleModalLabel"><i class="fas fa-edit"></i> UPDATE DATA PEGAWAI</h2>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="form-group">
                                                                                <label for="defaultSelect">Nama Lengkap</label>
                                                                                <input id="namalengkap" type="text" class="form-control fullname" name="fullname" value="<?= $peg['nama_pegawai']; ?>">
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-6 col-lg-6">
                                                                                    <div class="form-group">
                                                                                        <label for="defaultSelect">Nomor Induk Pegawai Negeri</label>
                                                                                        <input id="nip" type="text" class="form-control nip" name="nip" value="<?= $peg['nip']; ?>">
                                                                                    </div>

                                                                                    <div class="form-group">
                                                                                        <label for="defaultSelect">Nomor Induk Kependukukan</label>
                                                                                        <input type="text" class="form-control nik" name="nik" value="">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="defaultSelect">Tanggal Lahir</label>
                                                                                        <input type="date" class="form-control tgl_lahir" name="tgl_lahir" value="">

                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="defaultSelect">Nomor Telepon</label>
                                                                                        <input type="text" class="form-control phone" name="phone" value="">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="defaultSelect">Jenis Kelamin</label>
                                                                                        <select class="form-control" name="gender">
                                                                                            <option value="">- Pilih Jenis Kelamin-</option>
                                                                                            <option value="1">Laki-laki</option>
                                                                                            <option value="2">Perempuan</option>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="defaultSelect">Alamat E-Mail</label>
                                                                                        <input id="email" type="email" class="form-control email" name="email" value="">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6 col-lg-6">
                                                                                    <div class="form-group">
                                                                                        <label for="defaultSelect">Jabatan Pegawai Negeri</label>
                                                                                        <select class="form-control jabatan" name="jabatan">
                                                                                            <option value="">- Pilih Jabatan -</option>
                                                                                            <?php foreach ($jabatan as $value) : ?>
                                                                                                <option value="<?= $value->id ?>"><?= $value->nama_jabatan; ?></option>
                                                                                            <?php endforeach; ?>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="defaultSelect">Golongan Pegawai Negeri</label>
                                                                                        <select class="form-control golongan" name="golongan">
                                                                                            <option value="">- Pilih Golongan -</option>
                                                                                            <?php foreach ($golongan as $value) : ?>
                                                                                                <option value="<?= $value->id ?>"><?= $value->kode; ?></option>
                                                                                            <?php endforeach; ?>
                                                                                        </select>
                                                                                    </div>

                                                                                    <div class="form-group">
                                                                                        <label for="defaultSelect">Kode</label>
                                                                                        <input type="text" class="form-control kode" name="kode" value="">
                                                                                    </div>

                                                                                    <div class="form-group">
                                                                                        <label for="defaultSelect">Username</label>
                                                                                        <input type="text" class="form-control username" name="username" value="">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="defaultSelect">Password</label>
                                                                                        <input value="" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password">

                                                                                        <div id="pwindicator" class="pwindicator">
                                                                                            <div class="bar"></div>
                                                                                            <div class="label"></div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="defaultSelect">Konfirmasi Password</label>
                                                                                        <input id="password2" type="password" class="form-control" name="password-confirm">

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="submit" class="btn btn-success"><i class="fa fa-edit"></i> Update</button>
                                                                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- End Edit Pegawai  View-->
                                                        </form>


                                                        &nbsp;
                                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusModal<?= $peg['id']; ?>">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                        <!-- Modal Hapus-->
                                                        <form action="/hapuspegawai" method="post">
                                                            <?= csrf_field(); ?>
                                                            <div class="modal fade" id="hapusModal<?= $peg['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Ingin hapus data ini?</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <div class="col-sm-3">
                                                                                    Nama Pegawai <br />
                                                                                    Nomor Induk Pegawai<br />
                                                                                    Golongan<br />
                                                                                    Nama Jabatan
                                                                                </div>
                                                                                <div class="col-sm-9 fw-bold">
                                                                                    : <?= $peg['nama_pegawai']; ?><br />
                                                                                    : <?= $peg['nip']; ?><br />
                                                                                    : <?= $peg['golongan']; ?><br />
                                                                                    : <?= $peg['nama_jabatan']; ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <input type="hidden" name="_method" value="DELETE">
                                                                            <input type="hidden" name="id" class="id" value="<?= $peg['id']; ?>">
                                                                            <button type="button" class="btn btn-sm btn-info" data-dismiss="modal">
                                                                                <i class="fas fa-times"></i> Close
                                                                            </button>
                                                                            <button type="submit" class="btn btn-sm btn-danger">
                                                                                <i class="fa fa-trash"></i> Hapus...
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        <!-- End Modal Hapus-->
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
                    <h2 class="modal-title fw-bold text-primary" id="exampleModalLabel"><i class="fas fa-user-plus"></i> TAMBAH PEGAWAI</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="defaultSelect">Nama Lengkap</label>
                        <input id="namalengkap" type="text" class="form-control msg <?= session()->getFlashdata('fullname') ? 'is-invalid' : '' ?>" name="fullname" value="<?= old('fullname') ?>">
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="defaultSelect">Nomor Induk Pegawai Negeri</label>
                                <input id="nip" type="text" class="form-control <?= session()->getFlashdata('nip') ? 'is-invalid' : '' ?>" name="nip" value="">
                            </div>
                            <div class="form-group">
                                <label for="defaultSelect">Nomor Induk Kependukukan</label>
                                <input type="text" class="form-control <?= session()->getFlashdata('nik') ? 'is-invalid' : '' ?>" name="nik" value="<?= old('nik') ?>">
                            </div>
                            <div class="form-group">
                                <label for="defaultSelect">Alamat E-Mail</label>
                                <input id="email" type="email" class="form-control <?= session()->getFlashdata('email') ? 'is-invalid' : '' ?>" name="email" value="<?= old('email') ?>">
                            </div>
                            <div class="form-group">
                                <label for="defaultSelect">Jenis Kelain</label>
                                <select class="form-control <?= session()->getFlashdata('kode') ? 'is-invalid' : '' ?>" name="gender" required>
                                    <option value="">- Pilih Jenis Kelain -</option>
                                    <option value="1">Laki-laki</option>
                                    <option value="2">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Tanggal Lahir</label>
                                <input type="date" class="form-control <?= session()->getFlashdata('tgl_lahir') ? 'is-invalid' : '' ?>" name="tgl_lahir" value="<?= old('tgl_lahir') ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Nomor Telepon</label>
                                <input type="text" class="form-control <?= session()->getFlashdata('phone') ? 'is-invalid' : '' ?>" name="phone" value="<?= old('phone') ?>">

                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="defaultSelect">Pilih Jabatan PNS</label>
                                <select class="form-control <?= session()->getFlashdata('jabatan') ? 'is-invalid' : '' ?>" name="jabatan" required>
                                    <option value="">- Pilih Jabatan PNS -</option>
                                    <?php foreach ($jabatan as $jab) : ?>
                                        <option value="<?= $jab->kode; ?>"><?= $jab->nama_jabatan; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="defaultSelect">Golongan Pegawai Negeri</label>
                                <select class="form-control <?= session()->getFlashdata('golongan') ? 'is-invalid' : '' ?>" name="golongan" required>
                                    <option value="">- Pilih Golongan -</option>
                                    <?php foreach ($golongan as $value) : ?>
                                        <option value="<?= $value->id ?>"><?= $value->kode; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="defaultSelect">Kode</label>
                                <input type="text" class="form-control <?= session()->getFlashdata('kode') ? 'is-invalid' : '' ?>" name="kode" value="<?= old('kode') ?>">
                            </div>
                            <div class="form-group">
                                <label for="defaultSelect">Nama Pengguna</label>
                                <input type="text" class="form-control <?= session()->getFlashdata('username') ? 'is-invalid' : '' ?>" name="username" value="<?= old('username') ?>">
                            </div>
                            <div class="form-group">
                                <label for="defaultSelect">Password</label>
                                <input id="password" type="password" class="form-control pwstrength <?= session()->getFlashdata('password') ? 'is-invalid' : '' ?>" data-indicator="pwindicator" name="password">
                                <div id="pwindicator" class="pwindicator">
                                    <div class="bar"></div>
                                    <div class="label"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="defaultSelect">Konfirmasi Password</label>
                                <input id="password2" type="password" class="form-control <?= session()->getFlashdata('password') ? 'is-invalid' : '' ?>" name="password-confirm">
                            </div>


                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Modal Add Product-->



<?= $this->endSection() ?>