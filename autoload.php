<?php
spl_autoload_register(function($className){    
    $sources = [
        "lib/$className.php",
        "controllers/$className.php",
        "views/$className.php",
        "models/$className.php"
            ];
    foreach ($sources as $source) {
        if (file_exists($source)) {
            return require_once $source;
        }
    }
});