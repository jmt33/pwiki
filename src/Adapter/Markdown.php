<?php 
namespace Adapter;

class Markdown {
	public static function getFile()
	{
		//file_get_contents()
	}

	public static function setFile($title)
	{
		$markdownFile = MARKDOWNPATH."/".$title.".md";
		$handle = fopen($markdownFile,"w");
		fwrite($handle, "");
		fclose($handle);
	}
}