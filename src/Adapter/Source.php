<?php
namespace Pwiki\Adapter;
use Pwiki\Config;

class Source {
	public static function setMarkdownFile($title)
	{
		$config = Config::instance();
		$markdownFile = $config->markdownPath."/".$title.".md";
		$handle = fopen($markdownFile,"w");
		fwrite($handle, "");
		fclose($handle);
	}

	public static function putMarkdownContent($title, $content)
	{
		$config = Config::instance();
		$markdownFile = $config->markdownPath."/".$title.".md";
		$handle = fopen($markdownFile,"w");
		fwrite($handle, $content);
		fclose($handle);
	}

	public static function mvMarkdownFile($oldTitle, $newTitle)
	{
		$config = Config::instance();
		$oldMarkdownFile = $config->markdownPath."/".$oldTitle.".md";
		$newMarkdownFile = $config->markdownPath."/".$newTitle.".md";
		unlink($oldMarkdownFile);
	}

	public static function delHtmlFile($category, $oldTitle, $newTitle)
	{
		$config = Config::instance();
		//$newHtmlFile = $config->htmlPath.$category."/".$newTitle.".html";
		$oldHtmlFile = $config->htmlPath.$category."/".$oldTitle.".html";
		//unlink($newHtmlFile);
		unlink($oldHtmlFile);
	}
}
