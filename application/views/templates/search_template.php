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
		<div class="search_wrapper">		
			<form method="GET" action="<?=base_url('search')?>">
				<h3>Busca Productos</h3>
				<input type="text" name="search" id="search_input_template" placeholder="Busca los productos que necesites">
				<input type="submit" value="Buscar">
			</form>
		</div>
	</main>

	<?php include APPPATH . 'views/inc/footer.php' ?>
</body>
</html>