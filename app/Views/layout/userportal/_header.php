<header class="header">
    <!--top mobile menu start-->
    <div class="top-menu bg-white">
        <div class="container">
            <!--Navbar Mobile-->
            <nav class="navbar navbar-expand d-lg-none navbar-light px-0">
                <div id="navbar-mobile" class="collapse navbar-collapse nav-top-mobile">
                    <!--Top start menu-->
                    <ul id="mobile-menu1" class="navbar-nav">
                        <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1465 nav-item"><a href="#" class="nav-link">About</a></li>
                        <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1466 nav-item"><a href="#" class="nav-link">Contact Us</a></li>
                    </ul>
                    <!--end top start menu-->

                    <!--Top right menu-->
                    <ul class="navbar-nav ms-auto text-center">
                        <li class="nav-item">
                            <a class="nav-link" rel="noopener" href="https://facebook.com/" target="_blank">
                                <i class="fab fa-facebook"></i> <span class="visually-hidden">Facebook</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" rel="noopener" href="https://twitter.com/" target="_blank">
                                <i class="fab fa-twitter"></i> <span class="visually-hidden">Twitter</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" rel="noopener" href="https://youtube.com/" target="_blank">
                                <i class="fab fa-youtube"></i> <span class="visually-hidden">Youtube</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" rel="noopener" href="https://instagram.com/" target="_blank">
                                <i class="fab fa-instagram"></i> <span class="visually-hidden">Instagram</span>
                            </a>
                        </li>
                    </ul>
                    <!--end top right menu-->
                </div>
            </nav>
        </div>
    </div>

    <!-- top menu -->
    <div class="mobile-sticky fs-6 bg-secondary">
        <div class="container">
            <!--Navbar-->
            <nav class="navbar navbar-expand-lg navbar-dark px-0 py-0">
                <!--Hamburger button-->
                <a id="showStartPush" aria-label="sidebar menu" class="navbar-toggler sidebar-menu-trigger side-hamburger border-0 px-0" href="javascript:;">
                    <span class="hamburger-icon">
                        <span></span><span></span><span></span><span></span>
                    </span>
                </a>

                <!-- Mobile logo -->
                <a href="#">
                    <img class="mobile-logo img-fluid d-lg-none mx-auto" alt="mobile logo" src="<?= base_url() ?>/templet/logo/logo-bootnews-light.png">
                </a>

                <!--Right Toggle Button Search-->
                <button class="navbar-toggler px-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo2" aria-controls="navbarTogglerDemo2" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-search"></i>
                </button>

                <!--Top Navbar-->
                <div id="navbarTogglerDemo" class="collapse navbar-collapse">
                    <div class="date-area d-none d-lg-block">
                        <time class="navbar-text me-2"><?php echo date("l, M d, Y") ?></time>
                    </div>

                    <div class="col-9 ps-1 ps-md-2">
                        <div class="breaking-box position-relative py-2">
                            <div class="box-carousel" data-flickity='{ "cellAlign": "left", "wrapAround": true, "adaptiveHeight": true, "prevNextButtons": true , "autoPlay": 5000, "pageDots": false, "imagesLoaded": true }'>
                                <?php foreach ($v_beritaheader as $berita) : ?>
                                    <div class="col-12 active aribudin">
                                        <a class="h6 fw-normal text-white" href="<?= base_url(); ?>/content/<?= $berita['slug_artikel']; ?>">
                                            <?= $berita['judul']; ?>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                                <?php foreach ($v_informasiheader as $informasi) : ?>
                                    <div class="col-12 active aribudin">
                                        <a class="h6 fw-normal text-white" href="<?= base_url(); ?>/content/<?= $informasi['slug_artikel']; ?>">
                                            <?= $informasi['judul']; ?>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <ul class="navbar-nav ms-auto text-center">
                        <li class="nav-item">
                            <a class="nav-link" rel="noopener" href="https://facebook.com/" target="_blank">
                                <i class="fab fa-facebook"></i> <span class="visually-hidden">Facebook</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" rel="noopener" href="https://twitter.com/" target="_blank">
                                <i class="fab fa-twitter"></i> <span class="visually-hidden">Twitter</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" rel="noopener" href="https://youtube.com/" target="_blank">
                                <i class="fab fa-youtube"></i> <span class="visually-hidden">Youtube</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" rel="noopener" href="https://instagram.com/" target="_blank">
                                <i class="fab fa-instagram"></i> <span class="visually-hidden">Instagram</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!--End top navbar-->
            </nav>

            <!--search mobile-->
            <div class="collapse navbar-collapse  col-12 py-2" id="navbarTogglerDemo2">
                <!--search form-->
                <form class="form-inline" method="get" action="#" role="search">
                    <div class="input-group w-100">
                        <input class="form-control border border-right-0" name="s" type="text" placeholder="Search &hellip;" value="">
                        <span class="input-group-prepend bg-light-dark">
                            <input class="submit btn btn-primary" id="searchmobile" name="submit" type="submit" value="Search">
                        </span>
                    </div>
                </form>
                <!--end search form-->
            </div>
        </div>
    </div>


    <div class="second-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div id="main-logo" class="main-logo text-center-md-down">
                        <a href="<?= base_url(); ?>/" class="navbar-brand custom-logo-link" rel="home" aria-current="page">
                            <img src="<?= base_url() ?>/templet/logo/logo-bootnews.png" class="img-fluid" style="height: 60px;" />
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div id="main-logo" class="main-logo text-center-md-down">
                        <h2 class="entry-title display-2 display-2-lg mt-2" style="font-weight: bold; color: #2E279D;">
                            PORTAL RESMI <br />
                            KABUPATEN INTAN JAYA
                        </h2>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div id="custom_html-1" class="widget_text my-2 my-md-3 my-lg-4 d-none d-md-block text-center">
                        <form class="form-inline" method="get" action="#" role="search">
                            <div class="input-group w-100">
                                <input class="form-control border border-right-0" name="s" type="text" placeholder="Search &hellip;" value="">
                                <span class="input-group-prepend bg-light-dark">
                                    <input class="submit btn btn-primary" id="searchmobile" name="submit" type="submit" value="Search">
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>






    </div>
</header>