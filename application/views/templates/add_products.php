<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Agrega productos - <?=APPNAME?></title>
	<link rel="stylesheet" href="<?php echo base_url('stylesheets/css/') ?>add_products_styles.css">

	<?php include APPPATH . 'views/inc/head.php' ?>
</head>
<body>
	<header>
		<?php include APPPATH . 'views/inc/nav.php' ?>
	</header>

	<main>
		<div class="content">
			<h2>Agregar Producto</h2>

			<form method="POST" enctype="multipart/form-data" action="<?php echo base_url('members/register_product') ?>">

				<p id="title-error">Lorem ipsum dolor.</p>
				<input type="text" name="title" id="title" placeholder="Titulo">

				<p id="description-error">Lorem ipsum dolor.</p>
				<textarea name="description" id="description" placeholder="Description"></textarea>

				<p id="amount-error">Lorem ipsum dolor.</p>
				<div class="amount_wrap">
					<div class="amount">
						<label for="<?php echo site_url('members/add_products') ?>">Cantidad:</label>

						<span class="amount_wrapper">
							<span id="more_btn" class="more">
								<i class="fas fa-plus"></i>
							</span>

							<input id="count" type="text" name="count" value="1">

							<!-- <span id="counter" data-counter="1" class="counter">1</span> -->

							<span id="less_btn" class="less">
								<i class="fas fa-minus"></i>
							</span>
						</span>
					</div>

				<p id="dropzone-error">Lorem ipsum dolor.</p>
				<div id="dropzone" class="dropzone">
					<!-- <h3>Arrastra la imagenes aqui</h3> -->
					<p>Maximo 5 megabytes por imagen</p>
					<div class="input-wrap">
						<input multiple type="file" name="file[]" id="file">
						<p>Selecionar Archivos</p>
					</div>
				</div>

				<input id="submit_btn" class="disable" type="submit" value="Agregar">
			</form>

		</div>
	</main>

	<?php include APPPATH . 'views/inc/footer.php' ?>
	<script src="<?php echo base_url('js/') ?>add_products_scripts.js"></script>
</body>
</html>