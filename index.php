<?php
$currentDir = __DIR__;

$composerAutoload = $currentDir."/vendor/autoload.php";

if (!file_exists($composerAutoload)) {
    exit("请安装您的composer依赖");
}

if (isset($_SERVER['REQUEST_URI'])) {
    if ($_SERVER['REQUEST_URI'] === '/') {
        require $currentDir.'/src/view.php';
    } else {
        header("Content-Type:application/json");
        $uri = explode("/", $_SERVER['REQUEST_URI']);
        $namespace = "Pwiki\\".ucfirst($uri[1])."\\".ucfirst($uri[2]);
        if (class_exists($namespace)) {
            $class = new $namespace();
            $class->actionIndex();
    }
}
