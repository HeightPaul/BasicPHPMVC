<?php

/**
 * @brief Loading up the autoloader.
 */
require_once 'vendor/autoload.php';

/**
 * @brief Using desired classes.
 */
use \test\libs\Router;
use \test\libs\Request;
use \test\controllers\HomeController;
use \test\controllers\ContactController;
use \test\controllers\CarsController;
use \test\controllers\SongsController;
use \test\controllers\AuthorsController;

/**
 * @brief	Initialization of the request to be passed by.
 *
 * @see		\test\libs\Request
 *
 * @var		Router $router
 */
$request	= new Request();

/**
 * @brief	Initialization of the router with request parameters.
 *
 * @see		\test\libs\Router
 *
 * @var		Router $router
 */
$router		= new Router( $request );

/**
 * @see	\test\libs\Router->getControler()
 *
 * @var	string $controller
 */
$controller	= $router->getController();

/**
 * @see	\test\libs\Router->getAction()
 *
 * @var	string $action
 */
$action		= $router->getAction();

/**
 * @see	\test\libs\Router->getId()
 *
 * @var	string $id
 */
$id			= $router->getId();

/**
 * @brief	Loading up the Twig Template Engine.
 *
 * @var		Twig_Loader_Filesystem $loader
 */
$loader		= new Twig_Loader_Filesystem( 'view' );

/**
 * @var		Twig_Environment $twig
 */
$twig		= new Twig_Environment( $loader, [
	'cache' => false
]);

/**
 * @brief	 Checking function for possible action in a controller.
 *
 * @param	 string $page
 *
 * @param	 string $action
 *
 * @param	 string $id
 *
 * @return	void
 */
function checkAction( $page, $action, $id = null )
{
	if( method_exists( $page, $action ) )
	{
		$page->$action( $id );
	}
	else
	{
		echo 'Such action doesn\'t exist.';
	}
}

/**
 * @brief	Switch case for every controller.
 *
 * @details	If the requirement is met, calling the checking function inside of every case. By default it is home controller.
 */
switch ( strtolower( $controller ) )
{
	case 'contact':
		$page	= new ContactController( $request, $twig );
		checkAction( $page, $action );
		break;
	case 'cars':
		$page	= new CarsController( $request, $twig );
		checkAction( $page, $action );
		break;
	case 'songs':
		$page	= new SongsController( $request, $twig );
		checkAction( $page, $action, $id );
		break;
	case 'authors':
		$page	= new AuthorsController( $request, $twig );
		checkAction( $page, $action, $id );
		break;
	default:
		$page	= new HomeController( $request, $twig );
		checkAction( $page, $action );
		break;
}
