		<?php foreach( $vehicles as $key => $vehicle) : ?>
				<div class="weekly-offer-wrapper">
					<div class="ribbon-green">Actie!</div>
					<div class='vc_col-sm-12'>
						<div class="vc_col-sm-6 vc_col-xs-6">
							<div class="vehicle-image">
									<?php if(count($vehicle->images) > 0) { ?>
										<img src="<?= $vehicle->images[0]->source; ?>" class="img-responsive" alt="<?= $vehicle->make->name . " " . $vehicle->model->name; ?>" itemprop="image" />
									<?php } else { ?>
										<img src="https://caw4.cartel.nl/bundles/cartelcawclient/img/default-car-image.jpg" class="img-responsive" alt="<?= $vehicle->make->name . " " . $vehicle->model->name; ?>" itemprop="image" />
									<?php } ?>
							</div>
						</div>
						<div class="vc_col-sm-6 vc_col-xs-6">
							<div class="widget-title">
								<span><?= $content->widgettitle ?></span>
							</div>
							<h2 class="vehicle-title" itemprop="name">
								<?= $vehicle->make->name . " " . $vehicle->model->name; ?>
							</h2>
							<?php if(isset($vehicle->price) && $vehicle->price > 0 ){ ?>
								<?php if(isset($vehicle->specialPrice) && $vehicle->specialPrice > 0 ){ ?>
									<span class="vehicle-price">&euro; <?= number_format($vehicle->price, 0, ',', '.');?> ,-</span>
								<?php } else { ?>
									<span class="vehicle-price">&euro; <?= number_format($vehicle->price, 0, ',', '.');?> ,-</span>
								<?php } ?>
							<?php } else { ?>
								<span class="vehicle-price">Op aanvraag</span>
							<?php } ?>
							<a href="<?= $content->base_url ."/".  $vehicle->url; ?>" class="vehicle-link">
								Bekijk deze auto
							</a>
						</div>
					</div>
				</div>
		<?php endforeach; ?>