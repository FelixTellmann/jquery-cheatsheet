<?php
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

$console = new Application();

$console
	->register('build')
	->setDescription('Build all pages')
	->setCode(function (InputInterface $input, OutputInterface $output) {
		$app = new App\App($input, $output);

		$app->build();
	});

$console
	->register('watch')
	->setDescription('Watch changes in sources')
	->setCode(function (InputInterface $input, OutputInterface $output) {
		$app = new App\App($input, $output);

		$app->watch();
	});

$console
	->register('install')
	->setDescription('Install all dependencies')
	->setCode(function (InputInterface $input, OutputInterface $output) {
		$app = new App\App($input, $output);

		$app->install();
	});

$console->run();
