<div class="row mt-2">
    <div class="col-12">
        <div class="block-title-6">
            <h4 class="h5 border-primary"><span class="bg-primary text-white"><i class="fab fa-slideshare"></i> Slide Show</span></h4>
        </div>
    </div>
    <div class="col-lg-8">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <?php
                foreach ($v_slideshow as $key => $value) :
                    $active = ($key == 0) ? 'active' : '';
                ?>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?= $key; ?>" class="<?= $active; ?>" aria-current="true" aria-label="Slide 1"></button>
                <?php endforeach; ?>
            </div>


            <div class="carousel-inner">
                <?php
                foreach ($v_slideshow as $key => $value) :
                ?>
                    <?php $active = ($key == 0) ? 'active' : ''; ?>
                    <div class="carousel-item <?= $active; ?>">
                        <img src="<?= base_url() ?><?= $value['path_file_gambar'] ?>/<?= $value['file_gambar'] ?>" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h2 class="text-white"><?= $value['judul']; ?></h2>

                            <div class="card text-center" style="background-color: rgba(245, 245, 245, 0.2); opacity: 1; border-radius: 20px;">
                                <div class="card-body text-white">

                                    <?= $value['isi_artikel']; ?>

                                </div>
                            </div>

                        </div>
                    </div>

                <?php endforeach; ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <div class="col-lg-4">
        <img src="<?= base_url(); ?>/templet/logo/peta.png" style="border:0; height: 410px; width: 409px;" allowfullscreen="true" loading="lazy">
    </div>
</div>