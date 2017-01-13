<?php
namespace Controller;

use Monolog\Logger;
use Owl\Application;
use Owl\Http\Request;
use Owl\Http\Response;
use Owl\Mvc\Router;

class Learn extends \Controller
{
	/**@var object $application application对象*/
	private $application = null;

	public function __construct()
	{
		$this->application = new Application();
	}

	//public function __beforeExecute(Request $request, Response $response)
	//{
	//	$this->application = new Application();
	//}

	/**
	 * GET入口
	 * @return string
	 */
	public function GET()
	{
		$this->application->middleware(function(Request $request, Response $response){
			$method = $request->getMethod();
			$uri = $request->getRequestTarget();
			$startTime = microtime(true);

			yield;

			$useTime = (microtime(true) - $startTime) * 1000;
			$logger =  new Logger('app');
			$logger->debug(sprintf('%s %d %s %s', date('Y-m-d H:i:s', (int)$startTime), $useTime, $method, $uri));
		});

		//$this->application->middleware(function(Request $request, Response $response) {
		//	$router = new Router([
		//		'namespace' => '\Controller'
		//	]);
		//	$router->execute($request, $response);
		//});

		$this->application->start();
		return $this->render('Index', ['output' => 'get']);
	}

	/**
	 * POST 入口
	 * @return string
	 */
	public function POST()
	{
		return $this->render('Index', ['output' => 'post']);
	}

	/**
	 * 后置方法
	 * @param $request
	 * @param $response
	 */
	public function __afterExecute(Request $request, Response $response)
	{
		$this->application = null;
	}
}
