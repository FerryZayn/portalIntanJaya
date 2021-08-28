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
                                <a href="<?= base_url(); ?>/content/<?= $berita['slug']; ?>">
                                    <img width="400" height="340" src="<?= base_url() ?><?= $berita['path_file_gambar']; ?>/<?= $berita['file_gambar']; ?>" class="img-fluid" sizes="(max-width: 400px) 100vw, 400px" />
                                </a>
                            </div>
                            <div class="position-absolute px-3 pb-3 pt-0 b-0 w-100 bg-shadow">
                                <h3 class="h3 h5-sm h3-md my-1 text-center">
                                    <a class="text-white" href="<?= base_url(); ?>/content/<?= $berita['slug']; ?>">
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
                    <h4 class="h5 border-primary">
                        <span class="bg-primary text-white">Informasi dan Berita</span>
                    </h4>
                    <ul class="nav nav-tabs nav-block-link1 d-inline" id="cat-tabsone1" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="cat-navione1" data-bs-toggle="tab" href="#block-informasi" role="tab" aria-controls="block-informasi" aria-selected="true">Informasi</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="cat-navitwo1" data-bs-toggle="tab" href="#block-berita" role="tab" aria-controls="block-berita" aria-selected="false">Berita</a>
                        </li>
                    </ul>
                </div>

                <!--tabs content block informasi-->
                <div id="block-load1" class="tab-content ajax-tabs p-0">
                    <div class="tab-pane fade show active" id="block-informasi" role="tabpanel" aria-labelledby="cat-navione1">
                        <div class="row animate slideInDown">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <article class="card card-full hover-a mb-4">
                                    <div class="row">
                                        <?php foreach ($v_informasi as $informasi) : ?>
                                            <div class="col-3 col-md-4 pe-2 pe-md-0">
                                                <div class="ratio_115-80 image-wrapper">
                                                    <a href="<?= base_url(); ?>/content/<?= $informasi['slug']; ?>">
                                                        <img width="115" height="80" src="<?= base_url() ?><?= $informasi['path_file_gambar']; ?>/<?= $informasi['file_gambar']; ?>" class="img-fluid lazy wp-post-image" loading="lazy" sizes="(max-width: 115px) 100vw, 115px" /> <!-- post type -->
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-9 col-md-8">
                                                <div class="card-body pt-0">
                                                    <h3 class="card-title h6 h4-md h6-lg">
                                                        <a href="<?= base_url(); ?>/content/<?= $informasi['slug']; ?>"><?= $informasi['judul']; ?></a><br />
                                                        ...
                                                        <?php
                                                        $kalimat = $informasi['isi_artikel'];
                                                        $potong_kalimat = substr($kalimat, 60, 30);
                                                        echo $potong_kalimat;
                                                        ?>
                                                        ...
                                                    </h3>
                                                    <div class="card-text small text-muted">
                                                        <time class="news-date" datetime="2019-06-16T02:12:03+00:00">
                                                            <?php
                                                            $date = $informasi['created_date'];
                                                            echo date('d M Y', strtotime($date));
                                                            ?>
                                                        </time>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <a class="btn btn-primary btn-sm" href="<?= base_url(); ?>/content/semua-informasi"><i class="fas fa-angle-double-right"></i> Selengkapnya...</a>
                                </article>
                            </div>
                        </div>
                    </div>


                    <!--tabs content block berita-->
                    <div class="tab-pane fade" id="block-berita" role="tabpanel" aria-labelledby="cat-navitwo1">
                        <div class="row animate slideInDown">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <article class="card card-full hover-a mb-4">
                                    <div class="row">
                                        <?php foreach ($v_berita as $berita) : ?>
                                            <div class="col-3 col-md-4 pe-2 pe-md-0">
                                                <div class="ratio_115-80 image-wrapper">
                                                    <a href="<?= base_url(); ?>/content/<?= $berita['slug']; ?>">
                                                        <img width="115" height="80" src="<?= base_url() ?><?= $berita['path_file_gambar']; ?>/<?= $berita['file_gambar']; ?>" class="img-fluid lazy wp-post-image" loading="lazy" sizes="(max-width: 115px) 100vw, 115px" /> <!-- post type -->
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-9 col-md-8">
                                                <div class="card-body pt-0">
                                                    <h3 class="card-title h6 h4-md h6-lg">
                                                        <a href="<?= base_url(); ?>/content/<?= $berita['slug']; ?>">
                                                            <?= $berita['judul']; ?>
                                                        </a><br />
                                                        ...
                                                        <?php
                                                        $kalimat = $berita['isi_artikel'];
                                                        $potong_kalimat = substr($kalimat, 25, 30);
                                                        echo $potong_kalimat;
                                                        ?>
                                                        ...
                                                    </h3>
                                                    <div class="card-text small text-muted">
                                                        <time class="news-date" datetime="2019-06-16T02:12:03+00:00">
                                                            <?php
                                                            $date = $berita['created_date'];
                                                            echo date('d M Y', strtotime($date));
                                                            ?>
                                                        </time>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <a class="btn btn-primary btn-sm" href="<?= base_url(); ?>/content/semua-berita"><i class="fas fa-angle-double-right"></i> Selengkapnya...</a>
                                </article>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</div>