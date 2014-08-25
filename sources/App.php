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
			return new Builder(new FileSystem(BASE_PATH.'/sources'), new FileSystem(BASE_PATH.'/public'), $input, $output);
		});
	}

	public function build ()
	{
		$this->builder
			->clear()
			->render(['data' => 'pages', 'templates' => 'templates'])
			->copy('components/requirejs')
			->command([
				'stylecow convert css/styles.css ../public/css/styles.css --manifest css-build.json',
				'r.js -o js-build.js'
			]);
	}
}
