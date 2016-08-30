<?php
$currentDir = __DIR__;
if (isset($_SERVER['REQUEST_URI'])) {
    if ($_SERVER['REQUEST_URI'] === '/') {
        require $currentDir."/src/view.php";
    }
}
