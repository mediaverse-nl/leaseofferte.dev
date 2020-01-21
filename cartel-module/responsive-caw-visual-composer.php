<?php
class responsive_caw_visual_composer {

	function __construct() {
	}

	function caw_integrate_with_vc() {
		$site_url = get_option('siteurl');

		$plugin_url = plugin_dir_path(__FILE__);
		$plugin_url = strstr($plugin_url, '/wp-content');

		$url = $site_url . $plugin_url;

		vc_map( array(
			'name' => __('Cartel Auto-Webshop', 'caw-text-domain'),
			'base' => 'autowebshop',
			'icon' => $url . 'autowebshop.png',
			'category' => __('Cartel', 'caw-text-domain'),
			'params' => array(
				 array(
					'type'			=> 'textfield',
					'holder'		=> 'div',
					'class'			=> '',
					'heading'		=> __('Configuratiecode', 'caw-text-domain'),
					'param_name'	=> 'configuratiecode',
					'description'	=> __('De configuratiecode wordt geleverd door Cartel. <br /><strong>Verplicht veld!</strong>', 'caw-text-domain')
				 ),
				 array(
					'type'			=> 'textfield',
					'holder'		=> 'div',
					'class'			=> '',
					'heading'		=> __('Merk en model selectie (optioneel) (merk|model)', 'caw-text-domain'),
					'param_name'	=> 'merkmodelselectie',
					'description'	=> __('Voorbeeld 1: volkswagen Voorbeeld 2: volkswagen|golf Voorbeeld 3: volkswagen|golf audi|a4.', 'caw-text-domain' )
				),
				 array(
					'type'			=> 'textfield',
					'holder'		=> 'div',
					'class'			=> '',
					'heading'		=> __('Prijsfilter', 'caw-text-domain'),
					'param_name'	=> 'prijs',
					'description'	=> __('Vul hier een minimale en maximale prijswaarde wat u wilt instellen als prijsfilter. <br />Voorbeeld: <strong>1000-25000</strong>', 'caw-text-domain' )
				 ),
                array(
                    'type'			=> 'textfield',
                    'holder'		=> 'div',
                    'class'			=> '',
                    'heading'		=> __('Bouwjaar', 'caw-text-domain'),
                    'param_name'	=> 'bouwjaar',
                    'description'	=> __('Vul hier een minimale en maximale bouwjaar in wat u wilt instellen als bouwjaarfilter. <br />Voorbeeld: <strong>2014-2017</strong>', 'caw-text-domain' )
                ),
                array(
                    'type'			=> 'textfield',
                    'holder'		=> 'div',
                    'class'			=> '',
                    'heading'		=> __('Tellerstand', 'caw-text-domain'),
                    'param_name'	=> 'tellerstand',
                    'description'	=> __('Vul hier de minimale en maximale tellerstand in wat u wilt instellen als tellerfilter. <br />Voorbeeld: <strong>1000-68000</strong>', 'caw-text-domain' )
                ),
				 array(
					'type'			=> 'checkbox',
					'holder'		=> 'div',
					'class'			=> '',
					'heading'		=> __('Voertuigsoort', 'caw-text-domain'),
					'param_name'	=> 'voertuigsoort',
					'value'			=> array(
						'Occasion'	=> 'occasion',
						'Nieuw'		=> 'nieuw',
						'Demo'		=> 'demo'
					),
					'description'	=> __('', 'caw-text-domain')
				 ),
				 array(
					'type'			=> 'checkbox',
					'holder'		=> 'div',
					'class'			=> '',
					'heading'		=> __('Carrosserie', 'caw-text-domain'),
					'param_name'	=> 'carrosserie',
					'value'			=> array(
						'Hatchback'	=> 'hatchback',
						'Stationwagon'		=> 'stationwagon',
						'Multi purpose vehicle'		=> 'multi-purpose-vehicle',
						'Gesloten bestelwagen'		=> 'gesloten-bestelwagen',
						'Sports utility vehicle'		=> 'sports-utility-vehicle',
						'Terreinwagen'		=> 'terreinwagen',
						'Sedan'		=> 'sedan',
						'Cabriolet'		=> 'cabriolet',
						'Coupe'		=> 'coupe'
					),
					'description'	=> __('', 'caw-text-domain')
				 ),
				 array(
					'type'			=> 'dropdown',
					'holder'		=> 'div',
					'class'			=> '',
					'heading'		=> __('Voertuigcategorieen (optioneel)', 'caw-text-domain'),
					'param_name'	=> 'voertuigcategorie',
					'value'			=> array(
						'Alle voertuigsoorten'	=> '',
						'Personenautos'			=> 'personenauto',
						'Bedrijfswagens'		=> 'bedrijfswagen'
					),

					'description'	=> __('De categorieen die getoond worden.', 'caw-text-domain')
				 ),
				 array(
					'type'			=> 'dropdown',
					'holder'		=> 'div',
					'class'			=> '',
					'heading'		=> __('Aantal voertuigen', 'caw-text-domain'),
					'param_name'	=> 'voertuigmax',
					'value'			=> array(
						'12 auto\'s'	=> 12,
						'24 auto\'s'			=> 24,
						'48 auto\'s'		=> 48,
						'96 auto\'s'		=> 96
					),
					'std'			=> '',
					'description'	=> __('Aantal autos wat getoond moet worden.', 'caw-text-domain')
				 ),
                array(
                    'type'			=> 'dropdown',
                    'holder'		=> 'div',
                    'class'			=> '',
                    'heading'		=> __('Sorteer op', 'caw-text-domain'),
                    'param_name'	=> 'sortering',
                    'value'       => array(
                        'Prijs oplopend'   => 'prijs-oplopend',
                        'Prijs aflopend'  => 'prijs-aflopend',
                        'Tellerstand oplopend'  => 'tellerstand-oplopend',
                        'Bouwjaar aflopend'  => 'bouwjaar-aflopend',
                        'Net binnen'  => 'laatst-toegevoegd',
                    ),
                    'std'           => '',
                    'description'	=> __('Kies een sortering', 'caw-text-domain' )
                ),
				 array(
					'type'			=> 'checkbox',
					'holder'		=> 'div',
					'class'			=> '',
					'heading'		=> __('Actielayout', 'caw-text-domain'),
					'param_name'	=> 'actie_prijs',
					'value'			=> array(
						'Ja'	=> '1'
					),

					'description'	=> __('Vink dit aan als de actielayout getoond moet worden.', 'caw-text-domain')
				 ),
			)
		) );

		vc_map( array(
			'name' => __('Cartel Auto-Webshop zoekwidget', 'caw-text-domain'),
			'base' => 'autowebshopzoekwidget',
			'icon' => $url . 'autowebshopsearch.png',
			'category' => __('Cartel', 'caw-text-domain'),
			'admin_enqueue_js' => $url . 'js/vc.js',
			'params' => array(
				 array(
					'type'			=> 'textfield',
					'holder'		=> 'div',
					'class'			=> 'non-empty',
					'heading'		=> __('Configuratiecode', 'caw-text-domain'),
					'param_name'	=> 'configuratiecode',
					'description'	=> __('De configuratiecode wordt geleverd door Cartel. <br /><strong>Verplicht veld!</strong>', 'caw-text-domain')
				 ),
				 array(
					'type'			=> 'textfield',
					'holder'		=> 'div',
					'class'			=> 'non-empty',
					'heading'		=> __('Auto-Webshop link', 'caw-text-domain'),
					'param_name'	=> 'autowebshoppagina',
					'description'	=> __('De link naar de pagina van de Auto-Webshop. Voorbeeld: http://www.uwwebsite.nl/voorraad <br /><strong>Verplicht veld!</strong>', 'caw-text-domain' )
				 ),
				 array(
					'type'			=> 'textfield',
					'holder'		=> 'div',
					'class'			=> '',
					'heading'		=> __('Merk (optioneel)', 'caw-text-domain'),
					'param_name'	=> 'merkselectie',
					'description'	=> __('Het te tonen merk. Voorbeeld 1: volkswagen Voorbeeld 2: audi.', 'caw-text-domain' )
				 ),
				 array(
					'type'			=> 'textfield',
					'holder'		=> 'div',
					'class'			=> '',
					'heading'		=> __('Model (optioneel)', 'caw-text-domain'),
					'param_name'	=> 'modelselectie',
					'description'	=> __('De te tonen modellen. Voorbeeld 1: golf Voorbeeld 2: golf|polo.', 'caw-text-domain' )
				 ),
				 array(
					'type'			=> 'checkbox',
					'holder'		=> 'div',
					'class'			=> '',
					'heading'		=> __('Voertuigsoort (optioneel)', 'caw-text-domain'),
					'param_name'	=> 'voertuigsoort',
					'value'			=> array(
						'Occasion'	=> 'occasion',
						'Nieuw'		=> 'nieuw',
						'Demo'		=> 'demo'
					),
					'description'	=> __('', 'caw-text-domain')
				 ),
				 array(
					'type'			=> 'dropdown',
					'holder'		=> 'div',
					'class'			=> '',
					'heading'		=> __('Voertuigcategorieen (optioneel)', 'caw-text-domain'),
					'param_name'	=> 'voertuigcategorie',
					'value'			=> array(
						'Alle voertuigsoorten'	=> '',
						'Personenautos'			=> 'personenauto',
						'Bedrijfswagens'		=> 'bedrijfswagen'
					),
					'description'	=> __('De categorieen de gebruikt worden in zoekwidget.', 'caw-text-domain')
				 ),
				 array(
					'type'			=> 'checkbox',
					'holder'		=> 'div',
					'class'			=> '',
					'heading'		=> __('Zichtbare velden (optioneel)', 'caw-text-domain'),
					'param_name'	=> 'velden',
					'value'			=> array(
						'Merk'			=> '1',
						'Model'			=> '2',
						'Brandstof'		=> '3',
						'Transmissie'	=> '4',
						'Carrosserie'	=> '5'
					),
					'std'			=> '',
					'description'	=> __('Velden die zichtbaar zijn in de zoekwidget.', 'caw-text-domain')
				 ),
			)
		) );

		vc_map( array(
			'name' => __('Cartel Auto-Webshop Greep uit aanbod', 'caw-text-domain'),
			'base' => 'autowebshopgreepaanbod',
			'icon' => $url . 'autowebshopoffer.png',
			'category' => __('Cartel', 'caw-text-domain'),
			'admin_enqueue_js' => $url . 'js/vc.js',
			'params' => array(
				 array(
					'type'			=> 'textfield',
					'holder'		=> 'div',
					'class'			=> '',
					'heading'		=> __('Configuratiecode', 'caw-text-domain'),
					'param_name'	=> 'configuratiecode',
					'description'	=> __('De configuratiecode wordt geleverd door Cartel. <br /><strong>Verplicht veld!</strong>', 'caw-text-domain')
				 ),
				array(
					'type'			=> 'textfield',
					'holder'		=> 'div',
					'class'			=> '',
					'heading'		=> __('Auto-Webshop link', 'caw-text-domain'),
					'param_name'	=> 'autowebshoppagina',
					'description'	=> __('De link naar de pagina van de Auto-Webshop. Voorbeeld: http://www.uwwebsite.nl/voorraad <br /><strong>Verplicht veld!</strong>', 'caw-text-domain' )
				 ),
				array(
					'type'			=> 'textfield',
					'holder'		=> 'div',
					'class'			=> '',
					'heading'		=> __('Merk en model selectie (optioneel) (merk|model)', 'caw-text-domain'),
					'param_name'	=> 'merkmodelselectie',
					'description'	=> __('Voorbeeld 1: volkswagen Voorbeeld 2: volkswagen|golf Voorbeeld 3: volkswagen|golf audi|a4.', 'caw-text-domain' )
				 ),
				 array(
					'type'			=> 'checkbox',
					'holder'		=> 'div',
					'class'			=> '',
					'heading'		=> __('Voertuigsoort (optioneel)', 'caw-text-domain'),
					'param_name'	=> 'voertuigsoort',
					'value'			=> array(
						'Occasion'	=> 'occasion',
						'Nieuw'		=> 'nieuw',
						'Demo'		=> 'demo'
					),
					'std'			=> '',
					'description'	=> __('', 'caw-text-domain')
				 ),
				 array(
					'type'			=> 'dropdown',
					'holder'		=> 'div',
					'class'			=> '',
					'heading'		=> __('Voertuigcategorieen (optioneel)', 'caw-text-domain'),
					'param_name'	=> 'voertuigcategorie',
					'value'			=> array(
						'Alle voertuigsoorten'	=> '',
						'Personenautos'			=> 'personenauto',
						'Bedrijfswagens'		=> 'bedrijfswagen'
					),
					'description'	=> __('De categorieen de gebruikt worden in greep uit ons aanbod.', 'caw-text-domain')
				 ),
				 array(
					'type'			=> 'textfield',
					'holder'		=> 'div',
					'class'			=> '',
					'heading'		=> __('Prijsfilter', 'caw-text-domain'),
					'param_name'	=> 'prijs',
					'description'	=> __('Vul hier een minimale en maximale prijswaarde wat u wilt instellen als prijsfilter. <br />Voorbeeld: <strong>1000-25000</strong>', 'caw-text-domain' )
				 ),
                array(
                    'type'			=> 'textfield',
                    'holder'		=> 'div',
                    'class'			=> '',
                    'heading'		=> __('Bouwjaar', 'caw-text-domain'),
                    'param_name'	=> 'bouwjaar',
                    'description'	=> __('Vul hier een minimale en maximale bouwjaar in wat u wilt instellen als bouwjaarfilter. <br />Voorbeeld: <strong>2014-2017</strong>', 'caw-text-domain' )
                ),
				 array(
					'type'			=> 'checkbox',
					'holder'		=> 'div',
					'class'			=> '',
					'heading'		=> __('Brandstof (optioneel)', 'caw-text-domain'),
					'param_name'	=> 'brandstof',
					'value'			=> array(
						'Benzine'	=> 'benzine',
						'Diesel'	=> 'diesel',
						'Elektrisch'=> 'elektrisch',
						'Hybride'	=> 'hybride',
						'LPG G3'	=> 'lpg-g3',
					),
					'std'			=> '',
					'description'	=> __('', 'caw-text-domain')
				 ),
				 array(
					'type'			=> 'dropdown',
					'holder'		=> 'div',
					'class'			=> '',
					'heading'		=> __('Weergave', 'caw-text-domain'),
					'param_name'	=> 'weergave',
					'value'			=> array(
						'Raster'	=> 'raster',
						'Lijst'		=> 'lijst',
					),
					'std'			=> '',
					'description'	=> __('', 'caw-text-domain')
				 ),
				  array(
					'type'			=> 'dropdown',
					'holder'		=> 'div',
					'class'			=> '',
					'heading'		=> __('Aantal te tonen autos', 'caw-text-domain'),
					'param_name'	=> 'voertuigaantal',
					'value'       => array(
				        '1'     => '1',
				        '2'     => '2',
				        '3'     => '3',
				        '4'     => '4',
				        '6'     => '6',
				        '8'     => '8',
				        '10'    => '10'
				      ),
					'std'			=> '',
					'description'	=> __('', 'caw-text-domain' )
				 ),
				  array(
					'type'			=> 'dropdown',
					'holder'		=> 'div',
					'class'			=> '',
					'heading'		=> __('Filter op', 'caw-text-domain'),
					'param_name'	=> 'sortering',
					'value'       => array(
				    	'Prijs oplopend'   => 'prijs-oplopend',
				        'Prijs aflopend'  => 'prijs-aflopend',
				        'Willekeurige volgorde'  => 'random'
				      ),
					'std'           => '',
					'description'	=> __('Kies een sortering', 'caw-text-domain' )
				 ),
			)
		) );
		vc_map( array(
			'name' => __('Cartel Auto-Webshop Auto van de Week', 'caw-text-domain'),
			'base' => 'autowebshopweekauto',
			'icon' => $url . 'autowebshopoffer.png',
			'category' => __('Cartel', 'caw-text-domain'),
			'admin_enqueue_js' => $url . 'js/vc.js',
			'params' => array(
				array(
					'type'			=> 'textfield',
					'holder'		=> 'div',
					'class'			=> '',
					'heading'		=> __('Widget Titel', 'caw-text-domain'),
					'param_name'	=> 'widgettitel',
				 ),
				 array(
					'type'			=> 'textfield',
					'holder'		=> 'div',
					'class'			=> '',
					'heading'		=> __('Configuratiecode', 'caw-text-domain'),
					'param_name'	=> 'configuratiecode',
					'description'	=> __('De configuratiecode wordt geleverd door Cartel. <br /><strong>Verplicht veld!</strong>', 'caw-text-domain')
				 ),
				array(
					'type'			=> 'textfield',
					'holder'		=> 'div',
					'class'			=> '',
					'heading'		=> __('Auto-Webshop link', 'caw-text-domain'),
					'param_name'	=> 'autowebshoppagina',
					'description'	=> __('De link naar de pagina van de Auto-Webshop. Voorbeeld: http://www.uwwebsite.nl/voorraad <br /><strong>Verplicht veld!</strong>', 'caw-text-domain' )
				 ),
				array(
					'type'			=> 'textfield',
					'holder'		=> 'div',
					'class'			=> '',
					'heading'		=> __('Merk en model selectie (optioneel) (merk|model)', 'caw-text-domain'),
					'param_name'	=> 'merkmodelselectie',
					'description'	=> __('Voorbeeld 1: volkswagen Voorbeeld 2: volkswagen|golf Voorbeeld 3: volkswagen|golf audi|a4.', 'caw-text-domain' )
				 ),
				 array(
					'type'			=> 'checkbox',
					'holder'		=> 'div',
					'class'			=> '',
					'heading'		=> __('Voertuigsoort (optioneel)', 'caw-text-domain'),
					'param_name'	=> 'voertuigsoort',
					'value'			=> array(
						'Occasion'	=> 'occasion',
						'Nieuw'		=> 'nieuw',
						'Demo'		=> 'demo'
					),
					'std'			=> '',
					'description'	=> __('', 'caw-text-domain')
				 ),
				 array(
					'type'			=> 'dropdown',
					'holder'		=> 'div',
					'class'			=> '',
					'heading'		=> __('Voertuigcategorieen (optioneel)', 'caw-text-domain'),
					'param_name'	=> 'voertuigcategorie',
					'value'			=> array(
						'Alle voertuigsoorten'	=> '',
						'Personenautos'			=> 'personenauto',
						'Bedrijfswagens'		=> 'bedrijfswagen'
					),
					'description'	=> __('De categorieen de gebruikt worden in greep uit ons aanbod.', 'caw-text-domain')
				 ),
				 array(
					'type'			=> 'textfield',
					'holder'		=> 'div',
					'class'			=> '',
					'heading'		=> __('Prijsfilter', 'caw-text-domain'),
					'param_name'	=> 'prijs',
					'description'	=> __('Vul hier een minimale en maximale prijswaarde wat u wilt instellen als prijsfilter. <br />Voorbeeld: <strong>1000-25000</strong>', 'caw-text-domain' )
				 ),
                array(
                    'type'			=> 'textfield',
                    'holder'		=> 'div',
                    'class'			=> '',
                    'heading'		=> __('Bouwjaar', 'caw-text-domain'),
                    'param_name'	=> 'bouwjaar',
                    'description'	=> __('Vul hier een minimale en maximale bouwjaar in wat u wilt instellen als bouwjaarfilter. <br />Voorbeeld: <strong>2014-2017</strong>', 'caw-text-domain' )
                ),
				 array(
					'type'			=> 'checkbox',
					'holder'		=> 'div',
					'class'			=> '',
					'heading'		=> __('Brandstof (optioneel)', 'caw-text-domain'),
					'param_name'	=> 'brandstof',
					'value'			=> array(
						'Benzine'	=> 'benzine',
						'Diesel'	=> 'diesel',
						'Elektrisch'=> 'elektrisch',
						'Hybride'	=> 'hybride',
						'LPG G3'	=> 'lpg-g3',
					),
					'std'			=> '',
					'description'	=> __('', 'caw-text-domain')
				 ),
				 array(
					'type'			=> 'dropdown',
					'holder'		=> 'div',
					'class'			=> '',
					'heading'		=> __('Weergave', 'caw-text-domain'),
					'param_name'	=> 'weergave',
					'value'			=> array(
						'Week'	=> 'weekly',
					),
					'std'			=> '',
					'description'	=> __('', 'caw-text-domain')
				 ),
				  array(
					'type'			=> 'dropdown',
					'holder'		=> 'div',
					'class'			=> '',
					'heading'		=> __('Aantal te tonen autos', 'caw-text-domain'),
					'param_name'	=> 'voertuigaantal',
					'value'       => array(
				        '1'   => '1',
				      ),
					'std'			=> '',
					'description'	=> __('', 'caw-text-domain' )
				 ),
				  array(
					'type'			=> 'dropdown',
					'holder'		=> 'div',
					'class'			=> '',
					'heading'		=> __('Filter op', 'caw-text-domain'),
					'param_name'	=> 'sortering',
					'value'       => array(
				    	'Prijs oplopend'   => 'prijs-oplopend',
				        'Prijs aflopend'  => 'prijs-aflopend',
				        'Willekeurige volgorde'  => 'random'
				      ),
					'std'           => '',
					'description'	=> __('Kies een sortering', 'caw-text-domain' )
				 ),
			)
		) );
	}
}