<?php
$dir = __DIR__;
$autoloadFile = $dir."/../vendor/autoload.php";
if (file_exists($autoloadFile)) {
    include_once $dir."/../vendor/autoload.php";
} else {
    die("Please run `composer install`, to install the depend");
}

class ApiTest extends \PHPUnit_Framework_TestCase
{
    public function testGetCategory()
    {
        $dir = __DIR__;
        $pwiki = new \Pwiki\Pwiki(
            array(
                'pageInfo' => [
                    'title' => 'Mtao Blog',
                    'keywords' => '',
                    'description' => ''
                ],
                'markdownPath' => $dir."/markdown/",
                'htmlPath' => $dir."/html/",
                'htmlIndexFile' => $dir."/index.html",
                'databaseFile' => $dir."/.log.json",
                'commentPlugin' => '<div id="uyan_frame"></div><script type="text/javascript" src="http://v2.uyan.cc/code/uyan.js?uid=2101665"></script>'
            )
        );
        $this->assertArraySubset(
            $pwiki->getCategory(),
            [
                'Markdown'
            ]
        );
    }

    public function test
}
