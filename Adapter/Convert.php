<?php
namespace Adapter;
use \Adapter\FileData;
use \Tool\Markdown;

class Convert
{
	private $_key = '';
	private $_htmlFile = '';
	private $_htmlCategory = '';
	private $_markdown = '';
	# 是否强制覆盖
	private $_isOverFlow = false;

	private $_data = array();
	public function __construct($key)
	{
		$this->_key = $key;
	}

	private function _configure()
	{
		$data = $this->_data;
		$key = $this->_key;
		if (!isset($data[$key])) {
			throw new \Exception("没有此文件", 1);
		} else {
			$this->_htmlCategory = HTMLPATH.$data[$key]['category']."/";
			$this->_htmlFile = $this->_htmlCategory.$key."_".$data[$key]['title'].".html";
			$this->_markdown = MARKDOWNPATH.$key."_".$data[$key]['title'].".md";
		}
	}

	public function run()
	{
		$this->readyPageContent();
		$this->readyIndexContent();
	}

	public function readyPageContent()
	{
		if ($this->_markdown) {
			#如果不强制生成
			if (!$this->_isOverFlow && is_file($this->_htmlFile)) {
				return;
			}
			if (!is_dir($this->_htmlCategory)) {
				mkdir($this->_htmlCategory, 0777);
			}
			$content = $this->_data[$this->_key];
			$head_html = "
			<div id='post-nav'>
				<a href='../../index.html'>Home</a>&nbsp;»&nbsp;
				<a href='../../index.html#{$content['category']}'>{$content['category']}</a>&nbsp;»&nbsp;{$content['title']}
			</div>
			";

			$text = file_get_contents($this->_markdown);

			$markdown = new Markdown();

			$page_html = $markdown->text($text);

			$page_html = $head_html.$page_html;
			$handle = fopen($this->_htmlFile, "w");
			$contents = fwrite($handle, $this->renderPage($page_html));
			fclose($handle);
		}
	}

	public function readyIndexContent()
	{
		if (!$this->_markdown) {
			return false;
		}

		$category = array();
		if (!empty($this->_data)) {
			foreach ($this->_data as $data) {
				$category[$data['category']][$data['key']] = $data;
			}
		}

		$html = '';
		foreach ($category as $key => $cols) {
			$listHtml = '';
			foreach ($cols as $list) {
				$listHtml = $listHtml."<li class='pagelist'>
		          <a href='./Html/{$key}/{$list['key']}_{$list['title']}.html'>{$list['title']}</a>
		        </li>";
			}
			$html = $html.<<<HTML
				<h2 id="{$key}">{$key}</h2>
		        <ul>
		        	{$listHtml}
		        </ul>
HTML;
		}

		$handle = fopen(HTMLINDEXPATH, "w");
		fwrite($handle, $this->renderIndex($html));
		fclose($handle);
	}

	public function renderPage($page_html)
	{
		$html = <<<HTML
<!DOCTYPE html>
<html>
    <head>
        <meta charset=utf-8>
        <title>PHP Markdown Lib - Readme</title>
        <link href="http://jmt33.github.io/mtao/static/css/tango.css" rel="stylesheet"></link>
        <link href="http://jmt33.github.io/mtao/static/css/style.css" rel="stylesheet"></link>
    </head>
    <body>
        <div id="container">
            {$page_html}
        </div>
    </body>
</html>
HTML;

		return $html;
	}

	public function renderIndex($index_html)
	{
		$html = <<<HTML
			<!DOCTYPE HTML>
			<html>
			    <head>
			        <link rel="Stylesheet" type="text/css" href="http://jmt33.github.io/mtao/static/css/tango.css">
			        <link rel="Stylesheet" type="text/css" href="http://jmt33.github.io/mtao/static/css/style.css">
			        <title>为什么坚持，想一想当初</title>
			        <meta name="keywords" content="wiki"/>
			        <meta name="description" content="This is a demo wiki"/>
			        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
			    </head>

			    <body>
			        <div id="container">

				    <div id="wiki_title">为什么坚持，想一想当初</div>

				    <div id="index">
				    	{$index_html}
				      	<div class="clearfix"></div>
				    </div>

			        </div>
			        <div id="footer">
			            <span>
			                Copyright © 2012-2014 Mtao.
			            </span>
			        </div>

			    </body>
			</html>
HTML;
		return $html;
	}

	public function setData($data)
	{
		$this->_data = $data;
		$this->_configure();
	}

	public function setOverFlow($overFlow)
	{
		$this->_isOverFlow = $overFlow;
	}
}
?>
