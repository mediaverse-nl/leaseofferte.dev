<div class="caw-container caw-ui" id="caw-container">
	<section class="vehicle-overview" id="vehicle-overview">
		<?php foreach( $vehicles as $key => $vehicle) : ?>
		<article class="caw-vehicle vehicle-row-view" itemscope itemtype="http://schema.org/Vehicle">
		    <div class="caw-row">
		        <div class="caw-col-sm-3">
		            <div class="vehicle-image">
		           	 		<?php if(count($vehicle->images) > 0) { ?>
								<img src="<?= $vehicle->images[0]->source; ?>" class="img-responsive" alt="<?= $vehicle->make->name . " " . $vehicle->model->name; ?>" itemprop="image" />
							<?php } else { ?>
								<img src="https://caw4.cartel.nl/bundles/cartelcawclient/img/default-car-image.jpg" class="img-responsive" alt="<?= $vehicle->make->name . " " . $vehicle->model->name; ?>" itemprop="image" />
							<?php } ?>
		            </div>
		        </div>
		        <div class="caw-col-sm-4">
		            <h2 class="vehicle-title ellipsis" itemprop="name">
		                <a href="<?= $content->base_url ."/".  $vehicle->url; ?>" class="vehicle-link"><?= $vehicle->make->name . " " . $vehicle->model->name; ?> </a>
		            </h2>
		            <span class="vehicle-options"><?= $vehicle->version; ?></span>
		            <ul class="vehicle-info caw-row">
		                <li class="vehicle-year">
		                    <span class="caw-col-xs-6 caw-col-lg-4 caw-label">Bouwjaar:</span>
		                    <span class="caw-col-xs-6 caw-col-lg-8" itemprop="releaseDate"><?= $vehicle->year; ?></span>
		                </li>
		                <li class="vehicle-mileage">
		                    <span class="caw-col-xs-6 caw-col-lg-4 caw-label">Tellerstand:</span>
		                    <span class="caw-col-xs-6 caw-col-lg-8"><?= number_format($vehicle->mileage, 0, ',', '.');?> km</span>
		                </li>
		                <li class="vehicle-fuel">
		                    <span class="caw-col-xs-6 caw-col-lg-4 caw-label">Brandstof:</span>
		                    <span class="caw-col-xs-6 caw-col-lg-8"><?= $vehicle->fuel->name; ?></span>
		                </li>

						<li class="vehicle-transmission">
		                    <span class="caw-col-xs-6 caw-col-lg-4 caw-label">Transmissie:</span>
		                    <span class="caw-col-xs-6 caw-col-lg-8"><?= $vehicle->transmission->name; ?></span>
		                </li>

		                <li class="vehicle-provider">
		                    <span class="caw-col-xs-6 caw-col-lg-4 caw-label">Vestiging</span>
		                    <span class="caw-col-xs-6 caw-col-lg-8"><?= $vehicle->provider->name; ?></span>
		                </li>
		            </ul>
		        </div>
		        <div class="caw-col-sm-2 caw-vehicle-last-col">
		            <div class="vehicle-price">
						<?php if(isset($vehicle->price) && $vehicle->price > 0 ){ ?>
							<?php if(isset($vehicle->specialPrice) && $vehicle->specialPrice > 0 ){ ?>
								<span class="vehicle-price-before">&euro; <?= number_format($vehicle->showroomPrice, 0, ',', '.');?> ,-</span>
								<span class="vehicle-price-big">&euro; <?= number_format($vehicle->price, 0, ',', '.');?> ,-</span>
							<?php } else { ?>
								<span class="vehicle-price-big">&euro; <?= number_format($vehicle->price, 0, ',', '.');?> ,-</span>
							<?php } ?>
						<?php } else { ?>
							<span class="vehicle-price-big">Op aanvraag</span>
						<?php } ?>

		               <?php if(isset($vehicle->pricePerMonth) && $vehicle->pricePerMonth > 0 ){ ?>
		                    <span class="vehicle-price-finance">&euro; <?= number_format($vehicle->pricePerMonth, 0, ',', '.');?> ,- p/m</span>
		                <?php } ?>
		            </div>
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
		        </div>
		    </div>
		</article>
		<?php endforeach; ?>
	</section>
</div>