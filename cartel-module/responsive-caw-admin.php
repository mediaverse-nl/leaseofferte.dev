<?php
class responsive_caw_admin {

	function __construct() {
		add_action('caw_delete_car_hook', array($this, 'caw_delete_car'));
	}

	/**
	 * Add caw admin css
	 */
	function caw_admin_style() {
        wp_register_style('caw_admin_style_css', plugins_url() . '/responsive-caw/css/caw-admin-style.css', false, '2.0.0');

        wp_enqueue_style('caw_admin_style_css');
	}

	// Called on plugin activation
	function caw_admin_activate() {
		global $wp_rewrite;

		// Make sure pretty permalinks are enabled
		if (!$wp_rewrite->permalink_structure) {
		  echo("De Cartel Auto Webshop werkt alleen als 'pretty permalinks' geactiveerd is.");
		  exit();
		}
		add_option('caw4_url', 'https://prod.caw4.cartel.nl/cawclient/');

		$cron = wp_next_scheduled( 'caw_delete_car_hook' );
		  if( $cron == false ){
		    wp_schedule_event( mktime(0,0,0), 'weekly', 'caw_delete_car_hook' );
		  }

	}

	function caw_admin_activate_create_table() {
		global $wpdb;

		$tableName = $wpdb->prefix . 'caw4_cars';

		$charset_collate = $wpdb->get_charset_collate();

		$sql = "CREATE TABLE $tableName (
			car_id mediumint(9) NOT NULL,
			title varchar(255) DEFAULT '' NOT NULL,
			last_visit datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
			PRIMARY KEY  (car_id)
		) $charset_collate;";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
	}

	// Called on plugin deactivation
	function caw_admin_deactivate() {
		global $wpdb;

		delete_option('caw4_url');

		flush_rewrite_rules();

		wp_clear_scheduled_hook('caw_delete_car_hook');

		// Let's delete our table aswell
	    $wpdb->query( "DROP TABLE IF EXISTS wp_caw4_cars" );
	}


	/**
    * Cron to delete cars not visited in the past month
    */

    function caw_delete_car() {
  		 global $wpdb;

  		 $tableName = $wpdb->prefix . 'caw4_cars';
   		 $sql = "DELETE FROM $tableName WHERE last_visit < DATE_ADD( NOW(), INTERVAL -1 MONTH )";
   		 $wpdb->query( $sql );

    }

	// Wordpress admin settings menu
	function caw_admin_menu() {
		add_options_page('Cartel Auto-Webshop Instellingen', 'Cartel Auto-Webshop Instellingen', 'manage_options', 'responsive_caw_settings', array($this, 'caw_admin_settings'));
	}

	// Wordpress admin settings form
	function caw_admin_settings() {
		if (!current_user_can('manage_options'))  {
			wp_die(__( 'You do not have sufficient permissions to access this page.' ));
		}

		$updated = false;

		if (isset($_POST['caw4_url']) && !empty($_POST['caw4_url'])) {
			// Save the posted value in the database
			update_option('caw4_url', $_POST['caw4_url']);

			$updated = true;
		}

		 // Read in existing options value from database
		$caw_url = get_option('caw4_url');

		// See if caw_url is empty, if so, give warning.
		if(empty($caw_url)) {
			echo '<div class="alert alert-danger"><p><strong>' . __('Om de CAW juist te laten werken, sla eenmalig de volgende URL op "https://caw4.cartel.nl/cawclient/".', 'caw') . '</strong></p></div>';
		}

		// Any setings updated?
		if ($updated) {
			// Put an settings updated message on the screen
			echo '<div class="alert alert-success"><p><strong>' . __('De instellingen zijn opgeslagen.', 'caw') . '</strong></p></div>';
		}

		include_once('views/admin-form.php');
	}
}