<?php
namespace Pwiki\Console;


abstract class AbstractOption extends Output
{

    /**
     * @var \ArrayAccess
     */
    protected $container = null;

    /**
     * @var AdapterInterface
     */
    protected $adapter = null;

    /**
     * @var string
     */
    protected $bootstrap = null;

    protected $commands = array();

    public function __construct($name = null)
    {
        parent::__construct($name);
    }

    protected function getHtmlPath()
    {
        return MARKDOWNPATH;
    }

    protected function getMarkdownPath()
    {
        return MARKDOWNPATH;
    }

    protected function setCommands($commands)
    {
        $this->commands = $commands;
    }

    protected function getCommands()
    {
        return $this->commands;
    }
}
