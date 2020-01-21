<span class="vehicle-price-finance caw-row">
	<span class="caw-label caw-col-sm-6 text-left">Financial lease</span>
		<?php if($vehicle->leasespecifications->financial > 0) { ?>
			<span class="price caw-col-sm-6 text-right">&euro; <?= number_format($vehicle->leasespecifications->financial, 0, ',', '.');?>,- p/m</span>
		<?php } else { ?>
			<span class="price caw-col-sm-6 text-right">Op aanvraag</span>
		<?php } ?>
</span>