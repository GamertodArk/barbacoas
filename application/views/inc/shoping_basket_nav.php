<li id="shopping-basket" class="shopping-wrap">
	<i id="shopping-basket-icon" class="fas fa-shopping-basket"></i>

	<div id="basket_triangle" class="triangle"></div>

	<?php if(count($_SESSION['products']) > 0): ?>
		<span id="shopping_basket_counter" data-basket-counter="<?=count($_SESSION['products'])?>"><?=count($_SESSION['products'])?></span>
	<?php else: ?>
		<span class="hide" id="shopping_basket_counter" data-basket-counter="0">0</span>
	<?php endif; ?>


	<div id="basket_items_wrap" class="basket_wrap">

	<?php if(count($_SESSION['products']) > 0 ): ?>
		<div id="items_basket" class="items">

			<?php foreach ($_SESSION['products'] as $product): ?>
				<div class="shopping-item">

					<!-- <img src="" alt=""> -->
					<div class="img"></div>
					<span class="data">
						<p>Producto añadido a la cesta</p>
						<a href="">Ver producto</a>
					</span>
					<span onclick="delete_notification(this.parentNode)" class="remove-item">
						<i class="fas fa-times"></i>
					</span>
				</div>

			<?php endforeach; ?>

		</div>

	<?php else: ?>
		<div class="items empty">
			<p id="basket_empty_msg" class="empty">No tienes productos en la cesta de compra</p>
		</div>
	<?php endif; ?>

	<!--
	<div id="basket_items_wrap" class="items">

		<?php if(count($_SESSION['products']) > 0): ?>

			<?php foreach ($_SESSION['products'] as $product): ?>
				<div data-product-id="<?php echo $product['id'] ?>" class="shopping-item">
					<h3><?php echo $product['title'] ?></h3>
					<span onclick="delete_from_basket(<?=$product['id']?>, this.parentNode)" class="remove-item">
						<i class="fas fa-times"></i>
					</span>
				</div>
			<?php endforeach; ?>

		<?php else: ?>
			<p id="basket_empty_msg" class="empty">No tienes productos en la cesta de compra</p>
		<?php endif; ?>
	-->
	<!-- </div> -->
		<a href="<?=site_url('members/shopping_basket')?>">Ver la cesta de compra</a>
	</div>
</li>
