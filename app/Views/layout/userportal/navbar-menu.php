<div id="navbarTogglerDemo1" class="collapse navbar-collapse hover-mode">
    <!-- logo navbar -->
    <div class="logo-showbacktop">
        <a href="<?= base_url('/'); ?>" class="navbar-brand custom-logo-link">
            <img src="<?= base_url() ?>/templet/logo/intanjaya.png" class="img-fluid" style="width: 35px;" />
        </a>
    </div>

    <!--start main menu start-->
    <ul id="start-main" class="navbar-nav main-nav navbar-uppercase first-start-lg-0">
        <li class="menu-item active nav-item">
            <a href="<?= base_url('/content/home'); ?>" class="nav-link">Halaman Depan</a>
        </li>
        <li class="menu-item menu-item-has-children dropdown">
            <a href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle nav-link">Profil Daerah</a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="#" class="dropdown-item">Sejarah Singkat</a></li>
                <li><a href="<?= base_url(); ?>/content/visi-misi" class="dropdown-item">Visi & Misi</a></li>
                <li><a href="#" class="dropdown-item">Landasan Hukum</a></li>
                <li><a href="#" class="dropdown-item">Pemerintah</a></li>
                <li><a href="#" class="dropdown-item">Keadaan Geografis</a></li>
                <li><a href="#" class="dropdown-item">Keadaan Demografis</a></li>
            </ul>
        </li>

        <li class="menu-item menu-item-has-children dropdown">
            <a href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle nav-link">Potensi Daerah</a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="#" class="dropdown-item">Pertanian dan Perkebunan</a></li>
                <li><a href="#" class="dropdown-item">Pertambangan dan Energi</a></li>
            </ul>
        </li>

        <li class="menu-item menu-item-has-children dropdown">
            <a href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle nav-link">OPD</a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="<?= base_url("content/opd") ?>" class="dropdown-item">Organisasi Pemerintah Daerah</a></li>
            </ul>
        </li>


        <li><a href="#" data-bs-toggle="dropdown" class="nav-link dropdown-toggle">Artikel Publish</a>
            <div id="mega-menu-1356" class="dropdown-menu mega w-100 shadow-lrb-lg px-3 py-0 depth_0">
                <div class="row mega-hovers">
                    <div class="col-sm-3 col-md-2 vertical-tabs hover-tabs px-0 border-end-sm">
                        <!--navigation tabs-->
                        <ul class="nav nav-tabs text-center py-4 border-left-0 border-end-0 w-100" role="tablist">
                            <li class="nav-item">
                                <a id="nav-one3" class="nav-link font-weight-normal active" href="#berita-satu" role="tab" data-bs-toggle="tab" aria-controls="berita-satu" aria-selected="true">Informasi Publik</a>
                            </li>
                            <li class="nav-item">
                                <a id="nav-two3" class="nav-link font-weight-normal" href="#berita-dua" role="tab" data-bs-toggle="tab" aria-controls="berita-dua" aria-selected="false">Berita Publik</a>
                            </li>
                            <li class="nav-item">
                                <a id="nav-three3" class="nav-link font-weight-normal" href="#berita-tiga" role="tab" data-bs-toggle="tab" aria-controls="berita-tiga" aria-selected="false">Album Foto</a>
                            </li>
                            <li class="nav-item">
                                <a id="nav-four3" class="nav-link font-weight-normal" href="#berita-empat" role="tab" data-bs-toggle="tab" aria-controls="berita-empat" aria-selected="false">Album Video</a>
                            </li>
                            <li class="nav-item">
                                <a id="nav-four3" class="nav-link font-weight-normal" href="<?= base_url(); ?>/content/semua-artikel">Semua Artikel Portal</a>
                            </li>
                        </ul>
                        <!--end navigation tabs-->
                    </div>
                    <div class="col-sm-9 col-md-10 p-4">
                        <div class="tab-content mega-tabs">

                            <div id="berita-satu" class="tab-pane active show" role="tabpanel" aria-labelledby="nav-one3">
                                <div class="row">

                                    <?php foreach ($v_contentmenuinformasi as $ipmenu) : ?>
                                        <div class="col-6 col-sm-4 col-lg-3">
                                            <article class="card card-full hover-a mb-4">
                                                <div class="ratio_203-114 image-wrapper">
                                                    <a href="<?= base_url(); ?>/content/<?= $ipmenu['slug']; ?>">
                                                        <img width="203" height="114" src="<?= base_url() ?><?= $ipmenu['path_file_gambar']; ?>/<?= $ipmenu['file_gambar']; ?>" class="img-fluid" />
                                                    </a>
                                                </div>
                                                <div class="card-body">
                                                    <h2 class="card-title h5">
                                                        <a href="<?= base_url(); ?>/content/<?= $ipmenu['slug']; ?>"><?= $ipmenu['judul']; ?></a>
                                                    </h2>
                                                    <div class="card-text text-muted small">
                                                        <time class="news-date">
                                                            <?php
                                                            $date = $ipmenu['created_date'];
                                                            echo date('d M Y', strtotime($date));
                                                            ?>
                                                        </time>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <!-- <a class="btn btn-primary btn-sm" href="<?= base_url(); ?>/content/semua-informasi">
                                    <i class="fas fa-angle-double-right"></i> Lihat Semua Informasi Publik</a> -->
                            </div>


                            <div id="berita-dua" class="tab-pane" role="tabpanel" aria-labelledby="nav-two3">
                                <div class="row">
                                    <?php foreach ($v_contentmenuberita as $ipmenu) : ?>
                                        <div class="col-6 col-sm-4 col-lg-3">
                                            <article class="card card-full hover-a mb-4">
                                                <div class="ratio_203-114 image-wrapper">
                                                    <a href="<?= base_url(); ?>/content/<?= $ipmenu['slug']; ?>">
                                                        <img width="203" height="114" src="<?= base_url() ?><?= $ipmenu['path_file_gambar']; ?>/<?= $ipmenu['file_gambar']; ?>" class="img-fluid" />
                                                    </a>
                                                </div>
                                                <div class="card-body">
                                                    <h2 class="card-title h5">
                                                        <a href="<?= base_url(); ?>/content/<?= $ipmenu['slug']; ?>"><?= $ipmenu['judul']; ?></a>
                                                    </h2>
                                                    <div class="card-text text-muted small">
                                                        <time class="news-date">
                                                            <?php
                                                            $date = $ipmenu['created_date'];
                                                            echo date('d M Y', strtotime($date));
                                                            ?>
                                                        </time>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <a class="btn btn-primary btn-sm" href="<?= base_url(); ?>/content/semua-berita"><i class="fas fa-angle-double-right"></i> Lihat Semua Berita Publik</a>
                            </div>

                            <div id="berita-tiga" class="tab-pane" role="tabpanel" aria-labelledby="nav-three3">
                                <div class="row">
                                    <?php foreach ($v_contentmenualbumfoto as $a_fotomenu) : ?>
                                        <div class="col-6 col-sm-4 col-lg-3">
                                            <article class="card card-full hover-a mb-4">
                                                <div class="ratio_203-114 image-wrapper">
                                                    <a href="<?= base_url(); ?>/content/<?= $a_fotomenu['slug']; ?>">
                                                        <img width="203" height="114" src="<?= base_url() ?><?= $a_fotomenu['path_file_gambar']; ?>/<?= $a_fotomenu['file_gambar']; ?>" class="img-fluid" />
                                                    </a>
                                                </div>
                                                <div class="card-body">
                                                    <h2 class="card-title h5">
                                                        <a href="<?= base_url(); ?>/content/<?= $a_fotomenu['slug']; ?>"><?= $a_fotomenu['judul']; ?></a>
                                                    </h2>
                                                    <div class="card-text text-muted small">
                                                        <time class="news-date">
                                                            <?php
                                                            $date = $a_fotomenu['created_date'];
                                                            echo date('d M Y', strtotime($date));
                                                            ?>
                                                        </time>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <a class="btn btn-primary btn-sm" href="<?= base_url(); ?>/content/semua-album-foto"><i class="fas fa-angle-double-right"></i> Lihat Semua Album Foto</a>
                            </div>

                            <div id="berita-empat" class="tab-pane" role="tabpanel" aria-labelledby="nav-four3">
                                <div class="row">
                                    <?php foreach ($v_contentmenualbumvideo as $a_videomenu) : ?>
                                        <div class="col-6 col-sm-4 col-lg-3">
                                            <article class="card card-full hover-a mb-4">
                                                <div class="ratio_203-114 image-wrapper">
                                                    <a href="<?= base_url(); ?>/content/<?= $a_videomenu['slug']; ?>">
                                                        <img width="203" height="114" src="<?= base_url() ?><?= $a_videomenu['path_file_gambar']; ?>/<?= $a_videomenu['file_gambar']; ?>" class="img-fluid" />
                                                    </a>
                                                </div>
                                                <div class="card-body">
                                                    <h2 class="card-title h5">
                                                        <a href="<?= base_url(); ?>/content/<?= $a_videomenu['slug']; ?>"><?= $a_videomenu['judul']; ?></a>
                                                    </h2>
                                                    <div class="card-text text-muted small">
                                                        <time class="news-date">
                                                            <?php
                                                            $date = $a_videomenu['created_date'];
                                                            echo date('d M Y', strtotime($date));
                                                            ?>
                                                        </time>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <a class="btn btn-primary btn-sm" href="<?= base_url(); ?>/content/semua-album-video"><i class="fas fa-angle-double-right"></i> Lihat Semua Album Video</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>

        <li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-1339 nav-item">
            <a href="#" class="nav-link">Kegiatan</a>
        </li>
        <li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-1339 nav-item">
            <a href="#" class="nav-link">Kontak</a>
        </li>
        <li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-1339 nav-item">
            <a href="#" class="nav-link">Pengumuman</a>
        </li>
        <li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-1339 nav-item">
            <a href="#" class="nav-link">Tim Develop</a>
        </li>
    </ul>

    <!-- <div class="navbar-nav ms-auto d-none d-lg-block">
        <div class="search-box">
            <div class="search-menu no-shadow border-0 py-0">
                <form class="form-src form-inline" method="get" action="<?= base_url(); ?>" role="search">
                    <div class="input-group">
                        <input name="s" class="form-control end-0" type="text" placeholder="Search..." value="">
                        <span class="icones text-body">
                            <i class="fas fa-search"></i>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div> -->
</div>