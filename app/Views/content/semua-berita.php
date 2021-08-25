<?= $this->extend('/layout/userportal/portal') ?>

<?= $this->section('content') ?>
<main id="content">
    <div class="container">
        <div class="row">
            <!--breadcrumb-->
            <div class="col-12">
                <div class="breadcrumb u-breadcrumb  pt-3 px-0 mb-0 bg-transparent small">
                    <a class="breadcrumb-item" href="#">Home</a> &nbsp;&nbsp;&#187;&nbsp;&nbsp;
                    <span class="d-none d-md-inline">Data Lengkap Berita</span>
                </div>
            </div>

            <!--Main content-->
            <div class="col-md-12">
                <article>
                    <div class="block-area">
                        <div class="block-title-6">
                            <h4 class="h5 border-primary"><span class="bg-primary text-white"><i class="fab fa-ioxhost"></i> Semua Data Berita</span></h4>
                        </div>
                        <!--output-->
                        <div class="border-bottom-last-0 first-pt-0">
                            <?php foreach ($v_berita as $berita) : ?>
                                <article class="card card-full hover-a py-4 post-1305 post type-post status-publish format-video has-post-thumbnail hentry category-video tag-science tag-starvation post_format-post-format-video" id="post-1305">
                                    <div class="row">
                                        <div class="col-sm-3 col-md-12 col-lg-3">
                                            <div class="ratio_360-202 image-wrapper">
                                                <a href="<?= base_url(); ?>/content/<?= $berita['slug_artikel']; ?>">
                                                    <img style="border-radius:5px;" src="<?= base_url() ?><?= $berita['path_file_gambar']; ?>/<?= $berita['file_gambar']; ?>" class="img-fluid lazy wp-post-image" sizes="(max-width: 360px) 100vw, 360px" />
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-sm-9 col-md-12 col-lg-9">
                                            <div class="card-body pt-3 pt-sm-0 pt-md-3 pt-lg-0">
                                                <h3 class="card-title h2 h3-sm h2-md">
                                                    <a href="<?= base_url(); ?>/content/<?= $berita['slug_artikel']; ?>"><?= $berita['judul']; ?></a>
                                                </h3>
                                                <p class="card-text">
                                                    ...
                                                    <?php
                                                    $kalimat = $berita['isi_artikel'];
                                                    $potong_kalimat = substr($kalimat, 35, 230);
                                                    echo $potong_kalimat;
                                                    ?>
                                                    ...
                                                </p>
                                                <div class="card-text mb-2 text-muted small">
                                                    <span class="fw-bold d-none d-sm-inline me-1">
                                                        <a href="#" rel="author"><?= $berita['nama_pengarang']; ?></a> </span>
                                                    <time class="news-date">
                                                        <?php
                                                        $date = $berita['created_date'];
                                                        echo date('d M Y', strtotime($date));
                                                        ?>
                                                    </time>
                                                </div>
                                            </div>
                                            <a href="<?= base_url(); ?>/content/<?= $berita['slug_artikel']; ?>" class="btn btn-primary btn-sm mt-3">Baca Selengkapnya <i class="fa fa-arrow-circle-right"></i> </a>
                                        </div>
                                    </div>
                                </article>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="clearfix my-4">
                        <nav class="float-start" aria-label="Posts navigation">
                            <ul class="pagination">
                                <li class="page-item active">
                                    <span aria-current="page" class="page-link current">1</span>
                                </li>
                                <li class="page-item ">
                                    <a class="page-link" href="#">2</a>
                                </li>
                                <li class="page-item ">
                                    <a class="page-link" href="#">3</a>
                                </li>
                                <li class="page-item ">
                                    <a class="page-link" href="#">6</a>
                                </li>
                                <li class="page-item ">
                                    <a class="next page-link" href="#">&raquo;</a>
                                </li>
                            </ul>
                        </nav>
                        <span class="py-2 float-end"></span>
                    </div>
                </article>
            </div>
            <!-- <aside class="col-md-4 widget-area end-sidebar-lg" id="right-sidebar">
                <div class="sticky">
                    <?php // $this->include('layout/userportal/sosial-network'); 
                    ?>
                    <?php // $this->include('layout/userportal/informasi-lain'); 
                    ?>
                    <?php // $this->include('layout/userportal/latest-post'); 
                    ?>
                </div>
            </aside> -->
        </div>
    </div>
</main>

<?= $this->endSection() ?>