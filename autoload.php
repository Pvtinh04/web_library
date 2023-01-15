<?php
session_start();

spl_autoload_register('autoload');

function autoload($className)
{
    $paths = [
        'app/commons/',
        'app/helpers/',
        'app/models/',
        'app/controllers/',
        'app/exceptions/'
    ];

    $parts = explode('\\', $className);
    $name = array_pop($parts);

    foreach ($paths as $path) {
        $file = sprintf($path . '%s.php', $name);
        if (file_exists($file)) {
            include_once $file;
        }
    }
}