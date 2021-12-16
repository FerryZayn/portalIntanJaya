<?= $this->extend('/layout/mastersu/templet') ?>
<?= $this->section('content') ?>
<div class="main-panel">
	<div class="content">
		<div class="panel-header bg-info-gradient">
			<div class="page-inner py-5">
				<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
					<div>
						<h2 class="text-white pb-2 fw-bold">Dashboard</h2>
						<h5 class="text-white op-7 mb-2">Master</h5>
					</div>
				</div>
			</div>
		</div>
		<div class="page-inner mt--5">
			<div class="row">
				<div class="col-sm-6">
					<div class="card full-height bg-primary">
						<div class="card-box bg-primary">
							<div class="inner">
								<h3> 12345 Data </h3>
								<p> DATA PEGAWAI </p>
							</div>
							<div class="icon">
								<i class="fab fa-accusoft" aria-hidden="true"></i>
							</div>
							<a href="#" class="card-box-footer">
								Data Master <i class="fab fa-accusoft"></i>
							</a>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="card full-height bg-primary">
						<div class="card-box bg-primary">
							<div class="inner">
								<h3> 12345 Data </h3>
								<p> DATA OPD </p>
							</div>
							<div class="icon">
								<i class="fab fa-black-tie" aria-hidden="true"></i>
							</div>
							<a href="#" class="card-box-footer">
								Data Administrator Master <i class="fab fa-black-tie" aria-hidden="true"></i>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?= $this->include('/layout/mastertemp/_footer');  ?>
</div>
<?= $this->endSection() ?>