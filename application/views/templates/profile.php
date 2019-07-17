<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title><?=$name?> - <?=APPNAME?></title>
	<link rel="stylesheet" href="<?php echo base_url('stylesheets/css/') ?>profile_styles.css">
	<?php include APPPATH . 'views/inc/head.php' ?>
</head>
<body>
	<header>
		<?php include APPPATH . 'views/inc/nav.php' ?>
	</header>

	<main>
		<div class="user_summary">
			<div class="content">
				<div class="img"></div>
				<h3>Lorem ipsum dolor.</h3>
				<h4>@LoremIpsumDolor.</h4>
			</div>
		</div>

		<div class="products">
			<h2>Productos Publicados</h2>

			<div class="products_wrap">
				<p>No tiene productos actualmente</p>
			</div>
		</div>

		<hr>

		<h2>Nojoda</h2>
	</main>

	<?php include APPPATH . 'views/inc/footer.php' ?>
</body>
</html>