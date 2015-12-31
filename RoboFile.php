<?php

require __DIR__.'/bootstrap.php';

/**
 * This is project's console commands configuration for Robo task runner.
 *
 * @see http://robo.li/
 */
class RoboFile extends \Robo\Tasks
{
    /**
     * Run the server.
     */
    public function run()
    {
        $url = env('APP_CLI_SERVER_URL');

        //php server
        $this->taskServer(parse_url($url, PHP_URL_PORT) ?: 80)
            ->env([
                'APP_URL' => $url,
                'APP_DEV' => 'true',
            ])
            ->arg('server.php')
            ->background()
            ->run();

        //gulp + browser sync
        $this->taskExec('node node_modules/.bin/gulp sync')
            ->env([
                'APP_DEV' => 'true',
                'APP_URL' => $url,
                'APP_SYNC_PORT' => env('APP_SYNC_PORT'),
            ])
            ->run();
    }

    /**
     * Build the site.
     */
    public function build()
    {
        //Remove the previous building
        $this->taskFilesystemStack()
            ->remove('build')
            ->mkdir('build')
            ->run();

        //Build the site
        (new Site())->build($this->getOutput());

        //Generate + optimize
        $this->taskExec('node node_modules/.bin/gulp')
            ->env([
                'APP_URL' => env('APP_URL'),
            ])
            ->run();
    }

    /**
     * Publish the static site in the server using rsync
     * You have to configure the path connection in .env > APP_PUBLISH_RSYNC.
     */
    public function publish()
    {
        $this->build();

        $this->taskRsync()
            ->fromPath('build/')
            ->toPath(env('APP_PUBLISH_RSYNC'))
            ->recursive()
            ->run();
    }
}
