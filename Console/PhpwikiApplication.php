<?php 
namespace Console;

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
        if ($count !== 6) {
            throw new \Exception("参数错误", 1);
        }
    }

    private function _generate()
    {
        $count = count($this->commands);
        if ($count < 2) {
            throw new \Exception("参数错误", 1);
        }
    }

    private function _status()
    {
        exit('功能暂未开发');
    }

    public function getAction()
    {
        return $this->commands[1];
    }

}