<?php if($products): ?>
	<?php foreach($products as $product): ?>

		<?php if (!isset($product->id)) {$product = $product[0];} ?>

		<div data-product-id="<?=$product->id?>" class="item">
			<span id="item_view" class="view view_item_btn"><i class="far fa-eye"></i></span>

			<div class="image-wrap">
				<?php $images = explode(';', $product->images); ?>
				<img src="<?php echo base_url() ?>img/products/<?=$images[0]?>" alt="">
			</div>
			<div class="item-content">
				<a href="<?=site_url()?>products/review/<?=$product->id?>"><?=$product->title?></a>
			</div>
		</div>
	<?php endforeach; ?>
<?php endif; ?>
