<?php
define('BASE_PATH', str_replace('\\', '/', __DIR__));


//Init the composer loader
$composer = require BASE_PATH.'/vendor/autoload.php';


//Define basic constants
foreach (require 'constants.local.php' as $name => $value) {
	define($name, $value);
}

unset($name, $value);
