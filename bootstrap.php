<?php
if (!ini_get('date.timezone')) {
    ini_set('date.timezone', 'Europe/Madrid');
}

//Error configuration
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

//Init global libraries
$composer = include __DIR__.'/vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

Fol::setGlobal('composer', $composer);
Fol::setGlobal('dotenv', $dotenv);
