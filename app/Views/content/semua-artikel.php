<?= $this->extend('/layout/userportal/portal') ?>

<?= $this->section('content') ?>

<main id="content">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb u-breadcrumb  pt-3 px-0 mb-0 bg-transparent small">
                    <a class="breadcrumb-item" href="#">Home</a> &nbsp;&nbsp;&#187;&nbsp;&nbsp;
                    <span class="d-none d-md-inline">Kumpulan Artikel Portal Intan Jaya</span>
                </div>
            </div>
            <div class="col-md-12">
                <article>


                    <div class="block-area">
                        <div class="block-title-6">
                            <h4 class="h5 border-primary"><span class="bg-primary text-white"><i class="fas fa-city"></i> Kumpulan Artikel Portal Intan Jaya</span></h4>
                        </div>
                        <div class="row">
                            <?php foreach ($v_informasi as $informasi) : ?>
                                <article class="col-sm-3" style="padding-bottom: 20px;">
                                    <div class="cards">
                                        <div class="card">
                                            <article>
                                                <img src="<?= base_url() ?><?= $informasi['path_file_gambar'] ?>/<?= $informasi['file_gambar'] ?>" class="card-img-top" alt="...">
                                                <div class="card-body" style="padding: 5px;">
                                                    <a href="<?= base_url() ?>/content/<?= $informasi['slug'] ?>" class="btn fw-bold">
                                                        <?= $informasi['judul'] ?>
                                                    </a>
                                                    <div class="desc">
                                                        <?php
                                                        $kalimat = $informasi['isi_artikel'];
                                                        $potong_kalimat = substr($kalimat, 0, 120);
                                                        echo $potong_kalimat;
                                                        ?>...
                                                    </div>
                                                </div>
                                            </article>
                                            <div class="actions">
                                                <a href="<?= base_url() ?>/content/<?= $informasi['slug'] ?>" class="btn">
                                                    <span><i class="fas fa-eye"></i> LIHAT SELENGKAPNYA</span>
                                                    <img class="icon" src="https://rafaelavlucas.github.io/assets/icons/black/icon-18.svg">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            <?php endforeach; ?>
                        </div>
                    </div>


                    <?= $pager->links('artikel', 'pagin_artikel') ?>


                </article>
            </div>
        </div>
    </div>
</main>


<?= $this->endSection() ?>