<?php

namespace test\controllers;

use \test\models\Cars;

/**
 * @brief	The controller for cars' page.
 */
class CarsController extends AbstractController
{
	/**
	 * @brief	Cars index action echoes its specific phrase.
	 *
	 * @copydoc	test\controllers\AbstractController->index()
	 *
	 * @return	void
	 */
	public function index()
	{
		$data	= array( 'title' => 'Cars Homepage' );

		echo $this->view->render( 'public/index.html', [ 'data' => $data ] );
	}

	/**
	 * @brief	Cars action which outputs the cars' seed data by given brand and age with GET query.
	 *
	 * @return	void
	 */
	public function find()
	{
		$params	= $this->request->getQueryParams();
		$cars	= new Cars();
		$printedCarsData = $cars->getSeedData( $params['brand'], $params['age'] );

		print_r($printedCarsData);
	}

	/**
	 * @brief	Data action for finding cars in the seeding data.
	 *
	 * @details	Accessing given brand and age with POST from a HTML form input.
	 *
	 * @return	void
	 */
	public function filter()
	{
		$params		= $this->request->getPostParams();
		$cars		= new Cars();
		$carsData	= array();
		if ( isset( $params['brand'] ) && isset( $params['age'] ) ) {
			$carsData	= $cars->getSeedData( $params['brand'], $params['age'] );
		}
		$data		= array( 
			'title'		=> 'Cars Data', 
			'seedCars'	=> $carsData 
		);

		echo $this->view->render( 'cars/filter.html', $data );
	}

	/**
	 * @brief	Quiz action for checking user's input.
	 *
	 * @details	Accessing given brand and age with POST from a HTML form input.
	 *
	 * @return	void
	 */
	public function quiz()
	{
		$params	= $this->request->getPostParams();
		$cars	= new Cars();
		$result	= '';
		if ( isset( $params['brand'] ) && isset( $params['age'] ) ) {
			$carsData	= $cars->getQuizData( $params['brand'], $params['age'] );
		}

		echo $this->view->render( 'cars/quiz.html', [ 'title' => 'Quiz', 'result' => $result ] );
	}
}