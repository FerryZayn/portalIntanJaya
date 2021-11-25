<?= $this->extend('/layout/pemdatemp/templet') ?>
<?= $this->section('content') ?>
<div class="main-panel">
	<div class="content">
		<div class="panel-header bg-primary-gradient">
			<div class="page-inner py-5">
				<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
					<div>
						<h2 class="text-white pb-2 fw-bold">Dashboard</h2>
						<h5 class="text-white op-7 mb-2">Administrator Portal Pemda</h5>
					</div>
				</div>
			</div>
		</div>
		<div class="page-inner mt--5">
			<div class="row">
				<div class="col-sm-4">
					<div class="card full-height bg-satu">
						<div class="card-box bg-satu">
							<div class="inner">
								<h3><?= $j_berita; ?> Data</h3>
								<p>DATA BERITA </p>
							</div>
							<div class="icon">
								<i class="fab fa-accusoft" aria-hidden="true"></i>
							</div>
							<!-- <a href="/administrator/portal-pemda/berita/home" class="card-box-footer"> Lihat Data Berita <i class="fab fa-accusoft"></i></a> -->
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="card full-height bg-dua">
						<div class="card-box bg-dua">
							<div class="inner">
								<h3> <?= $j_informasi; ?> Data </h3>
								<p>DATA INFORMASI </p>
							</div>
							<div class="icon">
								<i class="fab fa-black-tie" aria-hidden="true"></i>
							</div>
							<!-- <a href="/administrator/portal-pemda/informasi/home" class="card-box-footer">Lihat Data Informasi <i class="fab fa-black-tie"></i></a> -->
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="card full-height bg-tiga">
						<div class="card-box bg-tiga">
							<div class="inner">
								<h3> <?= $j_visi; ?> Data </h3>
								<p>DATA VISI PEMDA </p>
							</div>
							<div class="icon">
								<i class="fas fa-allergies" aria-hidden="true"></i>
							</div>
							<!-- <a href="/administrator/portal-pemda/visi/v_visi" class="card-box-footer">Lihat Data Visi <i class="fas fa-allergies"></i></a> -->
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-4">
					<div class="card full-height bg-empat">
						<div class="card-box bg-empat">
							<div class="inner">
								<h3> <?= $j_foto; ?> Data </h3>
								<p>DATA ALBUM FOTO</p>
							</div>
							<div class="icon">
								<i class="fa fa-building" aria-hidden="true"></i>
							</div>
							<!-- <a href="/administrator/portal-pemda/album-foto/home" class="card-box-footer">Lihat Data Album Foto <i class="fa fa-building"></i></a> -->
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="card full-height bg-lima">
						<div class="card-box bg-lima">
							<div class="inner">
								<h3> <?= $j_video; ?> Data </h3>
								<p>DATA ALBUM VIDEO</p>
							</div>
							<div class="icon">
								<i class="far fa-envelope" aria-hidden="true"></i>
							</div>
							<!-- <a href="/administrator/portal-pemda/album-video/home" class="card-box-footer">Lihat Data Album Video <i class="far fa-envelope"></i></a> -->
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="card full-height bg-enam">
						<div class="card-box bg-enam">
							<div class="inner">
								<h3> <?= $j_misi; ?> Data </h3>
								<p>DATA MISI PEMDA </p>
							</div>
							<div class="icon">
								<i class="fas fa-american-sign-language-interpreting" aria-hidden="true"></i>
							</div>
							<!-- <a href="/administrator/portal-pemda/misi/v_misi" class="card-box-footer">Lihat Data Misi <i class="fas fa-american-sign-language-interpreting"></i></a> -->
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-4">
					<div class="card full-height bg-satu">
						<div class="card-box bg-satu">
							<div class="inner">
								<h3> <?php // echo $j_foto; 
										?>0 Data </h3>
								<p>DATA PROFIL PEJABAT</p>
							</div>
							<div class="icon">
								<i class="fa fa-building" aria-hidden="true"></i>
							</div>
							<!-- <a href="/administrator/portal-pemda/pejabat/v_pejabat" class="card-box-footer">Lihat Data Profil Pejabat <i class="fa fa-building"></i></a> -->
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="card full-height bg-dua">
						<div class="card-box bg-dua">
							<div class="inner">
								<h3> <?= $j_slideshow; ?> Data </h3>
								<p>DATA SLIDE SHOW</p>
							</div>
							<div class="icon">
								<i class="far fa-envelope" aria-hidden="true"></i>
							</div>
							<!-- <a href="/administrator/portal-pemda/slideshow/home" class="card-box-footer">Lihat Data Slide Show <i class="far fa-envelope"></i></a> -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?= $this->include('/layout/mastertemp/_footer');  ?>
</div>
<?= $this->endSection() ?>