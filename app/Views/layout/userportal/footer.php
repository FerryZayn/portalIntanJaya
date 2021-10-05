<div id="footer" class="footer-dark bg-dark bg-footer py-5 px-3" style="background-image: url(<?= base_url(); ?>/templet/gambar-berita/gambar-2.jpg)">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div id="bootnews_about-1" class="widget widget_categories widget_categories_custom">
                    <div class="block-area">
                        <h3 class="h5">About Us</h3>
                        <img class="footer-logo img-fluid mb-2" alt="footer logo" src="<?= base_url() ?>/templet/logo/intanjaya.png">
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus corporis rerum optio voluptatum consequatur? Recusandae iste omnis cupiditate non reprehenderit, illum dolorum molestiae deleniti, assumenda aliquid tempore. Maiores, minus reprehenderit?
                        </p>
                        <address>
                            <i class="fas fa-street-view"></i> Alamat Kantor
                        </address>
                        <p class="footer-info">
                            <i class="fas fa-phone-alt"></i> +(123) 456-7890
                        </p>
                        <p class="footer-info">
                            <i class="fas fa-fax"></i> +(123) 456-7890
                        </p>
                        <p class="footer-info">
                            <i class="fas fa-envelope"></i> username@mail.com
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div id="bootnews_custompost-7" class="widget widget_categories widget_categories_custom">
                    <h3 class="h5">Custom Post</h3>
                    <div class="small-post">
                        <?php foreach ($v_costumpost as $costumpost) : ?>
                            <article class="card card-full hover-a mb-4">
                                <div class="row">
                                    <div class="col-3 col-md-4 pe-2 pe-md-0">
                                        <div class="image-wrapper">
                                            <a href="<?= base_url(); ?>/content/<?= $costumpost['slug']; ?>">
                                                <img width="135" height="77" src="<?= base_url() ?><?= $costumpost['path_file_gambar']; ?>/<?= $costumpost['file_gambar']; ?>" class="img-fluid" />
                                            </a>
                                        </div>
                                    </div>

                                    <div class="col-9 col-md-8">
                                        <div class="card-body pt-0">
                                            <h3 class="card-title">
                                                <a href="<?= base_url(); ?>/content/<?= $costumpost['slug']; ?>">Judul Berita</a>
                                            </h3>
                                            <div class="card-text small text-muted">
                                                <time class="news-date">
                                                    <?php
                                                    $date = $costumpost['created_date'];
                                                    echo date('d M Y', strtotime($date));
                                                    ?>
                                                </time>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                    <div class="gap-0"></div>
                </div>
            </div>
            <div class="widget col-sm-6 col-md-4">
                <div id="bootnews_gallerypost-1" class="widget widget_categories widget_categories_custom">
                    <h3 class="h5">News in Pictures</h3>
                    <div class="col-12">
                        <ul class="row bg-light">
                            <?php foreach ($v_contentfooterfoto as $footer) : ?>
                                <li class="col-6 col-sm-4 px-0 hover-a mb-0 overflow zoom">
                                    <a href="<?= base_url(); ?>/content/<?= $footer['slug']; ?>">
                                        <div class="image-wrapper">
                                            <img width="282" height="240" src="<?= base_url() ?><?= $footer['path_file_gambar']; ?>/<?= $footer['file_gambar']; ?>" class="img-fluid" />
                                        </div>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>