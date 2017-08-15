<?php

function classLoader($class) {
    $path = str_replace(['\\', 'Iris/NsqToSwoole/'], [DIRECTORY_SEPARATOR, ''], $class);
    $file = __DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . $path . '.php';
    var_dump($file);
    if (file_exists($file)) {
        require_once $file;
    }
}

spl_autoload_register('classLoader');
