<span class="vehicle-price-finance caw-row">
	<span class="caw-label caw-col-sm-6 text-left">Operational lease</span>
		<?php if($vehicle->leasespecifications->operational > 0) { ?>
			<span class="price caw-col-sm-6 text-right">&euro; <?= number_format($vehicle->leasespecifications->operational, 0, ',', '.');?>,- p/m</span>
		<?php } else { ?>
			<span class="price caw-col-sm-6 text-right">Op aanvraag</span>
		<?php } ?>
</span>