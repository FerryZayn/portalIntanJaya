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
                    <img src="<?= base_url() ?>/templet/logo/intanjaya-big.png" class="img-fluid" sizes="(max-width: 452px) 100vw, 452px" />
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
                            <a href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle nav-link">Menu</a>
                            <ul class="dropdown-menu" aria-labelledby="menu-item-dropdown-1513" role="menu">
                                <li class="menu-item nav-item">
                                    <a href="#" class="dropdown-item">Link</a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-item nav-item">
                            <a href="#" class="nav-link">Menu</a>
                        </li>
                        <li class="menu-item nav-item">
                            <a href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle nav-link">Menu</a>
                            <ul class="dropdown-menu" aria-labelledby="menu-item-dropdown-1514" role="menu">
                                <li class="menu-item menu-item-1504 nav-item">
                                    <a href="#" class="dropdown-item">Link</a>
                                </li>
                                <li class="menu-item nav-item">
                                    <a title="Travel" href="#" class="dropdown-item dropdown-toggle">Menu</a>
                                    <ul class="dropdown-menu" aria-labelledby="menu-item-dropdown-1503" role="menu">
                                        <li class="menu-item nav-item">
                                            <a href="#" class="dropdown-item">Link 1</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="menu-item nav-item">
                                    <a title="Science" href="#" class="dropdown-item dropdown-toggle">Menu</a>
                                    <ul class="dropdown-menu" aria-labelledby="menu-item-dropdown-1511" role="menu">
                                        <li class="menu-item nav-item"><a href="#" class="dropdown-item">Link 1</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-item nav-item">
                            <a href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle nav-link">Menu</a>
                            <ul class="dropdown-menu" aria-labelledby="menu-item-dropdown-1515" role="menu">
                                <li class="menu-item nav-item"><a href="#" class="dropdown-item">Link 1</a></li>
                                <li class="menu-item nav-item"><a href="#" class="dropdown-item">Link 2</a></li>
                                <li class="menu-item nav-item"><a href="#" class="dropdown-item">Link 3</a></li>
                                <li class="menu-item nav-item"><a href="#" class="dropdown-item">Link 4</a></li>
                            </ul>
                        </li>
                        <li class="menu-item nav-item"><a href="#" class="nav-link">International</a></li>
                    </ul>
                </nav>
            </div>
        </div>

        <!-- copyright mobile sidebar menu -->
        <div class="mobile-copyright mt-5 text-center">
            <p>News - Portal Intan Jaya.</p>
        </div>
    </nav>
</div>