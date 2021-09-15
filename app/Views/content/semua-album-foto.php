<?= $this->extend('/layout/userportal/portal') ?>

<?= $this->section('content') ?>
<main id="content">
    <div class="container">
        <div class="row">
            <!--breadcrumb-->
            <div class="col-12">
                <div class="breadcrumb u-breadcrumb  pt-3 px-0 mb-0 bg-transparent small">
                    <a class="breadcrumb-item" href="#">Home</a>
                    <a class="breadcrumb-item" href="#">Album Foto</a> &nbsp;&nbsp;&#187;&nbsp;&nbsp;
                    <span class="d-none d-md-inline">Semua Album Foto</span>
                </div>
            </div>

            <!--Main content-->
            <div class="col-md-8">
                <article>
                    <div class="block-area">
                        <div class="block-title-6">
                            <h4 class="h5 border-primary"><span class="bg-primary text-white"><i class="fab fa-ioxhost"></i> Semua Album Foto</span></h4>
                        </div>
                        <!--output-->
                        <div class="border-bottom-last-0 first-pt-0">
                            <?php foreach ($v_albumfoto as $albumfoto) : ?>
                                <article class="card card-full hover-a py-4 post-1305 post type-post status-publish format-video has-post-thumbnail hentry category-video tag-science tag-starvation post_format-post-format-video" id="post-1305">
                                    <div class="row">
                                        <div class="col-sm-6 col-md-12 col-lg-6">
                                            <div class="ratio_360-202 image-wrapper">
                                                <a href="<?= base_url(); ?>/content/<?= $albumfoto['slug']; ?>">
                                                    <img style="border-radius:5px;" src="<?= base_url() ?><?= $albumfoto['path_file_gambar']; ?>/<?= $albumfoto['file_gambar']; ?>" class="img-fluid lazy wp-post-image" sizes="(max-width: 360px) 100vw, 360px" />
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-6">
                                            <div class="card-body pt-3 pt-sm-0 pt-md-3 pt-lg-0">
                                                <h3 class="card-title h2 h3-sm h2-md">
                                                    <a href="<?= base_url(); ?>/content/<?= $albumfoto['slug']; ?>"><?= $albumfoto['judul']; ?></a>
                                                </h3>
                                                <p class="card-text"><?= $albumfoto['isi_artikel']; ?></p>
                                                <div class="card-text mb-2 text-muted small">
                                                    <span class="fw-bold d-none d-sm-inline me-1">
                                                        <a href="<?= base_url(); ?>/content/<?= $albumfoto['slug']; ?>" rel="author"><?= $albumfoto['user_created']; ?></a> </span>
                                                    <time class="news-date"><?= $albumfoto['created_date']; ?></time>
                                                </div>
                                            </div>
                                            <a href="<?= base_url(); ?>/content/<?= $albumfoto['slug']; ?>" class="btn btn-primary btn-sm mt-3">Baca Selengkapnya <i class="fa fa-arrow-circle-right"></i> </a>
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
            <aside class="col-md-4 widget-area end-sidebar-lg" id="right-sidebar">
                <div class="sticky">
                    <?= $this->include('layout/userportal/sosial-network'); ?>
                    <?= $this->include('layout/userportal/informasi-lain'); ?>
                    <?= $this->include('layout/userportal/latest-post'); ?>
                </div>
            </aside>
        </div>
    </div>
</main>

<?= $this->endSection() ?>