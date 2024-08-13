<?php
spl_autoload_register(function(string $class) {
    $currentDir = __DIR__;
    $filePath = $currentDir . "/{$class}.php";
   if (file_exists($filePath)) {
       require_once($filePath);
   };
});
