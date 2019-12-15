<?php

namespace test\models;

use \test\libs\DB;

/**
 * @brief	Abstract class for all models
 */
abstract class AbstractModel
{
	/**
	 * @var	DB $db
	 */
	protected $db;

	/**
	 * @brief	AbstractModel constructor.
	 */
	public function __construct()
	{
		$this->db	= DB::Instance();
	}
}