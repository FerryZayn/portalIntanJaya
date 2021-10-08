<!-- KETERANGAN MENU MOBILE-->
<!-- Bisa samakan dengan menu desktop versi -->

<div class="mobile-side">
    <!--Left Mobile menu-->
    <div id="back-menu" class="back-menu back-menu-start">
        <span class="hamburger-icon open">
            <!-- Icon Close -->
            <i class="fas fa-times"></i>
        </span>
    </div>
    <nav id="mobile-menu" class="menu-mobile d-flex flex-column push push-start shadow-r-sm bg-white">
        <!-- mobile menu content -->
        <div class="mobile-content mb-auto">
            <!--logo-->
            <div class="logo-sidenav p-2">
                <a href="#" class="navbar-brand custom-logo-link" rel="home" aria-current="page">
                    <img src="<?= base_url() ?>/templet/logo/intanjaya-big.png" class="img-fluid" />
                </a>
            </div>

            <!--navigation-->
            <div class="sidenav-menu">
                <nav class="navbar navbar-inverse">
                    <ul id="side-menu" class="nav navbar-nav list-group list-unstyled side-link">
                        <li class="menu-item nav-item">
                            <a href="<?= base_url("/"); ?>" class="nav-link">Home</a>
                        </li>
                        <li class="menu-item nav-item">
                            <a href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle nav-link">Profil Daerah</a>
                            <ul class="dropdown-menu" aria-labelledby="menu-item-dropdown-1513" role="menu">
                                <li class="menu-item nav-item"><a href="#" class="dropdown-item">Sejarah Singkat</a></li>
                                <li class="menu-item nav-item"><a href="<?= base_url(); ?>/content/visi-misi" class="dropdown-item">Visi & Misi</a></li>
                                <li class="menu-item nav-item"><a href="#" class="dropdown-item">Landasan Hukum</a></li>
                                <li class="menu-item nav-item"><a href="#" class="dropdown-item">Pemerintah</a></li>
                                <li class="menu-item nav-item"><a href="#" class="dropdown-item">Keadaan Geografis</a></li>
                                <li class="menu-item nav-item"><a href="#" class="dropdown-item">Keadaan Demografis</a></li>


                            </ul>
                        </li>

                        <li class="menu-item nav-item">
                            <a href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle nav-link">Potensi Daerah</a>
                            <ul class="dropdown-menu" aria-labelledby="menu-item-dropdown-1514" role="menu">
                                <li class="menu-item menu-item-1504 nav-item">
                                    <a href="#" class="dropdown-item">Pertanian dan Perkebunan</a>
                                </li>
                                <li class="menu-item menu-item-1504 nav-item">
                                    <a href="#" class="dropdown-item">Pertambangan dan Energi</a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-item nav-item">
                            <a href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle nav-link">OPD</a>
                            <ul class="dropdown-menu" aria-labelledby="menu-item-dropdown-1515" role="menu">

                                <li class="menu-item nav-item"><a href="#" class="dropdown-item">Bappeda Intan Jaya</a></li>
                                <li class="menu-item nav-item"><a href="#" class="dropdown-item">BPKAD Intan Jaya</a></li>
                                <li class="menu-item nav-item"><a href="#" class="dropdown-item">Inspektorat Intan Jaya</a></li>
                                <li class="menu-item nav-item"><a href="#" class="dropdown-item">Kominfo Intan Jaya</a></li>
                                <li class="menu-item nav-item"><a href="#" class="dropdown-item">LPSE Intan Jaya</a></li>
                                <li class="menu-item nav-item"><a href="#" class="dropdown-item">PU Intan Jaya</a></li>
                                <li class="menu-item nav-item"><a href="#" class="dropdown-item">Setda</a></li>

                            </ul>
                        </li>
                        <li class="menu-item nav-item">
                            <a href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle nav-link">Artikel Publish</a>
                            <ul class="dropdown-menu" aria-labelledby="menu-item-dropdown-1515" role="menu">

                                <li class="menu-item nav-item"><a href="<?= base_url(); ?>/content/semua-informasi" class="dropdown-item">Informasi Publik</a></li>
                                <li class="menu-item nav-item"><a href="<?= base_url(); ?>/content/semua-berita" class="dropdown-item">Berita Publik</a></li>
                                <li class="menu-item nav-item"><a href="<?= base_url(); ?>/content/semua-album-foto" class="dropdown-item">Album Foto</a></li>
                                <li class="menu-item nav-item"><a href="<?= base_url(); ?>/content/semua-album-video" class="dropdown-item">Album Video</a></li>

                            </ul>
                        </li>
                        <li class="menu-item nav-item"><a href="#" class="nav-link">Kegiatan</a></li>
                        <li class="menu-item nav-item"><a href="#" class="nav-link">Pengumuman</a></li>
                        <li class="menu-item nav-item"><a href="#" class="nav-link">Kontak</a></li>
                        <li class="menu-item nav-item"><a href="#" class="nav-link">Tim Development</a></li>
                    </ul>
                </nav>
            </div>
        </div>

        <!-- copyright mobile sidebar menu -->
        <div class="mobile-copyright mt-5 text-center">
            <p>Portal Intan Jaya.</p>
        </div>
    </nav>
</div>