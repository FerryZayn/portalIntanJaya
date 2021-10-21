<?= $this->extend('/layout/userportal/portal') ?>

<?= $this->section('content') ?>

<main id="content">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="breadcrumb u-breadcrumb  pt-3 px-0 mb-0 bg-transparent small">
					<a class="breadcrumb-item" href="<?= base_url("/content/home") ?>">Home</a> &nbsp;&nbsp;&#187;&nbsp;&nbsp;
					<span class="d-none d-md-inline">Daftar OPD Kabupaten Intan Jaya</span>
				</div>
			</div>
			<div class="col-md-12">
				<article>
					<div class="block-area">
						<div class="block-title-6">
							<h4 class="h5 border-primary"><span class="bg-primary text-white"><i class="fab fa-ioxhost"></i> OPD Kabupaten Intan Jaya</span></h4>
						</div>
						<div class="border-bottom-last-0 first-pt-0">
							<div id="features" class="features section pt-3">
								<div class="container">
									<div class="row">
										<div class="col-lg-12">
											<div class="features-content">
												<div class="row">
													<div class="col-lg-12">
														<div class="features-item first-feature wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.4s">
															<div class="third-number number">
																<h6>OPD</h6>
															</div>
															<h4>ORGANISASI PEMERINTAH DAERAH</h4>
															<p align="left">
																<?php $i = 1; ?>
																<?php foreach ($v_contentopd as $opd) : ?>
																	<a href="<?= $opd['website']; ?>" target="_blank"><?= $i++; ?>. <?= $opd['nama_opd']; ?></a><br />
																<?php endforeach; ?>
															</p>
														</div>
													</div>
													<!-- <div class="col-lg-4">
														<div class="features-item first-feature wow fadeInUp" data-wow-duration="1s" data-wow-delay="0s">
															<div class="first-number number">
																<h6>02</h6>
															</div>
															<h4>BPKAD</h4>
															<p align="left">
																<a href="#">1. Nama 1</a> <br />
																<a href="#">2. Nama 2</a> <br />
																<a href="#">3. Nama 3</a> <br />
																<a href="#">4. Nama 4</a> <br />
																<a href="#">5. Nama 5</a> <br />
																<a href="#">6. Nama 6</a> <br />
																<a href="#">7. Nama 7</a> <br />
																<a href="#">8. Nama 8</a>
															</p>
														</div>
													</div>
													<div class="col-lg-4">
														<div class="features-item second-feature wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
															<div class="second-number number">
																<h6>03</h6>
															</div>
															<h4>INSPEKTORAT</h4>
															<p align="left">
																<a href="#">1. Nama 1</a> <br />
																<a href="#">2. Nama 2</a> <br />
																<a href="#">3. Nama 3</a> <br />
																<a href="#">4. Nama 4</a> <br />
																<a href="#">5. Nama 5</a> <br />
																<a href="#">6. Nama 6</a> <br />
																<a href="#">7. Nama 7</a> <br />
																<a href="#">8. Nama 8</a>
															</p>
														</div>
													</div> -->
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</article>
			</div>
		</div>
	</div>
</main>

<?= $this->endSection() ?>