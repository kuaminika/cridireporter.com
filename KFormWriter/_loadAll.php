<?php
// this is temporary untill i get autoload to work
foreach (scandir(dirname(__FILE__)) as $filename)
 {
   

    $path = dirname(__FILE__) . '/' . $filename;
    if (is_file($path) && $path != __FILE__) {
        require_once $path;
    }
}