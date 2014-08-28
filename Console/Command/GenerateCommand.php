<?php
namespace Console\Command;
use \Adapter\Convert;
use \Adapter\FileData;
use \Adapter\Helper;

class GenerateCommand extends AbstractCommand
{
	//参数
	public static $params = array(
		'-r', # 全部覆盖
		'-s', # 单个文件的生成
		'-i'  # 忽略已有文件
	);

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
		$data = FileData::getData();
		$this->setCommands($commands);

		if (!isset($this->commands[2]) || !in_array($this->commands[2], self::$params)) {
			Helper::writeln("参数错误", "error");
		}

		$param = $this->commands[2];

		//是否覆盖已有文件
		$overFlow = ($param === '-r' || $param === '-s') ?
			true :
			false;

		if ($this->commands[2] == '-s') {
			if (!isset($this->commands[3])) {
				Helper::writeln("少了要生成的版本~", "error");
			}
			$keys[] = $this->commands[3];
		} else {
			$keys = array_keys($data);
		}


		if (!empty($keys)) {
			foreach ($keys as $key) {
				$convert = new Convert($key);
				$convert->setData($data);
				$convert->setOverFlow($overFlow);
				$convert->run();
			}
		}
	}
}