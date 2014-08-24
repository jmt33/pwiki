<?php 
namespace Console\Command;


abstract class AbstractCommand
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

    protected function __construct()
    {
        
    }

	protected function configure()
    {
    	
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