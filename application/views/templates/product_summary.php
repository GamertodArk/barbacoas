<?php var_dump($productData); ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title><?=APPNAME?></title>
	<link rel="stylesheet" href="<?php echo base_url('stylesheets/css/')?>product_summary.css">
	<?php include APPPATH . 'views/inc/head.php' ?>
</head>
<body>
	<header>
		<?php include APPPATH . 'views/inc/nav.php'; ?>
	</header>

	<main>
		<div class="wrapper">
			<div class="main">
				<div class="product_data">
					<div class="img">
						<?php
							// Set glide class and split all product images
							$glide = 'static';
							$productImgs = $productData['product']['images'];
							$productImgs = explode(';', $productImgs);
						?>

						<?php include APPPATH . 'views/inc/product_preview_gallery.php' ?>
					</div>
					<div class="data">
						<h2><?=$productData['product']['title']?> <span class="price"><?=$productData['product']['price']?>$ / Dia</span></h2>

						<div class="description">
							<h3>Descripcion</h3>
							<p><?=$productData['product']['description']?></p>
						</div>

						<!-- <div class="pricing">
							<p>Precio:</p>
							<p class="price">23 $</p>
							<strong>|</strong>
							<p>Dia</p>
						</div> -->

						<!-- <div class="days_amount">
							<p>Dias:</p>

							<span class="amount_wrapper">
								<span id="increase_days" class="more">
									<i class="fas fa-plus"></i>
								</span>

								<input type="text" class="days" name="days" id="amount_days" value="1" placeholder="1">

								<span id="decrease_days" class="less">
									<i class="fas fa-minus"></i>
								</span>
							</span>

						</div> -->

						<div role="form" class="time-wrap">

							<select id="time-lapse" class="time-lapse" name="time-lapse">
								<option value="days">Dias</option>
								<option value="weeks">Semanas</option>
								<option value="months">Meses</option>
							</select>

							<input type="text" id="time-lapse-amount" name="amount" value="1" placeholder="1">
						</div>

						<div class="amount">
							<p>Cantidad:</p>

							<span class="amount_wrapper">
								<span data-max-amount="<?=$productData['product']['amount']?>" id="increase_amount" class="more">
									<i class="fas fa-plus"></i>
								</span>

								<input type="text" class="counter" name="counter" id="amount_counter" value="1" placeholder="1">

								<span id="decrease_amount" class="less">
									<i class="fas fa-minus"></i>
								</span>
							</span>
						</div>


						<span class="seller">Vendedor: <a href="<?= site_url('perfil/' . $productData['seller']['id']); ?>"><?= $productData['seller']['username'] ?></a></span>

						<div class="cesta_share">
							<button data-product-id="<?=$productData['product']['id']?>" id="basket_btn" class="btn">AÑADIR A LA CESTA</button>

							<div class="share">
								<span class="icon-wrap email">
									<i class="fas fa-envelope"></i>
								</span>

								<?php if(isset($session_data)): ?>
									<?php if($isInFav): ?>
										<span id="heart-disable" data-product-id="<?=$productData['product']['id']?>" class="icon-wrap heart disable">
											<i class="fas fa-heart"></i>
										</span>
									<?php else: ?>
										<span id="heart" data-product-id="<?=$productData['product']['id']?>" class="icon-wrap heart">
											<i class="fas fa-heart"></i>
										</span>
									<?php endif; ?>
								<?php endif; ?>
							</div>
						</div>

					<!-- Error structure -->
					<?php
						$PS_error_message_id = 'PS-error-msg-wrap';
						include APPPATH . 'views/inc/product_info_error_structure.php';
						unset($PS_error_message_id);
					?>
					</div>
				</div>
			</div>

			<div class="sidebar">
				<div class="feature feature-1">
					<div class="feature-content">
						<i class="fas fa-hand-holding-usd"></i>
						<h3>ALQUILER PARA NO COMPRAR</h3>
					</div>
				</div>

				<div class="feature feature-1">
					<div class="feature-content">
						<i class="fas fa-utensils"></i>
						<h3>DEVOLUCIÓN DE LA VAJILLA SIN LAVAR</h3>
					</div>
				</div>

				<div class="feature feature-1">
					<div class="feature-content">
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
		<div class="other-products">
			<h2>Productos que te pueden interesar</h2>
			<hr>

			<div class="products-wrap">
				<?php include APPPATH . 'views/inc/item.php'; ?>
			</div>
		</div>
	</main>
	<?php include APPPATH . 'views/inc/footer.php' ?>
 	<?php include APPPATH . "views/inc/product_modal.php" ?>
	<script src="<?=base_url()?>js/product_summary.js"></script>
	<script>

		let options = {
			slider: 'static--slider',
			carousel: 'static--carousel',
			swipeable: 'static--swipeable',
			dragging: 'static--dragging',
			cloneSlide: 'static__slide--clone',
			activeNav: 'static__bullet--active',
			activeSlide: 'static__slide--active',
			disabledArrow: 'static__arrow--disabled'
		}

	 	new Glide('.static', options).mount();
	</script>
</body>
</html>
