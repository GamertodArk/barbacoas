<?php $c = isset($glide) ? $glide : 'glide'; ?>
<div id="glide" class="<?php echo $c ?>">
	<div class="<?= $c ?>__track" data-glide-el="track">
		<ul class="<?= $c ?>__slides">
			<li class="<?= $c ?>__slide">
				<img src="<?php echo base_url('img/products/') ?>pic_14_big.jpg" alt="">
			</li>
			<li class="<?= $c ?>__slide">
				<img src="<?php echo base_url('img/products/') ?>pic_14_big.jpg" alt="">
			</li>
			<li class="<?= $c ?>__slide">
				<img src="<?php echo base_url('img/products/') ?>pic_14_big.jpg" alt="">
			</li>
		</ul>
	</div>

	<div class="<?= $c ?>__arrows" data-glide-el="controls">
		<button class="<?= $c ?>__arrow <?= $c ?>__arrow--left" data-glide-dir="<">
			<i class="fas fa-arrow-left"></i>		
		</button>
		<button class="<?= $c ?>__arrow <?= $c ?>__arrow--right" data-glide-dir=">">
			<i class="fas fa-arrow-right"></i>
		</button>
	</div>

	<div class="<?= $c ?>__bullets" data-glide-el="controls[nav]">
		<button class="<?= $c ?>__bullet" data-glide-dir="=0"></button>
		<button class="<?= $c ?>__bullet" data-glide-dir="=1"></button>
		<button class="<?= $c ?>__bullet" data-glide-dir="=2"></button>
	</div>
</div>
<?php if (isset($glide)) { unset($glide); }?>

<!--
<div id="glide" class="glide">
	<div class="glide__track" data-glide-el="track">
		<ul class="glide__slides">
			<li class="glide__slide">
				<img src="<?php echo base_url('img/products/') ?>pic_14_big.jpg" alt="">
			</li>
			<li class="glide__slide">
				<img src="<?php echo base_url('img/products/') ?>pic_14_big.jpg" alt="">
			</li>
			<li class="glide__slide">
				<img src="<?php echo base_url('img/products/') ?>pic_14_big.jpg" alt="">
			</li>
		</ul>
	</div>

	<div class="glide__arrows" data-glide-el="controls">
		<button class="glide__arrow glide__arrow--left" data-glide-dir="<">
			<i class="fas fa-arrow-left"></i>		
		</button>
		<button class="glide__arrow glide__arrow--right" data-glide-dir=">">
			<i class="fas fa-arrow-right"></i>
		</button>
	</div>

	<div class="glide__bullets" data-glide-el="controls[nav]">
		<button class="glide__bullet" data-glide-dir="=0"></button>
		<button class="glide__bullet" data-glide-dir="=1"></button>
		<button class="glide__bullet" data-glide-dir="=2"></button>
	</div>
</div>
-->