<?php

namespace test\libs;

use nguyenanhung\CodeIgniterDB as CI;

class DB
{
	protected static $db_data = array(
		'dsn'			=> '',
		'hostname'		=> 'localhost',
		'username'		=> 'root',
		'database'		=> 'test',
		'dbdriver'		=> 'mysqli',
		'dbprefix'		=> '',
		'pconnect'		=> FALSE,
		'db_debug'		=> TRUE,
		'cache_on'		=> FALSE,
		'cachedir'		=> '',
		'char_set'		=> 'utf8',
		'dbcollat'		=> 'utf8_general_ci',
		'swap_pre'		=> '',
		'encrypt'		=> FALSE,
		'compress'		=> FALSE,
		'stricton'		=> FALSE,
		'failover'		=> array(),
		'save_queries'	=> TRUE
	);

	/**
	 * @brief	One and only instance for the SQL connection.
	 * @return	DB|null
	 */

	public static function Instance()
	{
		static $inst	= null;
		if ( $inst === null)
		{
			$inst	= &CI\DB( self::$db_data );
		}
		return $inst;
	}
}