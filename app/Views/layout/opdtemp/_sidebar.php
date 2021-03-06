<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="<?= base_url(); ?>/admintemp/img/logo/user.png" alt="..." class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            <?= session()->get('nama_pegawai'); ?>
                            <span class="user-level">Administrator</span>
                        </span>
                    </a>
                </div>
            </div>
            <ul class="nav nav-primary">
                <li class="nav-item active">
                    <a href="/administrator/index">
                        <i class="fas fa-home"></i>
                        <p>ADMINISTRATOR</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Components</h4>
                </li>
                <li class="nav-item active">
                    <a href="/administrator/portal-opd/dashboard">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a href="#">
                        <i class="fas fa-layer-group"></i>
                        <p>Hak Akses</p>
                    </a>
                </li> -->
                <li class="nav-item">
                    <a href="/administrator/portal-opd/v_opd">
                        <i class="fas fa-desktop"></i>
                        <p>OPD</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a data-toggle="collapse" href="#forms">
                        <i class="fas fa-layer-group"></i>
                        <p>Artikel OPD</p> <span class="caret"></span>
                    </a>
                    <div class="collapse" id="forms">
                        <ul class="nav nav-collapse">
                            <li><a href="/administrator/portal-opd/berita/v_berita"><i class="fas fas fa-angle-right"></i> Berita</a></li>
                            <li><a href="/administrator/portal-opd/informasi/v_informasi"><i class="fas fas fa-angle-right"></i> Informasi</a></li>
                            <li><a href="/administrator/portal-opd/foto/v_foto"><i class="fas fas fa-angle-right"></i> Album Foto</a></li>
                            <li><a href="/administrator/portal-opd/video/v_video"><i class="fas fas fa-angle-right"></i> Album Video</a></li>
                            <li><a href="/administrator/portal-opd/visi/v_visi"><i class="fas fas fa-angle-right"></i> Visi</a></li>
                            <li><a href="/administrator/portal-opd/misi/v_misi"><i class="fas fas fa-angle-right"></i> Misi</a></li>
                            <li><a href="/administrator/portal-opd/slide/v_slide"><i class="fas fas fa-angle-right"></i> Slide Show</a></li>
                            <?php //foreach ($v_tipeartikel as $ta) : 
                            ?>
                            <!-- <li><a href="/administrator/portal-opd/data-artikel/<?php // $ta['id']; 
                                                                                        ?>"><i class="fas fas fa-angle-right"></i> <?php // $ta['tipe']; 
                                                                                                                                    ?></a></li> -->
                            <?php //endforeach; 
                            ?>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>