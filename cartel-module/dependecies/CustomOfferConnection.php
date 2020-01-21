<?php

namespace CawBundle;

/**
 * Caw Connection
 */
class CustomOfferConnection extends AbstractConnection
{
	/**
	 * @var array
	 */
	private $arguments = [];

	/**
	 * @param string $action
	 * @return string
	 */
	public function generateUrl($action)
	{
		return \sprintf(
				'%s/%s/%s/?ccid=%d&mapper={%s}',
				\rtrim( $this->getUrl(), '/' ),						// trim trailing slashes
				\ltrim( \rtrim( $this->getRoute(), '/' ), '/' ),	// trim leading and trailing slashes
				$action,											// CartelCawClient action
				$this->getClientConfigurationId(),					// Get Client Configuration
				$this->getArguments()								// just a test
		);
	}

	/**
	 * Add an argument for the API request
	 *
	 * @param string $name
	 * @param string $value
	 * @return \CawBundle\CustomOffer
	 */
	public function addArgument($name, $value)
	{
		$this->arguments[ (String) $name ] = (String) $value;

		return $this;
	}

	/**
	 * Get Arguments
	 *
	 * @return string
	 */
	private function getArguments()
	{
		$x = [];

		foreach ($this->arguments as $k => $v) {
			$x[] = \vsprintf('"%s":"%s"', [ $k, $v ] );
		}

		return \implode(",", $x);
	}

	/**
	 *
	 * @return string
	 */
	public function getConnectionTestPath()
	{
		return 'status';
	}

	/**
	 * @return string
	 */
	public function getRoute()
	{
		return '/custom-offer/';
	}
}