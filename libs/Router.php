<?php

namespace test\libs;

/**
 * @brief	Router class for accessing the routing parameters.
 */

class Router
{
	/**
	 * @var	string $controller
	 */

	protected $controller;

	/**
	 * @var	string $action
	 */

	protected $action;

	/**
	 * @var	string $id
	 */

	protected $id;

	/**
	 * @var	Request $request
	 */

	private $request;

	/**
	 * @brief	Router constructor.
	 *
	 * @details	The URI is being parsed.
	 *
	 * @param	$request
	 */

	public function __construct( $request )
	{
		$this->request	= $request;

		$this->parse();
	}
	/**
	 * @brief	The parsing function parse the string.
	 *
	 * @details	Separation of the controller and action from the routing.
	 */

	public function parse()
	{ 

		$parseResult   = parse_url( $this->request->getUri());

		$explodeResult = explode( '/', trim( $parseResult['path'], '/' ));
		
		/**
		 * @basic	If they are set, the value is set on the Router properties.
		 *
		 * @Details	Action is by default with value 'index'.
		 */

		if ( isset( $explodeResult[1]) )
		{
			$this->controller	= $explodeResult[1];
		}
		if ( isset( $explodeResult[2]) )
		{
			$this->action	= $explodeResult[2];
		}
		else
		{
			$this->action	= 'index';
		}
		if ( isset( $explodeResult[3]) )
		{
			$this->id	= $explodeResult[3];
		}
	}

	/**
	 * @basic	Getter for the controller, based on uri.
	 *
	 * @return	string
	 */

	public function getController()
	{
		return $this->controller;
	}

	/**
	 * @basic	Getter for the action, based on uri.
	 *
	 * @return	string
	 */

	public function getAction()
	{
		return $this->action;
	}

	/**
	 * @basic	Getter for the id, based on uri.
	 *
	 * @return	string
	 */

	public function getId()
	{
		return $this->id;
	}
}