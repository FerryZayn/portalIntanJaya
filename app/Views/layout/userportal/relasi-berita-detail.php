<div class="related-post mb-4">
    <div class="block-title-6">
        <h4 class="h5 border-primary"><span class="bg-primary text-white">Berita Terkait</span></h4>
    </div>
    <div class="nav-slider-hover nav-dots-top-right light-dots" data-flickity='{ "cellAlign": "left", "wrapAround": true, "adaptiveHeight": true, "prevNextButtons": true , "pageDots": true, "imagesLoaded": true }'>
        <?php foreach ($v_beritarelasi as $relasiberita) : ?>
            <article class="col-12 col-md-6 col-lg-4 me-2">
                <div class="card card-full hover-a">
                    <div class="ratio_337-337 image-wrapper">
                        <a href="<?= base_url(); ?>/content/<?= $relasiberita['slug']; ?>">
                            <img width="400" height="340" src="<?= base_url() ?><?= $relasiberita['path_file_gambar']; ?>/<?= $relasiberita['file_gambar']; ?>" class="img-fluid" sizes="(max-width: 400px) 100vw, 400px" />
                        </a>
                    </div>
                    <div class="position-absolute p-3 b-0 w-100 bg-shadow">
                        <a href="<?= base_url(); ?>/content/<?= $relasiberita['slug']; ?>">
                            <h5 class="card-title h3 h4-sm h5-md text-light my-1"><?= $relasiberita['judul']; ?></h5>
                        </a>
                        <div class="card-text my-2 dark small text-light">
                            <?php
                            $date = $relasiberita['created_date'];
                            echo date('d F Y', strtotime($date));
                            ?>
                        </div>
                    </div>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</div>