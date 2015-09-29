<?php
use Fol\Builder\App;
use Psr7Middlewares\Middleware;

/**
 * Class to generate the site and serve files
 */
class Site extends App
{
	public function init()
	{
		$this->servePages()->build(function ($middlewares) {
			$middlewares[] = Middleware::minify();
			return $middlewares;
		});

		$this->serveFiles();
	}
}
