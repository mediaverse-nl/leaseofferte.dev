<?php
	// Set Limit
	switch($limit) {
		case 1 :
			$colClassSm = 12;
		break;

		case 2:
			$colClassSm = 6;
		break;

		case 3:
		case 6:
			$colClassSm = 4;
		break;

		case 4:
		case 8:
		case 10:
			$colClassSm = 3;
		break;
	}
?>

<div class="caw-container caw-ui" id="caw-container">
	<section class="vehicle-overview" id="vehicle-overview">
		<div class="caw-row">
			<?php foreach( $vehicles as $key => $vehicle) :

			?>
			<div class='col-sm-<?= $colClassSm;?>'>
				<article class="caw-vehicle vehicle-photo-view" itemscope itemtype="http://schema.org/Vehicle">
					<div class="vehicle-image">
						<?php if(count($vehicle->images) > 0) { ?>
							<img data-src="<?= $vehicle->images[0]->source; ?>" src="<?= $vehicle->images[0]->source; ?>" class="img-responsive caw-img-raster" alt="<?= $vehicle->make->name . " " . $vehicle->model->name; ?>" itemprop="image" />
						<?php } else { ?>
							<img src="https://prod.caw4.cartel.nl/bundles/cartelcawclient/img/default-car-image.jpg" class="img-responsive" alt="<?= $vehicle->make->name . " " . $vehicle->model->name; ?>" itemprop="image" />
						<?php } ?>
					</div>
				<div class="vehicle-information__raster">
						<h2 class="vehicle-title ellipsis" itemprop="name">
							<a href="<?= $content->base_url ."/".  $vehicle->url; ?>" class="vehicle-link"><?= $vehicle->make->name . " " . $vehicle->model->name; ?> </a>
						</h2>
						<span class="vehicle-options"><?= $vehicle->version; ?></span>
						<?php
							if(count($vehicle->highlights) > 0) : ?>
						<ul class="vehicle-extra">
							<?php foreach($vehicle->highlights as $highlight) : ?>
								<li class="vehicle-owner"><?= $highlight; ?></li>
							<?php endforeach; ?>
						</ul>
						<?php
				        	endif;
						?>
					<ul class="vehicle-info">
						<li class="vehicle-year">
							<span class="caw-col-xs-6 caw-col-lg-4 caw-label">
								Bouwjaar:
							</span>
							<span class="caw-col-xs-6 caw-col-lg-8" itemprop="releaseDate">
								<?= $vehicle->year; ?>
							</span>
						</li>
						<li class="vehicle-mileage">
							<span class="caw-col-xs-6 caw-col-lg-4 caw-label">
							Tellerstand:
							</span>
							<span class="caw-col-xs-6 caw-col-lg-8">
								<?= number_format($vehicle->mileage, 0 , '' , '.'); ?> km
							</span>
						</li>
					</ul>
					<br clear="all" />
					</div>
					<div class="vehicle-price caw-raster">
						<?php

						$pluginPath = plugin_dir_path( __FILE__ ) . 'PricesLayout/';
						// The Cases are the ones coming from the CAW Database.

						switch( $content->pricesLayout ) {
							case 'f' :
								include( $pluginPath . 'financial.php' );
							break;

							case 'fl' :
								include( $pluginPath . 'financial-lease.php' );
							break;

							case 'op' :
								include( $pluginPath . 'operational-lease.php' );
							break;

							case 'pl' :
								include( $pluginPath . 'private-lease.php' );
							break;

							case 's' :
								include( $pluginPath . 'showroom.php' );
							break;

							case 's-f' :
								include( $pluginPath . 'showroom.php' );
								include( $pluginPath . 'financial.php' );
							break;

							case 's-fl' :
								include( $pluginPath . 'showroom.php' );
								include( $pluginPath . 'financial-lease.php' );
							break;

							case 's-op' :
								include( $pluginPath . 'showroom.php' );
								include( $pluginPath . 'operational-lease.php' );
							break;

							case 's-pl' :
								include( $pluginPath . 'showroom.php' );
								include( $pluginPath . 'private-lease.php' );
							break;

							default:
								include( $pluginPath . 'showroom.php' );
							break;
						}
						?>
					</div>
				</article>
			</div>
			<?php
				endforeach;
			?>
		</div>
	</section>
</div>
<style>
	.caw-ui .caw-vehicle.vehicle-photo-view .vehicle-price .vehicle-price-big-inline {
		display: inline !important;
}
</style>