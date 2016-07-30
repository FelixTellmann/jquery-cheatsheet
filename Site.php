<?php

use Psr7Middlewares\Middleware;
use League\Plates\Engine;
use Statico\Sources\StaticFiles;
use Statico\Sources\YamlFiles;

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

        $this->source(new StaticFiles('build/**/*'))->build(false);
        $this->source(new StaticFiles('source/files/*'));

        $plates = new Engine($this->getPath('source/templates'));
        $plates->addData(['app' => $this]);

        $this->source(new YamlFiles('source/data/*.yml'))
            ->templates($plates)
            ->pipe(Middleware::piwik('//piwik.oscarotero.com/')->addOption('disableCookies'));
    }
}
