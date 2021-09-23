<div class="row">
    <div class="col-12">
        <div class="block-area pt-4 pb-0 px-4 border bg-light-black mb-5">
            <div class="block-title-6">
                <h4 class="h5 border-primary"><span class="bg-primary text-white"><i class="fab fa-hotjar"></i> Album Video</span></h4>
            </div>
            <div class="nav-slider-hover nav-dots-top-right light-dots" data-flickity='{ "cellAlign": "left", "wrapAround": true, "adaptiveHeight": true, "prevNextButtons": true , "pageDots": true, "imagesLoaded": true }'>

                <?php foreach ($v_albumvideo as $albumvideo) : ?>
                    <article class="col-12 col-sm-6 col-lg-4 me-2">
                        <div class="card card-full text-white overflow zoom mb-4">
                            <div class="height-ratio image-wrapper">
                                <a href="<?= base_url(); ?>/content/<?= $albumvideo['slug']; ?>">
                                    <img width="400" height="340" src="<?= base_url() ?><?= $albumvideo['path_file_gambar']; ?>/<?= $albumvideo['file_gambar']; ?>" class="img-fluid lazy wp-post-image" sizes="(max-width: 400px) 100vw, 400px" />
                                </a>
                            </div>
                            <div class="position-absolute px-3 pb-3 pt-0 b-0 w-100 bg-shadow">
                                <h3 class="h3 h5-sm h3-md my-1 text-center">
                                    <a class="text-white" href="<?= base_url(); ?>/content/<?= $albumvideo['slug']; ?>"><?= $albumvideo['judul']; ?></a>
                                </h3>
                                <div class="text-muted small text-center">
                                    <time class="news-date text-white"><?= $albumvideo['created_date']; ?></time>
                                </div>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>

            </div>
            <p align="right">
                <a class="btn btn-primary text-white" href="/content/semua-album-video">
                    <i class="fas fa-angle-double-right"></i> Lihat Selengkapnya...
                </a>
            </p>
        </div>
    </div>
</div>