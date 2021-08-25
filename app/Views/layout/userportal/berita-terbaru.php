<div class="row">
    <div class="col-8">
        <div class="block-area pt-4 pb-0 px-4 border bg-light-black">
            <div class="block-title-6">
                <h4 class="h5 border-primary"><span class="bg-primary text-white"><i class="fab fa-hotjar"></i> Berita Terbaru</span></h4>
            </div>
            <div class="nav-slider-hover nav-dots-top-right light-dots" data-flickity='{ "cellAlign": "left", "wrapAround": true, "adaptiveHeight": true, "prevNextButtons": true , "pageDots": true, "imagesLoaded": true }'>

                <?php foreach ($v_berita as $berita) : ?>
                    <article class="col-12 col-sm-6 col-lg-4 me-2">
                        <div class="card card-full text-white overflow zoom mb-4">
                            <div class="height-ratio image-wrapper">
                                <a href="<?= base_url(); ?>/content/<?= $berita['slug_artikel']; ?>">
                                    <img width="400" height="340" src="<?= base_url() ?><?= $berita['path_file_gambar']; ?>/<?= $berita['file_gambar']; ?>" class="img-fluid" sizes="(max-width: 400px) 100vw, 400px" />
                                </a>
                            </div>
                            <div class="position-absolute px-3 pb-3 pt-0 b-0 w-100 bg-shadow">
                                <h3 class="h3 h5-sm h3-md my-1 text-center">
                                    <a class="text-white" href="<?= base_url(); ?>/content/<?= $berita['slug_artikel']; ?>">
                                        <?= $berita['judul']; ?>
                                    </a>
                                </h3>
                                <div class="text-muted small text-center">
                                    <time class="news-date text-white">
                                        <?php
                                        $date = $berita['created_date'];
                                        echo date('d M Y', strtotime($date));
                                        ?>
                                    </time>
                                </div>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </div>


    <div class="col-4">
        <div class="sticky">
            <aside class="widget">
                <div class="block-title-4">
                    <h4 class="h5 title-arrow">
                        <i class="fas fa-fire"></i> Informasi dan Berita
                    </h4>
                </div>
                <ul class="post-number list-unstyled border-bottom-last-0 order-6 rounded mb-5">
                    <?php foreach ($v_informasi as $informasi) : ?>
                        <li class="hover-a">
                            <a class="h5 h6-md h5-lg" href="<?= base_url(); ?>/content/<?= $informasi['slug_artikel']; ?>"><?= $informasi['judul']; ?></a>
                        </li>
                    <?php endforeach; ?>
                    <a class="btn btn-primary btn-sm" href="/content/semua-berita-informasi"><i class="fas fa-angle-double-right"></i> Selengkapnya...</a>
                </ul>
            </aside>
        </div>
    </div>
</div>