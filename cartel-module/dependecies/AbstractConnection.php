<?php

namespace CawBundle;

/**
 * Abstract Connection
 */
abstract class AbstractConnection
{
	/**
	 * @var integer	The configuration Id for the CawClient
	 */
	private $clientConfigurationId;

	/**
	 * @var string	The url to the Caw Server
	 */
	private $url;

	/**
	 * Constructor
	 *
	 * @param integer $clientConfigurationId
	 * @param string $url
	 */
	public final function __construct($clientConfigurationId, $url)
	{
		// Set client id
		$this->clientConfigurationId = $clientConfigurationId;

		// Set url
		$this->url = $url;

		// Test connection
		$this->test();
	}

	/**
	 * @return string
	 */
	protected function getUrl()
	{
		return $this->url;
	}

	/**
	 * @return integer
	 */
	protected function getClientConfigurationId()
	{
		return $this->clientConfigurationId;
	}

	/**
	 * Execute
	 *
	 * @param string $action
	 */
	public function execute($action)
	{
		$ch = \curl_init();
		\curl_setopt( $ch, CURLOPT_URL, $this->generateUrl( $action ) );
		\curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
		\curl_setopt( $ch, CURLOPT_TIMEOUT_MS, 5000 );

		// Get response
		$response = \curl_exec( $ch );

		// Get info from request
		$status = \curl_getinfo($ch, CURLINFO_HTTP_CODE);

		// Throw an error if the Caw Server is unreachable
		if ($status != 200) {
			throw new \BadMethodCallException(
				\sprintf(
					'Unabled to execute `%s` action at Cartel Caw Server (`%s`) with a status code: %d.',
					$action,
					$this->generateUrl( $action ),
					$status
				),
				$status
			);
		}

		return $response;
	}

	/**
	 * Test connection with the Caw Server
	 */
	protected function test()
	{
		// Construct url
		$url = \sprintf('%s/%s/%s/?ccid=%d',
				\rtrim( $this->getUrl(), '/app_dev.php' ),						// trim trailing slashes
				\ltrim( \rtrim( $this->getRoute(), '/' ), '/' ),	// trim leading and trailing slashes
				$this->getConnectionTestPath(),
				$this->getClientConfigurationId()
		);

		$ch = \curl_init();
		\curl_setopt( $ch, CURLOPT_URL, $url );
		\curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
		\curl_setopt( $ch, CURLOPT_TIMEOUT_MS, 5000 );
		\curl_exec( $ch );

		// Get info from request
		$status = \curl_getinfo( $ch, CURLINFO_HTTP_CODE );

		// Throw an error if the Caw Server is unreachable
		if ($status != 200) {
			throw new \RuntimeException(
				\sprintf( 'Unabled to conntect to Cartel Caw Server at `%s` with a status code: %d.',  $this->getUrl(), $status ),
				$status
			);
		}
	}

	/**
	 * @return string	An url that matches a CAW Server route
	 */
	public abstract function generateUrl($action);

	/**
	 * @return string	The route to your custom modulde.
	 */
	public abstract function getRoute();

	/**
	 * @return string	Return the path for the connection test action.
	 */
	public abstract function getConnectionTestPath();
}