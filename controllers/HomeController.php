<?php

namespace test\controllers;

/**
 * @brief The controller for cars data.
 */

class HomeController extends AbstractController
{
	/**
	 * @brief	Home index action echoes its specific phrase.
	 *
	 * @copydoc	test\controllers\AbstractController->index()
	 *
	 * @return	void
	 */
	public function index()
	{
		$data	= array( 'title'	=> 'Welcome to basic PHP MVC' );

		echo $this->view->render( 'home/index.html', [ 'data' => $data ] );
	}

	/**
	 * @brief	About page.
	 *
	 * @return	void
	 */
	public function about()
	{
		$data	= array( 'title'	=> 'Welcome to basic PHP MVC' );

		echo $this->view->render( 'home/about.html', [ 'data' => $data ] );
	}
}