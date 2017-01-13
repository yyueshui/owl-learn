<?php
namespace Controller;

class Learn extends \Controller
{
	public function GET()
	{
		return $this->render('Index', ['output' => 'get']);
	}

	public function POST()
	{
		return $this->render('Index', ['output' => 'post']);
	}
}
