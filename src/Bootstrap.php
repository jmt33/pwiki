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
        $data = \Pwiki\Adapter\FileData::getData();
        $category = [];
        foreach ($data as $key => $value) {
            if (!in_array($value['category'], $category)) {
                $category[] = $value['category'];
            }
        }
        return $category;
    }
}
