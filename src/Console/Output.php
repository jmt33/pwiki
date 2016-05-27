<?php
namespace Console;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Input\ArrayInput;

/**
 * 输出封装类
 */
class Output extends \Symfony\Component\Console\Command\Command
{

    function __construct($name = null)
    {
        parent::__construct($name);
    }


    function callCommand($command, $arguments = [], $output = null)
    {
        $command = $this->getApplication()->find($command);
        $input = new ArrayInput(array_merge(['command' => $command], $arguments));
        return $command->run($input, $output ? $output : self::getOutput());
    }


    static function getOutput()
    {
        return new ConsoleOutput();
    }

    protected function _w_info($text)
    {
        $output = self::getOutput();
        $output->writeln('<info>' . $text . '</info>');
        return $output;
    }


    protected function _w_comment($text)
    {

        self::getOutput()->writeln('<comment>' . $text . '</comment>');
    }

    protected function _w_question($text)
    {
        self::getOutput()->writeln('<question>' . $text . '</question>');
    }

    protected function _w_error($text)
    {
        self::getOutput()->writeln('<error>' . $text . '</error>');
        die(1);
    }

    protected function _getDefaultCommands()
    {
        return '<status|start|stop|restart>';
    }
}