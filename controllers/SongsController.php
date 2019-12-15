<?php

namespace test\controllers;

use \test\libs\Request;
use \test\models\Songs;
use \test\models\Authors;

/**
 * @brief The controller for songs SQL table.
 */
class SongsController extends AbstractController
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
		$this->model	= new Songs();
	}
	/**
	 * @brief	Default index action in Songs controller.
	 *
	 * @copydoc	test\controllers\AbstractController->index()
	 *
	 * @return	void
	 */
	public function index()
	{
		$data	= array( 'title'	=> 'Songs Homepage' );

		echo $this->view->render( 'public/index.html', [ 'data' => $data ] );
	}

	/**
	 * @brief	All data for Songs SQL table.
	 *
	 * @return	void
	 */
	public function data(): void
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
			'title'			=> 'Songs',
			'pagedData'		=> $pagedData,
			'currentPage'	=> $currentPage,
			'pagesCount'	=> $pagesCount
		);
		
		echo $this->view->render( 'songs/data.html', [ 'data' => $data, 'root' => $this->root ] );
	}

	/**
	 * @brief	Insert into the SQL table.
	 * 
	 * @return	void
	 */
	public function insert(): void
	{
		$authors	= new Authors();
		$params		= $this->request->getPostParams();
		$result		= "";

		if( !empty( $params ) )
		{
			$result = $this->model->insertSong( $params[ 'name' ], $params[ 'year' ], $params[ 'authorID' ] );
		}

		$data	= array(
			'title'			=> 'Insert New Song',
			'allAuthors'	=> $authors->selectAll(),
			'result'		=> $result
		);

		echo $this->view->render( 'songs/insert.html', [ 'data' => $data, 'root' => $this->root ] );
	}

	/**
	 * @brief	Edit a song in the SQL table.
	 *
	 * @param	int $id
	 *
	 * @return	void
	 */
	public function edit ( int $id ): void
	{
		$authors		= new Authors();
		$params			= $this->request->getPostParams();
		$result			= "";

		if( isset( $params['edit'] ) )
		{
			if( $params['edit'] == true )
			{
				$result	= $this->model->editSong( $params['id'], $params['name'], $params['year'], $params['authorID'] );
			}
		}

		$selectedRow	= $this->model->selectById( $id );
		$data			= array(
			'title'			=> 'Edit The Song',
			'allAuthors'	=> $authors->selectAll(),
			'selectedRow'	=> $selectedRow,
			'result'		=> $result
		);

		echo $this->view->render( 'songs/edit.html', [ 'data' => $data, 'root' => $this->root ] );
	}

	/**
	 * @brief	Delete from the SQL table.
	 *
	 * @param	int $id
	 *
	 * @return	void
	 */
	public function delete( int $id ): void
	{
		$result			= "";
		$selectedRow	= $this->model->selectById( $id );
		$params			= $this->request->getPostParams();

		if( isset( $params['edit'] ) )
		{
			if( $params['edit'] == true )
			{
				$result	= $this->model->deleteSong( $params['id'] );
			}
		}

		$data			= array(
			'title'			=> 'Delete The Song',
			'selectedRow'	=> $selectedRow,
			'result'		=> $result
		);

		echo $this->view->render( 'songs/delete.html', [ 'data' => $data, 'root' => $this->root ] );
	}

	/**
	 * @brief	Search data from the SQL table.
	 *
	 * @return	void
	 */
	public function search(): void
	{
		$authors		= new Authors();
		$params			= $this->request->getPostParams();
		$filter			= $this->request->getPostParams()['filter'] ?? 5;
		$currentPage	= $this->request->getPostParams()['curPage'] ?? 1;
		$filteredData	= array();
		$name			= '';
		$year			= '';
		$authorID		= '';

		if( isset ( $params['name'] ) )
		{
			$name	= $params['name'];
		}

		if( isset ( $params['name'] ) )
		{
			$year	= $params['year'];
		}

		if( isset ( $params['authorID'] ) )
		{
			$authorID	= $params['authorID'];
		}

		if( isset ( $params['name'] ) || isset ( $params['year'] ) || isset ( $params['authorID'] ) )
		{
			$filteredData	= $this->model->filteredSelect( $params['name'], (int) $params['year'], (int) $params['authorID'] );
		}

		$data			= array(
			'title'			=> 'Songs',
			'filteredData'	=> $filteredData,
			'allAuthors'	=> $authors->selectAll()
		);

		echo $this->view->render( 'songs/search.html',[
				'data' => $data,
				'root' => $this->root,
				'name' => $name,
				'year' => $year,
				'authorID' => $authorID ] );
	}
}