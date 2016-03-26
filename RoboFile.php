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
        $this->clean();

        $env = [
            'APP_DEV' => 'true',
            'APP_URL' => 'http://127.0.0.1:8000',
        ];

        //php server
        $this->taskServer(parse_url($env['APP_URL'], PHP_URL_PORT))
            ->env($env)
            ->arg('server.php')
            ->background()
            ->run();

        //gulp + browser sync
        $this->taskExec('node node_modules/.bin/gulp sync')
            ->env($env)
            ->run();
    }

    /**
     * Build the site.
     */
    public function build()
    {
        $this->clean();

        //Build the site
        Site::build();

        //Generate + optimize
        $this->taskExec('node node_modules/.bin/gulp')
            ->env(['APP_URL' => env('APP_URL')])
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

    /**
     * Remove the previous building
     */
    private function clean()
    {
        $this->taskFilesystemStack()
            ->remove('build')
            ->mkdir('build')
            ->run();
    }
}
