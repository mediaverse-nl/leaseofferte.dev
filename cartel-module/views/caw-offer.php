<?php
if(isset($content) && $content->success == 1) {

	// Define variables
	$limit = $content->limit;
	$vehicles = $content->vehicles;
	$sortSet = $content->sort;

	// Execute shuffle if it was selected
	if($sortSet == 'random') {
		shuffle( $vehicles );
	}

	if (!empty( $vehicles )) {
		$vehicles = array_chunk( $vehicles, $limit )[ 0 ];
	} else {
		echo "Geen voertuigen gevonden";
	} 

	include('caw-offer-raster.php');

} else {
	echo "Zowel de autowebshop pagina als de configuratiecode is verplicht om in te vullen!";
}
?>

<?php if(isset($content) && $content->success == 1) { ?>
<script type="text/javascript">
	var overviewUrl = "<?= $content->base_url; ?>";
</script>
<?php } ?>