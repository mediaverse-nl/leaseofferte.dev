<div>
	<h2><?php echo __( 'Cartel Auto Webshop instellingen', 'caw') ?></h2>
	<br/>
	<form name="caw_settings_form" method="post" action="">
		<label class="caw_admin caw_url"><?php _e("Url", 'caw' ); ?></label>
		
		<input type="text" name="caw4_url" value="<?php echo empty($caw_url) ? 'https://caw4.cartel.nl/cawclient/' : $caw_url; ?>" size="50">
		<hr>
		<p class="submit">
			<input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Wijzigingen opslaan') ?>" />
		</p>
	</form>
</div>