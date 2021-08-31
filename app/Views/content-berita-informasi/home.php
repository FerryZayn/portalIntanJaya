<?= $this->extend('/layout/userportal/portal') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-12">
        <?= $this->include('layout/userportal/_slide_header');
        ?>
        <?= $this->include('layout/userportal/bupati-wakil'); ?>
        <?= $this->include('layout/userportal/berita-terbaru'); ?>
        <?= $this->include('layout/userportal/album-foto'); ?>
        <?= $this->include('layout/userportal/album-video'); ?>
        <?= $this->include('layout/userportal/data-portal');
        ?>
    </div>
</div>
<?= $this->endSection() ?>