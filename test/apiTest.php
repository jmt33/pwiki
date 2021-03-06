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
    public $pwiki = null;

    public function setUp()
    {
        $dir = __DIR__;
        $this->pwiki = new \Pwiki\Pwiki(
            array(
                'pageInfo' => [
                    'title' => 'Mtao Blog',
                    'keywords' => '',
                    'description' => ''
                ],
                'markdownPath' => $dir."/markdown/",
                'htmlPath' => $dir."/html/",
                'htmlIndexFile' => $dir."/index.html",
                'commentPlugin' => '<div id="uyan_frame"></div><script type="text/javascript" src="http://v2.uyan.cc/code/uyan.js?uid=2101665"></script>'
            )
        );
    }

    public function testGetArticleByCategory()
    {
        $this->assertCount(
            0,
            $this->pwiki->getArticleByCategory(
                'demo'
            )
        );
    }

    public function testGetArticles()
    {
        $this->assertCount(
            1,
            $this->pwiki->getArticles()
        );
    }

    public function testGetCategory()
    {
        $this->assertArraySubset(
            $this->pwiki->getCategory(),
            [
                'Markdown'
            ]
        );
    }

    public function testGetMarkdownContentByKey()
    {
        $this->assertFalse(
            empty(
                $this->pwiki->getMarkdownContentByKey(20160527221029)
            )
        );
    }

    public function testNewMarkdown()
    {
        $info = $this->pwiki->newMarkdown(
            'Markdown',
            'test',
            'gogo'
        );
        $this->assertFileExists(
            $this->pwiki->config->markdownPath."/".$info['title'].".md"
        );
    }

    public function testPutMarkdownContent()
    {
        $info = $this->pwiki->putMarkdownContent(
            '20160527221029',
            'good',
            'mujia'
        );
        $file = $this->pwiki->config->markdownPath."/".$info['title'].".md";
        if (file_exists($file)) {
            $this->assertSame(
                file_get_contents($file),
                'mujia'
            );
        } else {
            throw new \Exception("Error: file not exists");
        }
    }

    public function tearDown()
    {
        shell_exec("rm -rf {$this->pwiki->config->markdownPath} && git checkout {$this->pwiki->config->markdownPath}");
    }
}
