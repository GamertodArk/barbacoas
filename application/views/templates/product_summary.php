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
						<?php $glide = 'static'; ?>
						<?php include APPPATH . 'views/inc/product_preview_gallery.php' ?>
					</div>
					<div class="data">
						<!-- <h2><?= $product['title'] ?></h2> -->
						<h2><?=$productData->title?></h2>

						<div class="description">
							<h3>Descripcion</h3>
							<!-- <p><?= $product['description'] ?></p> -->
							<p><?=$productData->description?></p>
						</div>

						<div class="amount">
							<p>Cantidad:</p>

							<span class="amount_wrapper">
								<span data-max-amount="<?=$productData->amount?>" id="increase_amount" class="more">
									<i class="fas fa-plus"></i>
								</span>

								<input type="text" class="counter" name="counter" id="amount_counter" value="1" placeholder="1">

								<span id="decrease_amount" class="less">
									<i class="fas fa-minus"></i>
								</span>
							</span>
						</div>


						<div class="cesta_share">
							<button data-product-id="<?=$productData->id?>" id="basket_btn" class="btn">AÑADIR A LA CESTA</button>

							<div class="share">							
								<span class="icon-wrap email">
									<i class="fas fa-envelope"></i>
								</span>

								<?php if($isInFav): ?>
									<span id="heart-disable" data-product-id="<?=$productData->id?>" class="icon-wrap heart disable">
										<i class="fas fa-heart"></i>
									</span>
								<?php else: ?>
									<span id="heart" data-product-id="<?=$productData->id?>" class="icon-wrap heart">
										<i class="fas fa-heart"></i>
									</span>
								<?php endif; ?>
							</div>
						</div>
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
				<!-- <?php include 'views/inc/item.php'; ?> -->
				<?php include APPPATH . 'views/inc/item.php'; ?>

				<!-- 
				<?php foreach ($otherProducts as $productRelated): ?>

					<?php $images = explode(';', $productRelated['images']); ?>

					<div data-product-id="<?= $productRelated['id'] ?>" class="item">
						<span id="item_view" class="view view_item_btn"><i class="far fa-eye"></i></span>

						<div class="image-wrap">
							<img src="<?= base_url('img/products/') . $images[0] ?>" alt="">
						</div>
						<div class="item-content">
							<a href="<?= site_url('products/review/') . $productRelated['id']?>"><?= $productRelated['title'] ?></a>
						</div>
					</div>					
				<?php endforeach; ?>
				-->
				
				<!-- 
				<?php for ($i=0; $i < 4; $i++): ?>
					<div data-product-id="" class="item">
						<span id="item_view" class="view view_item_btn"><i class="far fa-eye"></i></span>

						<div class="image-wrap">
							<img src="<?php echo base_url() ?>img/products/pic_14_big.jpg" alt="">
						</div>
						<div class="item-content">
							<a href="#">Lorem ipsum dolor sit amet, consectetur</a>
						</div>
					</div>
				<?php endfor; ?>
				-->

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
		// new Glide('#glide').mount();
	</script>
</body>
</html>