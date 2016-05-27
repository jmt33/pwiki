<?php
namespace Pwiki\Adapter;
use Pwiki\Config;

class Markdown {
	public static function getFile()
	{
		//file_get_contents()
	}

	public static function setFile($title)
	{
		$config = Config::instance();
		$markdownFile = $config->markdownPath."/".$title.".md";
		$handle = fopen($markdownFile,"w");
		fwrite($handle, "");
		fclose($handle);
	}
}
