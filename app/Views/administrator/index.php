<?= $this->extend('/layout/adminportal/templet') ?>
<?= $this->section('content') ?>

<div class="main-panel">
	<div class="content mt-0">
		<div class="panel-header bg-primary-gradient">
			<div class="page-inner py-5">
				<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
					<div class="mr-3">
						<img src="<?= base_url(); ?>/admintemp/img/logo/logo.png" style="width: 100px;">
					</div>
					<div>
						<h1 class="text-white fw-bold">PORTAL RESMI</h1>
						<h1 class="text-white pb-2 fw-bold">KABUPATEN INTAN JAYA</h1>
					</div>
					<div class="ml-md-auto py-2 py-md-0">
						<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
							<div class="avatar-sm">
								<img src="<?= base_url(); ?>/admintemp/img/logo/user.png" alt="..." class="avatar-img rounded-circle">
							</div>
						</a>
						<ul class="dropdown-menu dropdown-user animated fadeIn">
							<div class="dropdown-user-scroll scrollbar-outer">
								<li>
									<div class="user-box">
										<div class="avatar-lg"><img src="<?= base_url(); ?>/admintemp/img/logo/user.png" alt="image profile" class="avatar-img rounded"></div>
										<div class="u-text">
											<h4>
												<h4><?= session()->get('nama_pegawai'); ?></h4>
											</h4>
											<p class="text-muted"><?= session()->get('email'); ?></p>
											<a href="#" class="btn btn-xs btn-secondary btn-sm">View Profile</a>
										</div>
									</div>
								</li>
								<li>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="#">My Profile</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="#">Account Setting</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="/AuthController/logout">Logout</a>
								</li>
							</div>
						</ul>


					</div>
				</div>
			</div>
		</div>
		<div class="page-inner mt--5">
			<div class="row">
				<div class="col-sm-4">
					<div class="card full-height bg-satu">
						<div class="card-box bg-satu">
							<div class="inner" style="padding-bottom: 30px;">
								<h3> MASTER</h3>
							</div>
							<div class="icon">
								<i class="fab fa-accusoft" aria-hidden="true"></i>
							</div>
							<a href="/administrator/master/dashboard" class="card-box-footer">Masuk <i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="card full-height bg-dua">
						<div class="card-box bg-dua">
							<div class="inner" style="padding-bottom: 30px;">
								<h3> ADMINISTRATOR PORTAL PEMDA </h3>
							</div>
							<div class="icon">
								<i class="fab fa-black-tie" aria-hidden="true"></i>
							</div>
							<a href="/administrator/portal-pemda/dashboard" class="card-box-footer">Masuk <i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="card full-height bg-tiga">
						<div class="card-box bg-tiga">
							<div class="inner" style="padding-bottom: 30px;">
								<h3> ADMINISTRATOR PORTAL OPD </h3>
							</div>
							<div class="icon">
								<i class="fa fa-book" aria-hidden="true"></i>
							</div>
							<a href="/administrator/portal-opd/dashboard" class="card-box-footer">Masuk <i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-4">
					<div class="card full-height bg-empat">
						<div class="card-box bg-empat">
							<div class="inner" style="padding-bottom: 30px;">
								<h3> E-SAKIP </h3>
							</div>
							<div class="icon">
								<i class="fa fa-building" aria-hidden="true"></i>
							</div>
							<a href="/administrator/e-sakip/dashboard" class="card-box-footer">Masuk <i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="card full-height bg-lima">
						<div class="card-box bg-lima">
							<div class="inner" style="padding-bottom: 30px;">
								<h3> E-SURAT</h3>
							</div>
							<div class="icon">
								<i class="far fa-envelope" aria-hidden="true"></i>
							</div>
							<a href="/administrator/master/dashboard" class="card-box-footer">Masuk <i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?= $this->include('/layout/adminportal/_footer');  ?>
</div>
<?= $this->endSection() ?>