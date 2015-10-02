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
     * Install all npm and bower components
     */
    public function install()
    {
        //npm + bower
        $this->taskNpmInstall()->run();
        $this->taskBowerInstall('node_modules/.bin/bower')->run();
    }

    /**
     * Generate the assets
     */
    public function assets()
    {
        //Execute css/js generation
        $this->taskExec('node node_modules/.bin/stylecow -c stylecow.json')->run();
        $this->taskExec('node node_modules/.bin/r.js -o js.js')->run();
    }

    /**
     * Run a php server
     *
     * @option $sync Sync the browser with the changes
     */
    public function server($opts = ['sync' => false])
    {
        $this->assets();

        $server = $this->taskServer(parse_url(env('APP_CLI_SERVER_URL'), PHP_URL_PORT) ?: 80)->arg('server.php');

        if ($opts['sync']) {
            $server->background()->run();
            $this->taskExec('node sync.js')
                ->arg(env('APP_CLI_SERVER_URL'))
                ->run();
        } else {
            $server->run();
        }
    }

    /**
     * Build the site in ./public
     */
    public function build()
    {
        //Clear public
        $this->taskFilesystemStack()
            ->remove('public')
            ->mkdir('public')
            ->copy('source/.htaccess', 'public/.htaccess')
            ->run();

        $this->assets();

        Site::build();
    }

    /**
     * Publish the static site in the server using rsync
     * You can configure the path connection in .env > APP_PUBLISH_RSYNC
     */
    public function publish()
    {
        $this->taskRsync()
            ->fromPath('public/')
            ->toPath(env('APP_PUBLISH_RSYNC'))
            ->recursive()
            ->run();
    }
}