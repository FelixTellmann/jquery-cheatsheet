<?php
use Fol\Tasks\Runner;
use Fol\Tasks\Tasks;

class Builder extends Tasks
{
	public static function run() {
		(new Runner)->execute(__CLASS__);
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
			->run();

		//Execute css/js generation
		$this->taskExec('node node_modules/.bin/stylecow -c stylecow.json')->run();
		$this->taskExec('node node_modules/.bin/r.js -o js.js')->run();

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
			->toPath(env('APP_PUBLISH_RSYNC'))
			->recursive()
			->run();
	}
}
