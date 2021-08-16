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
				<div class="col-sm-6">
					<div class="card full-height bg-satu">
						<div class="card-box bg-satu">
							<div class="inner">
								<h3> 12345 Data </h3>
								<p> DATA BERITA </p>
							</div>
							<div class="icon">
								<i class="fab fa-accusoft" aria-hidden="true"></i>
							</div>
							<a href="#" class="card-box-footer"> Jumlah Data Berita <i class="fab fa-accusoft"></i></a>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="card full-height bg-dua">
						<div class="card-box bg-dua">
							<div class="inner">
								<h3> 12345 Data </h3>
								<p> JUMLAH DATA INFORMASI </p>
							</div>
							<div class="icon">
								<i class="fab fa-black-tie" aria-hidden="true"></i>
							</div>
							<a href="#" class="card-box-footer">Jumlah Data Informasi <i class="fab fa-black-tie"></i></a>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-6">
					<div class="card full-height bg-tiga">
						<div class="card-box bg-tiga">
							<div class="inner">
								<h3> 12345 Data </h3>
								<p>JUMLAH DATA ALBUM FOTO</p>
							</div>
							<div class="icon">
								<i class="fa fa-building" aria-hidden="true"></i>
							</div>
							<a href="#" class="card-box-footer">Jumlah Data Album Foto <i class="fa fa-building"></i></a>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="card full-height bg-empat">
						<div class="card-box bg-empat">
							<div class="inner">
								<h3> 12345 Data </h3>
								<p> JUMLAH DATA ALBUM VIDEO</p>
							</div>
							<div class="icon">
								<i class="far fa-envelope" aria-hidden="true"></i>
							</div>
							<a href="#" class="card-box-footer">Jumlah Data Album Video <i class="far fa-envelope"></i></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?= $this->include('/layout/mastertemp/_footer');  ?>
</div>
<?= $this->endSection() ?>