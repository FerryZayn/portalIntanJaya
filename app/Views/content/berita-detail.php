<?= $this->extend('/layout/userportal/portal') ?>

<?= $this->section('content') ?>
<main id="content">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="breadcrumb u-breadcrumb  pt-3 px-0 mb-0 bg-transparent small">
					<a class="breadcrumb-item" href="<?php base_url(); ?>/">Home</a> &nbsp;&nbsp;&#187;&nbsp;&nbsp;
					<span class="d-none d-md-inline"><?= $v_berita->judul; ?></span>
				</div>
			</div>
			<div class="col-md-8">
				<article>
					<header class="entry-header post-title">
						<h1 class="entry-title display-4 display-2-lg mt-2"><?= $v_berita->judul; ?></h1>
						<div class="entry-meta post-atribute mb-3 small fw-normal text-muted">

							<span class="byline me-2 me-md-3"><i class="far fa-user"></i> by <span class="author vcard"><a class="url fn n fw-bold" href="#"> <?= $v_berita->nama_pengarang; ?></a></span></span>
							<span class="posted-on me-2 me-md-3"><i class="far fa-edit"></i>
								<time class="entry-date published">
									<?php
									$date = $v_berita->created_date;
									echo date('d F Y', strtotime($date));
									?>
								</time>
							</span>
							<!-- <span class="me-2 me-md-3">
								<i class="far fa-eye"></i> Views 1268234 (Cooming Soon)
							</span> -->
						</div>
						<div class="social-share mb-3">
							<a class="btn btn-social btn-facebook text-white btn-sm blank-windows" href="https://www.facebook.com/sharer/sharer.php?u=<?= base_url(); ?>/content/<?= $v_berita->slug; ?>" target="_blank">
								<i class="fab fa-facebook"></i><span class="d-none d-sm-inline"> Facebook</span>
							</a>
							<a class="btn btn-social btn-twitter text-white btn-sm blank-windows" href="https://www.twitter.com/share?url=<?= base_url(); ?>/content/<?= $v_berita->slug; ?>" target="_blank">
								<i class="fab fa-twitter"></i><span class="d-none d-sm-inline"> Twitter </span>
							</a>
							<a class="btn btn-social btn-linkedin text-white btn-sm blank-windows" href="https://www.linkedin.com/shareArticle?mini=true&url=<?= base_url(); ?>/content/<?= $v_berita->slug; ?>" target="_blank">
								<i class="fab fa-linkedin"></i><span class="d-none d-sm-inline"> Linkedin</span>
							</a>
							<a class="btn btn-social btn-facebook text-white btn-sm blank-windows" href="https://wa.me/6281240784397?text=<?= base_url(); ?>/content/<?= $v_berita->slug; ?>" data-action="share/whatsapp/share" target="_blank">
								<i class="fab fa-whatsapp"></i><span class="d-none d-sm-inline"> Whatsapp</span>
							</a>
							<a class="btn btn-social btn-pinterest text-white btn-sm blank-windows" href="http://pinterest.com/pin/create/button/?url=<?= base_url(); ?>/content/<?= $v_berita->slug; ?>" target="_blank">
								<i class="fab fa-pinterest"></i> <span class="d-none d-sm-inline"> Pinterest</span>
							</a>
							<a class="btn btn-social btn-envelope text-white btn-sm" href="mailto:?subject=Your post title&body=Read complete article in here <?= base_url(); ?>/content/<?= $v_berita->slug; ?>" target="_blank">
								<i class="far fa-envelope"></i><span class="d-none d-sm-inline"> Email</span>
							</a>
						</div>
					</header>

					<div class="entry-content post-content">
						<figure class="image-single-wrapper">
							<img width="750" height="500" src="<?= base_url() ?><?= $v_berita->path_file_gambar; ?>/<?= $v_berita->file_gambar; ?>" class="img-fluid lazy wp-post-image" sizes="(max-width: 750px) 100vw, 750px" />
							<figcaption class="bg-themes"><?= $v_berita->kategori; ?></figcaption>
						</figure>
						<p><?= $v_berita->isi_artikel; ?></p>
					</div>
					<p>&nbsp;</p>
					<footer class="entry-footer">
						<div class="tags-links tagcloud"><span class="fw-bold me-2">Tags</span>
							<a href="#" rel="tag"><?= $v_berita->kategori; ?></a>
							<a href="#" rel="tag"><?= $v_berita->tipe; ?></a>
							<a href="#" rel="tag"><?= $v_berita->nama_status; ?></a>
						</div>
					</footer>
				</article>
				<hr>
				<div class="media author-box">
					<div class="media-figure mb-3">
						<img src="<?= base_url(); ?>/templet/logo/author.jpeg" class="avatar avatar-100 photo" height="100" width="100" loading='lazy' />
					</div>
					<div class="ms-sm-3 media-body">
						<h4 class="mb-2 font-weight-bold"><?= $v_berita->nama_pengarang; ?></h4>
						<a class="author-website mb-1" href="<?= base_url(); ?>/content/<?= $v_berita->slug; ?>"><?= base_url(); ?>/content/<?= $v_berita->judul; ?></a>
						<p>
							<?php
							$kalimat = $v_berita->isi_artikel;
							$potong_kalimat = substr($kalimat, 0, 170);
							echo $potong_kalimat;
							?>...
						</p>
					</div>
				</div>
				<hr>
				<?= $this->include('/layout/userportal/relasi-berita-detail'); ?>
				<div class="suggestion-box bg-themes">
					<h4 class="text-center">Kamu Harus Baca Ini</h4>
					<div id="close-suggestion" class="close-suggestion">
						<i class="fas fa-times-circle"></i>
					</div>
					<div class="card card-full u-hover hover-a mb-2">
						<?php foreach ($v_notif as $berita) : ?>
							<div class="ratio_251-141 image-wrapper">
								<a href="<?= base_url(); ?>/content/<?= $berita['slug']; ?>">
									<img width="300" height="200" src="<?= base_url() ?><?= $berita['path_file_gambar']; ?>/<?= $berita['file_gambar']; ?>" class="attachment-medium size-medium wp-post-image" sizes="(max-width: 300px) 100vw, 300px" />
								</a>
							</div>
							<div class="card-body">
								<h3 class="card-title mb-2 h5 h4-md">
									<a href="<?= base_url(); ?>/content/<?= $berita['slug']; ?>"><?= $berita['judul']; ?></a>
								</h3>
								<div class="mb-2 text-muted small">
									<?php
									$date = $berita['created_date'];
									echo date('d F Y', strtotime($date));
									?>
								</div>
							</div>
						<?php endforeach; ?>

					</div>
				</div>
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