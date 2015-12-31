<?php

use Fol\Builder\App;

/**
 * Class to generate the site and serve files.
 */
class Site extends App
{
    public function __construct()
    {
        $this->setUrl(env('APP_URL'));

        $this->addServer('pages', 'data/*.yml');
        $this->addServer('files', 'files/*');
    }
}
