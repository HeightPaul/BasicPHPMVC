<?php

namespace test\controllers;

use \test\libs\Request;
use \test\models\Songs;

/**
 * @brief Abstract class for all controllers to be extended by it.
 */

abstract class AbstractController
{
	/**
	 * @var	string $root
	 */
	protected $root = '/basicphpmvc';
	/**
	 * @var	Request $request
	 */
	protected $request;

	/**
	 * @var	Songs $model
	 */
	protected $model;

	/**
	 * @var	Twig_Environment $view
	 */
	protected $view;

	/**
	 * @brief	constructor as the request Object is given as parameter and acquired by bounded request.
	 *
	 * @param	test\libs\Request $request
	 *
	 * @param	Twig_Environment $twig
	 */
	public function __construct( Request $request, $twig )
	{
		$this->request	= $request;
		$this->view		= $twig;
	}

	/**
	 * @brief	Every child controller must contain index action.
	 */
	abstract public function index();
}