<?php

define('EXT', '.php');
define('DOCROOT', realpath(__DIR__) . '/');
define('CONSOLEPATH', DOCROOT.'Console'.DIRECTORY_SEPARATOR);
define('COMMANDPATH', CONSOLEPATH.'Command'.DIRECTORY_SEPARATOR);
# 生成markdown的文件夹
define('MARKDOWNPATH', DOCROOT.'Markdown'.DIRECTORY_SEPARATOR);
# 生成html的文件夹
define('HTMLPATH', DOCROOT.'Html'.DIRECTORY_SEPARATOR);
# 引导index.html
define('HTMLINDEXPATH', HTMLPATH.'/../index.html');

spl_autoload_register(
    function($class){
        require preg_replace(
        '{\\\\|_(?!.*\\\\)}',
        DIRECTORY_SEPARATOR,
        ltrim($class, '\\')).'.php';
    }
);

