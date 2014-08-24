<?php
	define("html_dir", "/home/mtao/project/");

	spl_autoload_register(
		function($class){
			require preg_replace(
			'{\\\\|_(?!.*\\\\)}',
			DIRECTORY_SEPARATOR,
			ltrim($class, '\\')).'.php';
		}
	);

	//use \Michelf\Markdown;
	use \Michelf\MarkdownExtra;

	$text = file_get_contents('/home/mtao/test.md');
	//$html = Markdown::defaultTransform($text);

	
	$my_html = MarkdownExtra::defaultTransform($text);
	//$html = SmartyPants::defaultTransform($my_html);


$html = <<<HTML
<!DOCTYPE html>
<html>
    <head>
    	<meta charset=utf-8>
        <title>PHP Markdown Lib - Readme</title>
        <link href="http://demo.simiki.org/static/css/tango.css" rel="stylesheet"></link>
        <link href="http://demo.simiki.org/static/css/style.css" rel="stylesheet"></link>
    </head>
    <body>
    	<div id="container">
			{$my_html}
		</div>
    </body>
</html>
HTML;

echo $html;