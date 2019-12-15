<?php

namespace test\controllers;

use \test\models\Authors;
use \test\libs\Request;

/**
 * @brief The controller for authors SQL table.
 */
class AuthorsController extends AbstractController
{
	/**
	 * @brief	constructor as the request Object is given as parameter and acquired by bounded request.
	 *
	 * @param	test\libs\Request $request
	 *
	 * @param	Twig_Environment $twig
	 */
	public function __construct( Request $request, $twig )
	{
		parent::__construct( $request, $twig );
		$this->model	= new Authors();
	}

	/**
	 * @brief	Default index action in Authors controller.
	 *
	 * @copydoc	test\controllers\AbstractController->index()
	 *
	 * @return	 void
	 */
	public function index( )
	{
		$data	= array( 'title'	=> 'Authors Homepage' );

		echo $this->view->render( 'public/index.html', [ 'data' => $data ] );
	}

	/**
	 * @brief	All data for Authors SQL table.
	 *
	 * @return	void
	 */
	public function data()
	{
		$params			= $this->request->getPostParams();
		$filter			= 5;
		$currentPage	= $this->request->getQueryParams()['page'] ?? 1;

		if( isset ( $params['filter'] ) )
		{
			$filter		= $params['filter'];
		}

		$pagedData		= $this->model->pagedSelect( $currentPage, $filter );
		$pagesCount		= $this->model->pagesCount( $filter );
		$data		= array(
			'title'			=> 'Authors',
			'pagedData'		=> $pagedData,
			'currentPage'	=> $currentPage,
			'pagesCount'	=> $pagesCount
		);

		echo $this->view->render( 'authors/data.html', [ 'data' => $data, 'root' => $this->root ] );
	}

	/**
	 * @brief	Insert into the SQL table.
	 *
	 * @return	void
	 */
	public function insert()
	{
		$params	= $this->request->getPostParams();
		$result	= "";

		if( !empty( $params ) )
		{
			$result = $this->model->insertAuthor( $params[ 'firstname' ], $params[ 'lastname' ] );
		}

		$data	= array(
			'title'		=> 'Insert New Author',
			'result'	=> $result
		);

		echo $this->view->render( 'authors/insert.html', [ 'data' => $data, 'root' => $this->root ] );
	}

	/**
	 * @brief	 Edit a author in the SQL table.
	 *
	 * @param	 int $id
	 *
	 * @return	void
	 */
	public function edit ( int $id )
	{
		$result			= "";
		$params			= $this->request->getPostParams();

		if( isset( $params['edit'] ) )
		{
			if( $params['edit'] == true )
			{
				$result	= $this->model->editAuthor( $params['id'], $params['firstname'], $params['lastname'] );
			}
		}

		$selectedRow	= $this->model->selectById( $id );
		$data			= array(
			'title'			=> 'Edit The Author',
			'selectedRow'	=> $selectedRow,
			'result'		=> $result
		);

		echo $this->view->render( 'authors/edit.html', [ 'data' => $data, 'root' => $this->root ] );
	}

	/**
	 * @brief	Delete from the SQL table.
	 *
	 * @param	int $id
	 *
	 * @return	void
	 */
	public function delete( int $id )
	{
		$result			= "";
		$selectedRow	= $this->model->selectById( $id );
		$params			= $this->request->getPostParams();

		if( isset( $params['edit'] ) )
		{
			if( $params['edit'] == true )
			{
				$result	= $this->model->deleteAuthor( $params['id'] );
			}
		}

		$data			= array(
			'title'			=> 'Delete The Author',
			'selectedRow'	=> $selectedRow,
			'result'		=> $result
		);

		echo $this->view->render( 'authors/delete.html', [ 'data' => $data, 'root' => $this->root ] );
	}

	/**
	 * @brief	Search data from the SQL table.
	 * 
	 * @return	void
	 */
	public function search()
	{
		$params			= $this->request->getPostParams();
		$filter			= 5;
		$currentPage	= 1;
		$filteredData	= array();
		$firstName		= '';
		$lastName		= '';

		if( isset ( $params['filter'] ) && isset ( $params['curPage'] ) )
		{
			$filter			= $params[ 'filter' ];
			$currentPage	= $params[ 'curPage' ];
		}

		if( isset ( $params['firstname'] ) )
		{
			$firstName	= $params['firstname'];
		}

		if( isset ( $params['lastname'] ) )
		{
			$lastName	= $params['lastname'];
		}

		if( isset ( $params['firstname'] ) || isset ( $params['lastname'] ) )
		{
			$filteredData	= $this->model->filteredSelect( $params['firstname'], $params['lastname'] );
		}

		$data			= array(
			'title'			=> 'Authors',
			'filteredData'	=> $filteredData
		);

		echo $this->view->render( 'authors/search.html', [ 
			'data' => $data,
			'root' => $this->root,
			'firstName'	=> $firstName,
			'lastName'	=> $lastName ] );
	}
}