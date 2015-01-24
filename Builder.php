<?php
use Robo\Tasks;
use Fol\Tasks\PageRender;

class Builder extends Tasks
{
	use PageRender;

	/**
	 * Install all npm and bower components
	 */
	public function install()
	{
		//npm + bower
		$this->taskNpmInstall()->run();
		$this->taskBowerInstall()->run();
	}

	/**
	 * Run a php server
	 */
	public function server()
	{
		echo "server started at http://localhost:8000\n";

		$this->taskServer(8000)
			->dir('public')
			->run();
	}

	/**
	 * Build the site in ./public
	 */
	public function build()
	{
		//Copy files
		$this->taskFilesystemStack()
			->remove('public')
			->mkdir('public')
			->copy('sources/htaccess', 'public/.htaccess')
			->copy('sources/favicon.ico', 'public/favicon.ico')
			->copy('sources/jquery.png', 'public/jquery.png')
			->copy('sources/jquery.pdf', 'public/jquery.pdf')
			->copy('sources/htaccess', 'public/.htaccess')
			->run();

		//Execute css/js generation
		$this->taskParallelExec()
			->process('node node_modules/.bin/stylecow execute stylecow.json')
			->process('node node_modules/.bin/r.js -o sources/js-build.js')
			->run();

		//Render pages
		$this->taskPageRender()
			->templates(__DIR__.'/sources/templates')
			->origin(__DIR__.'/sources/pages')
			->destination(__DIR__.'/public')
			->run();
	}
}
