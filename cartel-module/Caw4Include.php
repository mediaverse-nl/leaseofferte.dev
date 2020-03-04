<?php
class Caw4Include {
	const CURL_CURLOPT_CONNECTTIMEOUT = 5; //  Number of seconds to try and connect to the server
	const CURL_CURLOPT_TIMEOUT = 15; // Number of seconds to allow execution
	const CURL_CURLOPT_MAXREDIRS = 42; // Max number of redirects curl will follow

	const CAW4_INCLUDE_LIVE_URL = 'https://prod.caw4.cartel.nl/cawclient/';

	const CAW4_COOKIE_VIEW_MODE = 'caw4_view_mode';
	const CAW4_COOKIE_FAVORITE_VEHICLES = 'caw4_favorite_vehicles';
	const CAW4_COOKIE_EXPIRE_TIME = 2592000; // 30 days

	const CONTENT_ERROR = 'De voorraad module is tijdelijk niet beschikbaar.'; // Default error message

	private static $clientConfigurationId;
	private static $websiteUrl;
	private static $defaultMapper = array();
	private static $miniFilters = array('make', 'model', 'fuel');

	/*
	 * Filled by constructor
	 */
	private $caw4Page;

	/*
	 * Filled by cookie
	 */
	private $viewMode;
	private $favoriteVehicles;

	/*
	 * Debug
	 */
	private $lastUrlCalled;
	private $profiler;

	/*
	 * Executes a list of startup functions
	 */
	public function __construct($caw4Page = null) {
		$this->setCaw4Page($caw4Page);

		$this->validateState();
		$this->fetchCookieData();
		$this->processAjax(); // Has an exit if its executes an ajax action
	}

	/*
	 * Validate if the required variables are filled
	 */
	public function validateState() {
		if (session_status() == PHP_SESSION_NONE) {
			throw new Exception('Caw4Include requires an active session');
		}

		if(is_null(self::$clientConfigurationId)) {
			throw new Exception('clientConfigurationId cannot be empty');
		}

		if(is_null(self::$websiteUrl)) {
			throw new Exception('baseUrl cannot be empty');
		}
	}

	/*
	 * Fetch the cookie data and set the corresponding variables
	 */
	public function fetchCookieData() {
		$viewMode = filter_input(INPUT_COOKIE, self::CAW4_COOKIE_VIEW_MODE, FILTER_SANITIZE_STRING);
		$favoriteVehiclesData = filter_input(INPUT_COOKIE, self::CAW4_COOKIE_FAVORITE_VEHICLES, FILTER_SANITIZE_STRING, array('flags' => FILTER_FLAG_NO_ENCODE_QUOTES));

		if(!empty($viewMode)) {
			$this->setViewMode($viewMode);
		}

		if(!empty($favoriteVehiclesData)) {
			$favoriteVehicles = (array)json_decode($favoriteVehiclesData);

			$this->setFavoriteVehicles($favoriteVehicles);
		}
	}

	/*
	 * Execute an ajax action for the GET var method
	 */
	public function processAjax() {
		$ajaxMethod = filter_input(INPUT_GET, 'method', FILTER_SANITIZE_STRING);

		if(!empty($ajaxMethod)) {
			switch ($ajaxMethod) {
				case 'set-view-mode' :
					$viewMode = filter_input(INPUT_POST, 'view', FILTER_SANITIZE_STRING);

					if(!empty($viewMode)) {
						$this->setViewMode($viewMode);

						$expire = time() + self::CAW4_COOKIE_EXPIRE_TIME;
						setcookie(self::CAW4_COOKIE_VIEW_MODE, $this->getViewMode(), $expire);
					}

					echo '1';
					exit;
				break;

				case 'add-to-favorites':
					$vehicleId = filter_input(INPUT_POST, 'vehicle_id', FILTER_SANITIZE_STRING);
					$favoriteVehicles = array();

					if(!empty($vehicleId)) {
						$oldFavoriteVehicles = $this->getFavoriteVehicles();

						if(is_array($oldFavoriteVehicles)) {
							$favoriteVehicles = $oldFavoriteVehicles;
						}

						if(!in_array($vehicleId, $favoriteVehicles)) {
							$favoriteVehicles[] = $vehicleId;
						}

						$this->setFavoriteVehicles($favoriteVehicles);

						$expire = time() + self::CAW4_COOKIE_EXPIRE_TIME;
						setcookie(self::CAW4_COOKIE_FAVORITE_VEHICLES, json_encode($favoriteVehicles), $expire);
					}

					echo json_encode(array('total' => count($favoriteVehicles)));

					exit;
				break;

				case 'delete-from-favorites':
					$vehicleId = filter_input(INPUT_POST, 'vehicle_id', FILTER_SANITIZE_STRING);

					if(!empty($vehicleId)) {
						$oldFavoriteVehicles = $this->getFavoriteVehicles();

						if(is_array($oldFavoriteVehicles)) {
							$favoriteVehicles = array_diff($oldFavoriteVehicles, array($vehicleId));

							$expire = time() + 60 * 60 * 24 * 30;
							setcookie(self::CAW4_COOKIE_FAVORITE_VEHICLES, json_encode($favoriteVehicles), $expire);

							echo json_encode(array('total' => count($favoriteVehicles)));
						}
					}

					exit;
				break;
			}
		}
	}

	/*
	 * Get the content from the CAW4
	 */
	public function getContent($type, $caw4Url) {
		if($type == 'cawmini') {
			$request = http_build_query(array('ccid' 			 	=> self::getClientConfigurationId(),
											  'filters'				=> json_encode(self::$miniFilters),
											  'targetUrl'			=> self::getWebsiteUrl() . $this->getCaw4Page(),
										)
			);

			$caw4IncludeUrl = $caw4Url . $type . '?' . $request;
		} else if($type == 'jsmini') {
			$request = http_build_query(array('ccid' 			 	=> self::getClientConfigurationId(),
											  'type'				=> 'cawmini',
										)
			);

			$caw4IncludeUrl = $caw4Url . 'assets/js?' . $request;
		} else {
			$request = http_build_query(array(	'url'				=> self::getWebsiteUrl() . $_SERVER['REQUEST_URI'],
												'ccid'				=> self::getClientConfigurationId(),
												'baseUrl'			=> self::getWebsiteUrl() . $this->getCaw4Page(),
												'sessionHash'		=> md5(session_id()),
												'defaultMapper'		=> json_encode(self::getDefaultMapper()),
												'view'				=> $this->getViewMode(),
												'favoriteVehicles'	=> json_encode($this->getFavoriteVehicles())
										)
			);

			$caw4IncludeUrl = $caw4Url . 'url/' . $type . '?' . $request;
		}

		$this->lastUrlCalled = $caw4IncludeUrl;

		$ch = curl_init();

		curl_setopt ($ch, CURLOPT_URL, $caw4IncludeUrl);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, self::CURL_CURLOPT_CONNECTTIMEOUT);
		curl_setopt ($ch, CURLOPT_TIMEOUT, self::CURL_CURLOPT_TIMEOUT);
		curl_setopt ($ch, CURLOPT_MAXREDIRS, self::CURL_CURLOPT_MAXREDIRS);

		$cawContents = curl_exec($ch);

		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		$errorNumber = curl_errno($ch);

		curl_close($ch);

		// Check the response
		$error = false;

		if($httpCode != '200' || $errorNumber > 0) {
			$error = true;
		}

		if(!$error) {
			$cawContent = json_decode($cawContents);
		} else {
			$cawContent = $cawContents;
		}

		$contentData = array(	'content' => $cawContent,
								'url' => $caw4IncludeUrl,
								'httpCode' => $httpCode,
								'error' => $error);

		return $contentData;
	}

	/*
	 * Wrapper for getContent
	 */
	public function bodyContent($caw4Url = self::CAW4_INCLUDE_LIVE_URL) {
			return $this->getContent('content', $caw4Url);
	}

	/*
	 * Wrapper for getContent
	 */
	public function seoData($caw4Url = self::CAW4_INCLUDE_LIVE_URL) {
		return $this->getContent('seo', $caw4Url);
	}

	/*
	 * Wrapper for getContent
	 */
	public function cssFiles($caw4Url = self::CAW4_INCLUDE_LIVE_URL) {
		return $this->getContent('css', $caw4Url);
	}

	/*
	 * Wrapper for getContent
	 */
	public function jsFiles($caw4Url = self::CAW4_INCLUDE_LIVE_URL) {
		return $this->getContent('js', $caw4Url);
	}

	/*
	 * Wrapper for getContent
	 */
	public function miniContent($caw4Url = self::CAW4_INCLUDE_LIVE_URL) {
			return $this->getContent('cawmini', $caw4Url);
	}

	/*
	 * Wrapper for getContent
	 */
	public function miniJsFiles($caw4Url = self::CAW4_INCLUDE_LIVE_URL) {
		return $this->getContent('jsmini', $caw4Url);
	}

	/*
	 * Wrapper for all the content
	 */
	public function getAllContent($caw4Url = self::CAW4_INCLUDE_LIVE_URL, $cawMini = false) {
		$returnSeoData = null;
		$returnCssFiles = array();
		$returnJsFiles = array();
		$returnBodyContent = '';

		$seoData = $this->seoData($caw4Url);

		if(!$seoData['error']) {
			$returnSeoData = $seoData['content'];

			$cssFiles = $this->cssFiles($caw4Url);

			if(!$cssFiles['error']) {
				$returnCssFiles = $cssFiles['content'];

				if($cawMini) {
					$jsFiles = $this->miniJsFiles($caw4Url);
				} else {
					$jsFiles = $this->jsFiles($caw4Url);
				}

				if(!$jsFiles['error']) {
					$returnJsFiles = $jsFiles['content'];

					if($cawMini) {
						$bodyContent = $this->miniContent($caw4Url);
					} else {
						$bodyContent = $this->bodyContent($caw4Url);
					}

					if(!empty($bodyContent['content'])) {
						$returnBodyContent = $bodyContent['content'];
					}

					if($bodyContent['error'] && $bodyContent['httpCode'] >= 400 && $bodyContent['httpCode'] < 600) {
						http_response_code($bodyContent['httpCode']);
					}
				}
			}
		} else if($seoData['httpCode'] >= 400 && $seoData['httpCode'] < 600) {
			http_response_code($seoData['httpCode']);

			$returnBodyContent = $seoData['content'];
		}

		if(empty($returnBodyContent)) {
			$returnBodyContent = self::CONTENT_ERROR;
			http_response_code(503);
		}

		return array(	'seoData' => $returnSeoData,
						'bodyContent' => $returnBodyContent,
						'cssFiles' => $returnCssFiles,
						'jsFiles' => $returnJsFiles);
	}

//	public function getCawMini($cawMini, $caw4Url = self::CAW4_INCLUDE_LIVE_URL) {
//
//	}

	/*
	 * ClientConfigurationId setter & getter
	 */
	public static function setClientConfigurationId($clientConfigurationId) {
		if(is_numeric($clientConfigurationId) && $clientConfigurationId > 0) {
			self::$clientConfigurationId = $clientConfigurationId;
		} else {
			throw new Exception('Incorrect clientConfigurationId - must be numeric and > 0');
		}
	}

	public static function getClientConfigurationId() {
		return self::$clientConfigurationId;
	}

	/*
	 * WebsiteUrl setter & getter
	 */
	public static function setWebsiteUrl($websiteUrl) {
		if (preg_match( '/^(http|https):\\/\\/[a-z0-9_]+([\\-\\.]{1}[a-z_0-9]+)*\\.[_a-z]{2,5}'.'((:[0-9]{1,5})?\\/.*)?$/i' ,$websiteUrl)) {
			self::$websiteUrl = $websiteUrl;
		} else {
			throw new Exception('Incorrect baseUrl - not a valid URL');
		}
	}

	public static function getWebsiteUrl() {
		return self::$websiteUrl;
	}

	/*
	 * DefaultMapper setter & getter
	 */
	public static function setDefaultMapper($defaultMapper) {
		if(is_array($defaultMapper)) {
			self::$defaultMapper = $defaultMapper;
		} else {
			throw new Exception('Incorrect mapper - must be an array');
		}
	}

	public static function getDefaultMapper() {
		return self::$defaultMapper;
	}

	/*
	 * MiniFilters setter & getter
	 */
	public static function setMiniFilters($miniFilters) {
		if(is_array($miniFilters)) {
			self::$miniFilters = $miniFilters;
		} else {
			throw new Exception('Incorrect mini filters - must be an array');
		}
	}

	public static function getMiniFilters() {
		return self::$miniFilters;
	}

	/*
	 * Caw4Page setter & getter
	 */
	public function setCaw4Page($caw4Page) {
		$this->caw4Page = $caw4Page;
	}

	public function getCaw4Page() {
		return $this->caw4Page;
	}

	/*
	 * ViewMode setter & getter
	 */
	public function setViewMode($viewMode) {
		$this->viewMode = $viewMode;
	}

	public function getViewMode() {
		return $this->viewMode;
	}

	/*
	 * FavoriteVehicles setter & getter
	 */
	public function setFavoriteVehicles($favoriteVehicles) {
		if(is_array($favoriteVehicles)) {
			$this->favoriteVehicles = $favoriteVehicles;
		} else {
			throw new Exception('Incorrect favoriteVehicles - must be an array');
		}
	}

	public function getFavoriteVehicles() {
		return $this->favoriteVehicles;
	}

	/*
	 * lastUrlCalled getter
	 */
	public function getLastUrlCalled() {
		return $this->lastUrlCalled;
	}

	/*
	 * profiler getter
	 */
	public function getProfiler() {
		return $this->profiler;
	}

	/*
	 * Also prints the constants and statics. By default PHP doesn't do that
	 */
	public function __debugInfo() {
		return array(	'Constants' => array(	'CAW4_INCLUDE_LIVE_URL'			=> self::CAW4_INCLUDE_LIVE_URL,
												'CAW4_COOKIE_VIEW_MODE'			=> self::CAW4_COOKIE_VIEW_MODE,
												'CAW4_COOKIE_FAVORITE_VEHICLES'	=> self::CAW4_COOKIE_FAVORITE_VEHICLES,
												'CAW4_COOKIE_EXPIRE_TIME'		=> self::CAW4_COOKIE_EXPIRE_TIME
						),
						'Statics' => array(		'clientConfigurationId'			=> self::$clientConfigurationId,
												'websiteUrl'					=> self::$websiteUrl,
												'defaultMapper'					=> self::$defaultMapper,
						),
						'Variables' => get_object_vars($this));
	}
}