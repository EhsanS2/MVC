<?php

namespace App;

use mysql_xdevapi\Exception;

class View {
    private static $_extension = '.php';
    public static function render($viewPath, $data) {
        $viewPath = str_replace('.', DS, $viewPath);
        $path =  VIEWPATH . $viewPath . self::$_extension;
        if(is_readable($path)) {
            include $path;
        } else {
            throw new Exception("View ({$path}) is not accessable");
        }
    }
}