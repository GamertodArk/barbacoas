<?php $c = isset($glide) ? $glide : 'glide'; ?>
<div id="glide" class="<?php echo $c ?>">
	<div class="<?= $c ?>__track" data-glide-el="track">
		<ul class="<?= $c ?>__slides">
			<?php for ($i=0; $i < count($productImgs); $i++): ?>
				<li class="<?= $c ?>__slide">
					<img src="<?php echo base_url("img/products/$productImgs[$i]") ?>" alt="">
				</li>
			<?php endfor; ?>
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
		<?php for ($i=0; $i < count($productImgs); $i++): ?>
			<button class="<?= $c ?>__bullet" data-glide-dir="=<?=$i?>"></button>
		<?php endfor; ?>
	</div>
</div>
<?php if (isset($glide)) { unset($glide); }?>