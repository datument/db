<?php

declare( strict_types= 1 );

namespace Datument\DB;

////////////////////////////////////////////////////////////////

abstract class APdoStorage
{

	/**
	 * Static method getQueryGrammer
	 *
	 * @abstract
	 * @static
	 * @access protected
	 *
	 * @return class
	 */
	abstract static protected function getQueryGrammer():string;

	/**
	 * Static method getSchemaGrammer
	 *
	 * @abstract
	 * @static
	 * @access protected
	 *
	 * @return class
	 */
	abstract static protected function getSchemaGrammer():string;

	/**
	 * Constructor
	 *
	 * @access public
	 *
	 * @param  array $config
	 */
	public function __construct( array$config )
	{
		$this->config= $config;
	}

	/**
	 * Connect to database.
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function connect():viod
	{
		if(!( $this->pdo ))
		{
			$this->pdo= new \PDO(
				$this->getDsn()
			,
				$this->getConfig( 'username', null )
			,
				$this->getConfig( 'password', null )
			,
				[
					PDO::ATTR_CASE=>                     PDO::CASE_NATURAL,
					PDO::ATTR_ERRMODE=>                  PDO::ERRMODE_EXCEPTION,
					PDO::ATTR_ORACLE_NULLS=>             PDO::NULL_NATURAL,
					PDO::ATTR_STRINGIFY_FETCHES=>        false,
					PDO::ATTR_EMULATE_PREPARES=>         false,
					PDO::ATTR_AUTOCOMMIT=>               true,
					PDO::ATTR_PERSISTENT=>               true,
				]
			);
		}
	}

	/**
	 * Disconnect from database.
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function disconnect():viod
	{
		$this->pdo= null;
	}

	/**
	 * Var pdo
	 *
	 * @access private
	 *
	 * @var    \PDO
	 */
	private $pdo;

}
