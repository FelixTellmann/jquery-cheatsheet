<?php

use Psr7Middlewares\Middleware;
use League\Plates\Engine;

/**
 * Class to generate the site and serve files.
 */
class Site extends Statico\Site
{
    public function __construct()
    {
        $this->setUrl(env('APP_URL'));

        $this->pipe(Middleware::errorHandler());
        $this->pipe(Middleware::formatNegotiator());

        $templates = new Engine($this->getPath('source/templates'));
        $templates->addData(['app' => $this]);

        $this->staticFiles('build/**/*')
            ->build(false);

        $this->staticFiles('source/files/*');

        $this->yamlFiles('source/data/*.yml')
            ->templates($templates)
            ->pipe(Middleware::piwik('//oscarotero.com/piwik/')->addOption('disableCookies'));
    }
}
