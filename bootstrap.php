<?php
require __DIR__ . '/vendor/autoload.php';

define('EXT', '.php');
define('DOCROOT', realpath(__DIR__) . '/');
define('CONSOLEPATH', DOCROOT.'Console'.DIRECTORY_SEPARATOR);
define('COMMANDPATH', CONSOLEPATH.'Command'.DIRECTORY_SEPARATOR);


include DOCROOT.'Config/Define.php';

spl_autoload_register(
    function($class){
        require preg_replace(
        '{\\\\|_(?!.*\\\\)}',
        DIRECTORY_SEPARATOR,
        ltrim($class, '\\')).'.php';
    }
);

