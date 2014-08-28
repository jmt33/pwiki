<?php 
namespace Console;
use \Adapter\Helper;
class PhpwikiApplication
{
    public $command = array();

    public static $argv = array(
        'new',
        'generate',
        'status'
    );
    public function __construct($version = 'dev')
    {
        $this->getCommand();
        $this->execute();
    }

    public function getCommand()
    {
        $this->commands = $_SERVER['argv'];
        return call_user_func(array($this, '_' . $this->commands[1]));
    }

    public function execute()
    {
        $model = "\\Console\\Command\\".ucfirst($this->getAction())."Command";
        $command = new $model();
        $command->execute($this->commands);
    }

    private function _new()
    {
        $count = count($this->commands);
        if ($count !== 6 || $this->commands['2'] !== '-t' || $this->commands['4'] !== '-c') {
            Helper::writeln("参数错误", "error");
        }
    }

    private function _generate()
    {
        $count = count($this->commands);
        if ($count < 2) {
            Helper::writeln("参数错误", "error");
        }
    }

    private function _status()
    {
        Helper::writeln("功能暂未开发", "error");
    }

    public function getAction()
    {
        return $this->commands[1];
    }

}