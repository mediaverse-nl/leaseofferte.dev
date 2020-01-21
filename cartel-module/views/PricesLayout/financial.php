<?php if(!empty($vehicle->pricePerMonth) > 0) : ?>
	<span class="vehicle-price-finance caw-row">
		<span class="caw-label caw-col-sm-6 text-left">Financiering</span>
			<span class="price caw-col-sm-6 text-right">&euro; <?= number_format($vehicle->pricePerMonth, 0, ',', '.');?>,- p/m<</span>
	</span>
<?php endif; ?>