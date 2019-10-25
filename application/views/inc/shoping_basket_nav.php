<li id="shopping-basket" class="shopping-wrap">
	<i id="shopping-basket-icon" class="fas fa-shopping-basket"></i>

	<div id="basket_triangle" class="triangle"></div>

	<div id="basket_items_wrap" class="items">


		<?php if(count($_SESSION['products']) > 0): ?>
			<!-- <?php var_dump($_SESSION['products']); ?> -->
			<?php foreach ($_SESSION['products'] as $product): ?>
				<div data-product-id="<?php echo $product['id'] ?>" class="shopping-item">
					<!-- <h3>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum, ratione.</h3> -->
					<h3><?php echo $product['title'] ?></h3>
					<span onclick="delete_from_basket(this)" class="remove-item">
						<i class="fas fa-times"></i>
					</span>
				</div>
			<?php endforeach; ?>
		<?php else: ?>
			<p id="basket_empty_msg" class="empty">No tienes productos en la cesta de compra</p>
		<?php endif; ?>


<!-- 		<?php for($i = 0; $i < 2; $i++): ?>

			<div data-product-id="" class="shopping-item">
				<h3>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum, ratione.</h3>
				<span class="remove-item">
					<i class="fas fa-times"></i>
				</span>
			</div>

		<?php endfor; ?>
 -->
	</div>
</li>