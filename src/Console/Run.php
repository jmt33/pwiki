<?php
namespace Console;
use \Symfony\Component\Console\Application;

class Run
{
    public $Application = null;
    
    const COMMANDS_PATH = 'Console/Options/';

    public function __construct()
    {
        $this->Application = new Application();
    }

    public function start()
    {
        $this->_scanCommandsDir();
        $this->Application->run();
    }

    private function _scanCommandsDir()
    {
        $path = DOCROOT . self::COMMANDS_PATH;
        if (!is_dir($path)) {
            die('目录不存在');
        }
        $options = scandir($path);
        foreach ($options as $option) {
            if (!in_array($option, ['.', '..'])) {
                $className = "\\Console\\Options\\". ucfirst(str_replace('.php', '', $option));
                $this->_addCommands($className);
            }
        }
    }

    private function _addCommands($className)
    {
        $this->Application->add(new $className());
    }
}
