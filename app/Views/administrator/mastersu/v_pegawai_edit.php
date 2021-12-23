<?= $this->extend('/layout/mastersu/templet') ?>
<?= $this->section('content') ?>



<div class="main-panel">
    <!-- Star Modal Edit Pegawai -->
    <form action="/prosesupdatepegawai" method="post">
        <?= csrf_field(); ?>
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
                            <div class="card-header bg-warning">
                                <div class="d-flex align-items-center">
                                    <h4 class="card-title fw-bold text-white">
                                        <i class="fa fa-edit"></i> Form Edit Pegawai
                                    </h4>
                                </div>
                            </div>
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="">NAMA LENGKAP</label>
                                            <input id="namalengkap" type="text" class="form-control msg" value="<?= $tampiledit->nama_pegawai; ?>" name="p_nama" required>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="">NOMOR INDUK KEPENDUDUKAN</label>
                                                    <input type="text" class="form-control" value="<?= $tampiledit->nik; ?>" name="p_nik" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="">NOMOR INDUK PEGAWAI NEGRI</label>
                                                    <input id="p_nip" type="text" class="form-control" value="<?= $tampiledit->nip; ?>" name="p_nip" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="">JENIS KELAIMIN</label>
                                                    <select class="form-control" name="p_kelamin_code" required>
                                                        <option value="<?= $tampiledit->jenis_kelamin_code; ?>"><?= $tampiledit->jenis_kelamin_code; ?></option>
                                                        <option value=""></option>
                                                        <option>-- PILIH GENDER --</option>
                                                        <option value="1">LAKI-LAKI</option>
                                                        <option value="2">PEREMPUAN</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="">NO TELEPON</label>
                                                    <input type="text" class="form-control" value="<?= $tampiledit->no_hp; ?>" name="p_no_hp" required>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="">TEMPAT LAHIR</label>
                                                    <input type="text" class="form-control" value="<?= $tampiledit->tempat_lahir; ?>" name="tempat_l" value="<?= old('tempat_l') ?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="">TANGGAL LAHIR</label>
                                                    <input type="date" class="form-control" value="<?= $tampiledit->tanggal_lahir; ?>" name="p_tanggal_lahir" required>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="">NAMA OPD</label>
                                            <select class="form-control" name="opd_id" id="opd_id" required>
                                                <option value="<?= $tampiledit->opd_hdr_id; ?>"><?= $tampiledit->nama_opd; ?></option>
                                                <option value="">GANTI OPD LAINNYA...</option>
                                                <?php foreach ($opdview as $value) : ?>
                                                    <option value="<?= $value->id; ?>"><?= $value->nama_opd; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" class="jabatan_id" value="<?= $tampiledit->jabatan_id ?>">
                                            <label for="">JABATAN PEGAWAI NEGRI</label>
                                            <select class="form-control" name="p_jabatan" id="jabatan" required>
                                            </select>
                                            <?php if (session()->getFlashdata('jabatan')) : ?>
                                                <small class="text-danger">
                                                    <?= session()->getFlashdata('jabatan') ?>
                                                </small>
                                            <?php endif; ?>
                                        </div>


                                        <div class="form-group">
                                            <label for="">GOLONGAN</label>
                                            <select class="form-control golongan" name="p_golongan_id" required>
                                                <option value="<?= $tampiledit->golongan; ?>"><?= $tampiledit->golongan; ?></option>
                                                <option value="">PILIH GOLONGAN LAINNYA...</option>
                                                <?php foreach ($golongan as $value) : ?>
                                                    <option value="<?= $value->id ?>"><?= $value->kode; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="form-group">
                                                    <label for="">ALAMAT E-MAIL</label>
                                                    <input id="p_email" type="email" class="form-control" value="<?= $tampiledit->email; ?>" name="p_email" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label class="selectgroup-item"><label for="">IS PEGAWAI ?</label>
                                                        <input type="checkbox" checked class="selectgroup-input" id="customSwitch1" name="is_p">
                                                        <span class="selectgroup-button">IS PEGAWAI</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>









                            </div>
                            <div class="card-footer">
                                <input type="hidden" name="pegawai_id" class="pegawai_id" value="<?= $tampiledit->id; ?>">
                                <button type="submit" class="btn btn-success"><i class="fa fa-edit"></i> Update</button>
                                <a href="/administrator/mastersu/v_pegawai" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>
    <!-- End Edit Pegawai -->
    <?= $this->include('/layout/adminportal/_footer');  ?>
</div>



<script>
    // Star Proses Ambil Jabatan Berdasarkan OPD ID Edit
    const id_jabatan = $('.jabatan_id').val();
    var value = $("#opd_id option:selected").attr("value");
    $('#jabatan').html('<option>Mencari Jabatan...</option>');
    $.ajax({
        url: "<?php echo base_url('/prosesCariJabatan'); ?>/" + value,
        type: "GET",
        async: true,
        dataType: 'json',
        success: function(data) {
            var html = '';
            // console.log(data);
            $(data).each(function(key, value) {
                if (id_jabatan == value.id) {
                    html += '<option selected value=' + value.id + '>' + value.nama_jabatan + '</option>';
                } else {
                    html += '<option value=' + value.id + '>' + value.nama_jabatan + '</option>';
                }
            })
            $('#jabatan').html(html);
        }
    });
    // End Proses Ambil Jabatan Berdasarkan OPD ID Edit


    // Star Proses Ambil Jabatan OPD Edit
    $("#opd_id").on("change", function() {
        var value = $("#opd_id option:selected").attr("value");
        $('#jabatan').html('<option>Mencari Jabatan...</option>');
        $.ajax({
            url: "<?php echo site_url('/prosesCariJabatan'); ?>/" + value,
            type: "GET",
            async: true,
            dataType: 'json',
            success: function(data) {
                var html = '';
                $(data).each(function(key, value) {
                    html += '<option value=' + value.id + '>' + value.nama_jabatan + '</option>';
                })
                $('#jabatan').html(html);
            }
        });
    });
    // End Proses Ambil Jabatan OPD Edit
</script>


<?= $this->endSection() ?>