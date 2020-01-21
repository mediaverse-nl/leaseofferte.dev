<?php

namespace CawBundle;

/**
 * Custom Offer
 */
final class CustomOffer
{
	/**
	 * @var Connection
	 */
	private $connection;
	
	/**
	 * Constructor
	 *
	 * @param Connection $connection
	 */
	public function __construct(CustomOfferConnection $connection)
	{
		$this->connection = $connection;
	}
	
	/**
	 * @return Connection
	 */
	private function getConnection()
	{
		return $this->connection;
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
		// Add argument
		$this->getConnection()->addArgument($name, $value);
		
		return $this;
	}
	
	/**
	 * Filter vehicles
	 * 
	 * @see \Cartel\CawClientBundle\Controller\CustomOfferController::filterAction
	 */
	public function filterAction()
	{
		return $this->getConnection()->execute( 'filter' );
	}
	
	/**
	 * Get all the filters.
	 * An admin should use this function to define the filters
	 * 
	 * @see \Cartel\CawClientBundle\Controller\CustomOfferController::filtersAction
	 * @return array|json_encoded
	 */
	public function filtersAction()
	{
		return $this->getConnection()->execute( 'filters' );
	}
}