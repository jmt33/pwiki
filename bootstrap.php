<?php

define('EXT', '.php');
define('DOCROOT', realpath(__DIR__) . '/');
define('CONSOLEPATH', DOCROOT.'Console'.DIRECTORY_SEPARATOR);
define('COMMANDPATH', CONSOLEPATH.'Command'.DIRECTORY_SEPARATOR);
define('MARKDOWNPATH', DOCROOT.'Markdown'.DIRECTORY_SEPARATOR);
define('HTMLPATH', DOCROOT.'Html'.DIRECTORY_SEPARATOR);
define('HTMLINDEXPATH', DOCROOT.'index.html');

spl_autoload_register(
    function($class){
        require preg_replace(
        '{\\\\|_(?!.*\\\\)}',
        DIRECTORY_SEPARATOR,
        ltrim($class, '\\')).'.php';
    }
);

