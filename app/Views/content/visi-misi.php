<?= $this->extend('/layout/userportal/portal') ?>

<?= $this->section('content') ?>
<main id="content">
    <div class="container">
        <div class="row">
            <!--breadcrumb-->
            <div class="col-12">
                <div class="breadcrumb u-breadcrumb  pt-3 px-0 mb-0 bg-transparent small">
                    <a class="breadcrumb-item" href="#">Home</a> &nbsp;&nbsp;&#187;&nbsp;&nbsp;
                    <span class="d-none d-md-inline">Visi dan Misi PEMDA Kabupaten Intan Jaya</span>
                </div>
            </div>
            <div class="col-md-12">
                <article>
                    <div class="block-area">
                        <div class="block-title-6">
                            <h4 class="h5 border-primary"><span class="bg-primary text-white"><i class="fab fa-ioxhost"></i> Visi dan Misi PEMDA Kabupaten Intan Jaya</span></h4>
                        </div>
                        <div class="border-bottom-last-0 first-pt-0">
                            <div class="card text-dark mb-3 text-center">
                                <div class="card-header bg-primary text-white">Visi Kabupaten</div>
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <?php foreach ($v_misi as $m) : ?>
                                            <?= $m['isi_artikel']; ?>
                                        <?php endforeach; ?>
                                    </h5>
                                </div>
                            </div>
                            <div class="card text-dark bg-light mb-3 text-center">
                                <div class="card-header text-white" style="background-color: #6930C3;">Misi Kabupaten</div>
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <?php foreach ($v_visi as $v) : ?>
                                            <?= $v['isi_artikel']; ?>
                                        <?php endforeach; ?>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </div>

            <aside class="col-md-4 widget-area end-sidebar-lg" id="right-sidebar">
                &nbsp;
            </aside>


        </div>
    </div>
</main>

<?= $this->endSection() ?>