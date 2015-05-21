<?php
use Fol\Tasks\Tasks as Tasks;
use Fol\Config;

class Builder extends Tasks
{
	public function __construct()
	{
		$this->config = new Config('config', 'local');
	}

	/**
	 * Install all npm and bower components
	 */
	public function install()
	{
		//npm + bower
		$this->taskNpmInstall()->run();
		$this->taskBowerInstall('node_modules/.bin/bower')->run();
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
			->process('node node_modules/.bin/stylecow -c config/stylecow.json')
			->process('node node_modules/.bin/r.js -o config/js.js')
			->run();

		//Render pages
		$this->taskPageRender()
			->templates('sources/templates')
			->origin('sources/pages')
			->destination('public')
			->run();
	}

	/**
	 * Publish the static site in the server using rsync
	 * You must configure the path connection in config/local/rsync.php
	 */
	public function publish()
	{
		$this->taskRsync()
			->fromPath('public/')
			->toPath($this->config['rsync']['path'])
			->recursive()
			->run();
	}
}
