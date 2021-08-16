<?= $this->extend('/layout/userportal/portal') ?>

<?= $this->section('content') ?>
<main id="content">
	<div class="container">
		<div class="row">
			<!--breadcrumb-->
			<div class="col-12">
				<div class="breadcrumb u-breadcrumb  pt-3 px-0 mb-0 bg-transparent small">
					<a class="breadcrumb-item" href="#">Home</a>
					<a class="breadcrumb-item" href="#">Judul Berita Clik 1</a>
					<a class="breadcrumb-item" href="#">Berita 1/Berita 2 Cklik 2</a> &nbsp;&nbsp;&#187;&nbsp;&nbsp;
					<span class="d-none d-md-inline">Judul Berita Yang Sementara Tayang</span>
				</div>
			</div>

			<!--Main content-->
			<div class="col-md-8">
				<article>
					<header class="entry-header post-title">
						<h1 class="entry-title display-4 display-2-lg mt-2">Judul Berita Yang Sementara Tayang</h1>
						<div class="entry-meta post-atribute mb-3 small fw-normal text-muted">

							<span class="byline me-2 me-md-3">
								<i class="far fa-user"></i> by <span class="author vcard"><a class="url fn n fw-bold" href="#"> User Created</a></span>
							</span>
							<span class="posted-on me-2 me-md-3"><i class="far fa-edit"></i><time class="entry-date published"> Agustus 03, 2021</time>
							</span>
							<span class="me-2 me-md-3 text-muted d-none d-md-inline-block"><i class="far fa-comment-dots"></i> 0 Komentar</span>
							<!-- comments mobile Star-->
							<span class="me-2 me-md-3 text-muted d-md-none"><i class="far fa-comment-dots"></i> 0 Komentar</span>
							<!-- comments mobile End-->
							<span class="me-2 me-md-3"><i class="far fa-eye"></i> Views 1268234 (Sangat Banyak Epribadiiiii)</span>
						</div>

						<!--social share-->
						<div class="social-share mb-3">
							<a class="btn btn-social btn-facebook text-white btn-sm blank-windows" href="https://www.facebook.com/share.php?u=https://localhost:8080/content/judul-berita-yang-sedang-tayang/" target="_blank" rel="noopener" title="Share to facebook">
								<i class="fab fa-facebook"></i><span class="d-none d-sm-inline"> Facebook</span>
							</a>
							<a class="btn btn-social btn-twitter text-white btn-sm blank-windows" href="https://www.twitter.com/share?url=https://localhost:8080/content/judul-berita-yang-sedang-tayang/" target="_blank" rel="noopener" title="Share to twitter">
								<i class="fab fa-twitter"></i><span class="d-none d-sm-inline"> Twitter </span>
							</a>
							<a class="btn btn-social btn-linkedin text-white btn-sm blank-windows" href="https://www.linkedin.com/shareArticle?mini=true&url=https://localhost:8080/content/judul-berita-yang-sedang-tayang/" target="_blank" rel="noopener" title="Share to Linkedin">
								<i class="fab fa-linkedin"></i><span class="d-none d-sm-inline"> Linkedin</span>
							</a>
							<a class="btn btn-social btn-facebook text-white btn-sm blank-windows" href="whatsapp://send?text=Read more in https://localhost:8080/content/judul-berita-yang-sedang-tayang/" data-action="share/whatsapp/share" target="_blank" rel="noopener" title="Share to whatsapp">
								<i class="fab fa-whatsapp"></i><span class="d-none d-sm-inline"> Whatsapp</span>
							</a>
							<a class="btn btn-social btn-pinterest text-white btn-sm blank-windows" href="http://pinterest.com/pin/create/button/?url=https://localhost:8080/content/judul-berita-yang-sedang-tayang/" target="_blank" rel="noopener" title="Share to Pinterest">
								<i class="fab fa-pinterest"></i> <span class="d-none d-sm-inline"> Pinterest</span>
							</a>
							<a class="btn btn-social btn-envelope text-white btn-sm" href="mailto:?subject=Your post title&body=Read complete article in here https://localhost:8080/content/judul-berita-yang-sedang-tayang/" target="_blank" rel="noopener" title="Share by Email">
								<i class="far fa-envelope"></i><span class="d-none d-sm-inline"> Email</span>
							</a>
						</div><!-- social share -->
					</header>


					<div class="entry-content post-content">
						<figure class="image-single-wrapper">
							<img width="750" height="500" src="<?= base_url(); ?>/templet/gambar-berita/gambar.jpg" class="img-fluid lazy wp-post-image" sizes="(max-width: 750px) 100vw, 750px" />
							<figcaption class="bg-themes">Kategori Berita</figcaption>
						</figure>
						<p><span class="dropcaps dropcaps-one">L</span>orem ipsum dolor sit amet consectetur adipisicing elit. Beatae facere asperiores dicta. Ut ratione obcaecati odit cupiditate atque, recusandae dignissimos qui. Quos, distinctio architecto inventore sequi enim odit sapiente accusantium.</p>

						<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>



						<h3><strong>The standard Lorem Ipsum passage, used since the 1500s</strong></h3>
						<div class="wp-block-image">
							<figure class="alignleft is-resized"><img loading="lazy" src="<?= base_url(); ?>/templet/gambar-berita/gambar.jpg" class="wp-image-846" width="335" height="285" sizes="(max-width: 335px) 100vw, 335px" />
								<figcaption>Kategori Berita</figcaption>
							</figure>
						</div>
						<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sint adipisci odit fugit mollitia itaque nobis eaque impedit laboriosam asperiores, eius expedita labore ullam fugiat molestias sit neque explicabo odio animi?</p>
						<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sint adipisci odit fugit mollitia itaque nobis eaque impedit laboriosam asperiores, eius expedita labore ullam fugiat molestias sit neque explicabo odio animi?</p>
					</div>
					<!-- Entry Content Details End-->

					<p>&nbsp;</p>
					<footer class="entry-footer">
						<div class="tags-links mb-3"><span class="fw-bold me-2">Kategori Berita</span>
							<a href="#" rel="category tag">Kategori 1</a>
							<a href="#" rel="category tag">Kategori 2</a>
							<a href="#" rel="category tag">Kategori Lainnya</a> <!-- jika ada relasi dari berita yang tayang -->
						</div>

						<div class="tags-links tagcloud"><span class="fw-bold me-2">Tags</span>
							<a href="#" rel="tag">Tag 1</a>
							<a href="#" rel="tag">Tag 2</a>
							<a href="#" rel="tag">Tag 3</a>
							<a href="#" rel="tag">Tag Lainnya</a> <!-- jika ada relasi dari berita yang tayang -->
						</div>
					</footer>
				</article>

				<hr>

				<!--author-->
				<div class="media author-box">
					<div class="media-figure mb-3">
						<img src="<?= base_url(); ?>/templet/logo/author.jpeg" class="avatar avatar-100 photo" height="100" width="100" loading='lazy' />
					</div>
					<div class="ms-sm-3 media-body">
						<h4 class="mb-2 font-weight-bold">User Created</h4>
						<a class="author-website mb-1" target="_blank" rel="noopener" href="http://localhost:8080/content/berita-detail">http://localhost:8080/content/berita-detail</a>
						<p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a...</p>
					</div>
				</div>
				<hr>

				<!-- Previous and next article -->
				<div class="prev-next-post">
					<div class="row my-5">
						<!-- Previous article -->
						<div class="col-12 col-sm-6 prev-post-start">
							<span class="d-block text-muted mb-2">Previous article</span>
							&laquo; <a href="#" rel="prev">Judul Berita</a>
						</div>
						<!-- Next article -->
						<div class="col-12 col-sm-6 next-post-end">
							<span class="d-block text-muted mb-2">Next article</span>
							<a href="#" rel="next">Judul Berita</a> &raquo;
						</div>
					</div>
				</div>


				<!--related-->
				<?= $this->include('/layout/userportal/relasi-berita-detail'); ?>
				<!--End Related Posts-->


				<!--suggestion post-->

				<!-- Suggestion box Star-->
				<!-- Berita Sugesti box Selanjutnya -->
				<!-- Berita Sugesti box Selanjutnya -->
				<div class="suggestion-box bg-themes">
					<h4 class="text-center">Kamu Harus Baca Ini</h4>
					<div id="close-suggestion" class="close-suggestion">
						<i class="fas fa-times-circle"></i>
					</div>
					<div class="card card-full u-hover hover-a mb-2">
						<div class="ratio_251-141 image-wrapper">
							<a href="#">
								<img width="300" height="200" src="<?= base_url(); ?>/templet/gambar-berita/gambar.jpg" class="attachment-medium size-medium wp-post-image" sizes="(max-width: 300px) 100vw, 300px" />
							</a>
						</div>
						<div class="card-body">
							<h3 class="card-title mb-2 h5 h4-md">
								<a href="#">Lorem ipsum, dolor sit amet consectetur adipisicing elit.</a>
							</h3>
							<div class="mb-2 text-muted small">
								Agustus 03, 2021
							</div>
						</div>
					</div>
				</div>
				<!-- Berita Sugesti box Selanjutnya -->
				<!-- Suggestion box End-->


				<!--Comments-->
				<div id="comments" class="mb-5">
					<div id="respond" class="comment-respond">
						<h3 id="reply-title" class="comment-reply-title">Tinggalkan Pesan Anda
							<small>
								<a rel="nofollow" id="cancel-comment-reply-link" href="index.html#respond" style="display:none;">Cancel reply</a>
							</small>
						</h3>

						<form action="#" method="post" id="commentform" class="comment-form" novalidate>
							<p class="comment-notes"><span id="email-notes">Alamat email Anda tidak akan dipublikasikan. Bidang yang harus diisi ditandai *</p>

							<div class="form-group comment-form-comment">
								<textarea aria-label="comments" class="form-control mb-4" placeholder="Isi Komentar... *" id="comment" name="comment" cols="45" rows="8" required></textarea>
							</div>
							<div class="form-group comment-form-author">
								<input class="form-control mb-4" aria-label="name" id="author" placeholder="Nama Anda*" name="author" type="text" required>
							</div>
							<div class="form-group comment-form-email">
								<input class="form-control mb-4" aria-label="email" id="email" placeholder="Email *" name="email" type="email" required>
							</div>

							<p class="form-submit">
								<button name="submit" type="submit" id="submit" class="btn btn-primary"><i class="fas fa-vote-yea"></i> Kirim Komentar</button>
								<input type='hidden' name='comment_post_ID' value='1111' id='comment_post_ID' />
								<input type='hidden' name='comment_parent' id='comment_parent' value='0' />
							</p>
						</form>

					</div>
				</div>
			</div>
			<!-- left sidebar check -->

			<!-- right sidebar check -->
			<aside class="col-md-4 widget-area end-sidebar-lg" id="right-sidebar">
				<div class="sticky">
					<?= $this->include('layout/userportal/sosial-network'); ?>
					<?= $this->include('layout/userportal/informasi-lain'); ?>
					<!-- Latest Post 1 Star -->
					<?= $this->include('layout/userportal/latest-post'); ?>
					<!-- Latest Post 1 End -->
				</div>
			</aside>
		</div>
	</div>
</main>

<?= $this->endSection() ?>