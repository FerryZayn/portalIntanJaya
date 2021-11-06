<?= $this->extend('opd/website-opd') ?>

<?= $this->section('content') ?>
<div class="elementor-section-wrap">
    <!-- Slide -->
    <?= $this->include('/layoutopd/slide'); ?>

    <section class="elementor-section elementor-top-section elementor-element elementor-element-f2862a9 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="f2862a9" data-element_type="section">
        <div class="elementor-container elementor-column-gap-default">
            <div class="elementor-row">
                <!-- Berita Terbaru -->
                <?= $this->include('/layoutopd/berita-terbaru'); ?>

                <!-- Follow Us -->
                <?= $this->include('/layoutopd/follow-us'); ?>
            </div>
        </div>
    </section>

    <!-- Slide Tengah -->
    <?= $this->include('/layoutopd/slide-tengah'); ?>

    <!-- Trending -->

    <!-- lifestyle & Recent Post -->
    <?= $this->include('/layoutopd/berita-informasi'); ?>

    <!-- Read Next & Recent Comments -->

    <!-- Weekend Top -->

</div>
<?= $this->endSection() ?>