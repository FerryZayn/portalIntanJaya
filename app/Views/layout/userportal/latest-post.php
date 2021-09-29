<aside id="bootnews_latestside-4" class="widget widget_categories widget_categories_custom">
    <div class="block-title-4">
        <h4 class="h5 title-arrow"><span><i class="fas fa-dumpster-fire"></i> Latest Post</span></h4>
    </div>
    <div class="big-post">
        <?php foreach ($v_latestpostbox as $beritaa) : ?>
            <article class="card card-full hover-a mb-4">
                <div class="ratio_360-202 image-wrapper">
                    <a href="<?= base_url(); ?>/content/<?= $beritaa['slug']; ?>">
                        <img width="360" height="202" src="<?= base_url() ?><?= $beritaa['path_file_gambar']; ?>/<?= $beritaa['file_gambar']; ?>" class="img-fluid lazy wp-post-image" sizes="(max-width: 360px) 100vw, 360px" />
                    </a>
                </div>
                <div class="card-body">
                    <h2 class="card-title h1-sm h3-md">
                        <a href="<?= base_url(); ?>/content/<?= $beritaa['slug']; ?>"><?= $beritaa['judul']; ?></a>
                    </h2>
                    <div class="card-text text-muted small mb-2">
                        <span class="d-none d-sm-inline fw-bold me-1">
                            <a href="#" rel="author"><?= $beritaa['nama_pengarang']; ?></a>
                        </span>
                        <time class="news-date">
                            <?php
                            $date = $beritaa['created_date'];
                            echo date('d F Y', strtotime($date));
                            ?>
                        </time>
                    </div>
                    <p class="card-text">
                        <?php
                        $kalimat = $beritaa['isi_artikel'];
                        $potong_kalimat = substr($kalimat, 0, 200);
                        echo $potong_kalimat;
                        ?>...
                    </p>
                </div>
            </article>
        <?php endforeach; ?>
    </div>

    <div class="small-post">

        <?php foreach ($v_latestpostlist as $beritaa) : ?>
            <article class="card card-full hover-a mb-4">
                <div class="row">
                    <div class="col-3 col-md-4 pe-2 pe-md-0">
                        <div class="ratio_110-77 image-wrapper">
                            <a href="<?= base_url(); ?>/content/<?= $beritaa['slug']; ?>">
                                <img width="110" height="77" src="<?= base_url() ?><?= $beritaa['path_file_gambar']; ?>/<?= $beritaa['file_gambar']; ?>" class="img-fluid lazy wp-post-image" sizes="(max-width: 110px) 100vw, 110px" />
                            </a>
                        </div>
                    </div>

                    <div class="col-9 col-md-8">
                        <div class="card-body pt-0">
                            <h3 class="card-title h6 h5-sm h6-md">
                                <a href="<?= base_url(); ?>/content/<?= $beritaa['slug']; ?>"><?= $beritaa['judul']; ?></a>
                            </h3>
                            <div class="card-text small text-muted">
                                <time class="news-date">
                                    <?php
                                    $date = $beritaa['created_date'];
                                    echo date('d F Y', strtotime($date));
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
</aside>