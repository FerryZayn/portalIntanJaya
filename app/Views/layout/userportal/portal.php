<!DOCTYPE html>
<html lang="en-US">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="#">
	<meta name='robots' content='index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' />


	<title>Portal Intan Jaya</title>
	<meta name="description" content="Portal Intan Jaya" />
	<link rel="canonical" href="#" />
	<link rel="next" href="#" />
	<meta property="og:locale" content="en_US" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="Portal Intan Jaya" />
	<meta property="og:description" content="Portal Intan Jaya" />
	<meta property="og:url" content="#" />
	<meta property="og:site_name" content="Portal Intan Jaya" />
	<meta name="twitter:card" content="summary_large_image" />

	<!-- Sechema Graphic disini -->
	<?= $this->include('/layout/userportal/schema'); ?>

	<!-- / Yoast SEO plugin. -->
	<link rel='stylesheet' id='wp-block-library-css' href='<?= base_url() ?>/templet/css/style.min9f31.css?ver=5.7.2' media='all' />
	<link rel='stylesheet' id='bn_fonts-css' href='http://fonts.googleapis.com/css?family=Roboto%3Aregular%2Citalic%2C500%2C700%26subset%3Dlatin%2C' media='screen' />
	<link rel='stylesheet' id='bootnews-styles-css' href='<?= base_url() ?>/templet/css/bundle.min0079.css?ver=2.0.4.1623558256' media='all' />
	<link rel="stylesheet" href="<?= base_url() ?>/templet/css/card-data-portal.css">

	<!--load all styles fontawesome-->
	<link href="<?= base_url() ?>/templet/fontawesome/css/all.css" rel="stylesheet">
	<link href="<?= base_url() ?>/templet/fontawesome/css/svg-with-js.css" rel="stylesheet">


	<meta name="mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-title" content="Portal Templet">
	<style>
		.recentcomments a {
			display: inline !important;
			padding: 0 !important;
			margin: 0 !important;
		}
	</style>
	<style id="custom-background-css">
		body.custom-background {
			background-image: url("<?= base_url() ?>/logo/bgg-1.png");
			background-position: left top;
			background-size: auto;
			background-repeat: repeat;
			background-attachment: fixed;
		}
	</style>

	<!-- Begin Custom CSS -->
	<?= $this->include('layout/userportal/custom'); ?>

	<!-- End Custom CSS -->
	<link rel="icon" href="<?= base_url() ?>/templet/logo/android-icon-96x96-1-96x92.png" sizes="32x32" />
	<link rel="icon" href="<?= base_url() ?>/templet/logo/android-icon-96x96-1.png" sizes="192x192" />
	<link rel="apple-touch-icon" href="<?= base_url() ?>/templet/logo/android-icon-96x96-1.png" />
</head>

<body class="home blog custom-background wp-custom-logo full-width font-family hfeed">
	<a id="skippy" class="visually-hidden-focusable" href="#content">
		<div class="container">
			<span class="skiplink-text">Skip to content</span>
		</div>
	</a>
	<div class="bg-image"></div>
	<div class="wrapper">
		<?= $this->include('layout/userportal/_header'); ?>
		<div id="showbacktop" class="showbacktop full-nav bg-white border-lg-1 border-bottom shadow-b-sm border-none py-0">
			<div class="container">
				<nav id="main-menu" class="main-menu navbar navbar-expand-lg navbar-light px-2 px-lg-0 py-0">
					<?= $this->include('layout/userportal/navbar-menu'); ?>
				</nav>
			</div>
		</div>
		<?php // $this->include('layout/userportal/_slide_header.php');
		?>
		<?= $this->include('layout/userportal/mobile-menu'); ?>


		<main id="content">
			<div class="container">
				<!-- Content Star -->
				<?= $this->renderSection('content'); ?>
				<!-- Content End -->
			</div>
		</main>


		<footer>
			<?= $this->include('layout/userportal/footer'); ?>
			<div class="footer-copyright bg-secondary">
				<div class="container text-center text-white">
					Copyright Portal Intan Jaya News - All rights reserved
				</div>
			</div>
		</footer>
	</div>
	<a class="back-top btn btn-light border position-fixed r-1 b-1" href="#">
		<i class="fas fa-arrow-up"></i>
	</a>

	<script src='<?= base_url() ?>/templet/js/bundle.min6cab.js?ver=2.0.4.1623558202' id='bootnews-scripts-js'></script>
	<script src='<?= base_url() ?>/templet/js/wp-embed.min9f31.js?ver=5.7.2' id='wp-embed-js'></script>
	<script src='<?= base_url() ?>/templet/fontawesome/js/all.js'></script>
</body>

</html>