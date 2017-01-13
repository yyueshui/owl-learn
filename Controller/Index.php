<?php
namespace Controller;

class Index extends \Controller
{
	public function GET()
	{
		$middleware = new \Owl\middleware;

// middleware 1
		$middleware->insert(function($message) {
			//echo "before 1".PHP_EOL;
			//var_dump("before 1");

			yield 2;

			//echo "after 1".PHP_EOL;
			//var_dump("after 1");
		});

// middleware 2
		$middleware->insert(function($message) {
			//echo "before 2".PHP_EOL;

			yield 1;      // yield之后没有逻辑，这个yield实际可以省略
		});

// middleware 3
		$middleware->insert(function($message) {
			//yield;

			//echo "after 3".PHP_EOL;
		});

// middleware 4
		$middleware->insert(function($message) {
			//$this->println($message);
		});

		$middleware->execute(array('hello world!'));

		$this->response->withCookie('foo', 'bar');

		return $this->render('Index', ['output' => 'hello world2!']);
	}

	private function println($message)
	{
		//echo $message . PHP_EOL;
	}
}
