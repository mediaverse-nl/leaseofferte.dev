<span class="vehicle-price-buy caw-raster caw-row">
	<span class="caw-label caw-col-sm-6 text-left">Prijs</span>
	<?php if(isset($vehicle->price) && $vehicle->price > 0 ){ ?>
		<?php if(isset($vehicle->specialPrice) && $vehicle->specialPrice > 0 ){ ?>
			<span class="vehicle-price-before text-right">&euro; <?= number_format($vehicle->showroomPrice, 0, ',', '.');?> ,-</span>
			<span class="vehicle-price-big text-right">&euro; <?= number_format($vehicle->price, 0, ',', '.');?> ,-</span>
		<?php } else { ?>
			<span class="price caw-col-sm-6 text-right">&euro; <?= number_format($vehicle->price, 0, ',', '.');?> ,-</span>
		<?php } ?>
	<?php } else { ?>
		<span class="vehicle-price-big">Op aanvraag</span>
	<?php } ?>
</span>