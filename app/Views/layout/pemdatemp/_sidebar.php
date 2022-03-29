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
                    <a href="/administrator/portal-pemda/dashboard">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/administrator/portal-pemda/pejabat/v_pejabat">
                        <i class="fas fas fa-user-tie"></i>
                        <p>Profil Pejabat</p>
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a href="/administrator/portal-pemda/berita/home">
                        <i class="fas fas fa-book"></i>
                        <p>Artikel</p>
                    </a>
                </li> -->
                <li class="nav-item">
                    <a data-toggle="collapse" href="#artikel">
                        <i class="fas fas fa-book"></i>
                        <p>Artikel</p> <span class="caret"></span>
                    </a>
                    <div class="collapse" id="artikel">
                        <ul class="nav nav-collapse">
                            <li><a href="/administrator/portal-pemda/berita/home"><i class="fas fas fa-angle-right"></i> Berita</a></li>
                            <li><a href="/administrator/portal-pemda/informasi/home"><i class="fas fas fa-angle-right"></i> Informasi</a></li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a data-toggle="collapse" href="#visimisi">
                        <i class="fas fas fa-book"></i>
                        <p>Visi & Misi</p> <span class="caret"></span>
                    </a>
                    <div class="collapse" id="visimisi">
                        <ul class="nav nav-collapse">
                            <li><a href="/administrator/portal-pemda/visi/v_visi"><i class="fas fas fa-angle-right"></i> Visi Pemerintah</a></li>
                            <li><a href="/administrator/portal-pemda/misi/v_misi"><i class="fas fas fa-angle-right"></i> Misi Pemerintah</a></li>
                        </ul>
                    </div>
                </li>







                <li class="nav-item">
                    <a data-toggle="collapse" href="#album">
                        <i class="fas fa-chalkboard-teacher"></i>
                        <p>Album</p> <span class="caret"></span>
                    </a>
                    <div class="collapse" id="album">
                        <ul class="nav nav-collapse">
                            <li><a href="/administrator/portal-pemda/album-foto/home"><i class="fas fas fa-angle-right"></i> Album Foto</a></li>
                            <li><a href="/administrator/portal-pemda/album-video/home"><i class="fas fas fa-angle-right"></i> Album Video</a></li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a href="/administrator/portal-pemda/slideshow/home">
                        <i class="fab fa-slideshare"></i>
                        <p>Slide Show</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>