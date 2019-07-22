<!DOCTYPE html>
<html lang="en">
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

			<form action="">
				<input type="text" name="title" id="title" placeholder="Titulo">

				<textarea name="description" id="description" cols="30" rows="10" placeholder="Description"></textarea>

				<div class="amount_wrap">
					<div class="amount">
						<!-- <p>Cantidad:</p> -->
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
				</div>

				<!-- <div class="counter">
					<label for="counter">Cantidad:</label>
					<span class="counter_wrapper">

						<span id="more_btn" class="more">
							<i class="fas fa-plus"></i>
						</span>

						<input type="text" input="text" value="1">

						<span id="less_btn" class="less">
							<i class="fas fa-minus"></i>
						</span>

					</span>
				</div> -->
			</form>

		</div>
	</main>

	<?php include APPPATH . 'views/inc/footer.php' ?>
	<script src="<?php echo base_url('js/') ?>add_products_scripts.js"></script>
</body>
</html>