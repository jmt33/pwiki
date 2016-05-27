<?php
$dir = __DIR__;
include_once $dir."/../vendor/autoload.php";

class PwikiTest
{

    public function test($dir)
    {
        $bootstrap = new \Pwiki\Bootstrap();
        $bootstrap->setConfig(
            array(
                'markdownPath' => $dir."/markdown/",
                'htmlPath' => $dir."/html/",
                'htmlIndexFile' => $dir."/index.html",
                'databaseFile' => $dir."/.log.json"
            )
        );
        // $config = \Pwiki\Config::instance();
        // var_dump($config);
        $bootstrap->run();
    }
}
$pwiki = new PwikiTest();
$pwiki->test($dir);
