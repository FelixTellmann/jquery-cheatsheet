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
     * Install all npm and bower components.
     */
    public function install()
    {
        //npm + bower
        $this->taskNpmInstall()->run();
        $this->taskBowerInstall('node_modules/.bin/bower')->run();
    }

    /**
     * Run the server.
     */
    public function run()
    {
        $url = env('APP_CLI_SERVER_URL');

        //php server
        $this->taskServer(parse_url($url, PHP_URL_PORT) ?: 80)
            ->arg('server.php')
            ->background()
            ->run();

        //gulp + browser sync
        $this->taskExec('node node_modules/.bin/gulp sync')
            ->env([
                'APP_URL' => $url,
                'APP_SYNC_PORT' => 3000,
            ])
            ->run();
    }

    /**
     * Build the site in ./build.
     */
    public function build()
    {
        //Remove the previous building
        $this->taskFilesystemStack()
            ->remove('build')
            ->mkdir('build')
            ->copy('source/.htaccess', 'build/.htaccess')
            ->run();

        //Build the site
        (new Site())->build($this->getOutput());

        //Generate + optimize
        $this->taskExec('node node_modules/.bin/gulp build')->run();
    }

    /**
     * Publish the static site in the server using rsync
     * You can configure the path connection in .env > APP_PUBLISH_RSYNC.
     */
    public function publish()
    {
        $this->taskRsync()
            ->fromPath('build/')
            ->toPath(env('APP_PUBLISH_RSYNC'))
            ->recursive()
            ->run();
    }
}
