<?php
namespace Pwiki;
class Bootstrap
{
    public function setConfig($params)
    {
        Config::initialize(
            function($cfg) use ($params) {
                $cfg->set($params);
            }
        );
    }

    public function run()
    {
        $runner = new Console\Run();
        $runner->start();
    }
}
