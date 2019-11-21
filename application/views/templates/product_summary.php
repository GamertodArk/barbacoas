<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title><?=APPNAME?></title>
	<!-- <link rel="stylesheet" href="product_summary.css"> -->
	<link rel="stylesheet" href="<?php echo base_url('stylesheets/css/')?>product_summary.css">
	<?php include APPPATH . 'views/inc/head.php' ?>
</head>
<body>
	<header>
		<?php include APPPATH . 'views/inc/nav.php' ?>
	</header>

	<main>
		<div class="wrapper">
			<div class="main">
				<div class="product_data">
					<div class="img"></div>
					<div class="data">
						<h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur, fuga!</h2>

						<div class="description">
							<h3>Descripcion</h3>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam rerum optio unde reiciendis eligendi suscipit placeat iusto, earum animi ad mollitia omnis harum, ducimus commodi doloribus sequi, eum, facilis eveniet.</p>
						</div>

						<div class="amount">
							<p>Cantidad:</p>

							<span class="amount_wrapper">
								<span id="more_btn" class="more">
									<i class="fas fa-plus"></i>
								</span>

								<input type="text" class="counter" name="counter" id="counter" value="1" placeholder="1">

								<span id="less_btn" class="less">
									<i class="fas fa-minus"></i>
								</span>
							</span>
						</div>


						<div class="cesta_share">
							<button class="btn">AÑADIR A LA CESTA</button>

							<div class="share">							
								<span class="icon-wrap email">
									<i class="fas fa-envelope"></i>
								</span>

								<span class="icon-wrap heart">
									<i class="fas fa-heart"></i>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="sidebar">
				<!-- <h2>sidebar</h2> -->
				<div class="feature feature-1">
					<div class="feature-content">						
						<i class="fas fa-hand-holding-usd"></i>
						<h3>ALQUILER PARA NO COMPRAR</h3>
					</div>
				</div>

				<div class="feature feature-1">
					<div class="feature-content">						
						<!-- <i class="fas fa-hand-holding-usd"></i> -->
						<i class="fas fa-utensils"></i>
						<h3>DEVOLUCIÓN DE LA VAJILLA SIN LAVAR</h3>
					</div>
				</div>

				<div class="feature feature-1">
					<div class="feature-content">						
						<!-- <i class="fas fa-hand-holding-usd"></i> -->
						<i class="fas fa-truck"></i>
						<h3>ENTREGAS EN TODA EUROPA</h3>
					</div>
				</div>

				<div class="social-media">
					<div class="icon-wrap facebook">
						<i class="fab fa-facebook-f"></i>
					</div>

					<div class="icon-wrap twitter">
						<i class="fab fa-twitter"></i>
					</div>

					<div class="icon-wrap linkedin">
						<i class="fab fa-linkedin-in"></i>
					</div>

				</div>
			</div>
		</div>
	</main>

	<?php include APPPATH . 'views/inc/footer.php' ?>
</body>
</html>