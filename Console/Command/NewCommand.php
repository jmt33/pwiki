<?php
namespace Console\Command;
use \Adapter\FileData;
use \Adapter\Markdown;
use \Michelf\MarkdownExtra;

class NewCommand extends AbstractCommand
{
	public function __construct()
	{
		parent::__construct();
	}
	protected function configure()
	{
		parent::configure();
	}

	//markdown文件生成
	public function execute($commands)
	{
		$this->setCommands($commands);
		$title = trim($this->commands[3], '"');
		$category = trim($this->commands[5], '"');
		$time = date("YmdHis", time());
		$data = array(
			'key' => $time,
			'title' => $title,
			'category' => $category
		);

		FileData::setData($data);
		Markdown::setFile($time."_".$title);
	}
}