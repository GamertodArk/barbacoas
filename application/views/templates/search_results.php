<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Resultados de query </title>
	<link rel="stylesheet" href="<?=base_url('stylesheets/css/')?>search_results.css">
	<?php include APPPATH . 'views/inc/head.php' ?>
</head>
<body>
	<header>
		<?php include APPPATH . 'views/inc/nav.php' ?>
	</header>

	<main>
		<h2>Resultados de query</h2>
		<?php if($products): ?>
			<div class="products_wrapper">
				<?php include APPPATH . 'views/inc/item.php' ?>
			</div>
		<?php else: ?>
			<div class="empty">
				<h3>No hemos encontrado ningun producto relativo a tu busqueda</h3>
			</div>
		<?php endif; ?>
	</main>

	<?php include APPPATH . 'views/inc/footer.php' ?>
</body>
</html>