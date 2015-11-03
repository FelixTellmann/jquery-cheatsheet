<?php
use Fol\Builder\App;
use Psr7Middlewares\Middleware;

/**
 * Class to generate the site and serve files
 */
class Site extends App
{
    protected $sourcesDir = 'source';
    protected $buildDir = 'build';

    public function __construct()
    {
        $this->addServer('pages', 'data/*.yml');
        $this->addServer('files', 'files/*');
    }
}
