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

    public function getCategory()
    {
        $config = Config::instance();
        $category = [];
        foreach ($config->data as $data) {
            $category[] = $data['category'];
        };
        return array_values(array_unique($category));
    }
}
