<?php
namespace Pwiki;
use Closure;
class Config
{
    public $markdownPath = '';

    public $htmlPath = '';

    public $htmlIndexFile = '';

    public $databaseFile = '';

    public $commentPlugin = '';

    public $pageInfo = [];

    private static $instances = array();

    /**
     * Static method for instantiating a singleton object.
     *
     * @return object
     */
    public static function instance()
    {
        $class_name = get_called_class();

        if (!isset(self::$instances[$class_name]))
            self::$instances[$class_name] = new $class_name;

        return self::$instances[$class_name];
    }

    public static function initialize(Closure $initializer)
	{
		$initializer(static::instance());
	}

    public function set($params)
    {
        $this->pageInfo['title'] = isset($params['pageInfo']['title']) ? $params['pageInfo']['title'] : '';
        $this->pageInfo['keywords'] = isset($params['pageInfo']['keywords']) ? $params['pageInfo']['keywords'] : '';
        $this->pageInfo['description'] = isset($params['pageInfo']['description']) ? $params['pageInfo']['description'] : '';
        $this->markdownPath = $params['markdownPath'];
        $this->htmlPath = $params['htmlPath'];
        $this->htmlIndexFile = $params['htmlIndexFile'];
        $this->databaseFile = $params['databaseFile'];
        $this->commentPlugin = $params['commentPlugin'];
    }
}
