<?php

namespace test\controllers;

/**
 * @brief   The controller for contacts' page.
 */
class ContactController extends AbstractController
{
	/**
	 * @brief	Contact index action echoes its specific phrase.
	 *
	 * @copydoc	test\controllers\AbstractController->index()
	 *
	 * @return	void
	 */
	public function index()
	{
		$data	= array( 'title' => 'Contact Homepage' );

		echo $this->view->render( 'public/index.html', [ 'data' => $data ] );
	}
}