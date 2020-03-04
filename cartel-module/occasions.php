<?php
session_start();
include 'Caw4Include.php';

$clientConfigurationId = 145;

$customCssUrl = filter_input(INPUT_GET, 'customCssUrl', FILTER_SANITIZE_STRING);
if (!isset($_SESSION['customCssUrl'])) {
	$_SESSION['customCssUrl'] = $customCssUrl;
}
$customCssUrls = $_SESSION['customCssUrl'];

$endSlash = '';

if(empty($clientConfigurationId) || !is_numeric($clientConfigurationId)) {
	header("HTTP/1.1 400 Bad Request");
	echo 'Bad Request';
	die();
}

/* CAW settings */
$caw4Page		= '/autos' . $endSlash;
$websiteUrl		= env('APP_URL');
$defaultMapper  = array('btw' => 'btw', 'voertuigsoort' => 'nieuw,occasion', 'prijs' => '7950-999999', 'bouwjaar' => '2007-2099', 'sortering' => 'prijs-oplopend' );

Caw4Include::setClientConfigurationId($clientConfigurationId);
Caw4Include::setWebsiteUrl($websiteUrl);
Caw4Include::setDefaultMapper($defaultMapper);

/* Initiate the include */
$caw4Include = new Caw4Include($caw4Page);
$caw4Content = $caw4Include->getAllContent();
?>
<!DOCTYPE html>
<html>
	<head>

		<title><?php echo isset($caw4Content['seoData']->title) ? $caw4Content['seoData']->title : null; ?></title>
		<meta name="description" content="<?php echo isset($caw4Content['seoData']->description) ? $caw4Content['seoData']->description : null; ?>">

		<?php
		if(isset($caw4Content['seoData']->canonical)) { ?>
 			<link rel="canonical" href="<?php echo $caw4Content['seoData']->canonical; ?>" />
 			<?php
 		}

		if(isset($caw4Content['seoData']->openGraph)) {
			foreach((array) $caw4Content['seoData']->openGraph as $property => $value) {
				if($property == 'og:url' && empty($value)) {
					$value = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
				}

				echo '<meta property="' . $property . '" content="' . $value . '" />' . chr(10);
			}
		}
 		?>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<?php if(!empty($caw4Content['cssFiles'])) foreach($caw4Content['cssFiles'] as $cssFile) : ?>
			<link href="<?= $cssFile->href; ?>" type="<?= $cssFile->type; ?>" rel="<?= $cssFile->rel; ?>" />
		<?php endforeach; ?>
		<?php if (isset($customCssUrls))  { ?>
			<link href="<?= $customCssUrls; ?>" type="text/css"  rel="stylesheet" />
		<?php } ?>
        <style>
            .caw-nav-tabs a:hover{
                background: #d17508 !important;
            }
            .price-per-month{
                font-weight: bold;
                color: #0173B1;
            }
            label{
                font-weight: bold !important;

            }
            /*.caw-ui .financial-calculator .caw-form-group input.financial-price,*/
            /*.caw-ui .financiallease .caw-form-group input.financial-price,*/
            /*.caw-ui .operationallease .caw-form-group input.financial-price{*/
            /*    font-family: bold;*/
            /*}*/
        </style>
	</head>
	<body style="margin-bottom: 40px;background:#f4f4f4">
		<div class="container" style="max-width: 1170px; width:100%; margin: 0px auto;">
        	<?php echo $caw4Content['bodyContent']; ?>
        </div>

        <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
	<?php if(!empty($caw4Content['jsFiles'])) foreach($caw4Content['jsFiles'] as $jsFile) : ?>
		<script src="<?= $jsFile->src; ?>" type="<?= $jsFile->type; ?>"></script>
	<?php endforeach; ?>
	<script type="text/javascript">
		var dynamicIframe = {
			jqueryRef: null,		// The reference to jQuery
			previousHeight: 0,		// No need to explain
			additionalFields: [],	// Array of fields that are also checked besides the clientHeight / scrollHeight
			intervalSeconds: 100,	// Interval time (1000 = 1 second)
			interval: null,			// Filled with the interval, used to stop it

			// Initialization function
			init: function(setJqueryRef, setAdditionalFields, setIntervalSeconds) {
				// Fill the variables
				dynamicIframe.jqueryRef = setJqueryRef;
				dynamicIframe.additionalFields = setAdditionalFields || [];
				dynamicIframe.intervalSeconds = setIntervalSeconds || dynamicIframe.intervalSeconds;

				// Add checkHeight to events
				if (window.attachEvent) {
					window.attachEvent('onload', dynamicIframe.checkHeight());
				} else if (window.addEventListener) {
					window.addEventListener('load', dynamicIframe.checkHeight(), false);
				}

				// Start the interval
				dynamicIframe.interval = setInterval(dynamicIframe.checkHeight, dynamicIframe.intervalSeconds);
			},

			// Check if the current height is different to the previous height
			checkHeight: function() {
				var currentHeight = dynamicIframe.getHeight();

				if(currentHeight !== dynamicIframe.previousHeight) {
					dynamicIframe.previousHeight = currentHeight;

					dynamicIframe.sendHeight(currentHeight);
				}
			},

			// Find the biggest height
			getHeight: function() {
				var bodyHeight = dynamicIframe.jqueryRef('body').outerHeight(true);

				for(var fieldNumber in dynamicIframe.additionalFields) {
					if(bodyHeight < dynamicIframe.jqueryRef(dynamicIframe.additionalFields[fieldNumber]).outerHeight(true)) {
						bodyHeight = dynamicIframe.jqueryRef(dynamicIframe.additionalFields[fieldNumber]).outerHeight(true);
					}
				}

				return bodyHeight;
		   },

		   // Send the height to the parent
		   sendHeight: function(postHeight) {
				parent.postMessage(postHeight, '*');
		   },

		   // No need to explain
		   stopInterval: function() {
				clearInterval(dynamicIframe.interval);
		   }
		};

		var jQueryCAW = jQuery.noConflict();
		dynamicIframe.init(jQueryCAW, []);
		</script>
	</body>
</html>
