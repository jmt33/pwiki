<?php 
include "./bootstrap.php";

class AppTester extends \PHPUnit_Framework_TestCase
{
    public function testMarkDownPath()
    {
        $dir = is_dir(MARKDOWNPATH);
        $this->assertFalse(!$dir);
    }

    public function testHtmlPath()
    {
        $dir = is_dir(HTMLPATH);
        $this->assertFalse(!$dir);
    }

    public function testHtmlIndexPath()
    {
        $this->assertFileExists(HTMLINDEXPATH);
    }

    public function testDatabasePath()
    {
        $this->assertFileExists(DATABASEPATH);
    }

    public function testNew()
    {

    }

    public function testGenerateAll()
    {

    }

    public function testGenerateOne()
    {

    }
}