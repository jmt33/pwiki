<?php
namespace Console\Command;
use \Adapter\Convert;
use \Adapter\FileData;

class GenerateCommand extends AbstractCommand
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
		$keys = array();
		$this->setCommands($commands);
		if (isset($this->commands[2])) {
			$keys[] = $this->commands[2];
		} else {
			$keys = array_keys(FileData::getData());
		}
		if (!empty($keys)) {
			foreach ($keys as $key) {
				$convert = new Convert($key);
				$convert->run();
			}
		}
	}
}