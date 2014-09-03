<?php
namespace App;

use Fol\Builder\Builder;
use Fol\FileSystem;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class App extends \Fol\App {

	public function __construct(InputInterface $input, OutputInterface $output)
	{
		$this->define('builder', function () use ($input, $output) {
			return new Builder(new FileSystem(BASE_PATH.'/sources'), new FileSystem(PUBLIC_ROOT), $input, $output);
		});
	}

	public function build()
	{
		$this->builder
			->clear()
			->render(['data' => 'pages', 'templates' => 'templates'])
			->copy('favicon.ico')
			->copy('jquery.png')
			->copy('.htaccess')
			->command('stylecow convert css/styles.css '.PUBLIC_ROOT.'/css/styles.css --manifest css-build.json')
			->command('r.js -o js-build.js');
	}

	public function watch()
	{
		$this->builder->watch([
			'templates' => function () {
				$this->builder->render(['data' => 'pages', 'templates' => 'templates']);
			},
			'pages' => function () {
				$this->builder->render(['data' => 'pages', 'templates' => 'templates']);
			},
			'css' => function () {
				$this->builder->command('stylecow convert css/styles.css '.PUBLIC_ROOT.'/css/styles.css --manifest css-build.json');
			},
			'js' => function () {
				$this->builder->command('r.js -o js-build.js');
			}
		]);
	}
}
