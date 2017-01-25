<?php
namespace Pwiki;
class Pwiki
{
    public function __construct($params)
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

    public static function setMarkdownFile($title)
	{
		$config = Config::instance();
		$markdownFile = $config->markdownPath."/".$title.".md";
		$handle = fopen($markdownFile,"w");
		fwrite($handle, "");
		fclose($handle);
	}

	public function putMarkdownContent($title, $content)
	{
		$config = Config::instance();
		$markdownFile = $config->markdownPath."/".$title.".md";
		$handle = fopen($markdownFile,"w");
		fwrite($handle, $content);
		fclose($handle);
	}

	public function mvMarkdownFile($oldTitle, $newTitle)
	{
		$config = Config::instance();
		$oldMarkdownFile = $config->markdownPath."/".$oldTitle.".md";
		$newMarkdownFile = $config->markdownPath."/".$newTitle.".md";
		unlink($oldMarkdownFile);
	}

	public function delHtmlFile($category, $oldTitle, $newTitle)
	{
		$config = Config::instance();
		//$newHtmlFile = $config->htmlPath.$category."/".$newTitle.".html";
		$oldHtmlFile = $config->htmlPath.$category."/".$oldTitle.".html";
		//unlink($newHtmlFile);
		unlink($oldHtmlFile);
	}
}
